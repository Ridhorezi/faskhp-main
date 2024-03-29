<?php

namespace App\Http\Livewire\Tables\Usaha;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Usaha;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddUsaha extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $jenis_kelamin;
    public $jenis_usaha;
    public $alamat_usaha;
    public $tahun_usaha;
    public $gambar;

    protected $rules = [
        'name'            => 'required',
        'jenis_kelamin'   => 'required|in:l,p',
        'jenis_usaha'     => 'required',
        'alamat_usaha'    => 'required',
        'tahun_usaha'     => 'required|numeric|min:2000|digits:4',
        'gambar'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=800,height=800',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->user_id = Auth::user()->id;
        $this->name = "";
        $this->jenis_kelamin = "";
        $this->jenis_usaha = "";
        $this->alamat_usaha = "";
        $this->tahun_usaha = "";
        $this->gambar = null;
    }

    public function store()
    {
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/usaha', $name);
                $data['gambar'] = $name;
            }

            if (
                Auth::guard()
                    ->user()
                    ->hasRole('SuperAdmin')
            ) {
                $data['dibuat'] = 1;
            } else {
                $data['dibuat'] = Auth::user()->name;
            }

            $data['user_id'] = Auth::user()->id;

            $usaha = Usaha::create($data);

            $data['relasi_id'] = $usaha->id;

            $data = RoleHelper::alterByRole($data, 'Usaha');

        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");

        return RoleHelper::redirectByRoles('home', 'table.usaha.index');
    }

    public function render()
    {
        return RoleHelper::showViewByRoles('livewire.user.usaha.add', 'livewire.tables.usaha.add-usaha')
            ->adminLayoutData([
                'href' => 'Tables/Usaha',
                'name' => 'Add',
            ])->render();
    }
}
