<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        @if(\Illuminate\Support\Facades\Auth::check())
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        @endif
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('home')}}" class="nav-link">Home</a>
        </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
    </ul>

    <!-- Right navbar links -->
    @if(\Illuminate\Support\Facades\Auth::check())
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class='fas fa-sign-out-alt'></i>
            </a>
            <a href="{{ route('logout') }}"
{{--               onclick="event.preventDefault(); document.getElementById('frm-logout').submit();"--}}
            >
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <form id="frm-logout" action="{{ route('logout') }}" method="get" >
                        {{ csrf_field() }}
                    </form>
                    Logout
                </div>
            </a>
        </li>
    </ul>
        @endif
</nav>
