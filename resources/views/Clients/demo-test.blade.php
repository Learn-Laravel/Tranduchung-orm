{{-- <h2>Demo view unicode</h2>
@if(session('mess'))
<div class="alert alert-success">
    {{session('mess')}}
</div>
@endif
<form action="" method="post">
    @csrf
    <input type="text" name="username" id="" placeholder="Username ..." value="{{old('username');}}">
    <button type="submit">Submit</button>
</form> --}}
{{-- <x-todo>
    @foreach ($tasks as $task)
        <h3>{{$task['name']}}</h3>
    @endforeach
</x-todo> --}}

@extends('layouts.app')
@section('title', 'Page Title')
@section('sidebar')
    {{-- @parent --}}
    <p>This is apperended to the master sidebar</p>
@endsection
@section('content')
    <p>This is my body content</p>
@endsection
    
