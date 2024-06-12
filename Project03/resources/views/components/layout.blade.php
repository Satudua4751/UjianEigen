@props(['bodyClass'])
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title> Eigen Trial </title>
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="{{ asset('assets') }}/css/Bootstrap-5.1.0.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/material-dashboard-3.0.1.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/datatables.min.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/color-block.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/select.css" rel="stylesheet" />
    <script src="{{ asset('assets') }}/js/jquery-3.6.0.min.js"></script>
</head>

<body class="{{ $bodyClass }}">

    {{ $slot }}

    <script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
    <script src="{{ asset('assets') }}/js/core/bootstrap-5.2.3.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>

    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc     -->
    <script src="{{ asset('assets') }}/js/material-dashboard.js"></script>
    <script src="{{ asset('assets') }}/js/datatables.js"></script>
    <script src="{{ asset('assets') }}/js/select2.min.js"></script>
    <script src="{{ asset('assets') }}/js/sweetalert.min.js"></script>
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    @stack('js')
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

</body>

</html>
