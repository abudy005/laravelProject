<div class="header-top">
    <div class="container">
        <div class="header-left">
            <p>Free shipping on orders over $50.</p>
        </div><!-- End .header-left -->

        <div class="header-right">
            <ul class="top-menu">
                <li>
                    <a href="#">Links</a>
                    <ul>
                        <li>
                            @auth
                                <a href="{{ route('home') }}">{{ Auth::user()->name }}</a>
                            @else
                                <a href="{{ route('login') }}">Sign in / Sign up</a>
                            @endauth
                        </li>
                        @auth
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" style="background:none;border:none;padding:0;color:inherit;cursor:pointer;">Log Out</button>
                            </form>
                        </li>
                        @endauth
                    </ul>
                </li>
            </ul><!-- End .top-menu -->
        </div><!-- End .header-right -->
    </div><!-- End .container -->
</div><!-- End .header-top -->
