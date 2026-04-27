/**
 * artikel-editor.js
 *
 * Arsitektur OOP untuk halaman Tambah / Edit Artikel.
 *
 * Kelas-kelas:
 *  ├── QuillImageResizer  – drag-handle resize untuk gambar di dalam editor
 *  ├── LinkModal          – modal input teks + URL untuk menyisipkan link
 *  ├── ImageModal         – modal input URL gambar dengan live-preview
 *  ├── ThumbnailUploader  – drag-and-drop / click-to-upload foto unggulan
 *  ├── ToolbarManager     – sinkronisasi status tombol toolbar ↔ format Quill
 *  └── ArticleEditor      – orkestrator utama; inisialisasi semua kelas di atas
 */

/* ─────────────────
   QuillImageResizer
   ───────────────── */
class QuillImageResizer {
    static MIN_SIZE = 40;

    constructor(quill) {
        this.quill      = quill;
        this.activeImg  = null;
        this.overlay    = null;
        this.handleDir  = null;
        this.startX = this.startY = this.startW = this.startH = 0;
        this.editorRect = null;

        this._HANDLES = ['nw', 'n', 'ne', 'e', 'se', 's', 'sw', 'w'];

        this._onEditorClick   = this._onEditorClick.bind(this);
        this._onDocMouseDown  = this._onDocMouseDown.bind(this);
        this._onKeyDown       = this._onKeyDown.bind(this);
        this._onMouseMove     = this._onMouseMove.bind(this);
        this._onMouseUp       = this._onMouseUp.bind(this);
    }

    init() {
        this.quill.root.addEventListener('click', this._onEditorClick);
        document.addEventListener('mousedown', this._onDocMouseDown, true);
        document.addEventListener('keydown', this._onKeyDown);
    }

    // event handlers
    _onEditorClick(e) {
        const img = e.target.closest('img');
        if (img && this.quill.root.contains(img)) {
            e.preventDefault();
            e.stopPropagation();
            this.select(img);
        } else {
            this.deselect();
        }
    }

    _onDocMouseDown(e) {
        if (!this.overlay) return;

        const toolbar = document.querySelector('.toolbar-container');
        if (toolbar && toolbar.contains(e.target)) return;

        if (!this.overlay.contains(e.target) && !this.quill.root.contains(e.target)) {
            this.deselect();
        }
    }

    _onKeyDown(e) {
        if (e.key === 'Escape') this.deselect();
    }

    _onMouseMove(e) {
        if (!this.activeImg || !this.handleDir) return;

        const dx = e.clientX - this.startX;
        const dy = e.clientY - this.startY;
        const aspectRatio = this.startH / this.startW;
        const lockAspect  = !e.shiftKey;

        let newW = this.startW;
        let newH = this.startH;
        const dir = this.handleDir;

        if (dir.includes('e')) newW = this.startW + dx;
        if (dir.includes('w')) newW = this.startW - dx;
        if (dir.includes('s')) newH = this.startH + dy;
        if (dir.includes('n')) newH = this.startH - dy;

        if (lockAspect) {
            if (dir.length === 2 || dir === 'e' || dir === 'w') {
                newH = newW * aspectRatio;
            } else {
                newW = newH / aspectRatio;
            }
        }

        const maxW = this.editorRect.width - 4;
        newW = Math.max(QuillImageResizer.MIN_SIZE, Math.min(newW, maxW));
        newH = Math.max(QuillImageResizer.MIN_SIZE, newH);

        this.activeImg.style.width  = Math.round(newW) + 'px';
        this.activeImg.style.height = Math.round(newH) + 'px';

        this._positionOverlay(this.activeImg);
        this._updateBadge();
        this._updateSizeReadout();
    }

    _onMouseUp() {
        document.removeEventListener('mousemove', this._onMouseMove);
        document.removeEventListener('mouseup',   this._onMouseUp);
        document.body.style.cursor     = '';
        document.body.style.userSelect = '';
        this.handleDir = null;
    }

