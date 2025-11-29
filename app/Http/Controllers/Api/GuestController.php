<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guest;
use Illuminate\Support\Facades\Mail;

class GuestController extends Controller
{
    public function index()
{
    // Ambil semua data dulu, baru filter manual
    $guests = Guest::orderBy('created_at', 'desc')->get();
    
    // Filter yang status != 0 (atau status == 1)
    $filtered = $guests->filter(function($guest) {
        return $guest->status == 1 || $guest->status === true;
    });
    
    return response()->json($filtered->values());
}

   public function store(Request $request)
{
    $data = $request->validate([
        'nama' => 'required|string',
        'email' => 'required|email',
        'pesan' => 'nullable|string',
        'alamat' => 'nullable|string',
        'hadir' => 'required|boolean',
    ]);

    $guest = Guest::create($data);

    // Kirim email dengan PDF attachment
    try {
        $isAttending = $guest->hadir;
        
        // Pilih PDF berdasarkan status kehadiran
        $pdfFile = $isAttending 
            ? public_path('pdfs/hadir.pdf') 
            : public_path('pdfs/tidak_hadir.pdf');

        Mail::raw("Dear {$guest->nama},\n\nThank you for your RSVP confirmation. Please find attached your wedding invitation details.\n\nWarm Regards,\nGeorge & Carmen", function($message) use ($guest, $pdfFile) {
            $message->to($guest->email)
                    ->subject('Wedding RSVP Confirmation - George & Carmen')
                    ->attach($pdfFile, [
                        'as' => 'Wedding-Invitation.pdf',
                        'mime' => 'application/pdf',
                    ]);
        });
        
        \Log::info("Email dengan PDF berhasil dikirim ke {$guest->email} - Status: " . ($guest->hadir ? 'Hadir' : 'Tidak Hadir'));
    } catch (\Exception $e) {
        \Log::error('Email error: ' . $e->getMessage());
    }

    return response()->json([
        'message' => 'Data tamu disimpan dan email konfirmasi telah dikirim', 
        'data' => $guest
    ]);
}

    public function update(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $guest->update($request->all());
        return response()->json($guest);
    }

    public function destroy($id)
    {
        Guest::destroy($id);
        return response()->json(['message' => 'Data tamu dihapus']);
    }
}