<?php

namespace App\Http\Livewire\Tables\MencariKerja;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\MencariKerja;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddMencariKerja extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $jenis_kelamin;
    public $alamat;
    public $alasan_mencari_kerja;
    public $kontak;
    public $gambar;

    protected $rules = [
        'name'                    => 'required',
        'jenis_kelamin'           => 'required|in:l,p',
        'alamat'                  => 'required|max:250',
        'alasan_mencari_kerja'    => 'required|max:250',
        'kontak'                  => 'required|numeric',
        'gambar'                  => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=800,height=800',
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
        $this->alasan_mencari_kerja = "";
        $this->kontak = "";
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
                $this->gambar->storeAs('public/mencarikerja', $name);
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

            $mencarikerja = MencariKerja::create($data);

            $data['relasi_id'] = $mencarikerja['id'];

            $table = 'MencariKerja';

            $data = RoleHelper::alterByRole($data, $table);

        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");

        return RoleHelper::redirectByRoles('home', 'table.mencari-kerja.index');
    }

    public function render()
    {
        return RoleHelper::showViewByRoles('livewire.user.mencari-kerja.add', 'livewire.tables.mencari-kerja.add-mencari-kerja')
            ->adminLayoutData([
                'href' => 'Tables/MencariKerja',
                'name' => 'Add',
            ])->render();
    }
}