    // public API
    select(img) {
        if (this.activeImg === img) return;
        this.deselect();
        this.activeImg = img;

        if (!img.style.width)  img.style.width  = img.offsetWidth  + 'px';
        if (!img.style.height) img.style.height = img.offsetHeight + 'px';

        this._buildOverlay(img);
        this._showResizeToolbar(true);
        this._updateSizeReadout();
    }

    deselect() {
        if (!this.activeImg) return;
        this._removeOverlay();
        this._showResizeToolbar(false);
        this.activeImg = null;
    }

    applyPreset(pct) {
        if (!this.activeImg) return;
        const maxW   = this.quill.root.getBoundingClientRect().width - 4;
        const aspect = this.activeImg.naturalHeight / this.activeImg.naturalWidth;
        const newW   = Math.round(maxW * pct / 100);
        const newH   = Math.round(newW * aspect);
        this.activeImg.style.width  = newW + 'px';
        this.activeImg.style.height = newH + 'px';
        this._positionOverlay(this.activeImg);
        this._updateBadge();
        this._updateSizeReadout();
    }

    getActiveImg() { return this.activeImg; }

    // overlay build/position 
    _buildOverlay(img) {
        this._removeOverlay();

        const overlay = document.createElement('div');
        overlay.id = 'qir-overlay';
        overlay.style.cssText = `
            position:absolute; pointer-events:none;
            border:2px solid #3b82f6; border-radius:3px;
            box-sizing:border-box; z-index:100;
        `;
        this.overlay = overlay;
        this._positionOverlay(img);

        // handles
        this._HANDLES.forEach(dir => {
            const h = document.createElement('div');
            h.dataset.dir = dir;
            h.style.cssText = this._handleStyle(dir);
            h.style.pointerEvents = 'all';
            h.addEventListener('mousedown', this._onHandleMouseDown.bind(this));
            overlay.appendChild(h);
        });

        // floating badge
        const badge = document.createElement('div');
        badge.id = 'qir-badge';
        badge.style.cssText = `
            position:absolute; bottom:-22px; left:50%; transform:translateX(-50%);
            background:#3b82f6; color:#fff;
            font-size:10px; font-weight:600; font-family:'DM Sans',sans-serif;
            padding:2px 7px; border-radius:99px;
            white-space:nowrap; pointer-events:none; z-index:101;
        `;
        overlay.appendChild(badge);
        this._updateBadge();

        const container = this.quill.root.parentElement;
        container.style.position = 'relative';
        container.appendChild(overlay);
    }

    _positionOverlay(img) {
        if (!this.overlay) return;
        const containerRect = this.quill.root.parentElement.getBoundingClientRect();
        const imgRect       = img.getBoundingClientRect();
        this.overlay.style.left   = (imgRect.left - containerRect.left) + 'px';
        this.overlay.style.top    = (imgRect.top  - containerRect.top)  + 'px';
        this.overlay.style.width  = imgRect.width  + 'px';
        this.overlay.style.height = imgRect.height + 'px';
    }

    _removeOverlay() {
        if (this.overlay) { this.overlay.remove(); this.overlay = null; }
    }

    _handleStyle(dir) {
        const size = '9px', half = '-5px';
        const posMap = {
            nw: `top:${half};left:${half};cursor:nw-resize`,
            n:  `top:${half};left:calc(50% - 4px);cursor:n-resize`,
            ne: `top:${half};right:${half};cursor:ne-resize`,
            e:  `top:calc(50% - 4px);right:${half};cursor:e-resize`,
            se: `bottom:${half};right:${half};cursor:se-resize`,
            s:  `bottom:${half};left:calc(50% - 4px);cursor:s-resize`,
            sw: `bottom:${half};left:${half};cursor:sw-resize`,
            w:  `top:calc(50% - 4px);left:${half};cursor:w-resize`,
        };
        return `
            position:absolute; width:${size}; height:${size};
            background:#fff; border:2px solid #3b82f6; border-radius:2px;
            box-sizing:border-box; z-index:102; ${posMap[dir]};
        `;
    }

