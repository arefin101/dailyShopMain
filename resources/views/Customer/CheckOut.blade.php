@extends('layouts.CommonLayout')

@section('content')

<section id="checkout">
    <div class="container">
        <div class="row">
        <div class="col-md-12">
            <div class="checkout-area">
            <form action="">
                <div class="row">
                <div class="col-md-8">
                    <div class="checkout-left">
                    <div class="panel-group" id="accordion">
                        <!-- Coupon section -->
                        <div class="panel panel-default aa-checkout-coupon">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                Have a Coupon?
                            </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body">
                            <input type="text" placeholder="Coupon Code" class="aa-coupon-code">
                            <input type="submit" value="Apply Coupon" class="aa-browse-btn">
                            </div>
                        </div>
                        </div>
                        <!-- Login section -->
                        
                        <!-- Billing Details -->
                        
                        <!-- Shipping Address -->
                        <div class="panel panel-default aa-checkout-billaddress">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                Delivery Address
                            </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapsin">
                            <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                    <input type="text" placeholder="Name*">
                                </div>                             
                                </div>
                            </div>  
                            <div class="row">
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill" id="district">
                                    <select name="district">
                                        <option selected>Select Your District</option>
                                    </select>
                                </div>                             
                                </div>                            
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="tel" placeholder="Phone*">
                                </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                    <textarea cols="8" rows="3">Address*</textarea>
                                </div>                             
                                </div>                            
                            </div>   
                            <div class="row">
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="text" placeholder="Appartment, Suite etc.">
                                </div>                             
                                </div>
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="text" placeholder="City / Town*">
                                </div>
                                </div>
                            </div>   
                            <div class="row">
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="text" placeholder="District*">
                                </div>                             
                                </div>
                                <div class="col-md-6">
                                <div class="aa-checkout-single-bill">
                                    <input type="text" placeholder="Postcode / ZIP*">
                                </div>
                                </div>
                            </div> 
                            <div class="row">
                                <div class="col-md-12">
                                <div class="aa-checkout-single-bill">
                                    <textarea cols="8" rows="3">Special Notes</textarea>
                                </div>                             
                                </div>                            
                            </div>              
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkout-right">
                    <h4>Order Summary</h4>
                    <div class="aa-order-summary-area">
                        <table class="table table-responsive">
                        <thead>
                            <tr>
                            <th>Product</th>
                            <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr>
                            <td>{{$item->productName}}<strong> x  {{$item->quantity}}</strong></td>
                            <td>{{$item->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                            <th>Subtotal</th>
                            <td>{{$subtotal}}</td>
                            </tr>
                            <tr>
                            <th>Tax (3%)</th>
                            <td>{{$tax}}</td>
                            </tr>
                            <tr>
                            <th>Total</th>
                            <td>{{$total}}</td>
                            </tr>
                        </tfoot>
                        </table>
                    </div>
                    <h4>Payment Method</h4>
                    <div class="aa-payment-method">                    
                        <label for="cashdelivery"><input type="radio" id="cashdelivery" name="optionsRadios"> Cash on Delivery </label>
                        <label for="paypal"><input type="radio" id="paypal" name="optionsRadios" checked> Via Paypal </label>
                        <img src="https://www.paypalobjects.com/webstatic/mktg/logo/AM_mc_vs_dc_ae.jpg" border="0"  style="margin-top:5px" alt="PayPal Acceptance Mark">    
                        <input type="submit" value="Place Order" class="aa-browse-btn">                
                    </div>
                    </div>
                </div>
                </div>
            </form>
            </div>
        </div>
        </div>
    </div>
    </section>
    <!-- / Cart view section -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function(){
        $.ajax({

            url:"https://bdapis.herokuapp.com/api/v1.1/districts/",

            complete:function(xmlHttp, status){

                if(xmlHttp.status==200){
                    
                    str="";
                    var data = xmlHttp.responseJSON.data;
                    
                    str+="<option selected>Select Your District</option>"
                    for(var i=0; i<data.length; i++){
                        str+="<option value="+data[i].district+">"+data[i].district+"</option>"
                    }
                    $("#district select").html(str);
                }else{
                    alert(xmlHttp.statusText);
                }

            }

        })

    })

</script>

    

@stop