(function() {
    const configEl = document.getElementById('artikel-form-config');
    if (!configEl) {
        console.error('Konfigurasi tidak ditemukan');
        return;
    }

    let existingContent = configEl.dataset.existingContent || '';
    const uploadUrl = configEl.dataset.uploadUrl;
    const csrfToken = configEl.dataset.csrfToken;

    // Inisialisasi Quill
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Mulai menulis artikel Anda di sini...',
        modules: { toolbar: false }
    });

    setTimeout(() => quill.focus(), 100);

    if (existingContent) {
        if (existingContent.startsWith('"') && existingContent.endsWith('"')) {
            try {
                existingContent = JSON.parse(existingContent);
            } catch (e) {
                console.warn('Gagal parse existingContent:', e);
            }
        }
        quill.clipboard.dangerouslyPasteHTML(existingContent);
    }

    // Tangani paste gambar (mencegah base64)
quill.root.addEventListener('paste', async (e) => {
    const clipboardData = e.clipboardData || window.clipboardData;
    if (!clipboardData) return;
    
    const items = clipboardData.items;
    for (let i = 0; i < items.length; i++) {
        const item = items[i];
        if (item.type.indexOf('image') !== -1) {
            e.preventDefault();
            
            const file = item.getAsFile();
            if (file.size > 5 * 1024 * 1024) {
                alert('Ukuran gambar maksimal 5MB');
                return;
            }
            
            // Upload gambar ke server
            const formData = new FormData();
            formData.append('image', file);
            
            try {
                const res = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                });
                const data = await res.json();
                if (!res.ok) throw new Error(data.message || 'Upload gagal');
                
                const range = quill.getSelection(true);
                quill.insertEmbed(range.index, 'image', data.url);
                quill.setSelection(range.index + 1, 0);
            } catch (err) {
                alert('Gagal mengupload gambar: ' + err.message);
            }
            break;
        }
    }
});

    // IMAGE RESIZER
    const QuillImageResizer = (() => {
        const MIN_SIZE = 40;
        let activeImg = null;
        let overlay = null;
        let startX, startY, startW, startH, handleDir;

        function init() {
            quill.root.addEventListener('click', onEditorClick);
            document.addEventListener('mousedown', onDocMouseDown, true);
            document.addEventListener('keydown', e => { if (e.key === 'Escape') deselect(); });
        }

        function onEditorClick(e) {
            const img = e.target.closest('img');
            if (img && quill.root.contains(img)) {
                e.preventDefault();
                e.stopPropagation();
                select(img);
            } else {
                deselect();
            }
        }

        function onDocMouseDown(e) {
            if (!overlay) return;
            if (!overlay.contains(e.target) && !quill.root.contains(e.target)) {
                deselect();
            }
        }

        function select(img) {
            if (activeImg === img) return;
            deselect();
            activeImg = img;
            if (!img.style.width) img.style.width = img.offsetWidth + 'px';
            if (!img.style.height) img.style.height = img.offsetHeight + 'px';
            buildOverlay(img);
            showResizeToolbar(true);
            updateSizeReadout();
        }

        function deselect() {
            if (!activeImg) return;
            removeOverlay();
            showResizeToolbar(false);
            activeImg = null;
        }

        function buildOverlay(img) {
            removeOverlay();
            overlay = document.createElement('div');
            overlay.id = 'qir-overlay';
            overlay.style.cssText = `
                position:absolute; pointer-events:none;
                border:2px solid #3b82f6;
                border-radius:3px;
                box-sizing:border-box;
                z-index:100;
            `;
            positionOverlay(img);
            ['nw','n','ne','e','se','s','sw','w'].forEach(dir => {
                const h = document.createElement('div');
                h.dataset.dir = dir;
                h.style.cssText = getHandleStyle(dir);
                h.style.pointerEvents = 'all';
                h.addEventListener('mousedown', onHandleMouseDown);
                overlay.appendChild(h);
            });
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
            updateBadge();
            const container = quill.root.parentElement;
            container.style.position = 'relative';
            container.appendChild(overlay);
        }

        function positionOverlay(img) {
            if (!overlay) return;
            const containerRect = quill.root.parentElement.getBoundingClientRect();
            const imgRect = img.getBoundingClientRect();
            overlay.style.left = (imgRect.left - containerRect.left) + 'px';
            overlay.style.top = (imgRect.top - containerRect.top) + 'px';
            overlay.style.width = imgRect.width + 'px';
            overlay.style.height = imgRect.height + 'px';
        }

        function removeOverlay() {
            if (overlay) { overlay.remove(); overlay = null; }
        }

        function getHandleStyle(dir) {
            const size = '9px';
            const half = '-5px';
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
            return `position:absolute; width:${size}; height:${size}; background:#fff; border:2px solid #3b82f6; border-radius:2px; box-sizing:border-box; z-index:102; ${posMap[dir]};`;
        }

        function onHandleMouseDown(e) {
            if (!activeImg) return;
            e.preventDefault();
            e.stopPropagation();
            handleDir = e.currentTarget.dataset.dir;
            startX = e.clientX;
            startY = e.clientY;
            startW = activeImg.offsetWidth;
            startH = activeImg.offsetHeight;
            document.addEventListener('mousemove', onMouseMove);
            document.addEventListener('mouseup', onMouseUp);
            document.body.style.cursor = getCursorForDir(handleDir);
            document.body.style.userSelect = 'none';
        }

        function onMouseMove(e) {
            if (!activeImg || !handleDir) return;
            const dx = e.clientX - startX;
            const dy = e.clientY - startY;
            const aspectRatio = startH / startW;
            const lockAspect = !e.shiftKey;
            let newW = startW;
            let newH = startH;
            const dir = handleDir;
            if (dir.includes('e')) newW = startW + dx;
            if (dir.includes('w')) newW = startW - dx;
            if (dir.includes('s')) newH = startH + dy;
            if (dir.includes('n')) newH = startH - dy;
            if (lockAspect) {
                const isDiag = dir.length === 2;
                if (isDiag) newH = newW * aspectRatio;
                else if (dir === 'e' || dir === 'w') newH = newW * aspectRatio;
                else newW = newH / aspectRatio;
            }
            newW = Math.max(MIN_SIZE, Math.min(newW, quill.root.getBoundingClientRect().width - 4));
            newH = Math.max(MIN_SIZE, newH);
            activeImg.style.width  = Math.round(newW) + 'px';
            activeImg.style.height = Math.round(newH) + 'px';
            positionOverlay(activeImg);
            updateBadge();
            updateSizeReadout();
        }

        function onMouseUp() {
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
            document.body.style.cursor = '';
            document.body.style.userSelect = '';
            handleDir = null;
        }

        function getCursorForDir(dir) {
            const map = {
                nw: 'nw-resize', n: 'n-resize', ne: 'ne-resize', e: 'e-resize',
                se: 'se-resize', s: 's-resize', sw: 'sw-resize', w: 'w-resize'
            };
            return map[dir] || 'default';
        }

        function updateBadge() {
            if (!overlay || !activeImg) return;
            const badge = overlay.querySelector('#qir-badge');
            if (badge) badge.textContent = `${Math.round(activeImg.offsetWidth)} × ${Math.round(activeImg.offsetHeight)} px`;
        }

        function updateSizeReadout() {
            if (!activeImg) return;
            const readout = document.getElementById('img-size-readout');
            if (readout) readout.textContent = `${Math.round(activeImg.offsetWidth)} × ${Math.round(activeImg.offsetHeight)} px`;
        }

        function applyPreset(pct) {
            if (!activeImg) return;
            const maxW = quill.root.getBoundingClientRect().width - 4;
            const aspect = activeImg.naturalHeight / activeImg.naturalWidth;
            const newW = Math.round(maxW * pct / 100);
            const newH = Math.round(newW * aspect);
            activeImg.style.width  = newW + 'px';
            activeImg.style.height = newH + 'px';
            positionOverlay(activeImg);
            updateBadge();
            updateSizeReadout();
        }

        function showResizeToolbar(show) {
            const tb = document.getElementById('img-resize-toolbar');
            if (!tb) return;
            if (show) tb.classList.replace('hidden', 'flex');
            else tb.classList.replace('flex', 'hidden');
        }

        function getActiveImg() { return activeImg; }

        return { init, select, deselect, applyPreset, getActiveImg };
    })();

    window.artikelForm = {
        applyImagePreset: (pct) => QuillImageResizer.applyPreset(pct)
    };

    // FORMAT FUNCTIONS
    function updateToolbarState() {
        const range = quill.getSelection();
        if (!range) return;
        let format = quill.getFormat(range);

        const [leaf] = quill.getLeaf(range.index);
        if (leaf?.domNode?.tagName === 'IMG') {
            const blot = Quill.find(leaf.domNode);
            if (blot?.parent) format = quill.getFormat({ index: quill.getIndex(blot.parent), length: 1 });
        }

        document.querySelectorAll('[data-action="toggleFormat"]').forEach(btn => {
            const f = btn.dataset.format;
            if (f) btn.classList.toggle('active', !!format[f]);
        });

        document.querySelectorAll('[data-action="toggleHeader"]').forEach(btn => {
            let v = btn.dataset.level;
            if (v === 'false') v = false;
            else if (!isNaN(v)) v = parseInt(v);
            btn.classList.toggle('active', v === false ? !format.header : format.header === v);
        });

        document.querySelectorAll('[data-action="toggleList"]').forEach(btn => {
            const t = btn.dataset.listType;
            if (t) btn.classList.toggle('active', format.list === t);
        });

        const align = format.align || '';
        document.querySelectorAll('[data-action="toggleAlign"]').forEach(btn => {
            btn.classList.toggle('active', align === (btn.dataset.align || ''));
        });
    }

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
        quill.format('header', current.header === level ? false : level, 'user');
        updateToolbarState();
    }

    function toggleList(type) {
        const range = quill.getSelection(true);
        const current = quill.getFormat(range);
        quill.format('list', current.list === type ? false : type, 'user');
        updateToolbarState();
    }

    function toggleAlign(align) {
        const range = quill.getSelection(true);
        if (!range) { alert('Klik pada teks atau gambar terlebih dahulu'); return; }
        const [leaf] = quill.getLeaf(range.index);
        let targetRange = range;
        if (leaf?.domNode?.tagName === 'IMG') {
            const blot = Quill.find(leaf.domNode);
            if (blot?.parent) {
                const parent = blot.parent;
                targetRange = { index: quill.getIndex(parent), length: parent.length() };
            }
        }
        const formats = quill.getFormat(targetRange);
        const currentAlign = formats.align || '';
        quill.formatLine(
            targetRange.index, targetRange.length, 'align',
            currentAlign === align || align === '' ? false : align, 'user'
        );
        updateToolbarState();
    }

    function removeFormat() {
        const range = quill.getSelection();
        if (range) { quill.removeFormat(range.index, range.length); updateToolbarState(); }
        else alert('Pilih teks terlebih dahulu');
    }

    // LINK MODAL
    let linkModal = null;
    function createLinkModal(initialText, callback) {
        if (linkModal) linkModal.remove();
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm';
        modal.innerHTML = `
            <div class="bg-white dark:bg-zinc-800 rounded-xl shadow-xl w-full max-w-md p-6 border border-zinc-200 dark:border-zinc-700">
                <h3 class="text-lg font-semibold text-zinc-800 dark:text-white mb-4">Tambah Link</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Teks Link</label>
                        <input type="text" id="link-text-input" value="${initialText.replace(/"/g, '&quot;')}"
                            placeholder="Masukkan teks link"
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
        linkModal = modal;
        const textInput = modal.querySelector('#link-text-input');
        const urlInput  = modal.querySelector('#link-url-input');
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
        [textInput, urlInput].forEach(i => i.addEventListener('keypress', e => { if (e.key === 'Enter') { e.preventDefault(); submit(); } }));
        modal.addEventListener('click', e => { if (e.target === modal) close(); });
        textInput.focus();
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

    // IMAGE URL MODAL
    let imageModal = null;
    function createImageModal(callback) {
        if (imageModal) imageModal.remove();
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
        imageModal = modal;
        const urlInput         = modal.querySelector('#image-url-input');
        const previewContainer = modal.querySelector('#image-preview-container');
        const previewImg       = modal.querySelector('#image-preview');
        const errorMsg         = modal.querySelector('#image-error');
        const close  = () => { modal.remove(); imageModal = null; };
        const insert = () => {
            const url = urlInput.value.trim();
            if (!url) return alert('URL tidak boleh kosong');
            close();
            callback(url);
        };
        modal.querySelector('#image-insert-btn').addEventListener('click', insert);
        modal.querySelector('#image-cancel-btn').addEventListener('click', close);
        urlInput.addEventListener('keypress', e => { if (e.key === 'Enter') { e.preventDefault(); insert(); } });
        modal.addEventListener('click', e => { if (e.target === modal) close(); });
        urlInput.addEventListener('input', () => {
            const url = urlInput.value.trim();
            if (!url) { previewContainer.classList.add('hidden'); return; }
            const img = new Image();
            img.onload  = () => { previewImg.src = url; previewContainer.classList.remove('hidden'); errorMsg.classList.add('hidden'); };
            img.onerror = () => { errorMsg.textContent = 'URL tidak valid'; errorMsg.classList.remove('hidden'); previewContainer.classList.add('hidden'); };
            img.src = url;
        });
        urlInput.focus();
    }

    function addQuillImage() {
        createImageModal(url => {
            const range = quill.getSelection(true);
            quill.insertEmbed(range.index, 'image', url);
            quill.setSelection(range.index + 1, 0);
        });
    }

    // UPLOAD GAMBAR
    async function uploadQuillImage() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = 'image/jpeg,image/png,image/webp';
        input.click();
        input.onchange = async () => {
            const file = input.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) { alert('Ukuran gambar maksimal 5MB'); return; }
            const formData = new FormData();
            formData.append('image', file);
            try {
                const res = await fetch(uploadUrl, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                });
                const data = await res.json();
                if (!res.ok) {
                    if (res.status === 422 && data.errors) alert(Object.values(data.errors)[0][0]);
                    else alert(data.message || 'Upload gagal');
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

    function deleteSelectedImage() {
        const img = QuillImageResizer.getActiveImg();
        if (img) {
            QuillImageResizer.deselect();
            const blot = Quill.find(img);
            if (blot) {
                const idx = quill.getIndex(blot);
                quill.deleteText(idx, 1);
            } else {
                img.remove();
            }
        } else {
            alert('Klik gambar terlebih dahulu untuk memilihnya.');
        }
    }

    // SYNC KONTEN KE TEXTAREA SEBELUM SUBMIT
    const form = document.getElementById('artikel-form');
    form.addEventListener('submit', function(e) {
        // Validasi ukuran thumbnail (client‑side)
        const fileInput = document.getElementById('foto-input');
        const file = fileInput.files[0];
        const maxSize = 5 * 1024 * 1024;
        if (file && file.size > maxSize) {
            e.preventDefault();
            alert('Ukuran file thumbnail melebihi 5MB. Silakan pilih gambar yang lebih kecil.');
            return false;
        }

        document.getElementById('content-field').value = quill.root.innerHTML;
    });

    // THUMBNAIL PREVIEW
    function handleFotoChange(input) {
        const file = input.files[0];
        if (!file) return;
        const preview     = document.getElementById('foto-preview');
        const placeholder = document.getElementById('foto-placeholder');
        const filename    = document.getElementById('foto-filename');
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

    const fotoInput = document.getElementById('foto-input');
    if (fotoInput) {
        fotoInput.addEventListener('change', function() { handleFotoChange(this); });
    }

    const dropzone = document.getElementById('foto-dropzone');
    if (dropzone) {
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(ev =>
            dropzone.addEventListener(ev, e => { e.preventDefault(); e.stopPropagation(); }));
        dropzone.addEventListener('dragover',  () => dropzone.classList.add('border-primary', 'bg-primary/10'));
        dropzone.addEventListener('dragleave', () => dropzone.classList.remove('border-primary', 'bg-primary/10'));
        dropzone.addEventListener('drop', e => {
            dropzone.classList.remove('border-primary', 'bg-primary/10');
            const file = e.dataTransfer.files[0];
            if (file?.type.startsWith('image/')) {
                const input = document.getElementById('foto-input');
                input.files = e.dataTransfer.files;
                handleFotoChange(input);
            }
        });
    }

    // SUBMIT BUTTON DINAMIS
    const statusSelect = document.getElementById('status-select');
    const submitBtn    = document.getElementById('submit-action-btn');
    const submitText   = document.getElementById('submit-action-text');

    function updateSubmitButton() {
        const isDraft = statusSelect.value === 'draft';
        submitBtn.value = isDraft ? 'draft' : 'published';
        submitText.textContent = isDraft ? 'Simpan Draft' : 'Publikasikan';
        submitBtn.className = 'inline-flex items-center gap-1 px-4 py-2 text-sm font-medium rounded-lg transition-all';
        if (isDraft) {
            submitBtn.classList.add('border', 'border-primary/30', 'dark:border-primary/40', 'text-primary', 'hover:bg-primary/5');
        } else {
            submitBtn.classList.add('bg-primary', 'text-white', 'shadow-sm', 'hover:bg-primary-600', 'dark:bg-primary', 'dark:hover:bg-primary-700');
        }
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', updateSubmitButton);
        updateSubmitButton();
    }

    // INISIALISASI RESIZER & EVENT LISTENERS
    QuillImageResizer.init();

    quill.on('editor-change',    updateToolbarState);
    quill.on('selection-change', updateToolbarState);

    function setupToolbarListeners() {
        document.querySelectorAll('[data-action="toggleFormat"]').forEach(btn => {
            btn.addEventListener('click', () => toggleFormat(btn.dataset.format));
        });

        document.querySelectorAll('[data-action="toggleHeader"]').forEach(btn => {
            btn.addEventListener('click', () => {
                let level = btn.dataset.level;
                if (level === 'false') level = false;
                else level = parseInt(level);
                toggleHeader(level);
            });
        });

        document.querySelectorAll('[data-action="toggleList"]').forEach(btn => {
            btn.addEventListener('click', () => toggleList(btn.dataset.listType));
        });

        document.querySelectorAll('[data-action="toggleAlign"]').forEach(btn => {
            btn.addEventListener('click', () => toggleAlign(btn.dataset.align || ''));
        });

        const addLinkBtn = document.querySelector('[data-action="addLink"]');
        if (addLinkBtn) addLinkBtn.addEventListener('click', addQuillLink);

        const addImageUrlBtn = document.querySelector('[data-action="addImageUrl"]');
        if (addImageUrlBtn) addImageUrlBtn.addEventListener('click', addQuillImage);

        const uploadImageBtn = document.querySelector('[data-action="uploadImage"]');
        if (uploadImageBtn) uploadImageBtn.addEventListener('click', uploadQuillImage);

        const deleteImageBtn = document.querySelector('[data-action="deleteImage"]');
        if (deleteImageBtn) deleteImageBtn.addEventListener('click', deleteSelectedImage);

        const removeFormatBtn = document.querySelector('[data-action="removeFormat"]');
        if (removeFormatBtn) removeFormatBtn.addEventListener('click', removeFormat);

        // Preset resize
        document.querySelectorAll('[data-preset]').forEach(btn => {
            btn.addEventListener('click', () => {
                const pct = parseInt(btn.dataset.preset);
                QuillImageResizer.applyPreset(pct);
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupToolbarListeners);
    } else {
        setupToolbarListeners();
    }
})();