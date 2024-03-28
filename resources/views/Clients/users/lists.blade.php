@extends('layouts.client')
@section('title')
    {{ $title }}
@endsection
@section('content')

    @if (session('msg'))
        <div class="alert alert-success">{{ session('msg') }}</div>
    @endif
    <h1>{{ $title }}</h1>
    <a href="{{ route('users.add') }}" class="btn btn-primary">Them nguoi dung</a>
    <hr>
    <form action="" method="GET" class=" mb-3">
        <div class="row mt-3">
            <div class="col-3">
                <select name="status" id="" class="form-control">
                    <option value="0">--Tất Cả Trạng thái--</option>
                    <option value="active" {{ request()->status == 'active' ? 'selected' : false }}>kích hoạt</option>
                    <option value="inactive" {{ request()->status == 'inactive' ? 'selected' : false }}>chưa kích hoạt
                    </option>
                </select>
            </div>
            <div class="col-3">
                <select name="group_id" id="" class="form-control">
                    <option value="0">--Tất Cả Nhóm--</option>
                    @foreach ($groups as $item)
                        <option value="{{ $item->id }}" {{ request()->group_id == $item->id ? 'selected' : false }}>{{ $item->name }}</option>
                    @endforeach

                </select>
            </div>
            <div class="col-4">
                <input type="search" name="keywords" class="form-control" placeholder="Từ khóa tìm kiếm"
                    value="{{ request()->keywords }}">
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Tìm Kiếm</button>
            </div>
        </div>
    </form>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="5%">STT</th>
                <th><a href="?sort-by=fullname&sort-type={{$sortType}}" class="text-decoration-none">Tên</a></th>
                <th><a href="?sort-by=email&sort-type={{$sortType}}" class="text-decoration-none">Email</a></th>
                <th>Group</th>
                <th>Status</th>
                <th width="20%"><a href="?sort-by=create_at&sort-type={{$sortType}}" class="text-decoration-none">Thời gian</a></th>
                <th width="5%">Edit</th>
                <th width="5%">Delete</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($userList))
                @foreach ($userList as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->fullname }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->group_name }}</td>
                        <td>{!! $item->status==0?'<button class="btn btn-danger btn-sm">Chưa kích hoạt</button>':'<button class="btn btn-success btn-sm">Kích hoạt</button>' !!}</td>
                        <td>{{ $item->create_at }}</td>
                        <td>
                            <a href="{{ route('users.edit', ['id' => $item->id]) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                        </td>
                        <td>
                            <a onclick="return confirm('Ban co muon xoa khong')"
                                href="{{ route('users.delete', ['id' => $item->id]) }}"
                                class="btn btn-danger btn-sm">Delete</a>
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
