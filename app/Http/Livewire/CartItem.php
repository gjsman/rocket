<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Exceptions\InvalidRowIDException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartItem extends Component
{
    public string $rowId;
    public ?string $quantity = null;

    public function render()
    {
        try {
            $item = Cart::get($this->rowId);
            $limit = min(array(
                5,
                $item->model->seatsRemaining(),
            ));
            if($this->quantity === null) {
                if((int) $item->qty <= $limit) {
                    $this->quantity = $item->qty;
                } elseif($limit > 0) {
                    $this->quantity = $limit;
                } else {
                    $this->quantity = 0;
                    $this->deleteCartItem($item->rowId);
                    unset($item);
                }
            } else {
                if((int) $this->quantity <= $limit) {
                    if((int) $this->quantity > 0) {
                        Cart::update($this->rowId, $this->quantity);
                    } else {
                        $this->quantity = $limit;
                    }
                } else {
                    $this->quantity = $limit;
                }
            }
            $this->emit('recalculate');
            if(isset($item)) {
                return view('livewire.cart-item', ['item' => $item]);
            } else {
                return view('livewire.cart-item');
            }
        } catch (InvalidRowIDException $e) {
            return view('livewire.cart-item');
        }
    }

    public function deleteCartItem(string $item)
    {
        Cart::remove($item);
        $this->emit('recalculate');
    }
}
