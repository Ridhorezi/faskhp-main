<?php

namespace App\Http\Livewire\Tables\Kerja;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Kerja;
use App\Models\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddKerja extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $jenis_kelamin;
    public $nama_perusahaan;
    public $jabatan;
    public $tahun_kerja;
    public $gambar;

    protected $rules = [
        'name' => 'required',
        'jenis_kelamin' => 'required|in:l,p',
        'nama_perusahaan' => 'required',
        'jabatan' => 'required',
        'tahun_kerja' => 'required|numeric|min:2000|digits:4',
        'gambar' =>
            'nullable|image|mimes:jpg,jpeg,png|max:2048|dimensions:width=800,height=800',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->user_id = Auth::user()->id;
        $this->name = '';
        $this->jenis_kelamin = '';
        $this->nama_perusahaan = '';
        $this->jabatan = '';
        $this->tahun_kerja = '2000';
        $this->gambar = null;
    }

    public function store()
    {
        $data = $this->validate();

        try {
            if (!$this->gambar) {
                unset($data['gambar']);
            } else {
                $name =
                    time() .
                    hash('sha256', $this->gambar->getClientOriginalName()) .
                    $this->gambar->getClientOriginalName();
                $this->gambar->storeAs('public/kerja', $name);
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

            $kerja = Kerja::create($data);

            $data['relasi_id'] = $kerja->id;

            $data = RoleHelper::alterByRole($data, 'Kerja');

        } catch (\Exception $e) {
            $this->emit(
                'showAlert',
                'error',
                "Data gagal di simpan: {$e->getMessage()}"
            );

            return;
        }
        $this->resetForm();

        $this->emit('showAlert', 'success', 'Data berhasil di simpan.');

        return RoleHelper::redirectByRoles('home', 'table.kerja.index');
    }

    public function render()
    {
        // $query = Request::where('user_id', Auth::user()->id)->first();

        // if (!empty($query) && Auth::user()->hasRole('user')) {
        //     header('Location: ' . \URL::to('/'));
        //     die();
        // }

        return RoleHelper::showViewByRoles(
            'livewire.user.kerja.add',
            'livewire.tables.kerja.add'
        )
            ->adminLayoutData(['href' => 'Tables/Kerja', 'name' => 'Add'])
            ->render();
    }
}
