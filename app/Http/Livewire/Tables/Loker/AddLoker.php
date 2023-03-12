<?php

namespace App\Http\Livewire\Tables\Loker;

use App\Models\Loker;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class AddLoker extends Component
{
    public $title;
    public $description;
    public $qualification;
    public $contact;

    protected function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required|max:500',
            'qualification' => 'required|max:500',
            'contact' => 'required|numeric',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    private function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->qualification = '';
        $this->contact = '';
    }

    public function store()
    {
        $data = $this->validate();

        try {
            $loker = Loker::create($data);
        } catch (\Exception $e) {
            $this->emit(
                'showAlert',
                'error',
                "Data gagal di simpan: {$e->getMessage()}"
            );

            return;
        }
        $this->resetForm();

        $this->emit(
            'showAlert',
            'success',
            'Data berhasil di tambahkan',
            '/table/loker'
        );
    }

    public function render()
    {
        return view('livewire.tables.loker.add')->layout(
            'livewire.layouts.main',
            [
                'href' => 'Tables/Loker',
                'name' => 'Add',
            ]
        );
    }
}
