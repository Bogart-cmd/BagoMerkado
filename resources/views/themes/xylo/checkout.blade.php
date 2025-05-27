@extends('themes.xylo.layouts.master')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"> 
@endsection
@section('content')
    @php $currency = activeCurrency(); @endphp
    <section class="banner-area inner-banner pt-5 animate__animated animate__fadeIn productinnerbanner">
        <div class="container h-100">
            <div class="row">
                <div class="col-md-4">
                    <div class="breadcrumbs">
                        <a href="#">Home Page</a> <i class="fa fa-angle-right"></i> <a href="#">Product</a> <i
                            class="fa fa-angle-right"></i> checkout
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="cart-page pb-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <form action="">

                        <div class="shipping_info">
                            <h3 class="cart-heading">Shipping Information</h3>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <input type="text" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="text" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-3">
                                    <input type="text" class="form-control" placeholder="Adress">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="text" class="form-control" placeholder="Barangay / Building / Floor">
                                </div>

                                <input type="hidden" name="country" value="Philippines">

                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <input type="text" class="form-control" placeholder="City">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <select name="province" id="province" class="form-select">
                                        <option value="">Select Province</option>
                                        <option value="Metro Manila">Metro Manila</option>
                                        <option value="Cebu">Cebu</option>
                                        <option value="Davao del Sur">Davao del Sur</option>
                                        <!-- Add more provinces as needed -->
                                    </select>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <input type="text" class="form-control" placeholder="Zipcode">
                                </div>
                            </div>
                            <div class="mt-3">
                                <label>
                                    <input type="checkbox" checked> Use as billing
                                </label>
                            </div>

                        </div>

                        <div class="shipping_info">
                            <h3 class="cart-heading mt-5">Contact Information</h3>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <input type="email" class="form-control" placeholder="Email">
                                </div>
                                <div class="col-md-6 mt-3">
                                    <input type="text" class="form-control" placeholder="Phone">
                                </div>
                            </div>

                        </div>

                        <div class="shipping_info mt-5">
                            <div class="row">
                                <div class="col-md-8"><h3 class="cart-heading">Payment Method</h3></div>
                                <div class="col-md-4 text-end">
                                        <img src="https://1000logos.net/wp-content/uploads/2023/05/GCash-Logo.jpg" alt="Gcash" class="h-6" style="height: 70px; width: auto;">
                                        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-6"> -->
                                        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/PayMaya_Logo.png/1200px-PayMaya_Logo.png" alt="Amex" class="h-6" style="height: 50px; width: auto;"> -->
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-12 mt-3">
                                    <label></label>
                                    <input type="text" placeholder="Enter Number" class="form-control">
                                </div>
                            </div>

                        </div>
                    </form>

                </div>

                <div class="col-md-5 mt-5 mt-md-0">
                    <div class="cart-box">
                        <h3 class="cart-heading">Order summary</h3>

                        <div class="row border-bottom pb-2 mb-2 mt-4">
                            <div class="col-6 col-md-4">Subtotal</div>
                            <div class="col-6 col-md-8 text-end">₱{{ number_format($subtotal, 2) }}</div>
                        </div>
                        <div class="row border-bottom pb-2 mb-2">
                            <div class="col-4 col-md-4">Shipping</div>
                            <div class="col-8 col-md-8 text-end"><small>Enter you address to view shipping</small></div>
                        </div>
                        <div class="row border-bottom pb-2 mb-2">   
                            <div class="col-6 col-md-4">Total</div>
                            <div class="col-6 col-md-8 text-end"><span>₱{{ number_format($total, 2) }}</span></div>
                        </div>

                        <div class="mt-4">
                            <a href="#" class="read-more d-block text-center">Proceed </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>









@endsection

@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
   
</script>

@endsection