{{-- filepath: d:\laravel-projects\inventory-app\resources\views\layouts\sidebar.blade.php --}}
@auth
<nav class="navbar navbar-expand-lg navbar-light bg-light flex-column align-items-stretch p-0 sidebar">
    <button class="navbar-toggler m-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span> Menu
    </button>
    <div class="collapse navbar-collapse show" id="sidebarMenu">
        <ul class="nav flex-column" style="background-color:aliceblue">
            <li class="nav-item px-3 py-2
            ">
                <span class="fw-bold"> </span>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    Dashboard
                </a>
            </li>
                        <li class="nav-item">
                <a class="nav-link {{ Request::is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                    Kelola Produk
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('items*') ? 'active' : '' }}" href="{{ route('items.index') }}">
                    Items
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('categories*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('transactions*') ? 'active' : '' }}" href="{{ route('transactions.index') }}">
                    Transactions
                </a>
            </li>

            <li class="nav-item mt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-outline-danger w-100" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>
@endauth