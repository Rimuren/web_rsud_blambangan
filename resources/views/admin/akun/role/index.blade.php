<x-layouts::app.sidebar :title="'Roles'">
  <flux:main>
    <div class="p-6">
      <flux:card class="space-y-6">
        <div class="flex justify-between items-center">
          <flux:heading size="lg">Roles</flux:heading>

          @php
          $currentUser = auth()->user();
          @endphp

          {{-- Hanya Master yang bisa menambah role --}}
          @can('create role')
          <flux:button as="a" href="{{ route('admin.akun.role.create') }}" variant="primary" icon="plus-circle">
            Tambah Role
          </flux:button>
          @endcan
        </div>

        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="p-4 bg-green-100 text-green-700 rounded-lg">
          {{ session('success') }}
        </div>
        @endif
        @if(session('error'))
        <div class="p-4 bg-red-100 text-red-700 rounded-lg">
          {{ session('error') }}
        </div>
        @endif

        <div class="overflow-x-auto">
          <flux:table>
            <flux:table.columns>
              <flux:table.column class="w-16">No</flux:table.column>
              <flux:table.column>Role</flux:table.column>
              <flux:table.column>Permission</flux:table.column>
              <flux:table.column class="text-right">Aksi</flux:table.column>
            </flux:table.columns>

            <flux:table.rows>
              @forelse($roles as $index => $role)
              <flux:table.row>
                <flux:table.cell class="text-zinc-500">
                  {{ $roles->firstItem() + $index }}
                </flux:table.cell>
                <flux:table.cell>
                  <span class="font-medium">{{ $role->name }}</span>
                </flux:table.cell>
                <flux:table.cell>
                  <div class="flex flex-wrap gap-1">
                    @forelse($role->permissions as $perm)
                    <flux:badge color="blue" size="sm">{{ $perm->name }}</flux:badge>
                    @empty
                    <span class="text-xs text-zinc-400">Tidak ada permission</span>
                    @endforelse
                  </div>
                </flux:table.cell>

                {{-- Kolom Aksi dengan aturan akses --}}
                <flux:table.cell class="text-right">
                  <div class="flex justify-end gap-2">
                    @if($role->can_edit)
                    <flux:button href="{{ route('admin.akun.role.edit', $role->id) }}" variant="ghost" icon="pencil-square" size="sm" />
                    @endif
                    @if($role->can_delete)
                    <form action="{{ route('admin.akun.role.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Hapus role {{ $role->name }}?')" class="inline">
                      @csrf
                      @method('DELETE')
                      <flux:button type="submit" variant="ghost" icon="trash" size="sm" />
                    </form>
                    @endif
                  </div>
                </flux:table.cell>

              </flux:table.row>
              @empty
              <flux:table.row>
                <flux:table.cell colspan="4" class="text-center py-8 text-zinc-500">
                  Tidak ada data role
                </flux:table.cell>
              </flux:table.row>
              @endforelse
            </flux:table.rows>
          </flux:table>
        </div>

        <div class="flex justify-between items-center text-sm text-zinc-500">
          <span>Menampilkan {{ $roles->firstItem() }} - {{ $roles->lastItem() }} dari {{ $roles->total() }} roles</span>
          <div class="flex gap-2">
            {{ $roles->links() }}
          </div>
        </div>
      </flux:card>
    </div>
  </flux:main>
</x-layouts::app.sidebar>