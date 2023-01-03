<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('header')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap">
</head>
<body>
    <nav class="flex justify-between items-center bg-white h-20 shadow-md">
        <h2 class="text-4xl text-orange-600 font-bold">Foodie</h2>
        <ul>
            <li>
                <a class="" href="{{ route('admin.categories') }}">categories</a>
            </li>
            <li>
                <a href="{{ route('admin.foods') }}">foods</a>
            </li>
            <li>
                <a href="{{ route('admin') }}">index</a>
            </li>
            <li>
                <a href="{{ route('admin.delivery-agents') }}">delivery-agents</a>
            </li>
            <li>
                <a href="{{ route('admin.sliders') }}">sliders</a>
            </li>
            <li>
                <a href="{{ route('admin.orders') }}">orders</a>
            </li>
            <li>
                <a href="{{ route('admin.settings') }}">settings</a>
            </li>
            <li>
                <a href="{{ route('home') }}">site</a>
            </li>
        </ul>
    </nav>
</body>
</html>