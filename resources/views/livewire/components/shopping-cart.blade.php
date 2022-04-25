<div class="row">
<div class="col">
    <div class="container">
        <h1>POS Cashier</h1>

        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price (RM)</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Cost (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                        @if ($cart->qty > 0)
                        <tr>
                            <th>{{ $cart->name }}</th>
                            <td>{{ $cart->price }}</td>
                            <td>
                              <button wire:click ="decrement('{{$cart->rowId}}')">-</button>
                              {{ $cart->qty }}
                              <button wire:click ="increment({{$cart->id}})">+</button>
                            </td>
                            <td>{{ $cart->qty * $cart->price }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <th>Subtotal</th>
                        <td>{{ Cart::priceTotal() }}</td>
                    </tr>
                    <tr>
                        <th>No. of items</th>
                        <td>{{ Cart::count() }}</td>
                    </tr>
                    <tr>
                        <th>Tax</th>
                        <td>{{Cart::setGlobalTax(6);}}{{Cart::tax()}}</td>
                    </tr>
                    <tr>
                        <th>Service Charge</th>
                        <td>-</td>
                    </tr>
                    <tr>
                        <th>Total</th>
                        <td>{{ Cart::total() }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="d-flex justify-content-end">
                <div class="col-10 text-end">
                    <button class="btn btn-secondary" wire:click="deleteCart()" style="width: 100px;">Clear</button>
                </div>
                <div class="col-2 text-end">
                    <button type="button" data-toggle="modal" data-target="#confirmCheckoutModal" class="btn btn-primary">Checkout</button>
                    {{-- data-toggle="modal" data-target="#confirmDeleteModal" wire:click="confirmDelete({{ $subcategory->id }})" --}}
                    {{-- <button data-toggle="modal" data-target="#confirmCheckoutModal" wire:click="updateSubcategory({{ $subcategory->id }})" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</button> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col">
    <div class="container">
        <h1>Products</h1>
        <div class="row row-cols-2">
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product 1</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary" value="1" wire:click='addtoCart({{$product=1}})'>Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product 2</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary" value="2" wire:click='addtoCart({{$product=2}})'>Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product 3</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary" value="3" wire:click='addtoCart({{$product=3}})'>Add To Cart</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Product 4</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the
                            bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary" value="4" wire:click='addtoCart({{$product=4}})'>Add To Cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 <!-- Modal -->
 <div wire:ignore.self class="modal fade" id="confirmCheckoutModal" tabindex="-1" role="dialog" aria-labelledby="confirmCheckoutModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirm Checkout</h5>

              
          </div>
          <div class="modal-body">
            <form>
            <table class="table table-bordered">
              <tbody>
                  <tr>
                      <th>Total Paid Amount</th>
                      <td><input name="paidamount" type="number" value="" class="number" id="paidamount" placeholder="Enter Paid Amount" wire:model="paidamount"></td>
                  </tr>
                  <tr>
                      <th>Total</th>
                      <td>{{ Cart::total() }}</td>
                  </tr>
                  <tr>
                      <th>Payment Method</th>
                      <td>Cash</td>
                  </tr>
                  <tr>
                      <th>Change</th>
                        <td>
                            @if ($paidamount > Cart::total())
                          {{$Change = $paidamount - Cart::total()}}
                            @endif
                        </td>
                  </tr>
              </tbody>
            </table>
            <button type="button" wire:click.prevent="confirmPayment({{Cart::content()}})" class="btn btn-danger close-modal" data-dismiss="modal">Pay</button>
            </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary close-btn" data-dismiss="modal">Close</button>
          </div>
      </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
      livewire.on('closeCheckoutModal', () => {
          $('#confirmCheckoutModal').modal('hide');
      });
  });
  
</script>
</div>