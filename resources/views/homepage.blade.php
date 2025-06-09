@extends('layouts.app')

@section('content')
<!-- Header -->
<section class="bg-green-700 text-white py-6">
    <div class="container mx-auto flex flex-col md:flex-row items-center justify-center gap-4 px-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-20 h-20 object-contain">

        <p class="text-center md:text-left max-w-xl">
            <strong>Goatbiz</strong>: Aplikasi berbasis website untuk jual beli kambing serta sistem analisis usaha ternak untuk meningkatkan efisiensi manajemen peternakan kambing.
        </p>
    </div>
</section>

<!-- Our Product -->
<section class="py-8 bg-white text-center">
    <h2 class="text-xl font-semibold bg-green-600 text-white inline-block px-4 py-1 rounded-md mb-6">OUR PRODUCT</h2>
    <div class="flex flex-wrap justify-center gap-4 px-4">
        @foreach([1,2,3,4,5,6,7,8] as $product)
        <div class="bg-green-100 rounded-md p-2 shadow-md w-40">
            <img src="{{ asset('images/kambing.png') }}" alt="{{ asset('images/images.jpg') }}" class="w-full rounded-md">
        </div>
        @endforeach
    </div>
    <button class="mt-4 bg-green-600 text-white px-4 py-2 rounded-full">Selengkapnya</button>
</section>

<!-- Contact Info & Map -->
<section class="py-8 bg-gradient-to-b from-green-700 to-green-500 text-white">
    <div class="flex flex-col items-center space-y-4">
        <div class="flex justify-center gap-6 flex-wrap text-black">
            <div class="bg-green-100 p-4 rounded-md shadow-md text-center w-48">
                <h3 class="font-bold">Instagram</h3>
                <a href="https://instagram.com/dinap_farm" class="text-blue-600 hover:underline">@dinap_farm</a>
            </div>
            <div class="bg-green-100 p-4 rounded-md shadow-md text-center w-48">
                <h3 class="font-bold">Contact</h3>
                <p>+62 812-3456-7890</p>
            </div>
            <div class="bg-green-100 p-4 rounded-md shadow-md text-center w-48">
                <h3 class="font-bold">Location</h3>
                <p>Lingkaran, Enggal Barat, Lampung</p>
            </div>
        </div>

        <div class="mt-6 w-full max-w-md">
            <iframe class="w-full h-64 rounded-md" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3949.485692507687!2d113.72178947525606!3d-8.153721291876725!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd695b101f2d395:0x14e85a18bacc5877!2sDinap%20Farm!5e0!3m2!1sid!2sid!4v1745322611915!5m2!1sid!2sid" style="border:1px solid #ccc;"></iframe>
        </div>
    </div>
</section>

<!-- About Us -->
<section class="py-10 bg-white text-center px-4">
    <h2 class="text-xl font-semibold bg-green-600 text-white inline-block px-4 py-1 rounded-md mb-4">About Us</h2>
    <p class="mb-4 text-justify max-w-3xl mx-auto">
        Selamat datang di Kambingku.id — platform ladang kambing terpercaya!
        Kami adalah peternakan kambing yang sudah beroperasi lebih dari 10 tahun, dengan penekanan pada penyediaan kambing berkualitas tinggi, perawatan modern, dan kepuasan pelanggan.
        Dengan sistem pemantauan modern dan tim ahli yang berdedikasi, kambing siap kurban hingga aqiqah tersedia dan siap dikirim ke lokasi Anda. Website ini dibuat untuk memudahkan Anda dalam memilih kambing (lengkap dengan foto, detail, dan harga transparan). Kami percaya, beli kambing bisa praktis dan terpercaya!
    </p>
    <div class="flex flex-wrap justify-center gap-4 mt-6">
        <img src="{{ asset('images/foto1.jpg') }}" alt="Peternakan 1" class="w-72 rounded-md shadow-md">
        <img src="{{ asset('images/foto2.jpg') }}" alt="Peternakan 2" class="w-72 rounded-md shadow-md">
    </div>
</section>

@endsection
