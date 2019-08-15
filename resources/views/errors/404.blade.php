@extends('layouts.empty')

@section('css')
<link rel="stylesheet" href="{{ asset('css/404-page.css') }}">
@endsection

@section('content')
<!-- partial:index.partial.html -->
 <div id="clouds">
            <div class="cloud x1"></div>
            <div class="cloud x1_5"></div>
            <div class="cloud x2"></div>
            <div class="cloud x3"></div>
            <div class="cloud x4"></div>
            <div class="cloud x5"></div>
        </div>
        <div class="c">
            <div class="_404">404</div>
            <hr>
            <div class="_1">THE PAGE</div>
            <div class="_2">WAS NOT FOUND</div>
            <a class="btn" href="{{ route('admin.index') }}">Back to Admin</a>
        </div>
<!-- partial -->
@endsection
  
@section('js')

@endsection