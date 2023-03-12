<?php

namespace App\Http\Livewire\Tables\Loker;

use App\Models\Loker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EditLoker extends Component
{
    public $title;
    public $description;
    public $qualification;
    public $contact;

    public function mount(Loker $loker)
    {
        $this->title = $loker->title;
        $this->description = $loker->description;
        $this->qualification = $loker->qualification;
        $this->contact = $loker->contact;
        $this->selectedId = $loker->id;
    }

    protected $rules = [
        'title' => 'required',
        'description' => 'required|max:500',
        'qualification' => 'required|max:500',
        'contact' => 'required|max:20|numeric',
    ];

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

    public function update()
    {

        $data = $this->validate();

        try {

            $loker = Loker::where('id', $this->selectedId)->firstOrFail();

            $loker->update($data);

        } catch (\Exception $e) {

            $this->emit('showAlert', 'error', "Data gagal di perbarui: {$e->getMessage()}");

            return;
        }

        $this->resetForm();

        $this->emit(
            'showAlert',
            'success',
            'Data berhasil di perbarui.',
            '/table/loker'
        );

    }

    public function render()
    {
        return view(
            'livewire.tables.loker.edit-loker'
        )->layout('livewire.layouts.main', [
            'href' => 'Tables/Loker',
            'name' => 'Edit',
        ]);
    }
}
