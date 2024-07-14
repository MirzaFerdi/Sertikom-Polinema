@extends('layouts.main')

@section('navbar-title')
    Arsip Surat -> Lihat
@endsection

@section('content')
    <div class="container ">
        <div class=" flex flex-row p-5">
            <div class="bg-white shadow-md rounded-md p-4">
                <h1 class="text-xl font-bold ">Keterangan Arsip Surat</h1>
                <p class="text-gray-600"><span class="font-bold">Nomor:</span> {{ $arsip->nomor_surat }}</p>
                <p class="text-gray-600"><span class="font-bold">Kategori:</span> {{ $arsip->kategori->nama_kategori }}</p>
                <p class="text-gray-600"><span class="font-bold">Judul:</span> {{ $arsip->judul }}</p>
                <p class="text-gray-600"><span class="font-bold">Waktu Unggah:</span> {{ $arsip->waktu_pengarsipan }}</p>
            </div>
        </div>
    </div>
    <div class="px-3 mx-4 p-5 w-fit  bg-white shadow-md rounded-lg">
        <iframe class="w-[60rem] h-[30rem]" src="{{ asset('/storage/file_surat/' . $arsip->file) }}" frameborder="0"></iframe>
    </div>
    <div class="flex gap-4 py-3 px-4">
        <x-bladewind::button
            name="btn-unggah"
            type="secondary"
            size="small"
            uppercasing="false"
            onclick="window.history.back();"
        >
            Kembali
        </x-bladewind::button>
        <x-bladewind::button
            name="btn-unggah"
            color="green"
            has_spinner="true"
            type="primary"
            can_submit="true"
            size="small"
            uppercasing="false"
            onclick="window.location.href = '{{ route('arsip.download', $arsip->id) }}';"

        >
            Unduh
        </x-bladewind::button>
        <x-bladewind::button
            name="btn-edit"
            type="primary"
            size="small"
            uppercasing="false"
            onclick="window.location.href = '{{ route('arsip.edit', $arsip->id) }}';"
        >
            Edit/Ganti File
        </x-bladewind::button>
    </div>
@endsection
