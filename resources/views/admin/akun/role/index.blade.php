<x-layouts::app.sidebar :title="'Roles'">
    <flux:main>
        <div class="p-6">
            <div class="card">
                <div class="card-header">
                    <h1>Roles</h1>
                    <button class="btn-tambah">
                        <flux:icon.plus-circle variant="outline" class="w-5 h-5" />
                        Tambah Role
                    </button>
                </div>

                <div class="table-wrapper">
                    <table>
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th>Role</th>
                                <th>Permission</th>
                                <th class="col-aksi">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-no">1</td>
                                <td class="col-role">Admin Konten</td>
                                <td>
                                    <div class="permission-list">
                                        <span class="badge">admin-access</span>
                                        <span class="badge">admin-access</span>
                                        <span class="badge">admin-access</span>
                                    </div>
                                </td>
                                <td class="col-aksi">
                                    <div class="action-buttons">
                                        <button class="btn-icon" title="Edit">
                                            <flux:icon.pencil-square variant="outline" class="w-5 h-5" />
                                        </button>
                                        <button class="btn-icon" title="Hapus">
                                            <flux:icon.trash variant="outline" class="w-5 h-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-no">2</td>
                                <td class="col-role">Penulis</td>
                                <td>
                                    <div class="permission-list">
                                        <span class="badge">admin-access</span>
                                        <span class="badge">create article</span>
                                        <span class="badge">create category</span>
                                    </div>
                                </td>
                                <td class="col-aksi">
                                    <div class="action-buttons">
                                        <button class="btn-icon" title="Edit">
                                            <flux:icon.pencil-square variant="outline" class="w-5 h-5" />
                                        </button>
                                        <button class="btn-icon" title="Hapus">
                                            <flux:icon.trash variant="outline" class="w-5 h-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-no">3</td>
                                <td class="col-role">Dokumenter</td>
                                <td>
                                    <div class="permission-list">
                                        <span class="badge">admin-access</span>
                                        <span class="badge">add photo</span>
                                    </div>
                                </td>
                                <td class="col-aksi">
                                    <div class="action-buttons">
                                        <button class="btn-icon" title="Edit">
                                            <flux:icon.pencil-square variant="outline" class="w-5 h-5" />
                                        </button>
                                        <button class="btn-icon" title="Hapus">
                                            <flux:icon.trash variant="outline" class="w-5 h-5" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="table-footer">
                        <span>Menampilkan 3 dari 12 roles</span>
                        <div class="pagination">
                            <button class="btn-page" disabled>Previous</button>
                            <button class="btn-page">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </flux:main>
</x-layouts::app.sidebar>

<style>
.btn-tambah {
  display: flex;
  align-items: center;
  gap: 8px;
  background-color: #1e3a5f;
  color: #fff;
  border: none;
  border-radius: 8px;
  padding: 10px 20px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}
.btn-tambah:hover {
  background-color: #162e4d;
}
.btn-icon {
  background: none;
  border: none;
  cursor: pointer;
  padding: 4px;
  color: var(--color-zinc-400);
  transition: color 0.2s;
  display: flex;
  align-items: center;
}
.btn-icon:hover {
  color: #1e3a5f;
}
.card {
  background: var(--color-white);
  border-radius: 16px;
  padding: 32px;
}
.dark .card {
  background: var(--color-zinc-800);
}
.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 24px;
}
.card-header h1 {
  font-size: 22px;
  font-weight: 700;
  color: var(--color-zinc-900);
}
.dark .card-header h1 {
  color: var(--color-zinc-100);
}
.table-wrapper {
  border: 1px solid var(--color-zinc-200);
  border-radius: 10px;
  overflow: hidden;
}
.dark .table-wrapper {
  border-color: var(--color-zinc-700);
}
table {
  width: 100%;
  border-collapse: collapse;
}
thead tr {
  background-color: var(--color-zinc-100);
}
.dark thead tr {
  background-color: var(--color-zinc-700);
}
thead th {
  text-align: left;
  padding: 14px 20px;
  font-size: 11px;
  font-weight: 700;
  color: var(--color-zinc-500);
  letter-spacing: 0.08em;
  text-transform: uppercase;
}
.dark thead th {
  color: var(--color-zinc-400);
}
thead th.col-aksi {
  text-align: right;
}
tbody tr {
  border-top: 1px solid var(--color-zinc-200);
}
.dark tbody tr {
  border-top-color: var(--color-zinc-700);
}
tbody tr:hover {
  background-color: var(--color-zinc-50);
}
.dark tbody tr:hover {
  background-color: var(--color-zinc-750, #2d2d35);
}
tbody td {
  padding: 20px;
  font-size: 14px;
  color: var(--color-zinc-800);
  vertical-align: middle;
}
.dark tbody td {
  color: var(--color-zinc-200);
}
tbody td.col-no {
  color: var(--color-zinc-600);
  font-weight: 500;
  width: 60px;
}
.dark tbody td.col-no {
  color: var(--color-zinc-400);
}
tbody td.col-role {
  font-weight: 500;
  width: 180px;
}
.permission-list {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}
.badge {
  background-color: var(--color-blue-100);
  color: var(--color-blue-700);
  border-radius: 999px;
  padding: 4px 12px;
  font-size: 12px;
  font-weight: 500;
}
.dark .badge {
  background-color: var(--color-blue-900);
  color: var(--color-blue-300);
}
tbody td.col-aksi {
  text-align: right;
  width: 100px;
}
.action-buttons {
  display: flex;
  justify-content: flex-end;
  gap: 10px;
}
.table-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 14px 20px;
  border-top: 1px solid var(--color-zinc-200);
  background: var(--color-white);
}
.dark .table-footer {
  border-top-color: var(--color-zinc-700);
  background: var(--color-zinc-800);
}
.table-footer span {
  font-size: 13px;
  color: var(--color-zinc-500);
}
.dark .table-footer span {
  color: var(--color-zinc-400);
}
.pagination {
  display: flex;
  gap: 8px;
}
.btn-page {
  border: 1px solid var(--color-zinc-200);
  background: var(--color-white);
  color: var(--color-zinc-700);
  padding: 6px 16px;
  font-size: 13px;
  border-radius: 6px;
  cursor: pointer;
  transition: background 0.2s, border-color 0.2s;
}
.dark .btn-page {
  border-color: var(--color-zinc-600);
  background: var(--color-zinc-800);
  color: var(--color-zinc-300);
}
.btn-page:hover {
  background: var(--color-zinc-100);
}
.dark .btn-page:hover {
  background: var(--color-zinc-700);
}
.btn-page:disabled {
  color: var(--color-zinc-300);
  cursor: default;
  background: transparent;
}
.dark .btn-page:disabled {
  color: var(--color-zinc-600);
}
</style>