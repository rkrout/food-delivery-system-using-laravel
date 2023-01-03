<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @yield('header') --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600;1,700;1,800&display=swap">
</head>
<body>    
    <nav class="bg-white h-20 shadow-md fixed left-0 right-0 top-0 z-9">
        <div class="max-w-5xl mx-auto h-full flex justify-between items-center">
            <h2 class="text-2xl text-orange-600 font-bold">
                <span class="material-symbols-outlined">restaurant</span>
                Foodie
            </h2>
            <ul class="flex gap-8">
                <li>
                    <a class="flex gap-1 items-center text-orange-600 cursor-pointer transition-all duration-300" href="{{ route('home') }}">
                        <span class="material-symbols-outlined text-orange-600">home</span>
                        Home
                    </a>
                </li>
                <li>
                    <a class="flex gap-1 items-center hover:text-orange-600 cursor-pointer transition-all duration-300" href="{{ route('search') }}">
                        <span class="text-gray-600 material-symbols-outlined hover:text-orange-600">search</span>
                        <span>Search</span>
                    </a>
                </li>
                <li>
                    <a class="flex gap-1 items-center hover:text-orange-600 cursor-pointer transition-all duration-300" href="{{ route('cart') }}">
                        <span class="text-gray-600 material-symbols-outlined hover:text-orange-600">shopping_cart</span>
                        <span>Cart</span>
                    </a>
                </li>
                <li class="relative">
                    <a class="flex gap-1 items-center hover:text-orange-600 cursor-pointer transition-all duration-300">
                        <span class="text-gray-600 material-symbols-outlined hover:text-orange-600">person</span>
                        <span>Account</span>
                        <span class="text-gray-600 material-symbols-outlined">arrow_drop_down</span>
                    </a>
                    <ul class="absolute bg-white shadow-md w-48 py-2 rounded-md right-0 top-10 overflow-hidden">
                        <li>
                            <a 
                                class="px-4 py-2 hover:bg-gray-200 flex items-center gap-2" 
                                href="{{ route('auth.change-password-view') }}"
                            >
                                <span class="text-gray-600 material-symbols-outlined text-2xl">lock</span>
                                Change Password
                            </a>
                        </li>

                        <li>
                            <a 
                                class="px-4 py-2 hover:bg-gray-200 flex items-center gap-2" 
                                href="{{ route('auth.edit-account-view') }}}"
                            >
                                <span class="text-gray-600 material-symbols-outlined text-2xl">edit</span>
                                Edit Account
                            </a>
                        </li>

                        <li>
                            <a 
                                class="px-4 py-2 hover:bg-gray-200 flex items-center gap-2" 
                                href="{{ route('orders') }}}"
                            >
                                <span class="text-gray-600 material-symbols-outlined text-2xl">list</span>
                                My Orders
                            </a>
                        </li>

                        <li>
                            <a 
                                class="px-4 py-2 hover:bg-gray-200 flex items-center gap-2" 
                                href="{{ route('auth.logout') }}}"
                            >
                                <span class="text-gray-600 material-symbols-outlined text-2xl">logout</span>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>    
        </div>
    </nav>

    <div class="mt-20">
        @yield('content')
    </div>
</body>
</html>
