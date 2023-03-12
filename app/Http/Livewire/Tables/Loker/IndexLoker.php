<?php

namespace App\Http\Livewire\Tables\Loker;

use App\Http\Livewire\Modules\BaseTable;
use App\Http\Livewire\Modules\BulkDelete;
use App\Models\Loker;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use App\Exports\LokerExport;

class IndexLoker extends Component
{
    use WithPagination;
    use BaseTable;
    use BulkDelete;

    protected $paginationTheme = 'bootstrap';
    public $title;
    public $deleteOpened = false;
    public $selectedId;

    public function mount()
    {
        $this->setModel(Loker::class);
    }

    public function updated($fields)
    {
        $this->updatedBulk($fields);
        $this->updatedBase($fields);
    }

    private function cleanup()
    {
        $this->title = "";
        $this->deleteOpened = false;
        $this->selectedId = "";
    }

    public function openDelete($id)
    {
        $this->cleanup();

        try {
            $data = Loker::where('id', $id)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            $this->emit('showAlert', 'error', 'Gagal mendapat data');
            return;
        }

        $this->deleteOpened = true;
        $this->title = $data->title;
        $this->selectedId = $data->id;
        $this->emit('openModal', 'deletePreview');
    }

    public function deleteData()
    {
        try {
            $find = Loker::where('id', $this->selectedId);
            $find->delete();
        } catch (QueryException $q) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data. '.$q->getMessage());

            return;
        } catch (\Exception $e) {
            $this->emit('showAlert', 'error', 'Gagal menghapus data: '.$e->getMessage());

            return;
        }

        $this->emit('showAlert', 'success', 'Data berhasil dihapus');

    }

    public function exportLoker()
    {
        if ($this->items != null) {
            $this->emit('showAlert', 'success', 'Success export data');

            return (new LokerExport($this->items))->download('lowongan-kerja.xlsx');
        } else {
            $this->emit(
                'showAlert',
                'error',
                'Select record / option wajib di pilih !'
            );

            return;
        }
    }

    public function render()
    {
        $lokers = $this->lokerRender(Loker::class)->paginate(10);

        return view('livewire.tables.loker.index', compact('lokers'))->layout('livewire.layouts.main', ['href' => 'Tables', 'name' => 'Loker']);
    }
}
