@extends('layouts.main')

@section('navbar-title')
    Arsip Surat -> Unggah
@endsection

@section('content')
<div class="container mx-auto">
    <div class="flex flex-row p-5">
        <div class="bg-white shadow-md rounded-md p-4">
            <h1 class="text-xl font-bold ">Unggah</h1>
            <p class="text-gray-800 text-sm mb-4">Unggah surat yang telah terbit pada form ini untuk diarsipkan.</p>
            <div class="text-red-600 mb-2">
                <p class="font-bold">Catatan:</p>
                <ul class="list-disc pl-6">
                    <li>Unggah surat dalam format PDF.</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="">
        <x-bladewind::notification />
        <form action="{{route('arsip.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="flex flex-col gap-4 bg-white shadow-md rounded-md px-5 py-5 mx-5">
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
                        />
                </div>
                <div class="flex items-center">
                    <p class="font-medium w-32">File Surat(PDF)</p>
                    <div class="w-2/3">
                        <x-bladewind::filepicker
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
                    type="secondary"
                    size="small"
                    uppercasing="false"
                    onclick="window.history.back();"
                >
                    Kembali
                </x-bladewind::button>
                <x-bladewind::button
                    name="btn-unggah"
                    has_spinner="true"
                    type="primary"
                    can_submit="true"
                    size="small"
                    uppercasing="false"
                >
                    Simpan
                </x-bladewind::button>
            </div>
        </form>
    </div>

</div>
@endsection
