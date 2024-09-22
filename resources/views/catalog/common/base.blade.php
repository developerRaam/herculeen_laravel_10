<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@stack('setTitle')</title>
    <link rel="stylesheet" href="{{ URL::asset('css/catalog/common/common.css'); }}">
    <link rel="stylesheet" href="{{ URL::asset('css/catalog/style.css'); }}">
    @stack('addStyle')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- select 2 -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}

</head>
<body style="background:#f4f4f4;overflow-x:hidden">
    @include('catalog.common.top_header')
    @include('catalog.common.header')
    @yield('content')
    @include('catalog.common.footer')

    <script>
        // if(navigator.geolocation){
        //     navigator.geolocation.getCurrentPosition((position) => {
        //         const {latitude, longitude} = position.coords

        //         console.log(position)
        //     },(error) => {
        //         console.log(error)
        //     })

        // }
        // var xhr = new XMLHttpRequest();
        // xhr.open("POST", "get_location.php", true);
        // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        // xhr.onreadystatechange = function() {
        //     if (xhr.readyState == 4 && xhr.status == 200) {
        //         alert(xhr.responseText);
        //     }
        // };
        // xhr.send("latitude=" + latitude + "&longitude=" + longitude);

        // select 2
        // $(document).ready(function() {
        //     $('#filter').select2({
        //         placeholder: "Select a filter",
        //         minimumResultsForSearch: Infinity,
        //         // allowClear: true,
        //         height:'',
        //         search:true
        //     });
        // });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>