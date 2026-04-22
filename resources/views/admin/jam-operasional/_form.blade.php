<div class="space-y-6">
    @canany('jam_operasional.create','jam_operasional.update')
    <div class="grid gap-6 md:grid-cols-2">
        <div class="space-y-2">
            <flux:label for="hari">Hari <span class="text-red-500">*</span></flux:label>
            <flux:select id="hari" name="hari" required>
                <option value="">Pilih hari operasional</option>
                @foreach ($hariOptions as $value => $label)
                    <option value="{{ $value }}" @selected((string) old('hari', $jamOperasional->hari ?? '') === (string) $value)>
                        {{ $label }}
                    </option>
                @endforeach
            </flux:select>
            @error('hari')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div class="space-y-2">
            <flux:label for="is_closed">Status Hari</flux:label>
            <label class="flex items-center gap-3 rounded-2xl border border-zinc-200 px-4 py-3 text-sm text-zinc-700 dark:border-zinc-700 dark:text-zinc-300">
                <input
                    id="is_closed"
                    type="checkbox"
                    name="is_closed"
                    value="1"
                    @checked(old('is_closed', $jamOperasional->is_closed ?? false))
                    class="h-4 w-4 rounded border-zinc-300 text-blue-600 focus:ring-blue-500">
                <span>Tandai hari ini tutup</span>
            </label>
            @error('is_closed')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <div class="space-y-2">
            <flux:label for="jam_buka">Jam Buka</flux:label>
            <flux:input
                id="jam_buka"
                type="time"
                name="jam_buka"
                value="{{ old('jam_buka', isset($jamOperasional->jam_buka) ? substr($jamOperasional->jam_buka, 0, 5) : '') }}" />
            @error('jam_buka')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>

        <div class="space-y-2">
            <flux:label for="jam_tutup">Jam Tutup</flux:label>
            <flux:input
                id="jam_tutup"
                type="time"
                name="jam_tutup"
                value="{{ old('jam_tutup', isset($jamOperasional->jam_tutup) ? substr($jamOperasional->jam_tutup, 0, 5) : '') }}" />
            @error('jam_tutup')
                <flux:error>{{ $message }}</flux:error>
            @enderror
        </div>
    </div>

    <div class="rounded-2xl border border-emerald-200 bg-emerald-50/80 p-4 text-sm text-emerald-800 dark:border-emerald-900/60 dark:bg-emerald-950/40 dark:text-emerald-200">
        <div class="flex items-start gap-3">
            <flux:icon name="information-circle" class="mt-0.5 h-5 w-5 shrink-0" />
            <div>
                Jika hari libur atau tidak beroperasi, centang opsi `Tandai hari ini tutup`. Jika tidak dicentang, isi jam buka dan jam tutup.
            </div>
        </div>
    </div>
    @endcanany
</div>
