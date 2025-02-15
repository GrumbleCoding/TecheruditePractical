<header class="header">
    <div class="container">
        <nav class="navbar">
            <input type="checkbox" id="nav" class="hidden">
            <label for="nav" class="nav-toggle">
                <span></span>
                <span></span>
                <span></span>
            </label>
            <div class="wrapper">
                <ul class="menu">
                    @if(Auth::user() && Auth::user()->type == 'user')
                        <li class="menu-item">
                            <div class="wd-header-option">
                                <div class="dropdown">
                                    <a type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false" style="display:flex;">
                                        <img src="{{asset('assets/general/image/no_image.jpg')}}" alt="profile" class="img-fluid" style="width:25px; border-radius:50%; margin-right: 4px;"> My Account
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-top: 2px;">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.00008 17.3333C4.40008 17.3333 0.666748 13.5916 0.666748 8.99993C0.666748 4.39993 4.40008 0.666595 9.00008 0.666595C13.5917 0.666595 17.3334 4.39993 17.3334 8.99993C17.3334 13.5916 13.5917 17.3333 9.00008 17.3333ZM12.3334 7.34993C12.0834 7.10826 11.6917 7.10826 11.4501 7.35826L9.00008 9.8166L6.55008 7.35826C6.30841 7.10826 5.90841 7.10826 5.66675 7.34993C5.41675 7.59993 5.41675 7.9916 5.66675 8.23326L8.55841 11.1416C8.67508 11.2583 8.83341 11.3249 9.00008 11.3249C9.16675 11.3249 9.32508 11.2583 9.44175 11.1416L12.3334 8.23326C12.4584 8.1166 12.5167 7.95826 12.5167 7.79993C12.5167 7.63326 12.4584 7.47493 12.3334 7.34993Z" fill="#3A53A4" />
                                        </svg>
                                    </a>

                                    <div class="dropdown-menu dropdown-primary">
                                        <a class="dropdown-item" href="javascript:;" data-toggle="modal" data-target="#logOut" data-dismiss="modal">Logout</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @else
                        <li class="menu-item">
                            <a href="{{route('login')}}" class="loginbtn">Login</a>
                        </li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>