@extends('layouts.main')

@section('navbar-title')
    Arsip Surat
@endsection

@section('content')
    <div class="container mx-auto">
        <x-bladewind::notification />
        <div class=" flex flex-row p-5">
            <div class=" bg-white shadow-md rounded-md p-4">
                <h1 class="text-xl font-bold ">Arsip Surat</h1>
                <p class="text-gray-800 text-sm">Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. <br> Klik
                    "Lihat" pada kolom aksi untuk menampilkan surat.</p>
            </div>
        </div>
        <div class="px-5">
            <form action="{{ route('arsip.search') }}" class="cari-surat" method="GET">
                @csrf
                <div class="flex flex-row gap-4">
                    <div>
                        <p class="font-medium py-2">
                            Cari Surat:
                        </p>
                    </div>
                    <div class="w-96">
                        <x-bladewind::input
                            label="Search"
                            size="small"
                            name="keyword"
                            error_message="Masukkan kata kunci pencarian" show_error_inline="true" />

                    </div>
                    <div>

                        <x-bladewind::button
                            name="btn-cari"
                            has_spinner="true"
                            type="primary"
                            can_submit="true"
                            size="small">
                            Cari
                        </x-bladewind::button>
                    </div>
                </div>
            </form>
        </div>

        <div class="px-5">
            <x-bladewind::table
                no_data_message="Data Arsip Surat Kosong" has_shadow="true" divider="thin">
                <x-slot name="header">
                    <th>Nomor Surat</th>
                    <th>Kategori</th>
                    <th>Judul</th>
                    <th>Waktu Pengarsipan</th>
                    <th>Aksi</th>
                </x-slot>

                @foreach ($arsip as $item)
                    <x-bladewind::modal
                        type="warning"
                        title="Peringatan!"
                        name="warning-{{ $item->id }}"
                        size="medium"
                        ok_button_action="hapusSurat({{ $item->id }})"
                        ok_button_label="Hapus"
                    >
                        Apakah anda yakin ingin menghapus arsip surat ini?
                    </x-bladewind::modal>

                    <tr>
                        <td>{{ $item->nomor_surat }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td style="max-width: 25rem;">
                            <div class=" overflow-hidden" style="max-height: 3.6em;">
                                {{ $item->judul }}
                            </div>
                            @if (strlen($item->judul) > 50)
                                <span class="">
                                    {{ substr($item->judul, Str::length($item->judul)) }}
                                </span>
                            @endif
                        </td>
                        <td>{{ $item->waktu_pengarsipan }}</td>
                        <td>
                            <x-bladewind::button
                                uppercasing="false"
                                type="primary"
                                size="small"
                                has_spinner="true"
                                can_submit="true"
                                color="red"
                                onclick="showModal('warning-{{ $item->id }}')">
                                Hapus
                            </x-bladewind::button>

                            <x-bladewind::button
                                uppercasing="false"
                                type="primary"
                                size="small"
                                has_spinner="true"
                                can_submit="true" color="yellow"
                                onclick="window.location.href='{{ route('arsip.download', $item->id) }}'">
                                Unduh
                            </x-bladewind::button>

                            <x-bladewind::button
                                uppercasing="false"
                                type="primary"
                                size="small"
                                name="{{ $item->id }}" has_spinner="true" can_submit="true" color="blue"
                                onclick="window.location.href='{{ route('arsip.show', $item->id) }}'">
                                Lihat
                            </x-bladewind::button>
                        </td>
                @endforeach

            </x-bladewind::table>

            <x-bladewind::button
                uppercasing="false"
                class="my-3"
                type="primary"
                size="small"
                has_spinner="true"
                can_submit="true"
                color="blue"
                onclick="window.location.href='{{ route('arsip.create') }}'">
                Arsipkan Surat
            </x-bladewind::button>
        </div>
    </div>
@endsection

@section('script')
    <script>
        @if (session('success add'))
            showNotification('Berhasil Menambahkan Data', 'Data Arsip Surat berhasil ditambahkan');
        @endif
        @if (session('success edit'))
            showNotification('Berhasil Mengedit Data', 'Data Arsip Surat berhasil diubah');
        @endif
        @if (session('error'))
            showNotification('Terjadi Kesalahan', '{{ session('error') }}', 'error');
        @endif

        function hapusSurat(id) {
            fetch('/arsip/delete/' + id, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    _method: 'DELETE'
                })
            }).then(response => {
                // Handle response
                if (response.ok) {
                    showNotification('Berhasil Menghapus Data', 'Data Arsip Surat berhasil dihapus', 'info');
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    throw new Error('Network response was not ok.');
                }
            }).catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menghapus arsip surat.');
            });
        }
    </script>
@endsection
