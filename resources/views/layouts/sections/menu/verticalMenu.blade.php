@php
$configData = Helper::appClasses();
@endphp

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <!-- ! Hide app brand if navbar-full -->
  @if(!isset($navbarFull))
  <div class="app-brand demo">
    <a href="{{url('/')}}" class="app-brand-link">
      <span class="app-brand-logo demo">
        @include('_partials.macros',["height"=>20])
      </span>
      <span class="app-brand-text demo menu-text fw-bold">SSO Page</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
      <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
    </a>
  </div>
  @endif


  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner">
    {{-- <li class="menu-item">
      <a class="menu-link" href="javascript:void(0)"><i class="menu-icon ti ti-file-text"></i>
      <div>
        Lorem Ipsum Long Long Long Text
      </div></a>
    </li> --}}
    {{-- <li class="menu-item">
      <a class="menu-link menu-toggle" href="javascript:void(0)"><i class="menu-icon ti ti-smart-home"></i>
      <div>
        Dashboards
      </div></a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a class="menu-link" href="javascript:void(0)">
          <div>
            Dashboard 1
          </div></a>
        </li>
        <li class="menu-item">
          <a class="menu-link" href="javascript:void(0)">
          <div>
            Dashboard 2
          </div></a>
        </li>
        <li class="menu-item">
          <a class="menu-link" href="javascript:void(0)">
          <div>
            Dashboard 3
          </div></a>
        </li>
      </ul>
    </li> --}}
    <li class="menu-item  {{ Request::is('home')? 'active' : ''}}">
      <a class="menu-link" href="{{ route('pages-home')}}"><i class="menu-icon ti ti-smart-home"></i>
      <div>
        Dashboard
      </div></a>
    </li>
    @if (Auth::user()->role_id == '0')
    {{-- Admin Access --}}
    <li class="menu-item {{ Request::is('user/*')? 'active open' : ''}}">
      <a class="menu-link menu-toggle" href="javascript:void(0)"><i class="menu-icon ti ti-users"></i>
      <div>
        All User
      </div></a>
      <ul class="menu-sub">
        <li class="menu-item {{ Request::is('user/user-show/1')? 'active' : '' }}">
          <a class="menu-link" href="{{ route('pages-user-show', '1')}}">
          <div>
            User Eksternal
          </div></a>
        </li>
        <li class="menu-item {{ Request::is('user/user-show/0')? 'active' : '' }}">
          <a class="menu-link" href="{{ route('pages-user-show', '0')}}">
          <div>
            User Internal
          </div></a>
        </li>
        <li class="menu-item {{ Request::is('user/user-inactive')? 'active' : '' }}">
          <a class="menu-link" href="{{ route('pages-user-inactive')}}">
          <div>
            Account Inactive
          </div></a>
        </li>

      </ul>
    </li>

    <li class="menu-item {{ Request::is('oauth-client')? 'active' : '' }}">
      <a class="menu-link" href="{{ route('oauth-client.index')}}"><i class="menu-icon ti ti-receipt"></i>
      <div>
        Oauth Client
      </div></a>
    </li>

    <li class="menu-item {{ Request::is('sso-client-app')? 'active' : '' }}">
      <a class="menu-link" href="{{ route('sso-client-app.index')}}"><i class="menu-icon ti ti-link"></i>
      <div>
        SSO Client App
      </div></a>
    </li>

    <li class="menu-item">
      <a class="menu-link menu-toggle" href="javascript:void(0)"><i class="menu-icon ti ti-database"></i>
      <div>
        Master Ref
      </div></a>
      <ul class="menu-sub">
        <li class="menu-item">
          <a class="menu-link" href="javascript:void(0)">
          <div>
            Role
          </div></a>
        </li>

      </ul>
    </li>

    <li class="menu-item">
      <a class="menu-link" href="javascript:void(0)"><i class="menu-icon ti ti-history"></i>
      <div>
        Log Access Token
      </div></a>
    </li>
    @endif


  </ul>

</aside>
