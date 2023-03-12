<?php

namespace App\Http\Livewire\User\MencariKerja;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\MencariKerja;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use BaseTable;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function updated($fields)
    {
        $this->updatedBase($fields);
    }

    public function render()
    {
        $findJobs = $this->mencariKerjaRender(MencariKerja::class)->cleanRequest()->paginate(8);

        return view('livewire.user.mencari-kerja.index', compact('findJobs'))->layout('guest');
    }
}
