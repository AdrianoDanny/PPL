@extends('layouts.dashboardAdmin')

@section('content')
<div class="container-fluid" style="background: #f4f6fa; min-height:100vh;">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 p-0" style="background: #22314e; min-height:100vh;">
            <div class="text-center py-4">
                <div style="background:#fff; border-radius:50%; width:70px; height:70px; margin:auto;">
                    <i class="fa fa-user" style="font-size:40px; color:#22314e; line-height:70px;"></i>
                </div>
                <div class="mt-3" style="color:#fff; font-weight:bold;">JOHN DON</div>
                <div style="color:#b0b8c1; font-size:13px;">johndon@company.com</div>
            </div>
            <ul class="nav flex-column mt-4">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('homepage') }}"><i class="fa fa-home"></i> Home</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-file"></i> Kambing</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-envelope"></i> Pemasok</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-bell"></i> Customer</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="#"><i class="fa fa-map-marker"></i> Transaksi</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('goat.diagnose') }}"><i class="fa fa-map-marker"></i> Deteksi Penyakit</a></li>
            </ul>
        </div>
        <!-- Main Content -->
        <div class="col-md-10">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Sistem Deteksi Penyakit Kambing</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('goat.diagnose') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="gejala">Pilih gejala yang dialami kambing:</label>
                                    <select name="gejala[]" id="gejala" class="form-control" multiple size="10">
                                        <option value="gatal">Gatal</option>
                                        <option value="demam">Demam</option>
                                        <option value="lemas">Lemas</option>
                                        <option value="mata berair">Mata berair</option>
                                        <option value="batuk">Batuk</option>
                                        <option value="diare">Diare</option>
                                        <option value="luka kulit">Luka kulit</option>
                                        <option value="berat badan turun">Berat badan turun</option>
                                    </select>
                                    <small class="form-text text-muted">
                                        Gunakan Ctrl+klik untuk memilih beberapa gejala
                                    </small>
                                </div>

                                <button type="submit" class="btn btn-primary mt-3">Diagnosa</button>
                            </form>

                            @if(isset($results))
                                <div class="mt-4">
                                    @if(count($results) > 0)
                                        <div class="alert alert-success">
                                            <h5>🩺 Kemungkinan penyakit kambing:</h5>
                                            <ul>
                                                @foreach($results as $penyakit)
                                                    <li>{{ $penyakit }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <div class="alert alert-warning">
                                            ❌ Tidak ada penyakit yang terdeteksi berdasarkan gejala tersebut.
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

@endsection
