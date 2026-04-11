<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
    @fluxAppearance
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800 antialiased">

    <flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700 sidebar-custom">

        <flux:sidebar.header>
            <flux:sidebar.brand
                href="#"
                logo="https://rsudblambangan.id/images/navbar/Logo.png"
                logo:dark="https://rsudblambangan.id/images/navbar/Logo.png"
                name="Admin Panel." />

            <flux:sidebar.collapse
                class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
        </flux:sidebar.header>

        <flux:sidebar.nav>

            {{-- Dashboard --}}
            @can('admin-access')
            <flux:sidebar.item
                icon="home"
                :href="route('admin.dashboard')"
                :current="request()->routeIs('admin.dashboard')"
                wire:navigate>
                {{ __('Dashboard') }}
            </flux:sidebar.item>
            @endcan

            {{-- Manajemen Artikel --}}
            @can('manage artikel')
            <flux:sidebar.group expandable icon="document-text" heading="Manajemen Artikel" class="grid">
                @can('view daftar-artikel')
                <flux:sidebar.item
                    :href="route('admin.artikel.index')"
                    :current="request()->routeIs('admin.artikel.index')"
                    wire:navigate>
                    Daftar Artikel
                </flux:sidebar.item>
                @endcan

                @can('view daftar-kategori')
                <flux:sidebar.item
                    :href="route('admin.artikel.kategori.index')"
                    :current="request()->routeIs('admin.artikel.kategori.*')"
                    wire:navigate>
                    Daftar Kategori
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcan

            {{-- Manajemen Akun --}}
            @can('manage akun')
            <flux:sidebar.group expandable icon="user" heading="Manajemen Akun" class="grid">
                @can('view daftar-akun')
                <flux:sidebar.item
                    :href="route('admin.akun.index')"
                    :current="request()->routeIs('admin.akun.index')"
                    wire:navigate>
                    Daftar Akun
                </flux:sidebar.item>
                @endcan

                @can('view daftar-role')
                <flux:sidebar.item
                    :href="route('admin.akun.role.index')"
                    :current="request()->routeIs('admin.akun.role.index')"
                    wire:navigate>
                    Manajemen Role
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcan

            {{-- Manajemen Dokumentasi --}}
            @can('manage dokumentasi')
            <flux:sidebar.group expandable icon="photo" heading="Manajemen Dokumentasi">
                @can('view daftar-foto')
                <flux:sidebar.item
                    :href="route('admin.dokumentasi.foto')"
                    :current="request()->routeIs('admin.dokumentasi.foto')"
                    wire:navigate>
                    Foto
                </flux:sidebar.item>
                @endcan

                @can('view daftar-video')
                <flux:sidebar.item
                    :href="route('admin.dokumentasi.video')"
                    :current="request()->routeIs('admin.dokumentasi.video')"
                    wire:navigate>
                    Video
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcan

            {{-- Manajemen Dokter --}}
            @can('manage dokter')
            <flux:sidebar.group expandable icon="star" heading="Manajemen Dokter" class="grid">
                @can('view daftar-dokter')
                <flux:sidebar.item
                    :href="route('admin.dokter.index')"
                    :current="request()->routeIs('admin.dokter.index')"
                    wire:navigate>
                    Daftar Dokter
                </flux:sidebar.item>
                @endcan

                @can('view daftar-spesialis')
                <flux:sidebar.item
                    :href="route('admin.dokter.spesialis.index')"
                    :current="request()->routeIs('admin.dokter.spesialis.index')"
                    wire:navigate>
                    Daftar Spesialis
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcan

            {{-- Manajemen Ruangan --}}
            @can('manage ruangan')
            <flux:sidebar.group expandable icon="star" heading="Manajemen Ruangan" class="grid">
                @can('view daftar-bangsal')
                <flux:sidebar.item href="#">
                    Daftar Bangsal
                </flux:sidebar.item>
                @endcan

                @can('view daftar-kelas')
                <flux:sidebar.item href="#">
                    Daftar Kelas
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcan
        </flux:sidebar.nav>

        <flux:spacer />

        <x-desktop-user-menu
            class="hidden lg:block"
            :name="auth()->user()->name" />

    </flux:sidebar>

    {{-- Mobile Header --}}
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">

            <flux:profile
                :initials="auth()->user()->initials()"
                icon-trailing="chevron-down" />

            <flux:menu>

                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <flux:avatar
                                :name="auth()->user()->name"
                                :initials="auth()->user()->initials()" />

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <flux:heading class="truncate">
                                    {{ auth()->user()->name }}
                                </flux:heading>

                                <flux:text class="truncate">
                                    {{ auth()->user()->email }}
                                </flux:text>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item
                        :href="route('profile.edit')"
                        icon="cog"
                        wire:navigate>
                        {{ __('Settings') }}
                    </flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf

                    <flux:menu.item
                        as="button"
                        type="submit"
                        icon="arrow-right-start-on-rectangle"
                        class="w-full cursor-pointer"
                        data-test="logout-button">

                        {{ __('Log out') }}

                    </flux:menu.item>
                </form>

            </flux:menu>

        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts

</body>

</html>