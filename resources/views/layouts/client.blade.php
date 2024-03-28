<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/clients/CSS/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>@yield('title') - Unicode</title>
    @yield('css')
</head>

<body>
    {{-- @section('sitebar')
        <p>Main sitebar</p>
    @endsection --}}
    @include('Clients.blocks.header')
    <main class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-3">
                    <aside>
                        @section('sidebar')
                            @include('Clients.blocks.sidebar')
                        @show
                    </aside>
                </div>
                <div class="col-9">
                    <div class='content'>
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('Clients.blocks.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @yield('Js')
    @stack('scripts')
</body>

</html>