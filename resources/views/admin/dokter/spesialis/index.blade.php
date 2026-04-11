<x-layouts::app :title="'Manajemen Spesialis'">
    <x-slot:header>
        {{ __('Manajemen Spesialis') }}
    </x-slot:header>

    <div class=\"p-4 md:p-6 lg:p-8\">
        {{-- Header Section --}}
        <div class=\"mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4\">
            <div>
                <h2 class=\"text-3xl font-black text-zinc-900 dark:text-white tracking-tight\">Manajemen Spesialis</h2>
                <p class=\"text-zinc-500 dark:text-zinc-400 mt-2\">Daftar spesialisasi dokter yang tersedia di RSUD Blambangan.</p>
            </div>
        </div>

        {{-- Tabel Spesialis --}}
        <flux:card class=\"overflow-hidden\">
            <div class=\"overflow-x-auto\">
                <table class=\"w-full text-left border-collapse\">
                    <thead>
                        <tr class=\"bg-zinc-50 dark:bg-zinc-800/50 border-b border-zinc-200 dark:border-zinc-800\">
                            <th class=\"px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider\">Nama Spesialis</th>
                            <th class=\"px-6 py-4 text-xs font-bold text-zinc-500 uppercase tracking-wider\">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class=\"divide-y divide-zinc-100 dark:divide-zinc-800\">
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Kebidanan dan Kandungan (Obgyn)</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Spesialisasi dalam kesehatan reproduksi wanita, kehamilan, persalinan, dan nifas.</td>
                        </tr>
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Anak (Pediatri)</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Perawatan kesehatan anak dari baru lahir hingga remaja.</td>
                        </tr>
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Penyakit Dalam (Pen.</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Penanganan penyakit dalam dewasa seperti diabetes, hipertensi, dan infeksi.</td>
                        </tr>
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Bedah Umum</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Tindakan pembedahan untuk berbagai kasus umum dan darurat.</td>
                        </tr>
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Jantung dan Pembuluh Darah (Kardiologi)</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Diagnosis dan pengobatan penyakit jantung dan pembuluh darah.</td>
                        </tr>
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Paru (Pulmonologi)</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Perawatan penyakit pernapasan dan paru-paru.</td>
                        </tr>
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Urologi</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Spesialisasi saluran kemih dan organ reproduksi pria.</td>
                        </tr>
                        <tr class=\"hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors\">
                            <td class=\"px-6 py-4\">
                                <p class=\"text-sm font-bold text-zinc-900 dark:text-white\">Mata (Oftalmologi)</p>
                            </td>
                            <td class=\"px-6 py-4 text-sm text-zinc-600 dark:text-zinc-400\">Perawatan kesehatan mata dan penglihatan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </flux:card>
    </div>
</x-layouts::app>
