<x-layouts::app.sidebar :title="'Edit Artikel'">
    <x-slot:header>
        <div class="flex items-center gap-2.5 px-4 py-3">
            <a href="{{ route('admin.artikel.index') }}"
               class="p-1.5 hover:bg-zinc-100 dark:hover:bg-zinc-800 rounded-lg transition-colors text-zinc-500 hover:text-zinc-900 dark:hover:text-white">
                <flux:icon name="arrow-left" class="size-4" />
            </a>
            <div>
                <h1 class="text-lg font-bold text-zinc-900 dark:text-white tracking-tight">Edit Artikel</h1>
                <p class="text-xs text-zinc-500 dark:text-zinc-400">Perbarui konten edukasi kesehatan yang informatif dan terpercaya.</p>
            </div>
        </div>
    </x-slot:header>

    <div class="w-full max-w-5xl mx-auto px-6 py-6 space-y-6">
        {{-- Ubah action sesuai route update, misal: route('admin.artikel.update', $artikel->id) --}}
        <form method="POST" enctype="multipart/form-data" id="artikel-form" action="/admin/artikel/1/update">
            @csrf
            @method('PUT')

            {{-- INFORMASI ARTIKEL --}}
            <flux:card class="p-6 space-y-5 shadow-sm">
                <div class="flex items-center gap-2 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                    <flux:icon name="document-text" class="size-3.5 text-primary" />
                    <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Informasi Artikel</h2>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                        Judul Artikel <span class="text-red-500">*</span>
                    </label>
                    <input
                        type="text"
                        name="title"
                        required
                        placeholder="Masukkan judul artikel yang menarik..."
                        value="Manfaat Puasa bagi Kesehatan Jantung"
                        class="w-full px-3 py-2 text-sm font-semibold border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                    />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select
                                name="kategori"
                                required
                                class="w-full pl-3 pr-8 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white appearance-none focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                            >
                                <option value="" disabled>Pilih kategori...</option>
                                <option value="kesehatan" selected>Kesehatan</option>
                                <option value="tips">Tips Kesehatan</option>
                                <option value="berita">Berita RS</option>
                            </select>
                            <flux:icon name="chevron-down" class="size-3.5 text-zinc-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">Status Publikasi</label>
                        <div class="relative">
                            <select
                                name="status"
                                class="w-full pl-3 pr-8 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white appearance-none focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all"
                            >
                                <option value="draft">Draft</option>
                                <option value="published" selected>Diterbitkan</option>
                            </select>
                            <flux:icon name="chevron-down" class="size-3.5 text-zinc-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                    </div>
                </div>
            </flux:card>

            {{-- FOTO UNGGULAN --}}
            <flux:card class="p-4 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                    <flux:icon name="photo" class="size-3.5 text-primary" />
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Foto Unggulan</h2>
                </div>

                <label class="cursor-pointer block">
                    <div
                        id="foto-dropzone"
                        class="border-2 border-dashed border-zinc-200 dark:border-zinc-700 rounded-lg p-4 flex flex-col items-center justify-center gap-2 hover:border-primary/50 hover:bg-primary/5 transition-all duration-200 text-center"
                    >
                        {{-- Preview gambar yang sudah ada --}}
                        <img id="foto-preview" src="https://picsum.photos/id/20/800/400" alt="Preview" class="w-full max-h-36 object-cover rounded-md mb-1" />

                        <div id="foto-placeholder" class="hidden flex-col items-center gap-2">
                            <div class="w-9 h-9 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                <flux:icon name="arrow-up-tray" class="size-4 text-zinc-400" />
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Klik atau seret gambar ke sini</p>
                                <p class="text-[11px] text-zinc-400 dark:text-zinc-500 mt-0.5">PNG, JPG, JPEG · Maks. 5MB · Rekomendasi 1200×630px</p>
                            </div>
                        </div>

                        <p id="foto-filename" class="hidden text-xs font-medium text-primary">foto-sehat.jpg</p>
                    </div>
                    <input
                        type="file"
                        name="image"
                        id="foto-input"
                        accept="image/png,image/jpeg,image/jpg"
                        class="sr-only"
                        onchange="handleFotoChange(this)"
                    />
                </label>
            </flux:card>

            {{-- LAMPIRAN DOKUMEN --}}
            <flux:card class="p-4 space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-zinc-100 dark:border-zinc-800">
                    <div class="flex items-center gap-2">
                        <flux:icon name="paper-clip" class="size-3.5 text-primary" />
                        <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Lampiran Dokumen</h2>
                    </div>
                    <span class="text-[10px] text-zinc-400 dark:text-zinc-600">PDF &amp; Word (.doc, .docx)</span>
                </div>

                <label class="cursor-pointer block">
                    <div
                        id="file-dropzone"
                        class="border-2 border-dashed border-zinc-200 dark:border-zinc-700 rounded-lg p-4 flex flex-col items-center justify-center gap-2 hover:border-primary/50 hover:bg-primary/5 transition-all duration-200 text-center"
                        ondragover="event.preventDefault(); this.classList.add('border-primary','bg-primary/5')"
                        ondragleave="this.classList.remove('border-primary','bg-primary/5')"
                        ondrop="handleFileDrop(event)"
                    >
                        <div class="flex gap-1.5">
                            <div class="w-8 h-8 rounded-md bg-red-50 dark:bg-red-950/30 border border-red-100 dark:border-red-900/30 flex items-center justify-center">
                                <flux:icon name="document" class="size-4 text-red-500" />
                            </div>
                            <div class="w-8 h-8 rounded-md bg-blue-50 dark:bg-blue-950/30 border border-blue-100 dark:border-blue-900/30 flex items-center justify-center">
                                <flux:icon name="document-text" class="size-4 text-blue-500" />
                            </div>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Klik atau seret file ke sini</p>
                            <p class="text-[11px] text-zinc-400 dark:text-zinc-500 mt-0.5">PDF, DOC, DOCX · Maks. 10MB per file · Bisa beberapa file</p>
                        </div>
                    </div>
                    <input
                        type="file"
                        name="dokumen[]"
                        id="file-input"
                        accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document"
                        multiple
                        class="sr-only"
                        onchange="handleFileChange(this)"
                    />
                </label>

                {{-- Daftar lampiran yang sudah ada --}}
                <ul id="file-list" class="space-y-1.5">
                    <li class="flex items-center gap-2.5 px-3 py-2 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800">
                        <span class="w-7 h-7 rounded-md flex items-center justify-center text-[10px] font-black shrink-0 bg-red-100 dark:bg-red-950/40 text-red-600">PDF</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-zinc-800 dark:text-zinc-200 truncate">informasi-puasa.pdf</p>
                            <p class="text-[11px] text-zinc-400">2.4 MB</p>
                        </div>
                        <button type="button" onclick="removeFile(123)" class="w-6 h-6 rounded-md flex items-center justify-center text-zinc-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5">
                                <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"/>
                            </svg>
                        </button>
                    </li>
                    <li class="flex items-center gap-2.5 px-3 py-2 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800">
                        <span class="w-7 h-7 rounded-md flex items-center justify-center text-[10px] font-black shrink-0 bg-blue-100 dark:bg-blue-950/40 text-blue-600">DOC</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-xs font-medium text-zinc-800 dark:text-zinc-200 truncate">jadwal-konsultasi.docx</p>
                            <p class="text-[11px] text-zinc-400">0.8 MB</p>
                        </div>
                        <button type="button" onclick="removeFile(456)" class="w-6 h-6 rounded-md flex items-center justify-center text-zinc-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5">
                                <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"/>
                            </svg>
                        </button>
                    </li>
                </ul>
            </flux:card>

            {{-- KONTEN ARTIKEL --}}
            <flux:card class="overflow-hidden p-0">
                <div class="px-4 py-2.5 border-b border-zinc-100 dark:border-zinc-800 flex items-center gap-2">
                    <flux:icon name="pencil-square" class="size-3.5 text-primary" />
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Isi Artikel</h2>
                </div>

                {{-- Toolbar --}}
                <div class="px-3 py-1.5 bg-zinc-50 dark:bg-zinc-900/70 border-b border-zinc-200 dark:border-zinc-800 flex flex-wrap items-center gap-1">
                    <!-- ... toolbar sama seperti sebelumnya ... -->
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="formatDoc('bold')" title="Tebal" class="toolbar-btn"><flux:icon name="bold" class="size-3.5" /></button>
                        <button type="button" onclick="formatDoc('italic')" title="Miring" class="toolbar-btn"><flux:icon name="italic" class="size-3.5" /></button>
                        <button type="button" onclick="formatDoc('underline')" title="Garis bawah" class="toolbar-btn"><flux:icon name="underline" class="size-3.5" /></button>
                        <button type="button" onclick="formatDoc('strikeThrough')" title="Coret" class="toolbar-btn"><flux:icon name="strikethrough" class="size-3.5" /></button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="formatDoc('formatBlock','H2')" title="Heading 2" class="toolbar-btn text-[11px] font-bold px-1.5">H2</button>
                        <button type="button" onclick="formatDoc('formatBlock','H3')" title="Heading 3" class="toolbar-btn text-[11px] font-bold px-1.5">H3</button>
                        <button type="button" onclick="formatDoc('formatBlock','P')" title="Paragraf" class="toolbar-btn text-[11px] px-1.5">P</button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="formatDoc('insertUnorderedList')" title="Daftar Bullet" class="toolbar-btn"><flux:icon name="list-bullet" class="size-3.5" /></button>
                        <button type="button" onclick="formatDoc('insertOrderedList')" title="Daftar Angka" class="toolbar-btn"><flux:icon name="numbered-list" class="size-3.5" /></button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="formatDoc('justifyLeft')" title="Rata Kiri" class="toolbar-btn"><flux:icon name="bars-3-bottom-left" class="size-3.5" /></button>
                        <button type="button" onclick="formatDoc('justifyCenter')" title="Rata Tengah" class="toolbar-btn"><flux:icon name="bars-3" class="size-3.5" /></button>
                        <button type="button" onclick="formatDoc('justifyRight')" title="Rata Kanan" class="toolbar-btn"><flux:icon name="bars-3-bottom-right" class="size-3.5" /></button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="addLink()" title="Tambah Link" class="toolbar-btn"><flux:icon name="link" class="size-3.5" /></button>
                        <button type="button" onclick="addImageUrl()" title="Tambah Gambar URL" class="toolbar-btn"><flux:icon name="photo" class="size-3.5" /></button>
                    </div>
                    <div class="ml-auto">
                        <button type="button" onclick="formatDoc('removeFormat')" title="Hapus Format" class="toolbar-btn !text-zinc-400 hover:!text-red-500"><flux:icon name="x-mark" class="size-3.5" /></button>
                    </div>
                </div>

                {{-- Editor Area dengan konten awal (HTML) --}}
                <div
                    id="editor"
                    contenteditable="true"
                    class="min-h-[280px] p-4 text-sm leading-6 text-zinc-700 dark:text-zinc-300 outline-none"
                >
                    <h2>Manfaat Puasa bagi Kesehatan Jantung</h2>
                    <p>Puasa telah lama dikenal memiliki berbagai manfaat kesehatan, salah satunya adalah meningkatkan kesehatan jantung. Berikut beberapa manfaat puasa untuk jantung:</p>
                    <ul>
                        <li>Menurunkan tekanan darah</li>
                        <li>Mengurangi kadar kolesterol jahat (LDL)</li>
                        <li>Meningkatkan sensitivitas insulin</li>
                        <li>Mengurangi peradangan dalam tubuh</li>
                    </ul>
                    <p>Penelitian menunjukkan bahwa puasa dapat membantu menurunkan risiko penyakit jantung koroner hingga 40% jika dilakukan secara rutin dan sehat.</p>
                </div>

                <textarea name="content" id="content-field" class="sr-only"></textarea>
            </flux:card>

            {{-- ACTION BUTTONS --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 py-1">
                <p class="text-[11px] text-zinc-400 dark:text-zinc-600 flex items-center gap-1">
                    <flux:icon name="shield-check" class="size-3 text-emerald-500" />
                    Artikel disimpan dengan aman di server
                </p>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.artikel.index') }}"
                       class="px-3 py-1.5 rounded-lg border border-zinc-200 dark:border-zinc-700 text-xs font-semibold text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-800 transition-all">
                        Batal
                    </a>
                    <button type="submit" name="action" value="draft"
                            class="px-3 py-1.5 rounded-lg border border-primary/30 dark:border-primary/40 text-xs font-semibold text-primary hover:bg-primary/5 transition-all flex items-center gap-1">
                        <flux:icon name="document" class="size-3.5" />
                        Simpan Draft
                    </button>
                    <button type="submit" name="action" value="publish"
                            class="px-3 py-1.5 rounded-lg bg-primary hover:bg-primary/90 text-white text-xs font-semibold shadow-sm transition-all flex items-center gap-1">
                        <flux:icon name="paper-airplane" class="size-3.5" />
                        Perbarui Artikel
                    </button>
                </div>
            </div>

        </form>
    </div>

    <script>
        // Sama seperti kode JavaScript pada form tambah artikel, dengan penyesuaian agar preview gambar dan file list bisa diinisialisasi dengan data yang ada.
        // (Fungsi-fungsi seperti formatDoc, syncContent, handleFotoChange, dll tetap sama. Namun kita perlu menginisialisasi file-list dan preview gambar jika ada data awal)
        // Di sini kita hanya menambahkan beberapa baris untuk memastikan editor terisi dengan konten yang sudah ada.
        const editor       = document.getElementById('editor');
        const contentField = document.getElementById('content-field');
        const PLACEHOLDER  = 'Mulai menulis artikel Anda di sini...';

        function formatDoc(cmd, val = null) {
            editor.focus();
            document.execCommand(cmd, false, val);
            syncContent();
        }

        function syncContent() {
            // Jika editor berisi placeholder, kirim string kosong
            if (editor.innerText.trim() === PLACEHOLDER) {
                contentField.value = '';
            } else {
                contentField.value = editor.innerHTML;
            }
        }

        function addLink() {
            const url = prompt('Masukkan URL (contoh: https://example.com):');
            if (url) formatDoc('createLink', url);
        }

        function addImageUrl() {
            const url = prompt('Masukkan URL gambar:');
            if (url) formatDoc('insertImage', url);
        }

        // Inisialisasi editor: jika sudah ada konten (tidak kosong), jangan tampilkan placeholder
        if (editor.innerText.trim() === '') {
            editor.innerHTML = PLACEHOLDER;
        } else {
            syncContent();
        }

        editor.addEventListener('focus', () => {
            if (editor.innerText.trim() === PLACEHOLDER) editor.innerHTML = '';
        });
        editor.addEventListener('blur', () => {
            if (editor.innerText.trim() === '') editor.innerHTML = PLACEHOLDER;
        });
        editor.addEventListener('input', syncContent);

        /* Foto Upload (dengan inisialisasi jika ada preview) */
        function handleFotoChange(input) {
            const file = input.files[0];
            if (!file) return;
            const preview     = document.getElementById('foto-preview');
            const placeholder = document.getElementById('foto-placeholder');
            const filename    = document.getElementById('foto-filename');
            const reader      = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                filename.textContent = file.name;
                filename.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }

        /* Dokumen Upload */
        const allowedExts = ['pdf', 'doc', 'docx'];
        let uploadedFiles = [];

        // Untuk demo, kita masukkan file yang sudah ada ke array uploadedFiles
        // agar fungsionalitas remove bisa berjalan dengan baik
        uploadedFiles = [
            { id: 123, name: 'informasi-puasa.pdf', ext: 'PDF', size: '2.4' },
            { id: 456, name: 'jadwal-konsultasi.docx', ext: 'DOC', size: '0.8' }
        ];

        function handleFileDrop(e) {
            e.preventDefault();
            document.getElementById('file-dropzone').classList.remove('border-primary', 'bg-primary/5');
            addFiles(Array.from(e.dataTransfer.files));
        }

        function handleFileChange(input) {
            addFiles(Array.from(input.files));
        }

        function addFiles(files) {
            files.forEach(file => {
                const ext = file.name.split('.').pop().toLowerCase();
                if (!allowedExts.includes(ext)) return;
                const id = Date.now() + Math.random();
                uploadedFiles.push({
                    id, file,
                    name : file.name,
                    ext  : ext.toUpperCase(),
                    size : (file.size / 1048576).toFixed(2)
                });
            });
            renderFileList();
        }

        function removeFile(id) {
            uploadedFiles = uploadedFiles.filter(f => f.id != id);
            renderFileList();
        }

        function renderFileList() {
            const list = document.getElementById('file-list');
            if (!uploadedFiles.length) {
                list.classList.add('hidden');
                list.innerHTML = '';
                return;
            }
            list.classList.remove('hidden');
            list.innerHTML = uploadedFiles.map(f => `
                <li class="flex items-center gap-2.5 px-3 py-2 bg-zinc-50 dark:bg-zinc-900 rounded-lg border border-zinc-200 dark:border-zinc-800">
                    <span class="w-7 h-7 rounded-md flex items-center justify-center text-[10px] font-black shrink-0
                        ${f.ext === 'PDF' ? 'bg-red-100 dark:bg-red-950/40 text-red-600' : 'bg-blue-100 dark:bg-blue-950/40 text-blue-600'}">
                        ${f.ext}
                    </span>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-medium text-zinc-800 dark:text-zinc-200 truncate">${f.name}</p>
                        <p class="text-[11px] text-zinc-400">${f.size} MB</p>
                    </div>
                    <button type="button" onclick="removeFile(${f.id})"
                            class="w-6 h-6 rounded-md flex items-center justify-center text-zinc-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-3.5">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z"/>
                        </svg>
                    </button>
                </li>
            `).join('');
        }

        // Panggil renderFileList untuk menampilkan file yang sudah ada
        renderFileList();

        // Reset input file setelah pilih file
        document.getElementById('file-input').addEventListener('click', function() { this.value = null; });
        document.getElementById('foto-input').addEventListener('click', function() { this.value = null; });
    </script>

    <style>
        .toolbar-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 1.5rem;
            height: 1.5rem;
            border-radius: 0.25rem;
            color: #52525b;
            transition: background-color 0.15s, color 0.15s;
        }
        .dark .toolbar-btn { color: #a1a1aa; }
        .toolbar-btn:hover {
            background-color: #f4f4f5;
            color: var(--color-primary, #0d7ff2);
        }
        .dark .toolbar-btn:hover {
            background-color: #3f3f46;
            color: var(--color-primary, #0d7ff2);
        }

        #editor h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 1rem 0 0.4rem;
        }
        #editor h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin: 0.75rem 0 0.3rem;
        }
        #editor p {
            margin: 0.4rem 0;
        }
        #editor ul {
            list-style: disc;
            padding-left: 1.5rem;
            margin: 0.4rem 0;
        }
        #editor ol {
            list-style: decimal;
            padding-left: 1.5rem;
            margin: 0.4rem 0;
        }
        #editor a {
            color: var(--color-primary, #0d7ff2);
            text-decoration: underline;
        }
        #editor img {
            max-width: 100%;
            border-radius: 0.375rem;
            margin: 0.4rem 0;
        }
        #editor blockquote {
            border-left: 3px solid var(--color-primary, #0d7ff2);
            padding: 0.4rem 0.75rem;
            color: #64748b;
            font-style: italic;
            margin: 0.5rem 0;
        }
    </style>

</x-layouts::app.sidebar>