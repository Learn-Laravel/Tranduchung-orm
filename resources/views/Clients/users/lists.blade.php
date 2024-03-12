@extends('layouts.client')
@section('title')
{{ $title }}
@endsection
@section('content')

@if (session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
<h1>{{ $title }}</h1>
<a href="{{route('users.add')}}" class="btn btn-primary">Them nguoi dung</a>
<hr>
<table class="table table-bordered">
    <thead>
        <tr>
            <th width="5%">STT</th>
            <th>Tên</th>
            <th>Email</th>
            <th width="20%">Thời gian</th>
            <th width="5%">Edit</th>
            <th width="5%">Delete</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($userList))
        @foreach ($userList as $key => $item) 
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$item -> fullname}}</td>
                <td>{{$item ->email}}</td>
                <td>{{$item -> create_at}}</td>
                <td>
                    <a href="{{route('users.edit', ['id' => $item ->id])}}" class="btn btn-warning btn-sm">Edit</a>
                </td>
                <td>
                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
        @endforeach
        @else 
            <tr>
                <td colspan="6">Khong co nguoi dung</td>
            </tr>
        @endif 
    </tbody>
</table>
@endsection