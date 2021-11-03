<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{ csrf_token() }}">
        <title>Laravel Budget Control</title>

        <style>
            .bd-placeholder-img {
              font-size: 1.125rem;
              text-anchor: middle;
              -webkit-user-select: none;
              -moz-user-select: none;
              -ms-user-select: none;
              user-select: none;
            }

            @media (min-width: 768px) {
              .bd-placeholder-img-lg {
                font-size: 3.5rem;
              }
            }
          </style>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @include('navigation')

    <div class="container-fluid">
        <div class="row">
            @include('sidebar')

            <main role="main" class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                @yield('content')

            </main>
        </div>
    </div>
    <script src="{{ asset('/js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
