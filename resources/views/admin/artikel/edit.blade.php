<x-layouts::app :title="__('Edit Artikel')">
    <x-slot:header>
        {{ __('Edit Artikel') }}
    </x-slot:header>

    <div class="w-full max-w-4xl mx-auto px-4 pt-4">
        <h1 class="text-lg font-bold text-zinc-800 dark:text-white">Edit Artikel</h1>
        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Perbarui informasi artikel di bawah ini</p>
    </div>

    <div class="w-full max-w-5xl mx-auto px-6 py-6 space-y-6">
        <form method="POST" action="{{ route('admin.artikel.update', $artikel->id) }}" enctype="multipart/form-data" id="artikel-form">
            @csrf
            @method('PUT')

            {{-- INFORMASI ARTIKEL --}}
            <flux:card class="p-6 mb-6 space-y-5 shadow-sm">
                <div class="flex items-center gap-2 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                    <flux:icon name="document-text" class="size-3.5 text-primary" />
                    <h2 class="text-xs font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Informasi Artikel</h2>
                </div>

                <div class="space-y-2">
                    <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                        Judul Artikel <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" value="{{ old('judul', $artikel->judul) }}" required
                        placeholder="Masukkan judul artikel yang menarik..."
                        class="w-full px-3 py-2 text-sm font-semibold border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-600 focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                    @error('judul') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select name="kategori_id" required
                                class="w-full pl-3 pr-8 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white appearance-none focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option value="" disabled {{ old('kategori_id', $artikel->kategori_id) ? '' : 'selected' }}>Pilih kategori...</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id', $artikel->kategori_id) == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            <flux:icon name="chevron-down" class="size-3.5 text-zinc-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                        @error('kategori_id') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">Status Publikasi</label>
                        <div class="relative">
                            <select name="status"
                                class="w-full pl-3 pr-8 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white appearance-none focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option value="draft" {{ old('status', $artikel->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $artikel->status) == 'published' ? 'selected' : '' }}>Diterbitkan</option>
                            </select>
                            <flux:icon name="chevron-down" class="size-3.5 text-zinc-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                    </div>
                </div>
            </flux:card>

            {{-- FOTO UNGGULAN --}}
            <flux:card class="p-4 mb-6 space-y-3">
                <div class="flex items-center gap-2 pb-2 border-b border-zinc-100 dark:border-zinc-800">
                    <flux:icon name="photo" class="size-3.5 text-primary" />
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Foto Unggulan</h2>
                </div>

                <label class="cursor-pointer block">
                    <div id="foto-dropzone"
                        class="border-2 border-dashed border-zinc-200 dark:border-zinc-700 rounded-lg p-4 flex flex-col items-center justify-center gap-2 hover:border-primary/50 hover:bg-primary/5 transition-all duration-200 text-center">
                        @if($artikel->thumbnail)
                        <img id="foto-preview" src="{{ Storage::url($artikel->thumbnail) }}" alt="Preview" class="w-full max-h-36 object-cover rounded-md mb-1" />
                        @else
                        <img id="foto-preview" src="#" alt="Preview" class="hidden w-full max-h-36 object-cover rounded-md mb-1" />
                        @endif
                        <div id="foto-placeholder" class="{{ $artikel->thumbnail ? 'hidden' : 'flex' }} flex-col items-center gap-2">
                            <div class="w-9 h-9 rounded-lg bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center">
                                <flux:icon name="arrow-up-tray" class="size-4 text-zinc-400" />
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-zinc-700 dark:text-zinc-300">Klik atau seret gambar ke sini</p>
                                <p class="text-[11px] text-zinc-400 dark:text-zinc-500 mt-0.5">PNG, JPG, JPEG · Maks. 5MB · Rekomendasi 1200×630px</p>
                            </div>
                        </div>
                        <p id="foto-filename" class="hidden text-xs font-medium text-primary"></p>
                    </div>
                    <input type="file" name="thumbnail" id="foto-input" accept="image/png,image/jpeg,image/jpg" class="sr-only" onchange="handleFotoChange(this)">
                </label>
                @error('thumbnail') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
            </flux:card>

            {{-- KONTEN ARTIKEL dengan Quill dan Toolbar Kustom --}}
            <flux:card class="mb-6 overflow-hidden p-0">
                <div class="px-4 py-2.5 border-b border-zinc-100 dark:border-zinc-800 flex items-center gap-2">
                    <flux:icon name="pencil-square" class="size-3.5 text-primary" />
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Isi Artikel</h2>
                </div>

                {{-- Toolbar Kustom dengan Ikon Flux --}}
                <div class="px-3 py-1.5 bg-zinc-50 dark:bg-zinc-900/70 border-b border-zinc-200 dark:border-zinc-800 flex flex-wrap items-center gap-1">
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="quill.format('bold', true)" title="Tebal" class="toolbar-btn">
                            <flux:icon name="bold" class="size-3.5" />
                        </button>
                        <button type="button" onclick="quill.format('italic', true)" title="Miring" class="toolbar-btn">
                            <flux:icon name="italic" class="size-3.5" />
                        </button>
                        <button type="button" onclick="quill.format('underline', true)" title="Garis bawah" class="toolbar-btn">
                            <flux:icon name="underline" class="size-3.5" />
                        </button>
                        <button type="button" onclick="quill.format('strike', true)" title="Coret" class="toolbar-btn">
                            <flux:icon name="strikethrough" class="size-3.5" />
                        </button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="quill.format('header', 1)" title="Heading 1" class="toolbar-btn text-[11px] font-bold px-1.5">H1</button>
                        <button type="button" onclick="quill.format('header', 2)" title="Heading 2" class="toolbar-btn text-[11px] font-bold px-1.5">H2</button>
                        <button type="button" onclick="quill.format('header', 3)" title="Heading 3" class="toolbar-btn text-[11px] font-bold px-1.5">H3</button>
                        <button type="button" onclick="quill.format('header', false)" title="Paragraf" class="toolbar-btn text-[11px] px-1.5">P</button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="quill.format('list', 'ordered')" title="Daftar Angka" class="toolbar-btn">
                            <flux:icon name="numbered-list" class="size-3.5" />
                        </button>
                        <button type="button" onclick="quill.format('list', 'bullet')" title="Daftar Bullet" class="toolbar-btn">
                            <flux:icon name="list-bullet" class="size-3.5" />
                        </button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="quill.format('align', 'left')" title="Rata Kiri" class="toolbar-btn">
                            <flux:icon name="bars-3-bottom-left" class="size-3.5" />
                        </button>
                        <button type="button" onclick="quill.format('align', 'center')" title="Rata Tengah" class="toolbar-btn">
                            <flux:icon name="bars-3" class="size-3.5" />
                        </button>
                        <button type="button" onclick="quill.format('align', 'right')" title="Rata Kanan" class="toolbar-btn">
                            <flux:icon name="bars-3-bottom-right" class="size-3.5" />
                        </button>
                    </div>
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="addQuillLink()" title="Tambah Link" class="toolbar-btn">
                            <flux:icon name="link" class="size-3.5" />
                        </button>
                        <button type="button" onclick="addQuillImage()" title="Tambah Gambar URL" class="toolbar-btn">
                            <flux:icon name="photo" class="size-3.5" />
                        </button>
                        <button type="button" onclick="uploadQuillImage()" title="Upload Gambar" class="toolbar-btn">
                            <flux:icon name="arrow-up-tray" class="size-3.5" />
                        </button>
                    </div>
                    <div class="ml-auto">
                        <button type="button" onclick="quill.removeFormat(quill.getSelection())" title="Hapus Format" class="toolbar-btn !text-zinc-400 hover:!text-red-500">
                            <flux:icon name="x-mark" class="size-3.5" />
                        </button>
                    </div>
                </div>

                {{-- Quill Editor Area (tanpa toolbar bawaan) --}}
                <div id="quill-editor" class="min-h-[280px] p-4 text-sm leading-6 text-zinc-700 dark:text-zinc-300 outline-none"></div>
                <textarea name="konten" id="content-field" class="sr-only"></textarea>
            </flux:card>

            {{-- ACTION BUTTONS --}}
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 py-1">
                <p class="text-[11px] text-zinc-400 dark:text-zinc-600 flex items-center gap-1">
                    <flux:icon name="shield-check" class="size-3 text-emerald-500" />
                    Artikel disimpan dengan aman di server
                </p>
                <div class="flex items-center gap-2">
                    <flux:button as="a" href="{{ route('admin.artikel.index') }}" variant="ghost" class="text-sm">
                        Batal
                    </flux:button>
                    <flux:button type="submit" name="action" value="draft" variant="outline" class="border-primary/30 dark:border-primary/40 text-primary hover:bg-primary/5 flex items-center gap-1">
                        <flux:icon name="document" class="size-3.5" />
                        Simpan Draft
                    </flux:button>
                    <flux:button type="submit" name="action" value="publish" variant="primary" class="flex items-center gap-1 shadow-sm">
                        <flux:icon name="paper-airplane" class="size-3.5" />
                        Perbarui Artikel
                    </flux:button>
                </div>
            </div>
        </form>
    </div>

    <!-- Quill CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        // Inisialisasi Quill
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Mulai menulis artikel Anda di sini...',
            modules: {
                toolbar: false,
            }
        });

        // Set existing content dari database
        const existingContent = <?php echo json_encode(old('konten', $artikel->konten)); ?>;
        if (existingContent) {
            quill.root.innerHTML = existingContent;
        }

        // Fungsi untuk menambah link
        function addQuillLink() {
            const url = prompt('Masukkan URL (contoh: https://example.com):');
            if (url) {
                const range = quill.getSelection();
                if (range) {
                    quill.format('link', url);
                } else {
                    alert('Silakan pilih teks terlebih dahulu');
                }
            }
        }

        // Fungsi untuk menambah gambar dari URL
        function addQuillImage() {
            const url = prompt('Masukkan URL gambar:');
            if (url) {
                const range = quill.getSelection();
                if (range) {
                    quill.insertEmbed(range.index, 'image', url);
                } else {
                    quill.insertEmbed(quill.getLength() - 1, 'image', url);
                }
            }
        }

        // Fungsi untuk upload gambar ke server
        function uploadQuillImage() {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();
            input.onchange = async () => {
                const file = input.files[0];
                if (!file) return;
                const formData = new FormData();
                formData.append('image', file);
                const response = await fetch('{{ route("admin.artikel.upload-image") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                });
                const data = await response.json();
                const range = quill.getSelection();
                if (range) {
                    quill.insertEmbed(range.index, 'image', data.url);
                } else {
                    quill.insertEmbed(quill.getLength() - 1, 'image', data.url);
                }
            };
        }

        // Sinkronisasi konten ke textarea sebelum submit
        const form = document.getElementById('artikel-form');
        const contentField = document.getElementById('content-field');
        form.addEventListener('submit', () => {
            contentField.value = quill.root.innerHTML;
        });

        // Thumbnail preview
        function handleFotoChange(input) {
            const file = input.files[0];
            if (!file) return;
            const preview = document.getElementById('foto-preview');
            const placeholder = document.getElementById('foto-placeholder');
            const filename = document.getElementById('foto-filename');
            const reader = new FileReader();
            reader.onload = e => {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
                filename.textContent = file.name;
                filename.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
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

        .dark .toolbar-btn {
            color: #a1a1aa;
        }

        .toolbar-btn:hover {
            background-color: #f4f4f5;
            color: var(--color-primary, #0d7ff2);
        }

        .dark .toolbar-btn:hover {
            background-color: #3f3f46;
            color: var(--color-primary, #0d7ff2);
        }

        .ql-container.ql-snow {
            border: none !important;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        .ql-editor {
            padding: 1rem;
            font-family: inherit;
        }

        .ql-editor h2 {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 1rem 0 0.4rem;
        }

        .ql-editor h3 {
            font-size: 1.05rem;
            font-weight: 600;
            margin: 0.75rem 0 0.3rem;
        }

        .ql-editor p {
            margin: 0.4rem 0;
        }

        .ql-editor ul,
        .ql-editor ol {
            padding-left: 1.5rem;
            margin: 0.4rem 0;
        }

        .ql-editor ul {
            list-style: disc;
        }

        .ql-editor ol {
            list-style: decimal;
        }

        .ql-editor a {
            color: var(--color-primary, #0d7ff2);
            text-decoration: underline;
        }

        .ql-editor img {
            max-width: 100%;
            border-radius: 0.375rem;
            margin: 0.4rem 0;
        }

        .ql-editor blockquote {
            border-left: 3px solid var(--color-primary, #0d7ff2);
            padding: 0.4rem 0.75rem;
            color: #64748b;
            font-style: italic;
            margin: 0.5rem 0;
        }
    </style>
</x-layouts::app>