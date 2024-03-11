@extends('layouts.client')
@section('title')
{{ $title }}
@endsection
@section('content')
<h1>Thêm sản phẩm</h1>
<form action="{{route('post-add')}}" method="post" id="product_form">
    <!-- @if ($errors -> any())
    <div class="alert alert-danger text-center">
        {{$errorMessage}}
    </div>
    @endif -->

    <div class="alert alert-danger text-centr msg" style="display:none;"></div>
    <div class="mb-3">
        <label for="">Tên sản phẩm</label>
        <input type="text" class="form-control" name="product_name" placeholder="Tên sản phẩm..." value="{{old('product_name')}}">

        <span style="color:red" class="error product_name_error"></span>

    </div>
    <div class="mb-3">
        <label for="">Giá sản phẩm</label>
        <input type="text" class="form-control" name="product_price" placeholder="Giá sản phẩm..." value="{{old('product_price')}}">

        <span style="color:red" class="error product_price_error"></span>

    </div>
    {{-- <input type="hidden" name="_token" value="{{csrf_token()}}"> --}}
    <button type="submit" class="btn btn-primary">Thêm mới</button>
    @csrf

</form>
@endsection

@section('css')

@endsection

@section('Js')
<script>
    $(document).ready(function() {
        $('#product_form').on('submit', function(e) {
            e.preventDefault();
            let productName = $('input[name="product_name"]').val().trim();
            let productPrice = $('input[name="product_price"]').val().trim();
            let actionUrl = $(this).attr('action');
            let csrfToken = $(this).find('input[name="_token"]').val();
            $('_error').text('');
            $.ajax({
                url: actionUrl,
                type: 'POST',
                data: {
                    product_name: productName,
                    product_price: productPrice,
                    _token: csrfToken
                },
                dataType: 'json',
                success: function(response) {

                },
                error: function(error) {

                    $('.msg').show();
                    let responseJSON = error.responseJSON.errors;
            
                    if (Object.keys(responseJSON).length>0) {
                        $('.msg').text(responseJSON.msg);
                        for (let key in responseJSON) {
                            // console.log(responseJSON[key]);
                            $('.' + key + '_error').text(responseJSON[key][0]);
                        }
                    }

                }
            });
        });
    });
</script>
@endsection