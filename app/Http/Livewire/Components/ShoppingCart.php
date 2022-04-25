<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Transactions;

class ShoppingCart extends Component
{
    public Orders $orders;
    public OrderItems $orderitems;
    public Transactions $transactions;
    public $paidamount;
    public $product;
    public $rowId;
    public $totalpaidAmount;
    public $totalbeforetax;
    public $totalprice;
    public $totaltax;

    public function mount() {
        $this->order = new Orders();
        $this->totalbeforetax = Cart::priceTotal();
        $this->totalprice = Cart::total();
        $this->totaltax = $this->totalprice - $this->totalbeforetax;
        $this->resetcart = Cart::destroy();
    }
    

    public function deleteCart() {
        Cart::destroy();
    }

    public function render()
    {
        return view('livewire.components.shopping-cart', [
            'carts' => Cart::content(),
        ]);
    }

    public function addtoCart($product){
        if ($product === 1){
            Cart::add(['id' => '1', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        } else if ($product === 2){
            Cart::add(['id' => '2', 'name' => 'Product 2', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        } else if ($product === 3) {
            Cart::add(['id' => '3', 'name' => 'Product 3', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        } else {
            Cart::add(['id' => '4', 'name' => 'Product 4', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        }

    }

    public function decrement($id){

        $currentCart = Cart::get($id)->qty;
        if ($currentCart>0){
            $decreaseCart = Cart::get($id)->qty--;
        }
    }
    public function increment($id){
        if($id===1) {
            Cart::add(['id' => '1', 'name' => 'Product 1', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        } else if ($id===2) {
            Cart::add(['id' => '2', 'name' => 'Product 2', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        } else if ($id===3) {
            Cart::add(['id' => '3', 'name' => 'Product 3', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        } else {
            Cart::add(['id' => '4', 'name' => 'Product 4', 'qty' => 1, 'price' => 9.99, 'weight' => 1]);
        }
    }

    public function confirmPayment($id) {
        $newOrder = Orders::updateOrCreate(
            ['id' => $this->order->id],
            [
                'reference_no' => 'randomstring',
                'tax' => $this->totaltax,
                'service_charge' => '0',
                'total_amount_cents' => $this->totalprice,
                'is_walkin' => '1',
                'status' => 'Completed'
            ]
        );

        if($newOrder != null) {
            $this->resetcart;
        }


    }


}
