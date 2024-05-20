<?php

namespace App\Http\Livewire\Tables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Support\Str;

class DaftarAdminTable extends DataTableComponent
{
    protected $listeners = ['daftarAdminTable' => '$refresh'];
    public $password;

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),
            Column::make('Username', 'username')
                ->searchable()
                ->sortable(),
            Column::make('Role'),
            // ->searchable(
            //     function (Builder $query, $searchTerm) {
            //         $query->whereHas('roles', function ($query) use ($searchTerm) {
            //             return $query->where('name', 'like', '%' . $searchTerm . '%');
            //         });
            //     }
            // ),
            // ->sortable(
            //     function (Builder $query, $direction) {
            //         $query->whereHas('roles', function ($query) use ($direction) {
            //             return $query->orderBy('name', $direction);
            //         });
            //     }
            // ),
            Column::make('Foto'),
            Column::make('Aksi', 'id'),
        ];
    }

    public function query(): Builder
    {
        $a =  User::query()->role(['pimpinan', 'admin pendaftaran awal', 'admin wawancara', 'admin daftar ulang', 'admin verifikasi']);
        return $a;
    }

    public function rowView(): string
    {
        return 'livewire-tables.rows.daftar_admin_table';
    }

    public function rules($id)
    {
        return [
            'nama_lengkap' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'role' => 'required',
        ];
    }


    public function edit($id)
    {
        $admin = User::find($id);
        $this->admin_id = $id;
        $this->nama_lengkap = $admin->name;
        $this->username = $admin->username;
        $this->role = $admin->roles->first()->name;
    }

    public function update()
    {
        $this->validate($this->rules($this->admin_id));
        $admin = User::find($this->admin_id);
        $admin->name = $this->nama_lengkap;
        $admin->username = Str::lower($this->username);
        if ($this->password == 1) {
            $admin->password = bcrypt('password');
        }
        $admin->save();
        $admin->syncRoles($this->role);
        session()->flash('success', 'Admin berhasil diperbarui');
    }

    public function delete($id)
    {
        $admin = User::find($id);
        $this->admin_id = $id;
        $this->nama_lengkap = $admin->name . ' ?';
    }

    public function destroy()
    {
        $user = User::find($this->admin_id);
        $user->delete();
        $this->dispatchBrowserEvent('closeDeleteModal');
        session()->flash('success', 'Berhasil dihapus');
    }
}
