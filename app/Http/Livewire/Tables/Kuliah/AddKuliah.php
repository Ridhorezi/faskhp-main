<?php

namespace App\Http\Livewire\Tables\Kuliah;

use App\Http\Livewire\Modules\RoleHelper;
use App\Models\Kuliah;
use App\Models\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddKuliah extends Component
{
    use WithFileUploads;
    public $user_id;
    public $name;
    public $jenis_kelamin;
    public $nama_universitas;
    public $jurusan;
    public $gambar;

    protected $rules = [
        'name' => 'required',
        'jenis_kelamin' => 'required|in:l,p',
        'nama_universitas' => 'required',
        'jurusan' => 'required',
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
        $this->nama_universitas = '';
        $this->jurusan = '';
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
                $this->gambar->storeAs('public/kuliah', $name);
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

            $kuliah = Kuliah::create($data);

            $data['relasi_id'] = $kuliah['id'];

            $table = 'Kuliah';

            $data = RoleHelper::alterByRole($data, $table);

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

        return RoleHelper::redirectByRoles('home', 'table.kuliah.index');
    }

    public function render()
    {

        // $query = Request::where('user_id', Auth::user()->id)->first();

        // if (!empty($query) && Auth::user()->hasRole('user')) {
        //     header('Location: ' . \URL::to('/'));
        //     die();
        // }

        return RoleHelper::showViewByRoles(
            'livewire.user.kuliah.add',
            'livewire.tables.kuliah.add-kuliah'
        )
            ->adminLayoutData(['href' => 'Tables/Kuliah', 'name' => 'Add'])
            ->render();

        // return RoleHelper::showViewByRoles(
        //     'livewire.user.kuliah.add',
        //     'livewire.tables.kuliah.add-kuliah'
        // )
        //     ->adminLayoutData(['href' => 'Tables/Kuliah', 'name' => 'Add'])
        //     ->render();
    }
}
