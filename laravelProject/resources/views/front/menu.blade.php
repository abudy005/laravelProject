<div class="header-bottom sticky-header">
    <div class="container">
        <div class="header-left">
            <div class="dropdown category-dropdown">
                <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                    Browse Categories
                </a>
                <div class="dropdown-menu">
                    <nav class="side-nav">
                        <ul class="menu-vertical sf-arrows">
                            @forelse ($categories ?? [] as $category)
                                <li>
                                    <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                                    @if ($category->children->isNotEmpty())
                                        <ul>
                                            @foreach ($category->children as $child)
                                                <li><a href="{{ route('category', $child->slug) }}">{{ $child->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @empty
                                <li><a href="#">No categories yet</a></li>
                            @endforelse
                        </ul><!-- End .menu-vertical -->
                    </nav><!-- End .side-nav -->
                </div><!-- End .dropdown-menu -->
            </div><!-- End .category-dropdown -->
        </div><!-- End .header-left -->

        <div class="header-center">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a href="#">Shop</a>
                    </li>
                    <li>
                        <a href="{{ auth()->check() ? route('cart.index') : route('login') }}">Cart</a>
                    </li>
                </ul><!-- End .menu -->
            </nav><!-- End .main-nav -->
        </div><!-- End .header-center -->
    </div><!-- End .container -->
</div><!-- End .header-bottom -->
