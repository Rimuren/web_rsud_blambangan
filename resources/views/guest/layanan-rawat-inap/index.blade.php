@extends('layouts.guest.guest')

@section('title', 'Layanan Unggulan')

@section('content')


<!DOCTYPE html>
<html lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#137fec",
                        "hospital-blue": "#003366",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                        "secondary": "#ff9500",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<title>Hospital Inpatient Room Information</title>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
<div class="relative flex h-auto min-h-screen w-full flex-col group/design-root overflow-x-hidden">
<div class="layout-container flex h-full grow flex-col">
<div class="px-4 md:px-20 lg:px-40 flex flex-1 justify-center py-10">
<div class="layout-content-container flex flex-col max-w-[1200px] flex-1">
<div class="flex flex-wrap justify-between items-end gap-3 p-4 mb-6">
<div class="flex min-w-72 flex-col gap-3">
<h1 class="text-hospital-blue dark:text-primary text-4xl font-black leading-tight tracking-[-0.033em]">Layanan Rawat Inap</h1>
<p class="text-slate-600 dark:text-slate-400 text-lg font-normal max-w-2xl">Discover our range of specialized care environments, from premium executive suites to intensive care units.</p>
</div>
</div>
<div class="flex flex-col gap-8 p-4">
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden hover:shadow-md transition-shadow">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBSM1KyuK370pqRLBe9UtlAgjIHVbnjjk6-lRhq4fOTKJ26seo-gRhKYAen182eB5gY9vsCe_OZY9Vstt4Tzs2zjAyr_uRpvvCMC8DcNPKGs_SkyLtpjLFDuCycfrGHPn3lno0fyr_vhb2bI2uQH7in2UqrlZJe7MlsZfYwtZvYEfmTcH2yEVfa7jF7e4PEerYrUYOSM3g6n7WP-mhtWfA57yEaeaA53GxkqXSFuc9xReSENEEPfAMb6xSJiyG5O05W0wSYxgGQL7tg");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<div class="flex justify-between items-start mb-2">
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold">VIP/VVIP</h2>
<span class="px-3 py-1 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 text-xs font-bold rounded-full">Available</span>
</div>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Premium luxury suites offering maximum privacy, concierge service, and high-end amenities for exclusive patient comfort.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">ac_unit</span><span class="text-sm">Central AC</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">wifi</span><span class="text-sm">High Speed WiFi</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">tv</span><span class="text-sm">Smart TV</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">kitchen</span><span class="text-sm">Kitchenette</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 dark:border-slate-800 pt-6">
</div>
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCqFfnhT1hL1UrGfJSEa9MBAEhcKsQ13PemS6Cg9SPkwVNNodxe1yz_FjFt4Z6H4zOaw-5ySVuHSu-riaCBQo23I2X8waCR8sbZmaV_SzNb2jEphI3nkXWwWYI7xtjnyJHKejMOHVyOGthfaAQRHmQPRVXwaS6I97bg0ZlvPeVCbhyaJlmqS30cmbEJ8SHvs_N0TdNztjuJJbBWg5DGp7BFoPUeuPOgYf1VqaQUDe6Ic2vEnCq63zcc-kByznVW3BF9MIEGyD9UWg7X");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold mb-2">Tawang Alun</h2>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Comfortable private accommodation designed for peaceful recovery with dedicated bedside nursing assistance.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">ac_unit</span><span class="text-sm">Full AC</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">event_seat</span><span class="text-sm">Sofa Bed</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">bathroom</span><span class="text-sm">Ensuite Bath</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">notifications</span><span class="text-sm">Nurse Call</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
</div>
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCqFfnhT1hL1UrGfJSEa9MBAEhcKsQ13PemS6Cg9SPkwVNNodxe1yz_FjFt4Z6H4zOaw-5ySVuHSu-riaCBQo23I2X8waCR8sbZmaV_SzNb2jEphI3nkXWwWYI7xtjnyJHKejMOHVyOGthfaAQRHmQPRVXwaS6I97bg0ZlvPeVCbhyaJlmqS30cmbEJ8SHvs_N0TdNztjuJJbBWg5DGp7BFoPUeuPOgYf1VqaQUDe6Ic2vEnCq63zcc-kByznVW3BF9MIEGyD9UWg7X");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold mb-2">Sekardalu</h2>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Modern inpatient rooms featuring ergonomic design and essential healthcare facilities for standard patient care.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">ac_unit</span><span class="text-sm">AC</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">tv</span><span class="text-sm">LED TV</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">wifi</span><span class="text-sm">WiFi</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
</div>
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA35wkZohH7b5HBp1Q8ydBiVLRtXnvt07MB13RBI2K9AVHX0NDqewW2A-WEYIvZKBYRFfGnmRxdBs6eCLx0TRf8NTWxNk841Ae3YLGMS8JIqe-YcVgY_-B6aLlJy8OsgwZS97DPRyvMfkb60sLF6EqGPC0ldWbgPgtGMuAa7taRkD-W4d3KIWf6Den_UPqYe-AfgDYeFzoabbhx_bgL9mItmPZkl2OZfFxGjHLzgWhD4thDwBwKiTn3llf5XUCaBv1LR0v3ZIxgMTyy");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold mb-2">Agung Wilis</h2>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Quiet and spacious environment focused on postoperative recovery and long-term treatment support.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">window</span><span class="text-sm">Garden View</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">bed</span><span class="text-sm">Electric Bed</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
</div>
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCqFfnhT1hL1UrGfJSEa9MBAEhcKsQ13PemS6Cg9SPkwVNNodxe1yz_FjFt4Z6H4zOaw-5ySVuHSu-riaCBQo23I2X8waCR8sbZmaV_SzNb2jEphI3nkXWwWYI7xtjnyJHKejMOHVyOGthfaAQRHmQPRVXwaS6I97bg0ZlvPeVCbhyaJlmqS30cmbEJ8SHvs_N0TdNztjuJJbBWg5DGp7BFoPUeuPOgYf1VqaQUDe6Ic2vEnCq63zcc-kByznVW3BF9MIEGyD9UWg7X");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold mb-2">Sayu Wiwit</h2>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Standard care rooms providing professional medical attention in a clean, healing atmosphere.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">medical_services</span><span class="text-sm">Oxygen Supply</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">curtains</span><span class="text-sm">Privacy Screens</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">>
</div>
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCqFfnhT1hL1UrGfJSEa9MBAEhcKsQ13PemS6Cg9SPkwVNNodxe1yz_FjFt4Z6H4zOaw-5ySVuHSu-riaCBQo23I2X8waCR8sbZmaV_SzNb2jEphI3nkXWwWYI7xtjnyJHKejMOHVyOGthfaAQRHmQPRVXwaS6I97bg0ZlvPeVCbhyaJlmqS30cmbEJ8SHvs_N0TdNztjuJJbBWg5DGp7BFoPUeuPOgYf1VqaQUDe6Ic2vEnCq63zcc-kByznVW3BF9MIEGyD9UWg7X");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold mb-2">Mas Alit</h2>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Efficient shared care rooms designed for affordability without compromising quality of medical care.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">person_pin</span><span class="text-sm">Daily Doctor Visit</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">water_drop</span><span class="text-sm">Drinking Water</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA35wkZohH7b5HBp1Q8ydBiVLRtXnvt07MB13RBI2K9AVHX0NDqewW2A-WEYIvZKBYRFfGnmRxdBs6eCLx0TRf8NTWxNk841Ae3YLGMS8JIqe-YcVgY_-B6aLlJy8OsgwZS97DPRyvMfkb60sLF6EqGPC0ldWbgPgtGMuAa7taRkD-W4d3KIWf6Den_UPqYe-AfgDYeFzoabbhx_bgL9mItmPZkl2OZfFxGjHLzgWhD4thDwBwKiTn3llf5XUCaBv1LR0v3ZIxgMTyy");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold mb-2">Pulmo Center</h2>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Specialized unit for respiratory health, equipped with advanced pulmonary diagnostics and treatment systems.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">air</span><span class="text-sm">Air Purification</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">monitor_heart</span><span class="text-sm">O2 Monitoring</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">vaccines</span><span class="text-sm">Respiratory Therapy</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
</div>
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA35wkZohH7b5HBp1Q8ydBiVLRtXnvt07MB13RBI2K9AVHX0NDqewW2A-WEYIvZKBYRFfGnmRxdBs6eCLx0TRf8NTWxNk841Ae3YLGMS8JIqe-YcVgY_-B6aLlJy8OsgwZS97DPRyvMfkb60sLF6EqGPC0ldWbgPgtGMuAa7taRkD-W4d3KIWf6Den_UPqYe-AfgDYeFzoabbhx_bgL9mItmPZkl2OZfFxGjHLzgWhD4thDwBwKiTn3llf5XUCaBv1LR0v3ZIxgMTyy");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<div class="flex justify-between items-start mb-2">
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold">ICU</h2>
<span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Call Admission</span>
</div>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Intensive Care Unit for patients requiring constant medical monitoring and life support interventions.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">vital_signs</span><span class="text-sm">24/7 Monitoring</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">ventilator</span><span class="text-sm">Life Support</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">group</span><span class="text-sm">Specialist Team</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
</div>
</div>
</div>
<div class="group flex flex-col items-stretch justify-start rounded-xl @xl:flex-row @xl:items-start shadow-sm border border-slate-100 dark:border-slate-800 bg-white dark:bg-slate-900 overflow-hidden">
<div class="w-full @xl:w-1/3 bg-center bg-no-repeat aspect-video @xl:aspect-square bg-cover" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuA35wkZohH7b5HBp1Q8ydBiVLRtXnvt07MB13RBI2K9AVHX0NDqewW2A-WEYIvZKBYRFfGnmRxdBs6eCLx0TRf8NTWxNk841Ae3YLGMS8JIqe-YcVgY_-B6aLlJy8OsgwZS97DPRyvMfkb60sLF6EqGPC0ldWbgPgtGMuAa7taRkD-W4d3KIWf6Den_UPqYe-AfgDYeFzoabbhx_bgL9mItmPZkl2OZfFxGjHLzgWhD4thDwBwKiTn3llf5XUCaBv1LR0v3ZIxgMTyy");'></div>
<div class="flex w-full flex-col items-stretch justify-between gap-4 p-6 md:p-8">
<div>
<div class="flex justify-between items-start mb-2">
<h2 class="text-hospital-blue dark:text-slate-100 text-2xl font-bold">ICCU</h2>
<span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full">Specialized Unit</span>
</div>
<p class="text-slate-600 dark:text-slate-400 text-base mb-6">Intensive Cardiac Care Unit dedicated to patients with acute heart conditions requiring specialized cardiac nursing.</p>
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">ecg</span><span class="text-sm">Cardiac Monitoring</span></div>
<div class="flex items-center gap-2 text-hospital-blue"><span class="material-symbols-outlined">emergency</span><span class="text-sm">Resuscitation Ready</span></div>
</div>
</div>
<div class="flex items-center justify-end gap-4 border-t border-slate-100 pt-6">
</div>
</div>
</div>
</div>
<div class="mt-12 p-8 rounded-xl bg-slate-900 text-white flex flex-col md:flex-row items-center justify-between gap-6">
<div class="flex flex-col gap-2 text-center md:text-left">
<h3 class="text-xl font-bold">Need assistance with room selection?</h3>
<p class="text-slate-400">Our medical admission team is available 24/7 to assist you.</p>
</div>
<div class="flex gap-4">
</div>
</div>
</div>
</div>
</div>
</div>

</body></html>

@endsection