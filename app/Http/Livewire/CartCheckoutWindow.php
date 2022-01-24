<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartCheckoutWindow extends Component
{
    protected $listeners = ['recalculate' => 'render'];

    public function render()
    {
        return view('livewire.cart-checkout-window');
    }
}
