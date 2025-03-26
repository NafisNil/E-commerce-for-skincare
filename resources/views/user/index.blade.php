@extends('frontend.layouts.master')
@section('title')
    User Dashboard - Ziva
@endsection
@section('content')
<div class="mb-4 pb-4"></div>
<section class="my-account container login">
  <h2 class="page-title">My Account</h2>
  <div class="row">
    <div class="col-lg-3">
      <ul class="account-nav">
        @include('user.account-nav')
      </ul>
    </div>
    <div class="col-lg-9">
      <div class="page-content my-account__dashboard">
        <p>Hello <strong>User</strong></p>
        <p>From your account dashboard you can view your <a class="unerline-link" href="account_orders.html">recent
            orders</a>, manage your <a class="unerline-link" href="account_edit_address.html">shipping
            addresses</a>, and <a class="unerline-link" href="account_edit.html">edit your password and account
            details.</a></p>
      </div>
    </div>
  </div>
</section>
@endsection