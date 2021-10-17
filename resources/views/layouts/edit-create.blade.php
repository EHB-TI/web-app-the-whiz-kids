<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Custom Css -->
    <link rel="stylesheet" href="{{ asset('storage/css/admin-header.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('storage/css/admin-content.css') }}" type="text/css">
    <link href="{{ asset('storage/css/colorpicker/bootstrap-colorpicker.css') }}" rel="stylesheet">
    <title>OSD Ticket Shop - Admin</title>
</head>

<body>
    <div class="d-flex" id="wrapper">
        @include('partials.admin-sidebar')
        <div id="page-content-wrapper">
            @include('partials.admin-header')
            <div class="container-fluid">

                @include('partials.status-error')

                @yield('content')
            </div>
        </div>
    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script src="//unpkg.com/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('storage/js/colorpicker/bootstrap-colorpicker.js') }}"></script>
    <script>
        $(function() {
            // Basic instantiation:
            $('#titleColor').colorpicker();

            // Example using an event, to change the color of the #demo div background:
            $('#titleColor').on('colorpickerChange', function(event) {
                $('#event-title').css('color', event.color.toString());
                $('#event-date').css('color', event.color.toString());
            });
        });
    </script>
</body>

</html>