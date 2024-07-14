@extends('layouts.main')

@section('navbar-title')
    About
@endsection

@section('content')
<div class="container mx-auto">
    <div class=" flex flex-row p-5">
        <div class="relative flex bg-clip-border rounded-xl bg-white text-gray-700 shadow-md w-full max-w-[48rem] flex-row">
            <div
              class="relative w-1/3 m-0 overflow-hidden text-gray-700 bg-white rounded-l-lg bg-clip-border shrink-0">
              <img
                src="{{asset('foto/foto.jpg')}}"
                alt="card-image" class="object-cover w-full h-full" />
            </div>
            <div class="p-6">
              <h6
                class="block mb-4 font-sans text-base antialiased font-semibold leading-relaxed tracking-normal text-gray-700 uppercase">
                About
              </h6>
              <h4 class="block mb-2 font-sans text-2xl antialiased font-semibold leading-snug tracking-normal text-blue-gray-900">
                Aplikasi ini dibuat ini oleh:
              </h4>
              <p class="block mb-2  font-sans text-base antialiased font-medium leading-relaxed text-gray-700">
                Nama<span class="font-normal pl-9">: Mochammad Mirza Ferdinand Hakim</span>
              </p>
              <p class="block mb-2 font-sans text-base antialiased font-medium leading-relaxed text-gray-700">
                Prodi<span class="font-normal pl-11">: D3 - Teknologi Informasi PSDKU Lumajang</span>
              </p>
              <p class="block mb-2 font-sans text-base antialiased font-medium leading-relaxed text-gray-700">
                NIM<span class="font-normal pl-[55px]">: 2131740014</span>
              </p>
              <p class="block mb-2 font-sans text-base antialiased font-medium leading-relaxed text-gray-700">
                Tanggal<span class="font-normal pl-[18px]">: 13 Juli 2024</span>
              </p>
            </div>
          </div>
    </div>
</div>
@endsection
