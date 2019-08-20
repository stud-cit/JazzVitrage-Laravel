<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin</title>
    @include('layouts.site.styles')
</head>
<body>

<div id="site-app">
    <router-view></router-view>
</div>



@include('layouts.site.scripts')

</body>

</html>