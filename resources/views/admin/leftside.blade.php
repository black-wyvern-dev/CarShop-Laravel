<ul class="nav">
    <li class="active ">
        <a href="{{action('AdminController@homePage')}}">
            <i class="fa fa-tachometer-alt"></i>
            <p>{{ __('Dashboard') }}</p>
        </a>
    </li>

    <li>
        <a href="{{action('AdminController@users')}}">
            <i class="fa fa-user"></i>
            <p>{{ __('Users') }}</p>
        </a>
    </li>
    <li>
        <a href="{{action('AdminController@banners')}}">
            <i class="fa fa-flag" aria-hidden="true"></i>
            <p>{{ __('Banners') }}</p>
        </a>
    </li>
    <li>
        <a href="{{action('AdminController@makes')}}">
            <i class="fa fa-plus" aria-hidden="true"></i>
            <p>{{ __('Makes') }}</p>
        </a>
    </li>
    <li>
        <a href="{{action('AdminController@listings')}}">
            <i class="fa fa-list"></i>
            <p>{{ __('Listings') }}</p>
        </a>
    </li>
    <li>
        <a href="{{action('AdminController@interval')}}">
            <i class="fa fa-clock"></i>
            <p>{{ __('Interval') }}</p>
        </a>
    </li>
    <li>
        <a href="{{action('AdminController@pages')}}">
            <i class="fa fa-newspaper"></i>
            <p>{{ __('Pages') }}</p>
        </a>
    </li>

    <li>
        <a href="{{action('AdminController@logOut')}}">
            <i class="fa fa-power-off"></i>
            <p>{{ __('Log out') }}</p>
        </a>
    </li>

</ul>