<div class="p-3 bg-light text-dark container">
    <div class="row">
        <div class="col-6">
            <figure class="d-inline">
                <img width="80" src="{{ asset('images/logos/logo.png') }}" alt="Logo">
            </figure>
            <div class="d-inline m-2 fs-5">{{ config('app.name') }}</div>
        </div>
        <div class="col-6 d-flex align-items-center justify-content-end">
            <ul class="nav">
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item mr-2">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item mr-2">
                            <a class="nav-link ml-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if (Route::has('home'))
                        <li class="nav-item mr-2">
                            <a class="nav-link" href="{{ route('home') }}">{{ Auth::user()->name }}
                                ({{ Auth::user()->email }})</a>
                        </li>
                    @endif

                    @if (Route::has('logout'))
                        <li class="nav-item mr-2">
                            <a class="nav-link ml-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endif
                @endguest
            </ul>
        </div>
    </div>
</div>
