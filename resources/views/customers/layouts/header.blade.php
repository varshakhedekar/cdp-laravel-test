<div class="mb-4">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="{{ url('/') }}" class="navbar-brand">CDPINDA</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    <!-- <a href="#" class="nav-item nav-link active">Home</a> -->
                    <a href="{{ route('products') }}" class="nav-item nav-link">Products</a>
                </div>
                
                <ul class="navbar-nav ml-auto">
                    @guest
                            @if (Route::has('login'))
                                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                                    @auth
                                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 underline">Home</a>
                                    @else
                                        <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Login</a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                                        @endif
                                    @endif

                                    
                                </div>
                            @endif
                    @else
                        <li class="nav-item dropdown">
                            <a >{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} |</a>
                            
                                <a class="" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                        
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
</div>