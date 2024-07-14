@extends('layouts.main')

@section('navbar-title')
    Kategori Surat -> Edit
@endsection

@section('content')
<div class="container ">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class=" flex flex-row p-5">
        <div class=" px-3">
            <h1 class="text-2xl font-bold ">Tambah Kategori Surat</h1>
            <p class="text-gray-800 text-sm">Tambahkan atau edit data kategori. Jika sudah selesai, <br> jangan lupa untuk mengklik tombol "Simpan" </p>
        </div>
    </div>
    <div class="">
        <x-bladewind::notification />
        <form action="{{route('kategori.update', $kategori->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-4 bg-white shadow-md rounded-md px-5 py-4 mx-5">
                <div class="flex items-center">
                    <p class="font-medium w-36">ID Kategori</p>
                        @php
                           $kategori_id = \App\Models\KategoriSurat::find($kategori->id)->id;
                        @endphp
                        <x-bladewind::input
                            label="ID Kategori"
                            size="small"
                            name="id_kategori"
                            value="{{$kategori_id}}"
                            disabled
                            class="w-1/4"
                        />
                </div>
                <div class="flex items-center">
                    <p class="font-medium w-36">Nama Kategori</p>
                        @php
                            $nama_kategori = \App\Models\KategoriSurat::where('id', $kategori->id)->first()->nama_kategori;
                        @endphp
                        <x-bladewind::input
                            label="Nama Kategori"
                            size="small"
                            name="nama_kategori"
                            required="true"
                            error_message="Masukkan nama kategori"
                            show_error_inline="true"
                            value="{{$nama_kategori}}"
                            class="w-2/5"
                        />
                </div>
                <div class="flex items-center">
                    <p class="font-medium w-36">Keterangan</p>
                        @php
                            $keterangan = \App\Models\KategoriSurat::where('id', $kategori->id)->first()->keterangan;
                        @endphp
                        <x-bladewind::textarea
                            rows="6"
                            label="Keterangan"
                            size="small"
                            name="keterangan"
                            required="true"
                            error_message="Masukkan keterangan"
                            show_error_inline="true"
                            selected_value="{{$keterangan}}"
                            class="w-2/3"
                        />
                </div>
            </div>
            <div class="flex gap-3 py-3 px-5">
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
                    name="btn-tambah"
                    has_spinner="true"
                    type="primary"
                    can_submit="true"
                    size="small"
                    uppercasing="false"
                >
                    Edit
                </x-bladewind::button>
            </div>
        </form>
    </div>
</div>
@endsection
