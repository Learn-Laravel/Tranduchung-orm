@extends('layouts.client')
@section('sidebar')
@parent
<h3>Products sidebar</h3>
@endsection
@section('title')
{{ $title }}
@endsection
@section('content')
<h1>San Pham</h1>
@if (session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@push('scripts')
    <script>
        console.log('Push lan 2')
    </script>
@endsection

@section('css')

@endsection

@section('Js')

@endsection
@prepend('scripts')
    <script>
        console.log('Push lan 1')
    </script>
@endprepend