    _onHandleMouseDown(e) {
        if (!this.activeImg) return;
        e.preventDefault();
        e.stopPropagation();

        this.handleDir  = e.currentTarget.dataset.dir;
        this.startX     = e.clientX;
        this.startY     = e.clientY;
        this.startW     = this.activeImg.offsetWidth;
        this.startH     = this.activeImg.offsetHeight;
        this.editorRect = this.quill.root.getBoundingClientRect();

        document.addEventListener('mousemove', this._onMouseMove);
        document.addEventListener('mouseup',   this._onMouseUp);
        document.body.style.cursor     = this._cursorForDir(this.handleDir);
        document.body.style.userSelect = 'none';
    }

    _cursorForDir(dir) {
        return {
            nw: 'nw-resize', n: 'n-resize', ne: 'ne-resize', e: 'e-resize',
            se: 'se-resize', s: 's-resize', sw: 'sw-resize', w: 'w-resize',
        }[dir] || 'default';
    }

    // badge + readout 
    _updateBadge() {
        if (!this.overlay || !this.activeImg) return;
        const badge = this.overlay.querySelector('#qir-badge');
        if (badge) badge.textContent =
            `${Math.round(this.activeImg.offsetWidth)} × ${Math.round(this.activeImg.offsetHeight)} px`;
    }

    _updateSizeReadout() {
        if (!this.activeImg) return;
        const readout = document.getElementById('img-size-readout');
        if (readout) readout.textContent =
            `${Math.round(this.activeImg.offsetWidth)} × ${Math.round(this.activeImg.offsetHeight)} px`;
    }

    _showResizeToolbar(show) {
        const tb = document.getElementById('img-resize-toolbar');
        if (!tb) return;
        if (show) tb.classList.replace('hidden', 'flex');
        else       tb.classList.replace('flex', 'hidden');
    }
}


/* ──────────
   LinkModal
   ────────── */
class LinkModal {
    constructor(quill, toolbarManager) {
        this.quill          = quill;
        this.toolbarManager = toolbarManager;
        this._modal         = null;
    }

    open() {
        const range        = this.quill.getSelection(true);
        const selectedText = this.quill.getText(range.index, range.length).trim();

        this._create(selectedText, (text, url) => {
            if (selectedText) this.quill.deleteText(range.index, range.length);
            const idx = range.index;
            this.quill.insertText(idx, text, 'user');
            this.quill.setSelection(idx, text.length);
            this.quill.format('link', url);
            this.quill.setSelection(idx + text.length, 0);
            this.toolbarManager.update();
        });
    }

    _create(initialText, callback) {
        this._close();
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm';
        modal.innerHTML = `
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6 border border-zinc-200 dark:border-zinc-700">
                <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mb-4">Tambah Link</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Teks Link</label>
                        <input type="text" id="link-text-input" value="${initialText}" placeholder="Masukkan teks link"
                            class="w-full px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">URL</label>
                        <input type="text" id="link-url-input" placeholder="https://example.com"
                            class="w-full px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                    </div>
                </div>
                <div class="flex justify-end gap-2 mt-6">
                    <button id="link-cancel-btn" class="px-4 py-2 text-sm font-medium text-zinc-600 dark:text-zinc-400 hover:bg-zinc-100 dark:hover:bg-zinc-700 rounded-lg">Batal</button>
                    <button id="link-ok-btn" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg">Oke</button>
                </div>
            </div>`;
        document.body.appendChild(modal);
        this._modal = modal;

        const textInput = modal.querySelector('#link-text-input');
        const urlInput  = modal.querySelector('#link-url-input');

        const submit = () => {
            const text = textInput.value.trim();
            let   url  = urlInput.value.trim();
            if (!text || !url) { alert('Teks dan URL harus diisi'); return; }
            if (!url.startsWith('http')) url = 'https://' + url;
            this._close();
            callback(text, url);
        };

        modal.querySelector('#link-ok-btn').addEventListener('click', submit);
        modal.querySelector('#link-cancel-btn').addEventListener('click', () => this._close());
        [textInput, urlInput].forEach(i =>
            i.addEventListener('keypress', e => { if (e.key === 'Enter') { e.preventDefault(); submit(); } }));
        modal.addEventListener('click', e => { if (e.target === modal) this._close(); });
        textInput.focus();
    }

    _close() {
        if (this._modal) { this._modal.remove(); this._modal = null; }
    }
}


