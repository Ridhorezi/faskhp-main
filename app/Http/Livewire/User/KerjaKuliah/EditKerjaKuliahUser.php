<?php

namespace App\Http\Livewire\User\KerjaKuliah;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Container;
use App\Models\KerjaKuliah;
use App\Models\RequestEdit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditKerjaKuliahUser extends Component
{
    use WithFileUploads;
    public $name;
    public $jenis_kelamin;
    public $nama_perusahaan;
    public $jabatan;
    public $tahun_kerja;
    public $nama_universitas;
    public $jurusan;
    public $gambar;
    public $selectedId;
    public $gambarUpdated = false;

    public function mount(KerjaKuliah $kerjaKuliah)
    {
        $this->name = $kerjaKuliah->name;
        $this->jenis_kelamin = $kerjaKuliah->jenis_kelamin;
        $this->nama_perusahaan = $kerjaKuliah->nama_perusahaan;
        $this->jabatan = $kerjaKuliah->jabatan;
        $this->tahun_kerja = $kerjaKuliah->tahun_kerja;
        $this->nama_universitas = $kerjaKuliah->nama_universitas;
        $this->jurusan = $kerjaKuliah->jurusan;
        $this->gambar = $kerjaKuliah->gambar;
        $this->selectedId = $kerjaKuliah->id;
    }

    protected $rules = [
        'name'             => 'required',
        'jenis_kelamin'    => 'required|in:l,p',
        'nama_perusahaan'  => 'required',
        'jabatan'          => 'required',
        'tahun_kerja'      => 'required|numeric|min:2000|digits:4',
        'nama_universitas' => 'required',
        'jurusan'          => 'required',
        'gambar'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=800,height=800',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function updatedGambar()
    {
        $this->gambarUpdated = true;
    }

    private function resetForm()
    {
        $this->name = "";
        $this->jenis_kelamin = "";
        $this->nama_perusahaan = "";
        $this->jabatan = "";
        $this->tahun_kerja = "";
        $this->nama_universitas = "";
        $this->jurusan = "";
        $this->gambar = null;
        $this->gambarUpdated = false;
    }

    public function update()
    {

        if (!$this->gambarUpdated) {
            $this->gambar = false;
        }

        $data = $this->validate();

        DB::transaction(function () use ($data) {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name = time().hash("sha256", $this->gambar->getClientOriginalName()).$this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kerjakuliah', $name);
            }

            unset($data['gambar']);

            $data['gambar'] = $name;
            $data['dibuat'] = Auth::user()->name;

            $container = Container::create($data);

            RequestEdit::create([
                'id_container' => $container->id,
                'id_user'      => Auth::user()->id,
                'id_table'     => $this->selectedId,
                'table_type'   => 'kerjakuliah',
            ]);

            RoleHelper::validate();
        });

        $this->resetForm();
        $this->emit('showAlert', 'success', "Permintaan berhasil diajukan.");

        return to_route('user.kerjakuliah');
    }

    public function render()
    {
        return view('livewire.user.kerja-kuliah.edit-kerja-kuliah-user')->layout('guest');
    }
}
