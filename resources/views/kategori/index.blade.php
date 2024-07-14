@extends('layouts.main')

@section('navbar-title')
    Kategori Surat
@endsection

@section('content')
<div class="container mx-auto">
    <x-bladewind::notification />
    <div class=" flex flex-row p-5">
        <div class=" bg-white shadow-md rounded-md p-4">
            <h1 class="text-xl font-bold ">Kategori Surat</h1>
            <p class="text-gray-800 text-sm">Berikut ini adalah kategori surat yang telah terdaftar. <br> Klik "Lihat" pada kolom aksi untuk menampilkan surat.</p>
        </div>
    </div>
    <div class="px-5">
        <form action="{{route('kategori.search')}}" class="cari-surat">
            <div class="flex flex-row gap-4">
                <div>
                    <p class="font-medium py-2">
                        Cari Kategori:
                    </p>
                </div>
                <div class="w-96">
                    <x-bladewind::input
                        label="Search"
                        size="small"
                        name="keyword"
                        error_message="Masukkan kata kunci pencarian"
                        show_error_inline="true"
                    />

                </div>
                <div>

                    <x-bladewind::button
                    name="btn-cari"
                    has_spinner="true"
                    type="primary"
                    can_submit="true"
                    size="small"
                >
                    Cari
                </x-bladewind::button>
                </div>
            </div>
        </form>
    </div>

    <div class="px-5">
        <x-bladewind::table
            id="tabel-kategori"
            no_data_message="Data Kategori Kosong"
            has_shadow="true"
            divider="thin">
            <x-slot name="header">
                <th>ID Kategori</th>
                <th>Nama Kategori</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </x-slot>

            @foreach ($kategori as $item)

            <x-bladewind::modal
                type="warning"
                title="Peringatan!"
                name="warning-{{ $item->id }}"
                size="medium"
                ok_button_action="hapusKategori({{ $item->id }})"
                ok_button_label="Hapus"
            >
                Apakah anda yakin ingin menghapus kategori ini?
            </x-bladewind::modal>

            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->nama_kategori }}</td>
                <td style="max-width: 33.5rem;">
                    <div class=" overflow-hidden" style="max-height: 3.6em;">
                        {{ $item->keterangan }}
                    </div>
                    @if (strlen($item->keterangan) > 50)
                        <span class="">
                            {{ substr($item->keterangan, Str::length($item->keterangan)) }}
                        </span>
                    @endif
                </td>
                <td>
                    <x-bladewind::button
                        uppercasing="false"
                        type="primary"
                        size="small"
                        has_spinner="true"
                        can_submit="true"
                        color="red"
                        onclick="showModal('warning-{{ $item->id }}')"
                    >
                        Hapus
                    </x-bladewind::button>

                    <x-bladewind::button
                        uppercasing="false"
                        type="primary"
                        size="small"
                        has_spinner="true"
                        can_submit="true"
                        color="blue"
                        onclick="window.location.href='{{ route('kategori.edit', $item->id) }}';"
                    >
                        Edit
                    </x-bladewind::button>
                </td>
            </tr>
            @endforeach
        </x-bladewind::table>

        <x-bladewind::button
            class="my-6"
            name="btn-tambah"
            type="primary"
            size="small"
            uppercasing="false"
            onclick="window.location.href='{{ route('kategori.create') }}';"
        >
            Tambah Kategori Baru
        </x-bladewind::button>

    </div>
</div>
@endsection

@section('script')
<script>
    @if (session('success add'))
        console.log('fungsi berhasil');
        showNotification('Berhasil Menambahkan Data', 'Data Kategori Surat berhasil ditambahkan');
    @endif
    @if (session('success edit'))
        showNotification('Berhasil Mengedit Data', 'Data Kategori Surat berhasil diubah');
    @endif
    @if (session('success delete'))
        console.log('fungsi berhasil');
        window.location.reload();
    @endif
    @if (session('error'))
        showNotification('Terjadi Kesalahan', '{{ session('error') }}', 'error');
    @endif


    function hapusKategori(id) {
        fetch('/kategori/delete/' + id, {
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
                window.location.reload();
                setTimeout(function() {
                    showNotification('Berhasil Menghapus Data', 'Data Kategori Surat berhasil dihapus', 'info');
                }, 2000);
            } else {
                throw new Error('Network response was not ok.');
            }
        }).catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus kategori.');
        });
    }

</script>
@endsection
