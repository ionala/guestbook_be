<!DOCTYPE html>
<html>
<head>
    <title>Admin - Daftar Tamu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><strong>Admin - Daftar Tamu</strong></h2>
            <p class="mb-0">Total tamu: {{ $guests->count() }} orang</p>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <!-- Alert sukses -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>NAMA</th>
                    <th>EMAIL</th>
                    <th>PESAN</th>
                    <th>HADIR</th>
                    <th>STATUS</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($guests as $g)
                <tr>
                    <td><strong>{{ $g->nama }}</strong></td>
                    <td>{{ $g->email }}</td>
                    <td>{{ $g->pesan ?? '-' }}</td>
                    <td>
                        <span class="badge bg-{{ $g->hadir ? 'success' : 'secondary' }}">
                            {{ $g->hadir ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                    <td>
                        <span class="badge bg-{{ $g->status ? 'info' : 'dark' }}">
                            {{ $g->status ? 'Tampil' : 'Hide' }}
                        </span>
                    </td>
                    <td>
                        <!-- Button Toggle (Hide/Tampil) -->
                        <form action="{{ route('admin.guests.toggle', $g->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PUT')
                            <button 
                                type="submit" 
                                class="btn btn-sm btn-{{ $g->status ? 'warning' : 'success' }}"
                                onclick="return confirm('Yakin ingin mengubah status?')">
                                {{ $g->status ? 'Hide' : 'Tampil' }}
                            </button>
                        </form>

                        <!-- Button Delete -->
                        <form action="{{ route('admin.guests.delete', $g->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus data ini?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data tamu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>