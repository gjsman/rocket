<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Livewire\Component;

class CartItem extends Component
{
    public string $rowId;
    public ?string $quantity = null;

    public function render()
    {
        try {
            $item = \Gloudemans\Shoppingcart\Facades\Cart::get($this->rowId);
            if($this->quantity === null) {
                $this->quantity = $item->qty;
            } else {
                if((int) $this->quantity <= 5) {
                    if((int) $this->quantity > 0) {
                        \Gloudemans\Shoppingcart\Facades\Cart::update($this->rowId, $this->quantity);
                    } else {
                        $this->quantity = 1;
                    }
                } else {
                    $this->quantity = 5;
                }
            }
            $this->emit('recalculate');
            return view('livewire.cart-item', ['item' => $item]);
        } catch (InvalidRowIDException $e) {
            return view('livewire.cart-item');
        }
    }

    public function deleteCartItem(string $item)
    {
        \Gloudemans\Shoppingcart\Facades\Cart::remove($item);
        $this->emit('recalculate');
    }
}
