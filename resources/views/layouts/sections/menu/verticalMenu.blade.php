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
    {{-- Admin Access --}}
    @if(\App\Helpers\Helpers::checkPermission("Menu.AllUser.View"))
      <li class="menu-item {{ Request::is('user/*')? 'active open' : ''}}">
        <a class="menu-link menu-toggle" href="javascript:void(0)"><i class="menu-icon ti ti-users"></i>
        <div>
          All User
        </div></a>
        @if(\App\Helpers\Helpers::checkPermission("Masters.User.View"))
          <ul class="menu-sub">
            <li class="menu-item {{ Request::is('user/user-show') ? 'active' : '' }}">
              <a class="menu-link" href="{{ route('pages-user-show')}}">
              <div>
                User Active
              </div></a>
            </li>
            <li class="menu-item {{ Request::is('user/user-inactive')? 'active' : '' }}">
              <a class="menu-link" href="{{ route('pages-user-inactive')}}">
              <div>
                User Inactive
              </div></a>
            </li>
          </ul>
        @endif
      </li>
    @endif
    @if(\App\Helpers\Helpers::checkPermission("Masters.OauthClient.View"))
    <li class="menu-item {{ Request::is('oauth-client')? 'active' : '' }}">
      <a class="menu-link" href="{{ route('oauth-client.index')}}"><i class="menu-icon ti ti-receipt"></i>
      <div>
        Oauth Client
      </div></a>
    </li>
    @endif
    @if(\App\Helpers\Helpers::checkPermission("Masters.ClientApp.View"))
    <li class="menu-item {{ Request::is('sso-client-app')? 'active' : '' }}">
      <a class="menu-link" href="{{ route('sso-client-app.index')}}"><i class="menu-icon ti ti-link"></i>
      <div>
        SSO Client App
      </div></a>
    </li>
    @endif
    @if(\App\Helpers\Helpers::checkPermission("Menu.Master.View"))
    <li class="menu-item {{ Request::is('masters/*')? 'active open' : ''}}">
      <a class="menu-link menu-toggle" href="javascript:void(0)"><i class="menu-icon ti ti-database"></i>
      <div>
        Master Ref
      </div></a>
      @if(\App\Helpers\Helpers::checkPermission("Masters.User.View"))
          <ul class="menu-sub">
            <li class="menu-item {{ Request::is('masters/roles')? 'active' : '' }}">
              <a class="menu-link" href="{{ route('master.roles.index')}}">
              <div>
                Role
              </div></a>
            </li>
          </ul>
        @endif
    </li>
    @endif
    @if(\App\Helpers\Helpers::checkPermission("LogAccess.View"))
    <li class="menu-item {{ Request::is('sso-log-access')? 'active' : '' }}">
      <a class="menu-link" href="{{ route('sso-log-access.index')}}"><i class="menu-icon ti ti-history"></i>
      <div>
        Log Access Token
      </div></a>
    </li>
    @endif
  </ul>
</aside>