/* ───────────
   ImageModal
   ─────────── */
class ImageModal {
    constructor(quill) {
        this.quill  = quill;
        this._modal = null;
    }

    open() {
        this._create(url => {
            const range = this.quill.getSelection(true);
            this.quill.insertEmbed(range.index, 'image', url);
            this.quill.setSelection(range.index + 1, 0);
        });
    }

    _create(callback) {
        this._close();
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm';
        modal.innerHTML = `
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6 border border-zinc-200 dark:border-zinc-700">
                <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mb-4">Tambah Gambar dari URL</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">URL Gambar</label>
                        <input type="text" id="image-url-input" placeholder="https://example.com/gambar.jpg"
                            class="w-full px-3 py-2 text-sm border border-zinc-200 dark:border-zinc-700 rounded-lg bg-zinc-50 dark:bg-zinc-900">
                    </div>
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
            </div>`;
        document.body.appendChild(modal);
        this._modal = modal;

        const urlInput         = modal.querySelector('#image-url-input');
        const previewContainer = modal.querySelector('#image-preview-container');
        const previewImg       = modal.querySelector('#image-preview');
        const errorMsg         = modal.querySelector('#image-error');

        const insert = () => {
            const url = urlInput.value.trim();
            if (!url) { alert('URL tidak boleh kosong'); return; }
            this._close();
            callback(url);
        };

        modal.querySelector('#image-insert-btn').addEventListener('click', insert);
        modal.querySelector('#image-cancel-btn').addEventListener('click', () => this._close());
        urlInput.addEventListener('keypress', e => { if (e.key === 'Enter') { e.preventDefault(); insert(); } });
        modal.addEventListener('click', e => { if (e.target === modal) this._close(); });

        urlInput.addEventListener('input', () => {
            const url = urlInput.value.trim();
            if (!url) { previewContainer.classList.add('hidden'); return; }
            const img = new Image();
            img.onload  = () => {
                previewImg.src = url;
                previewContainer.classList.remove('hidden');
                errorMsg.classList.add('hidden');
            };
            img.onerror = () => {
                errorMsg.textContent = 'URL tidak valid';
                errorMsg.classList.remove('hidden');
                previewContainer.classList.add('hidden');
            };
            img.src = url;
        });
        urlInput.focus();
    }

    _close() {
        if (this._modal) { this._modal.remove(); this._modal = null; }
    }
}


/* ──────────────────
   ThumbnailUploader
   ────────────────── */
class ThumbnailUploader {
    constructor({ dropzoneId, inputId, previewId, placeholderId, filenameId }) {
        this.dropzone    = document.getElementById(dropzoneId);
        this.input       = document.getElementById(inputId);
        this.preview     = document.getElementById(previewId);
        this.placeholder = document.getElementById(placeholderId);
        this.filename    = document.getElementById(filenameId);
    }

    init() {
        this.input.addEventListener('change', () => this._handleFile(this.input.files[0]));
        this._initDragDrop();
    const removeBtn = document.getElementById('foto-remove-btn');
    if (removeBtn) removeBtn.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();
        this.remove();
    });
    }
    remove() {
    this.preview.src = '#';
    this.preview.classList.add('hidden');
    this.placeholder.classList.remove('hidden');
    this.placeholder.classList.add('flex');
    this.filename.textContent = '';
    this.filename.classList.add('hidden');
    this.input.value = '';

    const flag = document.getElementById('remove-thumbnail-flag');
    if (flag) flag.value = '1';

    const removeBtn = document.getElementById('foto-remove-btn');
    if (removeBtn) removeBtn.classList.add('hidden');
    }

    _handleFile(file) {
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            this.preview.src = e.target.result;
            this.preview.classList.remove('hidden');
            this.placeholder.classList.add('hidden');
            this.filename.textContent = file.name;
            this.filename.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    _initDragDrop() {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ev =>
            this.dropzone.addEventListener(ev, e => { e.preventDefault(); e.stopPropagation(); }));

        this.dropzone.addEventListener('dragover',  () =>
            this.dropzone.classList.add('border-primary', 'bg-primary/10'));
        this.dropzone.addEventListener('dragleave', () =>
            this.dropzone.classList.remove('border-primary', 'bg-primary/10'));
        this.dropzone.addEventListener('drop', e => {
            this.dropzone.classList.remove('border-primary', 'bg-primary/10');
            const file = e.dataTransfer.files[0];
            if (file?.type.startsWith('image/')) {
                const dt = new DataTransfer();
                dt.items.add(file);
                this.input.files = dt.files;
                this._handleFile(file);
            }
        });
    }
}


