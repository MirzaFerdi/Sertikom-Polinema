@extends('layouts.main')

@section('navbar-title')
    Arsip Surat -> Lihat -> Edit
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
            <h1 class="text-2xl font-bold ">Edit Arsip Surat</h1>
            <p class="text-gray-800 text-sm">Edit data arsip surat. Jika sudah selesai, <br> jangan lupa untuk mengklik tombol "Simpan" </p>
        </div>
    </div>
    <div>
        <x-bladewind::notification />
        <form action="{{route('arsip.update', $arsip->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="flex flex-col gap-4 bg-white shadow-md rounded-md px-5 py-4 mx-5">
                <div class="flex items-center">
                    <p class="font-medium w-36">Nomor Surat</p>
                        <x-bladewind::input
                            label="Nomor Surat"
                            size="small"
                            name="nomor_surat"
                            required="true"
                            error_message="Masukkan nomor surat"
                            show_error_inline="true"
                            class="w-1/4"
                            value="{{$arsip->nomor_surat}}"
                        />
                </div>
                <div class="flex items-center">
                    <p class="font-medium w-32 *:">Kategori</p>
                    <div class="w-[14.2rem]">
                        @php
                            $kategoriOptions = [];
                            foreach ($kategori as $data) {
                                $kategoriOptions[] = [
                                    'label' => $data->nama_kategori,
                                    'value' => $data->id,
                                ];
                            }
                        @endphp
                        <x-bladewind::select

                            label="Kategori Surat"
                            size="small"
                            name="kategori_id"
                            required="true"
                            error_message="Pilih kategori surat"
                            show_error_inline="true"
                            :data="$kategoriOptions"
                            selected_value="{{$arsip->kategori_id}}"
                        />
                    </div>
                </div>
                <div class="flex items-center">
                    <p class="font-medium w-36">Judul</p>
                        <x-bladewind::input
                            label="Judul Surat"
                            size="small"
                            name="judul"
                            error_message="Masukkan judul surat"
                            show_error_inline="true"
                            class="w-2/5"
                            value="{{$arsip->judul}}"
                        />
                </div>
                <div class="flex items-center">
                    <p class="font-medium w-32">File Surat(PDF)</p>
                    <div class="w-2/3">
                        <x-bladewind::filepicker
                            url="{{ asset('storage/file_surat/' . $arsip->file) }}"
                            selected_value="{{ $arsip->file }}"
                            placeholder="File Surat"
                            name="file"
                            accepted_file_types=".pdf"
                        />
                    </div>
                </div>
            </div>
            <div class="flex gap-3 py-3 px-5">
                <x-bladewind::button
                    name="btn-unggah"
                    type="primary"
                    size="small"
                    uppercasing="false"
                    onclick="window.history.back();"
                >
                    Kembali
                </x-bladewind::button>
                <x-bladewind::button
                    name="btn-edit"
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

