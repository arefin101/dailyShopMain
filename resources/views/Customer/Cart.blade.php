@extends('layouts.CommonLayout')

@section('content')

<section id="cart-view">
   <div class="container">
     <div class="row">
       <div class="col-md-12">
         <div class="cart-view-area">
           <div class="cart-view-table">
             <form action="">
               <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        @foreach($cart as $item)
                        <td><a class="remove" href="#"><fa class="fa fa-close"></fa></a></td>
                        @if($item->picture == 'defaultP.jpg')
                        <td><a href="#"><img src="assets/img/{{ $item->picture }}" alt="img"></a></td>
                        @else
                        <td><a href="#"><img src="data:image/png;base64, {{ $item->picture }}" alt="img"></a></td>
                        @endif
                        <td><a class="aa-cart-title" href="#">{{$item->productName}}</a></td>
                        <td>{{$item->price}}</td>
                        <td><input class="aa-cart-quantity" type="number" value="{{$item->quantity}}"></td>
                        <td>{{$item->totalPrice}}</td>
                        <tr>
                        @endforeach
                        <td colspan="6" class="aa-cart-view-bottom">
                          <div class="aa-cart-coupon">
                            <input class="aa-coupon-code" type="text" placeholder="Coupon">
                            <input class="aa-cart-view-btn" type="submit" value="Apply Coupon">
                          </div>
                          <input class="aa-cart-view-btn" type="submit" value="Update Cart">
                        </td>
                      </tr>
                      </tbody>
                  </table>
                </div>
             </form>
             <!-- Cart Total view -->
             <div class="cart-view-total">
               <h4>Cart Totals</h4>
               <table class="aa-totals-table">
                 <tbody>
                   <tr>
                     <th>Subtotal</th>
                     <td>$450</td>
                   </tr>
                   <tr>
                     <th>Total</th>
                     <td>$450</td>
                   </tr>
                 </tbody>
               </table>
               <a href="{{ route('CheckOut') }}" class="aa-cart-view-btn">Proced to Checkout</a>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>

 @stop