@php
    use App\Models\Cart;
    $headerCartCount = 0;
    $headerCartTotal = 0;
    if (auth()->check()) {
        $headerCartItems = Cart::where('user_id', auth()->id())->get();
        $headerCartCount = $headerCartItems->sum('quantity');
        $headerCartTotal = $headerCartItems->sum(fn ($item) => $item->price * $item->quantity);
    }
@endphp

<div class="header-middle">
    <div class="container">
        <div class="header-left">
            <button class="mobile-menu-toggler">
                <span class="sr-only">Toggle mobile menu</span>
                <i class="icon-bars"></i>
            </button>
            <a href="{{ route('home') }}" class="logo">
                <img src="{{ asset('assets/shop/images/demos/demo-2/logo.png') }}" alt="Molla Logo" width="105" height="25">
            </a>
        </div><!-- End .header-left -->

        <div class="header-center">
            <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                <form action="#" method="get">
                    <div class="header-search-wrapper search-wrapper-wide">
                        <label for="q" class="sr-only">Search</label>
                        <input type="search" class="form-control" name="q" id="q" placeholder="Search product ...">
                        <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                    </div><!-- End .header-search-wrapper -->
                </form>
            </div><!-- End .header-search -->
        </div>

        <div class="header-right">
            <div class="account">
                @auth
                    <a href="#" title="{{ Auth::user()->name }}">
                        <div class="icon"><i class="icon-user"></i></div>
                        <p>Account</p>
                    </a>
                @else
                    <a href="{{ route('login') }}" title="Login">
                        <div class="icon"><i class="icon-user"></i></div>
                        <p>Login</p>
                    </a>
                @endauth
            </div><!-- End .account -->

            <div class="dropdown cart-dropdown">
                <a href="{{ auth()->check() ? route('cart.index') : route('login') }}"
                   class="dropdown-toggle" role="button"
                   data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                    <div class="icon">
                        <i class="icon-shopping-cart"></i>
                        @if ($headerCartCount > 0)
                            <span class="cart-count">{{ $headerCartCount }}</span>
                        @endif
                    </div>
                    <p>Cart</p>
                </a>
            </div><!-- End .cart-dropdown -->
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-middle -->
