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
                                    @if ($category->children->isNotEmpty())
                                        <a href="#" data-toggle="collapse" data-target="#cat-{{ $category->id }}"
                                           role="button" aria-expanded="false"
                                           aria-controls="cat-{{ $category->id }}" class="sf-with-ul">
                                            {{ $category->title }}
                                        </a>
                                        <div class="collapse" id="cat-{{ $category->id }}">
                                            <ul>
                                                @foreach ($category->children as $child)
                                                    <li>
                                                        <a href="{{ route('category', $child->slug) }}">
                                                            {{ $child->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @else
                                        <a href="{{ route('category', $category->slug) }}">{{ $category->title }}</a>
                                    @endif
                                </li>
                            @empty
                                <li><a href="#">No categories yet</a></li>
                            @endforelse
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="header-center">
            <nav class="main-nav">
                <ul class="menu sf-arrows">
                    <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                        <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li>
                        <a href="{{ auth()->check() ? route('cart.index') : route('login') }}">Cart</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
