<?php
/**
 * HONAKO THEME
 * By: Hoiyen
 * Ver: 0.0.1
 * Last Update: 05/03/2016
 *
 * Domain: 
 * Public
 *
 * Type:
 * Template
 * 
 * Description:
 * Homepage template
 */
?>
@extends('inc.master')
@section('content')

    @if ( ! $products->isEmpty() )
    <div class="container youplay-store store-grid">

      <!-- Games List -->
      <div class="col-md-12">

        <div class="isotope-list row vertical-gutter">

          @foreach ( $products as $product )
          <!-- Single Product Block -->
          <div class="item col-lg-3 col-md-4 col-xs-6">
            <a href="#!" class="angled-img">
              <div class="img img-offset">
                <img src="{{ $product->getImage('medium') }}" alt="">
              </div>
              <div class="bottom-info">
                <h4>{{ $product->name }}</h4>
                <div class="row">
                  <div class="col-xs-6">
                  </div>
                  <div class="col-xs-6">
                    <div class="price">
                      IDR {{ $product->getPrice() }}
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
          <!-- /Single Product Block -->
          @endforeach

        </div>

      </div>
      <!-- /Games List -->

    </div>
    @endif

    <!-- Preorder -->
    <div class="h2"></div>
    <section class="youplay-banner small">
      <div class="image" style="background-image: url(assets/images/banner-witcher-3.jpg); background-size: cover;" data-top-bottom="background-position: 50% -150px;" data-bottom-top="background-position: 50% 150px;">
      </div>

      <div class="info container align-center">
        <div>
          <h2>The Witcher 3:<br> Wild Hunt</h2>

          <!-- See countdown init in bottom of the page -->
          <div class="countdown h2" data-end="2017/01/01"></div>

          <br>
          <br>
          <a class="btn btn-lg" href="#!">Pre-Order</a>
        </div>
      </div>
    </section>
    <!-- /Preorder -->


    <!-- Partners -->
    <section class="youplay-banner small mt-80">
      <div class="image" style="background-image: url(assets/images/banner-bg.jpg); background-size: cover;" data-top-bottom="background-position: 50% -150px;" data-bottom-top="background-position: 50% 150px;">
      </div>

      <div class="info align-center">
        <div>
          <h2 class="mb-40">Partners</h2>

          <div class="row">
            <div class="col-md-10 col-md-offset-1">
              <div class="owl-carousel" data-autoplay="6000">
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-1.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-2.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-3.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-4.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-5.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-6.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-7.png" alt="">
                  </a>
                </div>
                <div class="item">
                  <a href="#">
                    <img src="assets/images/partner-logo-8.png" alt="">
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Partners -->


    <!-- Features -->
    <h2 class="container h1">Why Buy from Us</h2>
    <section class="youplay-features container">
      <div class="col-md-3 col-sm-6">
        <div class="feature angled-bg">
          <i class="fa fa-cc-visa"></i>
          <h3>Payment</h3>
          <small>More than 10 payment systems</small>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="feature angled-bg">
          <i class="fa fa-gamepad"></i>
          <h3>Games</h3>
          <small>A large number of games</small>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="feature angled-bg">
          <i class="fa fa-money"></i>
          <h3>Cheap</h3>
          <small>Lowest prices on the Internet</small>
        </div>
      </div>
      <div class="col-md-3 col-sm-6">
        <div class="feature angled-bg">
          <i class="fa fa-users"></i>
          <h3>Community</h3>
          <small>The largest gaming community</small>
        </div>
      </div>
    </section>
@endsection