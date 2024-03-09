<h1>Trang Chu Unicode</h1>
<!-- <h2>{{ !empty(request()->keyword) ? request()->keyword : 'khong co gi' }}</h2> -->
<!-- <h2>{{ !empty(request()->keyword) ? request()->keyword : 'khong co gi' }}</h2>
<div class="container">
    {!! !empty($content) ? $content : false !!}
</div>
<hr> -->

{{-- @for ($i = 1; $i <= 10; $i++)
    <p>Phan tu: {{$i}}</p>
@endfor
@@ -84,9 +84,36 @@
Hi, {{ age }}
</script>
@endverbatim 
@php
$message = "Thanh Cong";
@endphp--}}
@include('paths.notice')
@extends('layouts.client')
@section('sidebar')
@parent
<h3>Home sidebar</h3>
@endsection
@section('title')
{{ $title }}
@endsection
@section('content')
<h1>Trang chu</h1>
<!-- @datetime('2021-12-15 15:00:30') -->
@include('Clients.Contents.slide')
@include('Clients.Contents.abouts')
@env('production')
<p>Moi truong production</p>
@elseenv('test')
<p>moi truong test</p>
@else
<p>Moi truong dev</p>
@endenv
@php
        
        @endphp
    
        <x-alert type='info' :content="$message" data-icon="youtube"/>
    
        <!-- <x-input.button/>
        <x-forms.button/>     -->
@endsection

@section('css')

@endsection

@section('Js')

@endsection