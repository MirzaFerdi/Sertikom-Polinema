{{-- Sidebar --}}
<div class="bg-gray-800 text-white h-screen w-64 flex-shrink-0">
    <div class="p-4">
        <h1 class="text-xl font-bold mb-4">Arsip Surat</h1>
        <p class="text-sm text-gray-400 mb-2">Menu</p>
        <ul>
            <li class="mb-2 {{ request()->routeIs('arsip.*') ? 'bg-gray-700' : '' }}">
                <a href="{{ route('arsip.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-regular fa-envelope mr-2"></i> Arsip
                </a>
            </li>
            <li class="mb-2 {{ request()->routeIs('kategori.*') ? 'bg-gray-700' : '' }}">
                <a href="{{ route('kategori.index') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-list mr-2"></i> Kategori Surat
                </a>
            </li>
            <li class="mb-2 {{ request()->is('about') ? 'bg-gray-700' : '' }}">
                <a href="{{ url('about') }}" class="block py-2 px-4 hover:bg-gray-700 rounded">
                    <i class="fa-solid fa-circle-info mr-2"></i> About
                </a>
            </li>
        </ul>
    </div>
</div>
