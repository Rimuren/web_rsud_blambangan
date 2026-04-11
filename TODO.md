# Task: Add routes to guest header menu items and dropdowns

## Steps to complete:

### 1. [x] Add missing routes to routes/web.php
- Add routes for Profil, Artikel public, Galeri Foto/Video
- Ensure all Layanan/Informasi routes exist

### 2. [x] Create stub views for missing pages
- guest/profil/index.blade.php
- guest/artikel/index.blade.php  
- guest/galeri/foto/index.blade.php
- guest/galeri/video/index.blade.php

### 3. [x] Update resources/views/partials/guest/header.blade.php
- Replace all href="#" with {{ route('name') }}

### 4. [ ] Test all navigation links
- Check guest pages load correctly
- Verify dropdown functionality

### 5. [ ] Clear route cache
- php artisan route:clear
- php artisan route:cache

**Progress: 3/5 completed**

