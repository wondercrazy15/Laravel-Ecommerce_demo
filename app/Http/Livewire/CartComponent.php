<?php

namespace App\Http\Livewire;
use Carbon\Carbon;
use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
    public function increaseQuntity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart ::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');

    }
    public function decreaseQuntity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty - 1;
        Cart ::instance('cart')->update($rowId,$qty);
        $this->emitTo('cart-count-component','refreshComponent');

    } 
    public function destroy($rowId)
    {
        Cart::instance('cart')->remove($rowId);
        $this->emitTo('cart-count-component','refreshComponent');
        session()->flash('success_message','Item has been Removed From Cart..!');
    }
    public function destroyAll()
    {
        Cart::instance('cart')->destroy();
        $this->emitTo('cart-count-component','refreshComponent');

    } 
    public function checkout(){
        if(Auth::check())
        {
            return redirect()->route('checkout');
        }
        else{
            return redirect()->route('login');
        }
    }
    
    public function render()
    {
        return view('livewire.cart-component')->layout('layouts.base');
    }
}
