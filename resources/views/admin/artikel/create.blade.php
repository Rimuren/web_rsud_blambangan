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
                            <select name="status"
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

                {{-- Toolbar Kustom --}}
                <div class="px-3 py-1.5 bg-zinc-50 dark:bg-zinc-900/70 border-b border-zinc-200 dark:border-zinc-800 flex flex-wrap items-center gap-1 toolbar-container">
                    {{-- Format Teks --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="toggleFormat('bold')" title="Tebal" class="toolbar-btn">
                            <flux:icon name="bold" class="size-3.5" />
                        </button>
                        <button type="button" onclick="toggleFormat('italic')" title="Miring" class="toolbar-btn">
                            <flux:icon name="italic" class="size-3.5" />
                        </button>
                        <button type="button" onclick="toggleFormat('underline')" title="Garis bawah" class="toolbar-btn">
                            <flux:icon name="underline" class="size-3.5" />
                        </button>
                        <button type="button" onclick="toggleFormat('strike')" title="Coret" class="toolbar-btn">
                            <flux:icon name="strikethrough" class="size-3.5" />
                        </button>
                    </div>
                    {{-- Heading --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="toggleHeader(1)" title="Heading 1" class="toolbar-btn text-[11px] font-bold px-1.5">H1</button>
                        <button type="button" onclick="toggleHeader(2)" title="Heading 2" class="toolbar-btn text-[11px] font-bold px-1.5">H2</button>
                        <button type="button" onclick="toggleHeader(3)" title="Heading 3" class="toolbar-btn text-[11px] font-bold px-1.5">H3</button>
                        <button type="button" onclick="toggleHeader(false)" title="Paragraf" class="toolbar-btn text-[11px] px-1.5">P</button>
                    </div>
                    {{-- List --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="toggleList('ordered')" title="Daftar Angka" class="toolbar-btn">
                            <flux:icon name="numbered-list" class="size-3.5" />
                        </button>
                        <button type="button" onclick="toggleList('bullet')" title="Daftar Bullet" class="toolbar-btn">
                            <flux:icon name="list-bullet" class="size-3.5" />
                        </button>
                    </div>
                    {{-- Alignment --}}
                    <div class="flex items-center gap-0.5 bg-white dark:bg-zinc-800 rounded-md p-0.5 border border-zinc-200 dark:border-zinc-700">
                        <button type="button" onclick="toggleAlign('')" title="Rata Kiri" class="toolbar-btn align-btn">
                            <flux:icon name="bars-3-bottom-left" class="size-3.5" />
                        </button>
                        <button type="button" onclick="toggleAlign('center')" title="Rata Tengah" class="toolbar-btn align-btn">
                            <flux:icon name="bars-3" class="size-3.5" />
                        </button>
                        <button type="button" onclick="toggleAlign('right')" title="Rata Kanan" class="toolbar-btn align-btn">
                            <flux:icon name="bars-3-bottom-right" class="size-3.5" />
                        </button>
                    </div>
                    {{-- Insert Link, Gambar, Upload --}}
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
                        <button type="button" onclick="deleteSelectedImage()" title="Hapus Gambar Terpilih" class="toolbar-btn text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20">
                            <flux:icon name="trash" class="size-3.5" />
                        </button>
                    </div>
                    {{-- Remove Format --}}
                    <div class="ml-auto">
                        <button type="button" onclick="removeFormat()" title="Hapus Format" class="toolbar-btn !text-zinc-400 hover:!text-red-500">
                            <flux:icon name="x-mark" class="size-3.5" />
                        </button>
                    </div>
                </div>

                {{-- Quill Editor --}}
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
                        Publikasikan
                    </flux:button>
                </div>
            </div>
        </form>
    </div>

    {{-- Quill CSS & JS --}}
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        // ===================
        // INISIALISASI QUILL
        // ===================
        const quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Mulai menulis artikel Anda di sini...',
            modules: {
                toolbar: false,
            }
        });

        setTimeout(() => quill.focus(), 100);

        const oldContent = {!! json_encode(old('konten', '')) !!};
        if (oldContent) {
            quill.root.innerHTML = oldContent;
        }

        // =======================================
        // FUNGSI TOGGLE FORMAT (B, I, U, Strike)
        // =======================================
        function toggleFormat(format) {
            const range = quill.getSelection(true);
            if (!range || range.length === 0) {
                const current = quill.getFormat();
                quill.format(format, !current[format]);
            } else {
                const current = quill.getFormat(range);
                quill.format(format, !current[format], 'user');
            }
            updateToolbarState();
        }

        function toggleHeader(level) {
            const range = quill.getSelection(true);
            const current = quill.getFormat(range);
            const currentHeader = current.header;
            if (currentHeader === level) {
                quill.format('header', false, 'user');
            } else {
                quill.format('header', level, 'user');
            }
            updateToolbarState();
        }

        function toggleList(type) {
            const range = quill.getSelection(true);
            const current = quill.getFormat(range);
            if (current.list === type) {
                quill.format('list', false, 'user');
            } else {
                quill.format('list', type, 'user');
            }
            updateToolbarState();
        }

        // =================
        // TOGGLE ALIGNMENT
        // =================
        function toggleAlign(align) {
            const range = quill.getSelection(true);
            if (!range) {
                alert('Klik pada teks atau gambar terlebih dahulu');
                return;
            }

            const [leaf] = quill.getLeaf(range.index);
            const isImage = leaf && leaf.domNode && leaf.domNode.tagName === 'IMG';

            let targetRange = range;
            if (isImage) {
                const blot = Quill.find(leaf.domNode);
                if (blot && blot.parent) {
                    const parent = blot.parent;
                    const index = quill.getIndex(parent);
                    const length = parent.length();
                    targetRange = { index, length };
                }
            }

            const formats = quill.getFormat(targetRange);
            const currentAlign = formats.align || '';

            if (currentAlign === align) {
                quill.formatLine(targetRange.index, targetRange.length, 'align', false, 'user');
            } else {
                if (align === '') {
                    quill.formatLine(targetRange.index, targetRange.length, 'align', false, 'user');
                } else {
                    quill.formatLine(targetRange.index, targetRange.length, 'align', align, 'user');
                }
            }
            updateToolbarState();
        }

        function removeFormat() {
            const range = quill.getSelection();
            if (range) {
                quill.removeFormat(range.index, range.length);
                updateToolbarState();
            } else {
                alert('Pilih teks terlebih dahulu');
            }
        }

        // ===========
        // MODAL LINK
        // ===========
        let linkModal = null;

        function createLinkModal(initialText, callback) {
            if (linkModal) linkModal.remove();

            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm';
            modal.innerHTML = `
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6 border border-zinc-200 dark:border-zinc-700">
                    <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mb-4">Tambah Link</h3>
                    <div class="space-y-4">
                        <div><label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Teks Link</label>
                            <input type="text" id="link-text-input" value="${initialText}" placeholder="Masukkan teks link" class="w-full px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900"></div>
                        <div><label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">URL</label>
                            <input type="text" id="link-url-input" placeholder="https://example.com" class="w-full px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900"></div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button id="link-cancel-btn" class="px-4 py-2 text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg">Batal</button>
                        <button id="link-ok-btn" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Oke</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            linkModal = modal;

            const textInput = modal.querySelector('#link-text-input');
            const urlInput = modal.querySelector('#link-url-input');
            const close = () => { modal.remove(); linkModal = null; };
            const submit = () => {
                const text = textInput.value.trim();
                let url = urlInput.value.trim();
                if (!text || !url) return alert('Teks dan URL harus diisi');
                if (!url.startsWith('http')) url = 'https://' + url;
                close();
                callback(text, url);
            };
            modal.querySelector('#link-ok-btn').addEventListener('click', submit);
            modal.querySelector('#link-cancel-btn').addEventListener('click', close);
            textInput.focus();
            [textInput, urlInput].forEach(i => i.addEventListener('keypress', e => { if (e.key === 'Enter') { e.preventDefault(); submit(); } }));
            modal.addEventListener('click', e => { if (e.target === modal) close(); });
        }

        function addQuillLink() {
            const range = quill.getSelection(true);
            const selectedText = quill.getText(range.index, range.length).trim();
            createLinkModal(selectedText, (text, url) => {
                if (selectedText) quill.deleteText(range.index, range.length);
                const idx = range.index;
                quill.insertText(idx, text, 'user');
                quill.setSelection(idx, text.length);
                quill.format('link', url);
                quill.setSelection(idx + text.length, 0);
                updateToolbarState();
            });
        }

        // =================
        // MODAL GAMBAR URL
        // =================
        let imageModal = null;

        function createImageModal(callback) {
            if (imageModal) imageModal.remove();

            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm';
            modal.innerHTML = `
                <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6 border border-zinc-200 dark:border-zinc-700">
                    <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mb-4">Tambah Gambar dari URL</h3>
                    <div class="space-y-4">
                        <div><label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">URL Gambar</label>
                            <input type="text" id="image-url-input" placeholder="https://example.com/gambar.jpg" class="w-full px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900"></div>
                        <div id="image-preview-container" class="hidden border rounded-lg p-2 bg-zinc-100 dark:bg-zinc-900">
                            <p class="text-xs text-zinc-500 mb-2">Pratinjau:</p>
                            <img id="image-preview" src="#" alt="Preview" class="max-w-full max-h-48 object-contain mx-auto" />
                        </div>
                        <p id="image-error" class="text-xs text-red-500 hidden"></p>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button id="image-cancel-btn" class="px-4 py-2 text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg">Batal</button>
                        <button id="image-insert-btn" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Sisipkan</button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
            imageModal = modal;

            const urlInput = modal.querySelector('#image-url-input');
            const previewContainer = modal.querySelector('#image-preview-container');
            const previewImg = modal.querySelector('#image-preview');
            const errorMsg = modal.querySelector('#image-error');
            const insertBtn = modal.querySelector('#image-insert-btn');
            const cancelBtn = modal.querySelector('#image-cancel-btn');

            const close = () => { modal.remove(); imageModal = null; };
            const insert = () => {
                const url = urlInput.value.trim();
                if (!url) return alert('URL tidak boleh kosong');
                close();
                callback(url);
            };

            insertBtn.addEventListener('click', insert);
            cancelBtn.addEventListener('click', close);
            urlInput.addEventListener('keypress', e => { if (e.key === 'Enter') { e.preventDefault(); insert(); } });
            modal.addEventListener('click', e => { if (e.target === modal) close(); });
            urlInput.focus();

            // Opsional: preview saat input berubah (tanpa tombol)
            urlInput.addEventListener('input', () => {
                const url = urlInput.value.trim();
                if (!url) return previewContainer.classList.add('hidden');
                const img = new Image();
                img.onload = () => { previewImg.src = url; previewContainer.classList.remove('hidden'); errorMsg.classList.add('hidden'); };
                img.onerror = () => { errorMsg.textContent = 'URL tidak valid'; errorMsg.classList.remove('hidden'); previewContainer.classList.add('hidden'); };
                img.src = url;
            });
        }

        function addQuillImage() {
            createImageModal(url => {
                const range = quill.getSelection(true);
                quill.insertEmbed(range.index, 'image', url);
                quill.setSelection(range.index + 1, 0);
            });
        }

        // ==============
        // UPLOAD GAMBAR
        // ==============
async function uploadQuillImage() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/jpeg,image/png,image/webp';
    input.click();
    input.onchange = async () => {
        const file = input.files[0];
        if (!file) return;

        // Validasi ukuran client-side
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 5MB');
            return;
        }

        const formData = new FormData();
        formData.append('image', file);

        try {
            const res = await fetch('{{ route("admin.artikel.upload-image") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: formData
            });

            const data = await res.json();

            if (!res.ok) {
                // Tangani error validasi dari Laravel (status 422)
                if (res.status === 422 && data.errors) {
                    const firstError = Object.values(data.errors)[0][0];
                    alert(firstError);
                } else {
                    alert(data.message || 'Upload gagal');
                }
                return;
            }

            const range = quill.getSelection(true);
            quill.insertEmbed(range.index, 'image', data.url);
            quill.setSelection(range.index + 1, 0);
        } catch (e) {
            alert('Terjadi kesalahan jaringan');
            console.error(e);
        }
    };
}

        // ==================
        // SINKRONISASI FORM
        // ==================
        const form = document.getElementById('artikel-form');
        const contentField = document.getElementById('content-field');
        form.addEventListener('submit', () => contentField.value = quill.root.innerHTML);

        // ==============
        // TOOLBAR STATE
        // ==============
        function updateToolbarState() {
            const range = quill.getSelection();
            if (!range) return;

            let format = quill.getFormat(range);
            const [leaf] = quill.getLeaf(range.index);
            if (leaf?.domNode?.tagName === 'IMG') {
                const blot = Quill.find(leaf.domNode);
                if (blot?.parent) {
                    const parent = blot.parent;
                    const idx = quill.getIndex(parent);
                    format = quill.getFormat({ index: idx, length: 1 });
                }
            }

            document.querySelectorAll('[onclick*="toggleFormat"]').forEach(btn => {
                const m = btn.getAttribute('onclick').match(/'([^']+)'/);
                if (m) btn.classList.toggle('active', !!format[m[1]]);
            });
            const header = format.header;
            document.querySelectorAll('[onclick*="toggleHeader"]').forEach(btn => {
                const m = btn.getAttribute('onclick').match(/\(([^)]+)\)/);
                if (m) {
                    let v = m[1];
                    if (v === 'false') v = false;
                    else if (!isNaN(v)) v = parseInt(v);
                    btn.classList.toggle('active', v === false ? !header : header === v);
                }
            });
            document.querySelectorAll('[onclick*="toggleList"]').forEach(btn => {
                const m = btn.getAttribute('onclick').match(/'([^']+)'/);
                if (m) btn.classList.toggle('active', format.list === m[1]);
            });
            const align = format.align || '';
            document.querySelectorAll('[onclick*="toggleAlign"]').forEach(btn => {
                const m = btn.getAttribute('onclick').match(/'([^']*)'/);
                if (m) btn.classList.toggle('active', align === m[1]);
            });
        }

        quill.on('editor-change', updateToolbarState);
        quill.on('selection-change', updateToolbarState);

        // ==================
        // THUMBNAIL PREVIEW
        // ==================
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

        const dropzone = document.getElementById('foto-dropzone');
        ['dragenter','dragover','dragleave','drop'].forEach(ev => dropzone.addEventListener(ev, e => { e.preventDefault(); e.stopPropagation(); }));
        dropzone.addEventListener('dragover', () => dropzone.classList.add('border-primary','bg-primary/10'));
        dropzone.addEventListener('dragleave', () => dropzone.classList.remove('border-primary','bg-primary/10'));
        dropzone.addEventListener('drop', e => {
            dropzone.classList.remove('border-primary','bg-primary/10');
            const file = e.dataTransfer.files[0];
            if (file?.type.startsWith('image/')) {
                document.getElementById('foto-input').files = e.dataTransfer.files;
                handleFotoChange(document.getElementById('foto-input'));
            }
        });
    </script>

    <style>
    .toolbar-btn { 
        display: inline-flex; 
        align-items: center; 
        justify-content: center; 
        min-width: 1.75rem; 
        height: 1.75rem; 
        border-radius: 0.25rem; 
        color: #52525b; 
        transition: all 0.15s; 
        cursor: pointer; 
    }

    .toolbar-btn > * { pointer-events: none !important; }

    .dark .toolbar-btn { color: #a1a1aa; }

    .toolbar-btn:hover { 
        background-color: #f4f4f5; 
        color: #0d7ff2; 
    }

    .dark .toolbar-btn:hover { 
        background-color: #3f3f46; 
        color: #60a5fa; 
    }

    .toolbar-btn.active { 
        background-color: #0d7ff2 !important; 
        color: white !important; 
    }

    .dark .toolbar-btn.active { 
        background-color: #2563eb !important; 
        color: white !important; 
    }

    /* QUILL */
    .ql-container.ql-snow { 
        border: none !important; 
        font-size: 0.875rem; 
        line-height: 1.5; 
    }

    .ql-editor { 
        padding: 1rem; 
        font-family: inherit; 
    }

    .ql-editor:focus { outline: none; }

    /* TEXT */
    .ql-editor p { margin: 0.4rem 0; }

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

    /* LIST */
    .ql-editor ul, .ql-editor ol { 
        padding-left: 1.5rem; 
        margin: 0.4rem 0; 
    }

    .ql-editor ul { list-style: disc; }
    .ql-editor ol { list-style: decimal; }

    /* LINK */
    .ql-editor a { 
        color: #0d7ff2; 
        text-decoration: underline; 
        cursor: pointer; 
    }

    .ql-editor a:hover { 
        color: #2563eb !important; 
        text-decoration: none !important; 
    }

    /* =========================
        UTAMA GAMBAR
    ========================= */
    .ql-editor img {
        max-width: 100%;
        border-radius: 0.375rem;
        margin: 0.5rem 0;
        cursor: pointer;
        display: block;
    }

    /* default kiri */
    .ql-editor p img {
        margin-left: 0;
        margin-right: auto;
    }

    /* center */
    .ql-editor .ql-align-center img {
        margin-left: auto;
        margin-right: auto;
    }

    /* right */
    .ql-editor .ql-align-right img {
        margin-left: auto;
        margin-right: 0;
    }

    /* left explicit */
    .ql-editor .ql-align-left img {
        margin-left: 0;
        margin-right: auto;
    }

    /* ALIGN TEXT */
    .ql-editor .ql-align-center {
        text-align: center;
    }

    .ql-editor .ql-align-right {
        text-align: right;
    }

    .ql-editor .ql-align-left {
        text-align: left;
    }

    /* BLOCKQUOTE */
    .ql-editor blockquote { 
        border-left: 3px solid #0d7ff2; 
        padding: 0.4rem 0.75rem; 
        color: #64748b; 
        font-style: italic; 
        margin: 0.5rem 0; 
    }
</style>
</x-layouts::app>