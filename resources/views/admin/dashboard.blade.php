<x-layouts::app :title="__('Dashboard')">
    <x-slot:header>
        {{ __('Dashboard') }}
    </x-slot:header>

    @can('admin-access')
    <div class="p-4 md:p-6 lg:p-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h2 class="text-3xl md:text-4xl font-black text-zinc-900 dark:text-white tracking-tight">Dashboard Overview</h2>
                <p class="text-zinc-500 dark:text-zinc-400 mt-3 text-lg">Welcome back! Here is a summary of your content performance and recent hospital updates.</p>
            </div>
            <div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-10">

            <flux:card class="p-6 md:p-8">
                <p class="text-sm font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-center">Total Articles</p>
                <div class="flex items-end justify-center mt-4">
                    <p class="text-4xl font-bold text-zinc-900 dark:text-white">124</p>
                </div>
            </flux:card>

            <flux:card class="p-6 md:p-8">
                <p class="text-sm font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-center">Published</p>
                <div class="flex items-end justify-center mt-4">
                    <p class="text-4xl font-bold text-zinc-900 dark:text-white">118</p>
                </div>
            </flux:card>

            <flux:card class="p-6 md:p-8">
                <p class="text-sm font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-center">Draft</p>
                <div class="flex items-end justify-center mt-4">
                    <p class="text-4xl font-bold text-zinc-900 dark:text-white">6</p>
                </div>
            </flux:card>

            <flux:card class="p-6 md:p-8">
                <p class="text-sm font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-center">Total Dokter</p>
                <div class="flex items-end justify-center mt-4">
                    <p class="text-4xl font-bold text-zinc-900 dark:text-white">48</p>
                </div>
            </flux:card>

            <flux:card class="p-6 md:p-8">
                <p class="text-sm font-semibold text-zinc-500 dark:text-zinc-400 uppercase tracking-wider text-center">Total User</p>
                <div class="flex items-end justify-center mt-4">
                    <p class="text-4xl font-bold text-zinc-900 dark:text-white">312</p>
                </div>
            </flux:card>
        </div>

            <div class="lg:col-span-1">
                <flux:card class="p-0 overflow-hidden">
                    <div class="px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 flex justify-between items-center">
                        <h3 class="font-bold text-zinc-900 dark:text-white">Recent Activities</h3>
                        <flux:button variant="ghost" size="sm" class="text-primary">View All</flux:button>
                    </div>
                    
                    <div class="divide-y divide-zinc-100 dark:divide-zinc-800">
                        <div class="px-6 py-4 flex items-start gap-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <div class="size-10 shrink-0 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <flux:icon name="document-text" class="size-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-1">Protocol Penanganan Pasien Darurat</p>
                                <p class="text-xs text-zinc-500 mt-1">Edited by Dr. Sarah • 2 hours ago</p>
                            </div>
                            <flux:badge color="sky" size="sm">Review</flux:badge>
                        </div>

                        <div class="px-6 py-4 flex items-start gap-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <div class="size-10 shrink-0 rounded-lg bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                                <flux:icon name="cloud-arrow-up" class="size-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-1">Tips Menjaga Kesehatan Jantung</p>
                                <p class="text-xs text-zinc-500 mt-1">Published by Team • 5 hours ago</p>
                            </div>
                            <flux:badge color="emerald" size="sm">Live</flux:badge>
                        </div>

                        <div class="px-6 py-4 flex items-start gap-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <div class="size-10 shrink-0 rounded-lg bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center text-amber-600 dark:text-amber-400">
                                <flux:icon name="photo" class="size-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-1">IGD Facility Tour Assets</p>
                                <p class="text-xs text-zinc-500 mt-1">Uploaded by Media • 1 day ago</p>
                            </div>
                            <flux:badge color="amber" size="sm">Asset</flux:badge>
                        </div>

                        {{-- Activity 4 --}}
                        <div class="px-6 py-4 flex items-start gap-4 hover:bg-zinc-50 dark:hover:bg-zinc-800/50 transition-colors">
                            <div class="size-10 shrink-0 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                <flux:icon name="chat-bubble-left" class="size-5" />
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-zinc-900 dark:text-white line-clamp-1">Feedback on "Vaccination Drive"</p>
                                <p class="text-xs text-zinc-500 mt-1">Comment by Admin • 2 days ago</p>
                            </div>
                            <flux:badge color="purple" size="sm">Feedback</flux:badge>
                        </div>
                    </div>
                </flux:card>
            </div>
        </div>
    </div>
    @endcan
</x-layouts::app>
