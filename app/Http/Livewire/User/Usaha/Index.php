<?php

namespace App\Http\Livewire\User\Usaha;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\Usaha;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use BaseTable;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function mount()
    {
        $this->filterUsingYear('tahun_usaha');
    }

    public function updated($fields)
    {
        $this->updatedBase($fields);
    }

    public function render()
    {
        $businesses = $this->membukaUsahaRender(Usaha::class)->cleanRequest()->paginate(8);

        return view('livewire.user.usaha.index', compact('businesses'))->layout('guest');
    }
}
