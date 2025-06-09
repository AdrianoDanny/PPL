<ul class="nav justify-content-center">
    <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">Contact Us</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">About Us</a>
    </li>
    @guest
    <li class="nav-item">
        <a class="nav-link text-primary" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Masuk</a>
    </li>
    @endguest
    @auth
    <li class="nav-item">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link btn btn-link">Logout</button>
        </form>
    </li>
    @endauth
</ul>
