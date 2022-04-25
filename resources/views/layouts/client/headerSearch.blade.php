@include('../layouts/client/header')

<nav class="navbar navbar-expand-sm navbar-light bg-white justify-content-center p-0">
    <ul class="nav">
        <li class="nav-item mx-3">
            <a class="nav-link mx-5 {{ (request()->is('search/user*')) ? 'active-headSide' : '' }}" 
                href="{{ route('search.user', ['key' => $key]) }}">
                {{ __('User') }}
            </a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link mx-5 {{ (request()->is('search/category*')) ? 'active-headSide' : '' }}" 
                href="{{ route('search.category', ['key' => $key]) }}">
                {{ __('Category') }}
            </a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link mx-5 {{ (request()->is('search/post*')) ? 'active-headSide' : '' }}" 
                href="{{ route('search.post', ['key' => $key]) }}">
                {{ __('Post') }}
            </a>
        </li>
    </ul>
</nav>