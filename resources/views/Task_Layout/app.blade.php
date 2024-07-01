<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body>
    <h1 class="text-3xl text-orange-500 font-bold pb-5 mt-5  text-center">@yield('title')</h1>
    @yield('content')
</body>
</html>