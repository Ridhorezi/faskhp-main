<?php

namespace App\Http\Livewire\User;

use App\Http\Livewire\Modules\BaseTable;
use App\Models\Loker;
use Livewire\Component;
use Livewire\WithPagination;

class LokerIndex extends Component
{
    use BaseTable;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $lokers = $this->lokerRender(Loker::class)->paginate(8);
        return view('livewire.user.loker', compact('lokers'))->layout('guest');
    }
}
