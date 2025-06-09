{{-- resources/views/kambing/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Data Kambing</h4>
                    <a href="{{ route('kambing.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Kambing
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Jenis</th>
                                    <th>Berat (kg)</th>
                                    <th>Usia (bulan)</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    @if(Auth::guard('akun')->user()->role === 'admin')
                                        <th>Pemasok</th>
                                    @endif
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kambings as $kambing)
                                    <tr>
                                        <td>
                                            @if($kambing->foto_kambing)
                                                <img src="{{ asset('storage/kambing/' . $kambing->foto_kambing) }}"
                                                     alt="Foto Kambing" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                            @else
                                                <div class="bg-light p-2 text-center" style="width: 60px; height: 60px;">
                                                    <i class="fas fa-image text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>{{ $kambing->jenis }}</td>
                                        <td>{{ $kambing->berat }}</td>
                                        <td>{{ $kambing->usia }}</td>
                                        <td>Rp {{ number_format($kambing->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <span class="badge {{ $kambing->status_tersedia ? 'bg-success' : 'bg-danger' }}">
                                                {{ $kambing->status_tersedia ? 'Tersedia' : 'Tidak Tersedia' }}
                                            </span>
                                        </td>
                                        @if(Auth::guard('akun')->user()->role === 'admin')
                                            <td>{{ $kambing->pemasok->nama ?? '-' }}</td>
                                        @endif
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('kambing.show', $kambing) }}" class="btn btn-info btn-sm">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('kambing.edit', $kambing) }}"
                                                   class="btn btn-warning btn-sm edit-btn"
                                                   data-id="{{ $kambing->id }}">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('kambing.destroy', $kambing) }}"
                                                      method="POST"
                                                      class="d-inline delete-form"
                                                      id="delete-form-{{ $kambing->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                            class="btn btn-danger btn-sm delete-btn"
                                                            data-id="{{ $kambing->id }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ Auth::guard('akun')->user()->role === 'admin' ? '8' : '7' }}" class="text-center">
                                            Tidak ada data kambing
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{ $kambings->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
// Konfirmasi untuk edit
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');

        Swal.fire({
            title: 'Konfirmasi Edit',
            text: 'Apakah Anda yakin ingin mengubah data kambing ini?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Edit!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = href;
            }
        });
    });
});

// Konfirmasi untuk delete[4]
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');

        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: 'Data kambing akan dihapus permanen!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    });
});
</script>
@endpush
