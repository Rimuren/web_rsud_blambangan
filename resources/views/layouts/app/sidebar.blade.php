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
            @can('admin.access')
            <flux:sidebar.item
                icon="home"
                :href="route('admin.dashboard')"
                :current="request()->routeIs('admin.dashboard')"
                wire:navigate>
                {{ __('Dashboard') }}
            </flux:sidebar.item>
            @endcan

            @can('jam_operasional.view')
            <flux:sidebar.item
                icon="clock"
                :href="route('admin.jam-operasional.index')"
                :current="request()->routeIs('admin.jam-operasional.*')"
                wire:navigate>
                Jam Operasional
            </flux:sidebar.item>
            @endcan

            @can('iklan.view')
            <flux:sidebar.item
                icon="megaphone"
                :href="route('admin.iklan.index')"
                :current="request()->routeIs('admin.iklan.*')"
                wire:navigate>
                Manajemen Iklan
            </flux:sidebar.item>
            @endcan

            {{-- Manajemen Artikel --}}
            @canany(['artikel.view', 'kategori.view'])
            <flux:sidebar.group expandable icon="document-text" heading="Manajemen Artikel" class="grid">
                @can('artikel.view')
                <flux:sidebar.item
                    :href="route('admin.artikel.index')"
                    :current="request()->routeIs('admin.artikel.index')"
                    wire:navigate>
                    Daftar Artikel
                </flux:sidebar.item>
                @endcan

                @can('kategori.view')
                <flux:sidebar.item
                    :href="route('admin.artikel.kategori.index')"
                    :current="request()->routeIs('admin.artikel.kategori.*')"
                    wire:navigate>
                    Daftar Kategori
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcanany

            {{-- Manajemen Akun --}}
            @canany(['akun.view', 'role.view'])
            <flux:sidebar.group expandable icon="user" heading="Manajemen Akun" class="grid">
                @can('akun.view')
                <flux:sidebar.item
                    :href="route('admin.akun.index')"
                    :current="request()->routeIs('admin.akun.index')"
                    wire:navigate>
                    Daftar Akun
                </flux:sidebar.item>
                @endcan

                @can('role.view')
                <flux:sidebar.item
                    :href="route('admin.akun.role.index')"
                    :current="request()->routeIs('admin.akun.role.index')"
                    wire:navigate>
                    Manajemen Role
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcanany

            {{-- Manajemen Dokumentasi --}}
            @canany(['foto.view', 'video.view'])
            <flux:sidebar.group expandable icon="photo" heading="Manajemen Dokumentasi">
                @can('foto.view')
                <flux:sidebar.item
                    :href="route('admin.dokumentasi.foto.index')"
                    :current="request()->routeIs('admin.dokumentasi.foto.index')"
                    wire:navigate>
                    Foto
                </flux:sidebar.item>
                @endcan

                @can('video.view')
                <flux:sidebar.item
                    :href="route('admin.dokumentasi.video.index')"
                    :current="request()->routeIs('admin.dokumentasi.video.index')"
                    wire:navigate>
                    Video
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcanany

            {{-- Manajemen Dokter --}}
            @canany(['dokter.view', 'poliklinik.view'])
            <flux:sidebar.group expandable icon="star" heading="Manajemen Dokter" class="grid">
                @can('dokter.view')
                <flux:sidebar.item
                    :href="route('admin.dokter.index')"
                    :current="request()->routeIs('admin.dokter.index')"
                    wire:navigate>
                    Daftar Dokter
                </flux:sidebar.item>
                @endcan

                @can('poliklinik.view')
                <flux:sidebar.item
                    :href="route('admin.dokter.poliklinik.index')"
                    :current="request()->routeIs('admin.dokter.poliklinik.*')"
                    wire:navigate>
                    Daftar Poliklinik
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcanany

            {{-- Manajemen Ruangan --}}
            @canany(['bangsal.view'])
            <flux:sidebar.group expandable icon="star" heading="Manajemen Ruangan" class="grid">
                @can('bangsal.view')
                <flux:sidebar.item href="{{ route('admin.manajemen-ruangan.bangsal.index') }}" :current="request()->routeIs('admin.manajemen-ruangan.bangsal.index')" wire:navigate>
                    Daftar Bangsal
                </flux:sidebar.item>
                @endcan
            </flux:sidebar.group>
            @endcanany
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