/* ───────────────
   ToolbarManager
   ─────────────── */
class ToolbarManager {
    constructor(quill) {
        this.quill = quill;
    }

    init() {
        this.quill.on('editor-change',    () => this.update());
        this.quill.on('selection-change', () => this.update());
    }

    update() {
        const range = this.quill.getSelection();
        if (!range) return;

        let format = this.quill.getFormat(range);

        const [leaf] = this.quill.getLeaf(range.index);
        if (leaf?.domNode?.tagName === 'IMG') {
            const blot = Quill.find(leaf.domNode);
            if (blot?.parent) {
                format = this.quill.getFormat({ index: this.quill.getIndex(blot.parent), length: 1 });
            }
        }

        // toggleFormat buttons  (bold, italic, underline, strike)
        document.querySelectorAll('[data-toolbar="format"]').forEach(btn => {
            btn.classList.toggle('active', !!format[btn.dataset.fmt]);
        });

        // toggleHeader buttons
        document.querySelectorAll('[data-toolbar="header"]').forEach(btn => {
            let level = btn.dataset.level;
            if (level === 'false') level = false;
            else if (!isNaN(level)) level = parseInt(level);
            btn.classList.toggle('active', level === false ? !format.header : format.header === level);
        });

        // toggleList buttons
        document.querySelectorAll('[data-toolbar="list"]').forEach(btn => {
            btn.classList.toggle('active', format.list === btn.dataset.listType);
        });

        // toggleAlign buttons
        const align = format.align || '';
        document.querySelectorAll('[data-toolbar="align"]').forEach(btn => {
            btn.classList.toggle('active', align === btn.dataset.align);
        });
    }
}


/* ──────────────────────────────────
   ArticleEditor  (main orchestrator)
   ────────────────────────────────── */
class ArticleEditor {
    /**
     * @param {object} config
     * @param {string} config.uploadImageUrl   – server route for image upload
     * @param {string} config.csrfToken        – Laravel CSRF token
     * @param {string} config.oldContent       – previous editor content
     */
    constructor({ uploadImageUrl, csrfToken, oldContent = '' }) {
        this.uploadImageUrl = uploadImageUrl;
        this.csrfToken      = csrfToken;
        this.oldContent     = oldContent;
    }

    init() {
        this._initQuill();
        this._initKeyboardCustom();
        this._initSubModules();
        this._initSubmitButton();
        this._initFormSync();
        setTimeout(() => this.quill.focus(), 100);
    }

    // Quill setup
    _initQuill() {
        this.quill = new Quill('#quill-editor', {
            theme: 'snow',
            placeholder: 'Mulai menulis artikel Anda di sini...',
            modules: { 
                toolbar: false,
                keyboard: {
                    bindings: {
                        shiftEnter: null
                    }
                }
            },
        });

        if (this.oldContent) this.quill.root.innerHTML = this.oldContent;
    }

