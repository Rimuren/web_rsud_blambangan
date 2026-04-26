<x-layouts::app :title="__('Tambah Artikel')">
    <x-slot:header>
        {{ __('Tambah Artikel') }}
    </x-slot:header>

    <div class="w-full max-w-4xl mx-auto px-4 pt-4">
        <h1 class="text-lg font-bold text-zinc-800 dark:text-white">Tambah Artikel</h1>
        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">Isi form di bawah untuk menambahkan artikel baru</p>
    </div>

    <div class="w-full max-w-5xl mx-auto px-6 py-6 space-y-6">
        <form method="POST" action="{{ route('admin.artikel.store') }}" enctype="multipart/form-data" id="artikel-form">
            @csrf

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
                    <input type="text" name="judul" value="{{ old('judul') }}" required
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
                                <option value="" disabled {{ old('kategori_id') ? '' : 'selected' }}>Pilih kategori...</option>
                                @foreach($kategoris as $kat)
                                <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                                @endforeach
                            </select>
                            <flux:icon name="chevron-down" class="size-3.5 text-zinc-400 absolute right-2.5 top-1/2 -translate-y-1/2 pointer-events-none" />
                        </div>
                        @error('kategori_id') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-xs font-semibold text-zinc-700 dark:text-zinc-300">Status Publikasi</label>
                        <div class="relative">
                            <select name="status" id="status-select"
                                class="w-full pl-3 pr-8 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900 text-zinc-900 dark:text-white appearance-none focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none transition-all">
                                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Diterbitkan</option>
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
                        <img id="foto-preview" src="#" alt="Preview" class="hidden w-full max-h-36 object-cover rounded-md mb-1" />
                        <div id="foto-placeholder" class="flex flex-col items-center gap-2">
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
                    <input type="file" name="thumbnail" id="foto-input" accept="image/png,image/jpeg,image/jpg" class="sr-only">
                </label>
                @error('thumbnail') <div class="text-red-500 text-xs mt-1">{{ $message }}</div> @enderror
            </flux:card>

            {{-- KONTEN ARTIKEL --}}
            <flux:card class="mb-6 overflow-hidden p-0">
                <div class="px-4 py-2.5 border-b border-zinc-100 dark:border-zinc-800 flex items-center gap-2">
                    <flux:icon name="pencil-square" class="size-3.5 text-primary" />
                    <h2 class="text-[10px] font-bold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">Isi Artikel</h2>
                </div>

                {{-- Toolbar --}}
                <div class="px-3 py-1.5 bg-zinc-50 dark:bg-zinc-900/70 border-b border-zinc-200 dark:border-zinc-800 flex flex-wrap items-center gap-1 toolbar-container">

                    {{-- Format: bold / italic / underline / strike --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" title="Tebal"       class="toolbar-btn" data-toolbar="format" data-fmt="bold"
                            onclick="editor.toggleFormat('bold')">
                            <flux:icon name="bold" class="size-3.5" />
                        </button>
                        <button type="button" title="Miring"      class="toolbar-btn" data-toolbar="format" data-fmt="italic"
                            onclick="editor.toggleFormat('italic')">
                            <flux:icon name="italic" class="size-3.5" />
                        </button>
                        <button type="button" title="Garis bawah" class="toolbar-btn" data-toolbar="format" data-fmt="underline"
                            onclick="editor.toggleFormat('underline')">
                            <flux:icon name="underline" class="size-3.5" />
                        </button>
                        <button type="button" title="Coret"       class="toolbar-btn" data-toolbar="format" data-fmt="strike"
                            onclick="editor.toggleFormat('strike')">
                            <flux:icon name="strikethrough" class="size-3.5" />
                        </button>
                    </div>

                    {{-- Heading --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" title="Heading 1" class="toolbar-btn text-[11px] font-bold px-1.5" data-toolbar="header" data-level="1"
                            onclick="editor.toggleHeader(1)">H1</button>
                        <button type="button" title="Heading 2" class="toolbar-btn text-[11px] font-bold px-1.5" data-toolbar="header" data-level="2"
                            onclick="editor.toggleHeader(2)">H2</button>
                        <button type="button" title="Heading 3" class="toolbar-btn text-[11px] font-bold px-1.5" data-toolbar="header" data-level="3"
                            onclick="editor.toggleHeader(3)">H3</button>
                        <button type="button" title="Paragraf"  class="toolbar-btn text-[11px] px-1.5" data-toolbar="header" data-level="false"
                            onclick="editor.toggleHeader(false)">P</button>
                    </div>

                    {{-- List --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" title="Daftar Angka" class="toolbar-btn" data-toolbar="list" data-list-type="ordered"
                            onclick="editor.toggleList('ordered')">
                            <flux:icon name="numbered-list" class="size-3.5" />
                        </button>
                        <button type="button" title="Daftar Bullet" class="toolbar-btn" data-toolbar="list" data-list-type="bullet"
                            onclick="editor.toggleList('bullet')">
                            <flux:icon name="list-bullet" class="size-3.5" />
                        </button>
                    </div>

                    {{-- Align --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" title="Rata Kiri"   class="toolbar-btn" data-toolbar="align" data-align=""
                            onclick="editor.toggleAlign('')">
                            <flux:icon name="bars-3-bottom-left" class="size-3.5" />
                        </button>
                        <button type="button" title="Rata Tengah" class="toolbar-btn" data-toolbar="align" data-align="center"
                            onclick="editor.toggleAlign('center')">
                            <flux:icon name="bars-3" class="size-3.5" />
                        </button>
                        <button type="button" title="Rata Kanan"  class="toolbar-btn" data-toolbar="align" data-align="right"
                            onclick="editor.toggleAlign('right')">
                            <flux:icon name="bars-3-bottom-right" class="size-3.5" />
                        </button>
                    </div>

                    {{-- Media --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" title="Tambah Link"          class="toolbar-btn" onclick="editor.openLinkModal()">
                            <flux:icon name="link" class="size-3.5" />
                        </button>
                        <button type="button" title="Tambah Gambar URL"    class="toolbar-btn" onclick="editor.openImageModal()">
                            <flux:icon name="photo" class="size-3.5" />
                        </button>
                        <button type="button" title="Upload Gambar"        class="toolbar-btn" onclick="editor.uploadImage()">
                            <flux:icon name="arrow-up-tray" class="size-3.5" />
                        </button>
                        <button type="button" title="Hapus Gambar Terpilih" class="toolbar-btn text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20"
                            onclick="editor.deleteSelectedImage()">
                            <flux:icon name="trash" class="size-3.5" />
                        </button>
                    </div>

                    {{-- Image Resize Presets --}}
                    <div id="img-resize-toolbar"
                         class="hidden items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-blue-200 dark:border-blue-700">
                        <span class="text-[10px] font-semibold text-blue-500 px-1.5 select-none">Lebar:</span>
                        <button type="button" title="25%"  class="toolbar-btn text-[10px] font-bold px-1.5 text-blue-600" onclick="editor.applyImagePreset(25)">25%</button>
                        <button type="button" title="50%"  class="toolbar-btn text-[10px] font-bold px-1.5 text-blue-600" onclick="editor.applyImagePreset(50)">50%</button>
                        <button type="button" title="75%"  class="toolbar-btn text-[10px] font-bold px-1.5 text-blue-600" onclick="editor.applyImagePreset(75)">75%</button>
                        <button type="button" title="100%" class="toolbar-btn text-[10px] font-bold px-1.5 text-blue-600" onclick="editor.applyImagePreset(100)">100%</button>
                        <div class="w-px h-4 bg-zinc-200 dark:bg-zinc-700 mx-0.5"></div>
                        <span id="img-size-readout" class="text-[10px] text-zinc-400 px-1 tabular-nums select-none min-w-[72px]"></span>
                    </div>

                    {{-- Remove Format --}}
                    <div class="ml-auto">
                        <button type="button" title="Hapus Format" class="toolbar-btn !text-zinc-400 hover:!text-red-500"
                            onclick="editor.removeFormat()">
                            <flux:icon name="x-mark" class="size-3.5" />
                        </button>
                    </div>
                </div>

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
                    <button type="submit" id="submit-action-btn" name="action" value="draft"
                        class="inline-flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-lg transition-all border border-primary/30 dark:border-primary/40 text-primary hover:bg-primary/5">
                        <flux:icon name="document" class="size-3.5" />
                        <span id="submit-action-text">Simpan Draft</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Asset eksternal Quill --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    {{-- CSS dan JS khusus --}}
    <link href="{{ asset('css/admin/artikel-form.css') }}" rel="stylesheet">
    <script src="{{ asset('js/admin/artikel-form.js') }}" ></script>

<script>
    const editor = new ArticleEditor({
        uploadImageUrl : '{{ route("admin.artikel.upload-image") }}',
        csrfToken      : '{{ csrf_token() }}',
        oldContent     : @json(old('konten', '')),
    });

    editor.init();
</script>

</x-layouts::app>