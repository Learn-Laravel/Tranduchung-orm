@extends('layouts.client')
@section('title')
{{ $title }}
@endsection
@section('content')

@if (session('msg'))
<div class="alert alert-success">{{session('msg')}}</div>
@endif
@if ($errors ->any())
    <div class="alert alert-danger">Du lieu nhap vao khong hop le. vUi long kiem tra lai</div>
@endif
<h1>{{ $title }}</h1>

<form action="{{route('users.postEdit')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="Ho va ten"></label>
        <input type="text" class="form-control" name="fullname" placeholder="Ho va ten" value="{{old('fullname') ?? $userDetail -> fullname}}">
        @error('fullname')
            <span style="color:red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="Email"></label>
        <input type="text" class="form-control" name="email" placeholder="email" value="{{old('email') ?? $userDetail -> email }}">
        @error('email')
            <span style="color:red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <select name="group_id" id="" class="form-control">
            <option value="0">--Chọn Nhóm--</option>
            @foreach ($groups as $item)
                <option value="{{ $item->id }}" {{old('group_id') == $item->id || $userDetail->group_id == $item->id?'selected':false }}>{{ $item->name }}</option>
            @endforeach

        </select>
        @error('group_id')
            <span style="color:red">{{$message}}</span>
        @enderror
    </div>
    <div class="mb-3">
        <select name="status" id="" class="form-control">
            <option value="0" {{old('status') == 0 || $userDetail->status == 0?'selected':false }}>Chưa Kích Hoạt</option>
            <option value="1" {{old('status') == 1 || $userDetail->status == 1?'selected':false }}>Kích Hoạt</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cap Nhap</button>
    <a href="{{route('users.index')}}" class="btn btn-warning">Quay lai</a>
</form>
@endsection