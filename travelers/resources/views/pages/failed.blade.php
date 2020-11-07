@extends('layouts.success')
@section('title', 'Checkout Success')

@section('content')
<main>
    <section class="container section-success text-center">
      <div class="row">
        <div class="col mt-5">
            <img src="{{ url('frontend/images/ic_mail.png') }}">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <h3 class="mt-3">
            Ooopss!
          </h3>
          <p class="mt-1">
            Transaksi Kamu Gagal.
            <br>
            Hubungi Costumer Services untuk mengatasi masalah Kamu.
          </p>
          <a href="{{ url('/')}}" class="btn btn-home-page">
            Home Page
          </a>
        </div>
      </div>
    </section>
</main>
@endsection
