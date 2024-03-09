<h2>Demo view unicode</h2>
@if(session('mess'))
<div class="alert alert-success">
    {{session('mess')}}
</div>
@endif
<form action="" method="post">
    @csrf
    <input type="text" name="username" id="" placeholder="Username ..." value="{{old('username');}}">
    <button type="submit">Submit</button>
</form>