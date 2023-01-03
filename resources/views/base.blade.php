<ul>
    <li>
        <a href="{{ route('auth.change-password-view') }}">Change Password</a>
    </li>
    <li>
        <a href="{{ route('home') }}">home</a>
    </li>
    <li>
        <a href="{{ route('auth.edit-account-view') }}">Edit Account</a>
    </li>
    <li>
        <a href="{{ route('search') }}">search</a>
    </li>
    <li>
        <a href="{{ route('cart') }}">cart</a>
    </li>
    <li>
        <a href="{{ route('cart.checkout') }}">checkout</a>
    </li>
    <li>
        <a href="{{ route('orders') }}">orders</a>
    </li>
    <li>
        <form action="{{ route('auth.logout') }}" method="post">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </li>
</ul>