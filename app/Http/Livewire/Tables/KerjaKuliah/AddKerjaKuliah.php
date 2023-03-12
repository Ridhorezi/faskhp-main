<?php

namespace App\Http\Livewire\Tables\KerjaKuliah;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\KerjaKuliah;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddKerjaKuliah extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $jenis_kelamin;
    public $nama_perusahaan;
    public $jabatan;
    public $tahun_kerja;
    public $nama_universitas;
    public $jurusan;
    public $gambar;

    protected $rules = [
        'name'              => 'required',
        'jenis_kelamin'     => 'required|in:l,p',
        'nama_perusahaan'   => 'required',
        'jabatan'           => 'required',
        'tahun_kerja'       => 'required|numeric|min:2000|digits:4',
        'nama_universitas'  => 'required',
        'jurusan'           => 'required',
        'gambar'            => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=800,height=800',
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
        $this->nama_perusahaan = "";
        $this->jabatan = "";
        $this->tahun_kerja = "";
        $this->nama_universitas = "";
        $this->jurusan = "";
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
                $this->gambar->storeAs('public/kerjakuliah', $name);
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

            $kerjakuliah = KerjaKuliah::create($data);

            $data['relasi_id'] = $kerjakuliah->id;

            $data = RoleHelper::alterByRole($data, 'KerjaKuliah');

        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', "Data gagal di simpan: {$e->getMessage()}");

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', "Data berhasil di simpan.");

        return RoleHelper::redirectByRoles('home', 'table.kerja-kuliah.index');
    }

    public function render()
    {
        return RoleHelper::showViewByRoles('livewire.user.kerja-kuliah.add', 'livewire.tables.kerja-kuliah.add-kerja-kuliah')
            ->adminLayoutData(['href' => 'Tables/KerjaKuliah', 'name' => 'Add'])->render();
    }
}
