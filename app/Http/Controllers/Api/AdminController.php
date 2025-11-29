<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $guests = Guest::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $guests
        ]);
    }

    public function toggleVisibility($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->is_visible = !$guest->is_visible;
        $guest->save();

        return response()->json([
            'success' => true,
            'message' => 'Visibility updated successfully',
            'data' => $guest
        ]);
    }

    public function destroy($id)
    {
        $guest = Guest::findOrFail($id);
        $guest->delete();

        return response()->json([
            'success' => true,
            'message' => 'Guest deleted successfully'
        ]);
    }
}