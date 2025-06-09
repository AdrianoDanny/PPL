{{-- resources/views/kambing/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Data Kambing</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('kambing.update', $kambing) }}" method="POST" enctype="multipart/form-data" id="update-form">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis Kambing</label>
                                    <input type="text" class="form-control @error('jenis') is-invalid @enderror"
                                           id="jenis" name="jenis" value="{{ old('jenis', $kambing->jenis) }}" required>
                                    @error('jenis')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="berat" class="form-label">Berat (kg)</label>
                                    <input type="number" step="0.1" class="form-control @error('berat') is-invalid @enderror"
                                           id="berat" name="berat" value="{{ old('berat', $kambing->berat) }}" required>
                                    @error('berat')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="usia" class="form-label">Usia (bulan)</label>
                                    <input type="number" class="form-control @error('usia') is-invalid @enderror"
                                           id="usia" name="usia" value="{{ old('usia', $kambing->usia) }}" required>
                                    @error('usia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                           id="harga" name="harga" value="{{ old('harga', $kambing->harga) }}" required>
                                    @error('harga')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if(Auth::guard('akun')->user()->role === 'admin')
                        <div class="mb-3">
                            <label for="pemasok_id" class="form-label">Pemasok</label>
                            <select class="form-control @error('pemasok_id') is-invalid @enderror"
                                    id="pemasok_id" name="pemasok_id" required>
                                <option value="">Pilih Pemasok</option>
                                @foreach($pemasoks as $pemasok)
                                    <option value="{{ $pemasok->id }}"
                                            {{ old('pemasok_id', $kambing->pemasok_id) == $pemasok->id ? 'selected' : '' }}>
                                        {{ $pemasok->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('pemasok_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @else
                        <input type="hidden" name="pemasok_id" value="{{ $kambing->pemasok_id }}">
                        @endif

                        <div class="mb-3">
                            <label for="foto_kambing" class="form-label">Foto Kambing</label>
                            @if($kambing->foto_kambing)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/kambing/' . $kambing->foto_kambing) }}"
                                         alt="Foto Kambing" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                            <input type="file" class="form-control @error('foto_kambing') is-invalid @enderror"
                                   id="foto_kambing" name="foto_kambing" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                            @error('foto_kambing')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror"
                                      id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $kambing->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1"
                                       id="status_tersedia" name="status_tersedia"
                                       {{ old('status_tersedia', $kambing->status_tersedia) ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_tersedia">
                                    Kambing Tersedia
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('kambing.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="button" class="btn btn-primary" id="update-btn">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('update-btn').addEventListener('click', function() {
    Swal.fire({
        title: 'Konfirmasi Update',
        text: 'Apakah Anda yakin ingin menyimpan perubahan data kambing ini?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Update!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('update-form').submit();
        }
    });
});
</script>
@endpush
