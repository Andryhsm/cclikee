@extends('front.layout.master')

@section('content')
  <div class="buy-product">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="index.html">Home</a></li>
        <li class="active">Buy</li>
      </ul>
      <!-- BEGIN SIDEBAR & CONTENT -->
      <div class="row margin-bottom-40">
        <!-- BEGIN CONTENT -->
        <h1>Buy locally (You already have the best price and link)</h1>
        <div class="col-md-12 col-sm-9" style="background:#fff;">
            <form role="form" class="form-horizontal form-without-legend">

              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                  <label for="email">BRAND / PUBLISHER:<span class="require">*</span></label>
                   <select name="brand" multiple>
                    <option val="">Brands currently available in </option>
                    <option val="">Brands currently available in </option>
                  </select>
                </div>

              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                  <label for="email">Modal/Product:<span class="require">*</span></label>
                  <input type="email"  id="email">
                </div>
                <div class="form-group">
                  <label for="email">Color:<span class="require">*</span></label>
                  <input type="email"  id="email">
                </div>
                <div class="form-group">
                  <label for="email">Cut:<span class="require">*</span></label>
                  <input type="email"  id="email">
                </div>
              </div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="form-group">
                  <label for="email">Reduced Price<span class="require">*</span></label>
                  <input type="email"  id="email">
                </div>
                <div class="form-group">
                  <label for="email">Product Link / Price<span class="require">*</span></label>
                  <input type="email"  id="email">
                </div>
                <div class="form-group">
                  <label for="email"></label>
                  <button type="submit" class="btn btn-primary buy-btn">Submit Application</button>
                </div>
              </div>
            </form>
            <!-- END FORM-->
        </div>
        <!-- END CONTENT -->
      </div>
      <!-- END SIDEBAR & CONTENT -->
    </div>
  </div>
@stop