    // CUSTOM KEYBOARD
    _initKeyboardCustom() {
        const editorRoot = this.quill.root;
        let shiftEnterTimer = null;
        
        editorRoot.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                const range = this.quill.getSelection();
                if (!range) return;
                
                const format = this.quill.getFormat(range);
                const isInList = format.list === 'ordered' || format.list === 'bullet';
                
                // SHIFT + ENTER di dalam LIST
                if (e.shiftKey && isInList) {
                    e.preventDefault();
                    e.stopPropagation();
                    
                    // Simpan index saat ini
                    const currentIndex = range.index;
                    
                    // Insert line break
                    this.quill.insertText(currentIndex, '\n', 'user');
                    this.quill.formatText(currentIndex + 1, 1, 'list', false, 'user');

                    setTimeout(() => {
                        const editorContent = editorRoot.innerHTML;
                        
                        // Hapus format list dari seluruh baris baru
                        const newRange = this.quill.getSelection();
                        if (newRange) {
                            // Pastikan format list dihapus dari posisi cursor
                            this.quill.format('list', false, 'silent');
                            
                            // Dapatkan elemen DOM di posisi cursor
                            const [leaf, offset] = this.quill.getLeaf(newRange.index);
                            if (leaf && leaf.domNode) {
                                let currentNode = leaf.domNode;
                                
                                // Cari elemen terdekat (li atau p)
                                while (currentNode && !['LI', 'P', 'DIV'].includes(currentNode.tagName)) {
                                    currentNode = currentNode.parentElement;
                                }
                                
                                if (currentNode) {
                                    // Terapkan indentasi
                                    currentNode.style.paddingLeft = '30px';
                                    currentNode.style.marginLeft = '0px';
                                    currentNode.style.listStyle = 'none';
                                    currentNode.classList.add('ql-indented-line');
                                }
                            }
                        }
                        
                        // Hapus semua list item yang kosong
                        const allLis = editorRoot.querySelectorAll('li');
                        allLis.forEach(li => {
                            // Jika li hanya berisi whitespace atau kosong, hapus
                            if (li.textContent.trim() === '' && li.children.length === 0) {
                                li.remove();
                            }
                            // Jika li hanya berisi \n atau &nbsp;
                            if (li.innerHTML.trim() === '' || li.innerHTML === '<br>' || li.innerHTML === '&nbsp;') {
                                li.remove();
                            }
                        });
                        
                        // Perbaiki penomoran list agar tetap urut
                        const allOrderedLists = editorRoot.querySelectorAll('ol');
                        allOrderedLists.forEach(ol => {
                            let counter = 1;
                            ol.querySelectorAll('li').forEach(li => {
                                // Hapus atribut value
                                li.removeAttribute('data-value');
                                li.removeAttribute('value');
                                // Update counter style
                                li.style.counterReset = 'none';
                            });
                        });
                        
                    }, 15);
                    
                    return false;
                }
            }
        });
        
        // Tambahkan CSS global untuk baris hasil Shift+Enter
        const style = document.createElement('style');
        style.textContent = `
            .ql-editor .ql-indented-line {
                padding-left: 30px !important;
                margin-left: 0 !important;
                list-style: none !important;
            }
            .ql-editor li {
                position: relative;
            }
            .ql-editor .ql-indented-line {
                display: block;
            }
        `;
        document.head.appendChild(style);
        
        // Bersihkan timer jika komponen di-destroy
        window.addEventListener('beforeunload', () => {
            if (shiftEnterTimer) clearTimeout(shiftEnterTimer);
        });
    }
    
    // sub-modules
    _initSubModules() {
        // Image resizer
        this.imageResizer = new QuillImageResizer(this.quill);
        this.imageResizer.init();

        // Toolbar manager
        this.toolbarManager = new ToolbarManager(this.quill);
        this.toolbarManager.init();

        // Modals
        this.linkModal  = new LinkModal(this.quill, this.toolbarManager);
        this.imageModal = new ImageModal(this.quill);

        // Thumbnail uploader
        this.thumbnailUploader = new ThumbnailUploader({
            dropzoneId:    'foto-dropzone',
            inputId:       'foto-input',
            previewId:     'foto-preview',
            placeholderId: 'foto-placeholder',
            filenameId:    'foto-filename',
        });
        this.thumbnailUploader.init();
    }

    // submit button (draft vs publish)
    _initSubmitButton() {
        this._statusSelect = document.getElementById('status-select');
        this._submitBtn    = document.getElementById('submit-action-btn');
        this._submitText   = document.getElementById('submit-action-text');

        this._statusSelect.addEventListener('change', () => this._syncSubmitButton());
        this._syncSubmitButton();
    }

    _syncSubmitButton() {
        const isDraft = this._statusSelect.value === 'draft';
        this._submitBtn.value         = isDraft ? 'draft' : 'published';
        this._submitText.textContent  = isDraft ? 'Simpan Draft' : 'Publikasikan';

        this._submitBtn.className = 'inline-flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-lg transition-all';

        if (isDraft) {
            this._submitBtn.classList.add(
                'border', 'border-primary/30', 'dark:border-primary/40',
                'text-primary', 'hover:bg-primary/5',
            );
        } else {
            this._submitBtn.classList.add(
                'bg-primary', 'text-white', 'shadow-sm',
                'hover:bg-primary-600', 'dark:bg-primary', 'dark:hover:bg-primary-700',
            );
        }
    }

    // sync Quill HTML → hidden textarea before submit
    _initFormSync() {
        document.getElementById('artikel-form')
            .addEventListener('submit', () => {
                document.getElementById('content-field').value = this.quill.root.innerHTML;
            });
    }

    // public toolbar action methods 

    toggleFormat(format) {
        const range   = this.quill.getSelection(true);
        const current = this.quill.getFormat(range.length ? range : undefined);
        this.quill.format(format, !current[format], range.length ? 'user' : undefined);
        this.toolbarManager.update();
    }

    toggleHeader(level) {
        const range   = this.quill.getSelection(true);
        const current = this.quill.getFormat(range);
        this.quill.format('header', current.header === level ? false : level, 'user');
        this.toolbarManager.update();
    }

    toggleList(type) {
        const range   = this.quill.getSelection(true);
        const current = this.quill.getFormat(range);
        if (current.list === type) {
            this.quill.format('list', false, 'user');
        } else {
            this.quill.format('list', type, 'user');
        }
        this.toolbarManager.update();
    }

    toggleAlign(align) {
        const range = this.quill.getSelection(true);
        if (!range) { alert('Klik pada teks atau gambar terlebih dahulu'); return; }

        const [leaf] = this.quill.getLeaf(range.index);
        let targetRange = range;
        if (leaf?.domNode?.tagName === 'IMG') {
            const blot = Quill.find(leaf.domNode);
            if (blot?.parent) {
                const parent = blot.parent;
                targetRange  = { index: this.quill.getIndex(parent), length: parent.length() };
            }
        }

        const formats      = this.quill.getFormat(targetRange);
        const currentAlign = formats.align || '';
        this.quill.formatLine(
            targetRange.index, targetRange.length, 'align',
            currentAlign === align || align === '' ? false : align, 'user',
        );
        this.toolbarManager.update();
    }

    removeFormat() {
        const range = this.quill.getSelection();
        if (range) { this.quill.removeFormat(range.index, range.length); this.toolbarManager.update(); }
        else alert('Pilih teks terlebih dahulu');
    }

    openLinkModal()  { this.linkModal.open();  }
    openImageModal() { this.imageModal.open(); }

    applyImagePreset(pct) { this.imageResizer.applyPreset(pct); }

    deleteSelectedImage() {
        const img = this.imageResizer.getActiveImg();
        if (!img) { alert('Klik gambar terlebih dahulu untuk memilihnya.'); return; }

        this.imageResizer.deselect();
        const blot = Quill.find(img);
        if (blot) {
            const idx = this.quill.getIndex(blot);
            this.quill.deleteText(idx, 1);
        } else {
            img.remove();
        }
    }

    async uploadImage() {
        const input = document.createElement('input');
        input.type   = 'file';
        input.accept = 'image/jpeg,image/png,image/webp';
        input.click();

        input.onchange = async () => {
            const file = input.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) { alert('Ukuran gambar maksimal 5MB'); return; }

            const formData = new FormData();
            formData.append('image', file);

            try {
                const res  = await fetch(this.uploadImageUrl, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': this.csrfToken },
                    body: formData,
                });
                const data = await res.json();

                if (!res.ok) {
                    if (res.status === 422 && data.errors) alert(Object.values(data.errors)[0][0]);
                    else alert(data.message || 'Upload gagal');
                    return;
                }

                const range = this.quill.getSelection(true);
                this.quill.insertEmbed(range.index, 'image', data.url);
                this.quill.setSelection(range.index + 1, 0);
            } catch (err) {
                alert('Terjadi kesalahan jaringan');
                console.error(err);
            }
        };
    }
}