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
    </div>
</div>
