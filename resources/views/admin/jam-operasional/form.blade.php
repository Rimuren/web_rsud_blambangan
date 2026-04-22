{{-- Pilih Rentang Hari --}}
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    {{-- Dari Hari --}}
    <flux:field>
        <flux:label required>Dari Hari</flux:label>
        <flux:select name="hari_mulai" required>
            <option value="">Pilih Hari</option>
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $index => $nama)
                <option value="{{ $index + 1 }}" {{ old('hari_mulai') == $index + 1 ? 'selected' : '' }}>
                    {{ $nama }}
                </option>
            @endforeach
        </flux:select>
        <flux:error name="hari_mulai" />
    </flux:field>

    {{-- Sampai Hari --}}
    <flux:field>
        <flux:label required>Sampai Hari</flux:label>
        <flux:select name="hari_selesai" required>
            <option value="">Pilih Hari</option>
            @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $index => $nama)
                <option value="{{ $index + 1 }}" {{ old('hari_selesai') == $index + 1 ? 'selected' : '' }}>
                    {{ $nama }}
                </option>
            @endforeach
        </flux:select>
        <flux:error name="hari_selesai" />
    </flux:field>
</div>

{{-- Jam Buka & Tutup --}}
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
    <flux:field>
        <flux:label>Jam Buka</flux:label>
        <flux:input type="time" name="jam_buka" value="{{ old('jam_buka', '08:00') }}" />
        <flux:error name="jam_buka" />
    </flux:field>

    <flux:field>
        <flux:label>Jam Tutup</flux:label>
        <flux:input type="time" name="jam_tutup" value="{{ old('jam_tutup', '17:00') }}" />
        <flux:error name="jam_tutup" />
    </flux:field>
</div>

{{-- Checkbox Tutup --}}
<flux:field>
    <label class="flex items-center gap-3">
        <flux:checkbox name="is_closed" value="1" {{ old('is_closed') ? 'checked' : '' }} />
        <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">Tutup Sepanjang Hari (Libur)</span>
    </label>
</flux:field>