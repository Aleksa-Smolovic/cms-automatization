@extends('layouts.empty')

@section('css')
<link rel="stylesheet" href="{{ asset('css/403-page.css') }}">
@endsection

@section('content')
<!-- partial:index.partial.html -->
<div class="scene">
  <div class="overlay"></div>
  <div class="overlay"></div>
  <div class="overlay"></div>
  <div class="overlay"></div>
  <span class="bg-403">403</span>
  <div class="text">
    <span class="hero-text"></span>
    <span class="msg">Zabranjen pristup <span>subscriber</span>-ima.</span>
    <span class="support">
      <a href="/">Vrati se na početnu</a>
    </span>
  </div>
  <div class="lock"></div>
</div>
<!-- partial -->
@endsection
  
@section('js')

@endsection