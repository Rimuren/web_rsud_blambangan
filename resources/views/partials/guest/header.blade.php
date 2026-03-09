<flux:navbar>

    <flux:navbar.item href="#">Profil</flux:navbar.item>

    <flux:navbar.item href="#">Dokter & Jadwal</flux:navbar.item>

    <flux:navbar.item href="#">Info Kamar</flux:navbar.item>


    {{-- DROPDOWN LAYANAN --}}
    <flux:dropdown>

        <flux:dropdown.trigger>
            <flux:navbar.item icon:trailing="chevron-down">
                Layanan
            </flux:navbar.item>
        </flux:dropdown.trigger>

        <flux:dropdown.menu>

            <flux:dropdown.item href="#">
                Layanan Rawat Inap
            </flux:dropdown.item>

            <flux:dropdown.item href="#">
                Layanan Unggulan
            </flux:dropdown.item>

            <flux:dropdown.item href="#">
                Layanan Rawat Jalan
            </flux:dropdown.item>

            <flux:dropdown.item href="#">
                Layanan IGD
            </flux:dropdown.item>

            <flux:dropdown.item href="#">
                Layanan MCU
            </flux:dropdown.item>

        </flux:dropdown.menu>

    </flux:dropdown>


    <flux:navbar.item href="#">Informasi</flux:navbar.item>

    <flux:navbar.item href="#">Galeri</flux:navbar.item>

    <flux:navbar.item href="#">Kontak</flux:navbar.item>

</flux:navbar>