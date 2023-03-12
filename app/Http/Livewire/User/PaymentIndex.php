<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class PaymentIndex extends Component
{
    public function render()
    {
        return view('livewire.user.payment')->layout('guest');
    }
}
