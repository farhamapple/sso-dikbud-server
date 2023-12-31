@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Home')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-primary" role="alert"><h2 class="text-center">Selamat Datang, di Halaman Dashboard SSO</h2></div>
    </div>
  </div>
    <!-- /Help Center Header -->
    <div class="row">
      <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ $calculate_user['total_user'] }}</h5>
              <small>Total User SSO</small>
            </div>
            <div class="card-icon">
              <span class="badge bg-label-primary rounded-pill p-2">
                <i class="ti ti-users ti-sm ti-tada"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ $calculate_user['total_user_internal'] }}</h5>
              <small>User Internal</small>
            </div>
            <div class="card-icon">
              <span class="badge bg-label-success rounded-pill p-2">
                <i class="ti ti-user ti-sm ti-tada"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ $calculate_user['total_user_eksternal'] }}</h5>
              <small>User Eksternal</small>
            </div>
            <div class="card-icon">
              <span class="badge bg-label-warning rounded-pill p-2">
                <i class="ti ti-user ti-sm ti-tada"></i>
              </span>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-body d-flex justify-content-between align-items-center">
            <div class="card-title mb-0">
              <h5 class="mb-0 me-2">{{ $calculate_user['total_user_inactive'] }}</h5>
              <small>User Inactive</small>
            </div>
            <div class="card-icon">
              <span class="badge bg-label-danger rounded-pill p-2">
                <i class="ti ti-user-x ti-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p style="margin-left: 10px">
      Aplikasi-Aplikasi yang sudah Terkoneksi SSO
    </p>

    <!-- Popular Articles -->
    <div class="row">
      @isset($dataSsoClientApp)
          @foreach ($dataSsoClientApp as $item)
          <div class="col-md-3">
            <div class="card icon-card cursor-pointer text-center mb-4 mx-2">
              <div class="card-body">
                <i class="ti {!! $item->icon !!} ti-xl mb-2"></i>
                <p class="icon-name text-capitalize text-truncate mb-4 mt-2">{{ $item->name }}</p>
                <a class="btn btn-sm btn-label-primary waves-effect" href="{{ $item->link_redirect}}">Go To</a>
              </div>
            </div>
          </div>
          @endforeach
      @endisset


    </div>
    <!-- /Popular Articles -->

    {{-- <!-- Knowledge Base -->
    <div class="help-center-knowledge-base py-5 help-center-bg-alt bg-help-center">
      <div class="container-xl">
        <h3 class="text-center mt-4">Knowledge Base</h3>
        <div class="row">
          <div class="col-lg-10 mx-auto">
            <div class="row">
              <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-label-success p-2 rounded me-2"
                        ><i class="ti ti-shopping-cart ti-sm"></i
                      ></span>
                      <h5 class="fw-semibold mt-3 ms-1">eCommerce</h5>
                    </div>
                    <ul>
                      <li class="text-primary py-1">
                        <a href="./pages-help-center-categories.html">Pricing Wizard</a>
                      </li>
                      <li class="text-primary pb-1">
                        <a href="./pages-help-center-categories.html">Square Sync</a>
                      </li>
                    </ul>
                    <p class="mb-0 fw-semibold">
                      <a href="javascript:void(0);">56 articles</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-label-info p-2 rounded me-2"
                        ><i class="ti ti-device-laptop ti-sm"></i
                      ></span>
                      <h5 class="fw-semibold mt-3 ms-1">Building Your Website</h5>
                    </div>
                    <ul>
                      <li class="text-primary py-1">
                        <a href="./pages-help-center-categories.html">First Steps</a>
                      </li>
                      <li class="text-primary pb-1">
                        <a href="./pages-help-center-categories.html">Add Images</a>
                      </li>
                    </ul>
                    <p class="mb-0 fw-semibold">
                      <a href="javascript:void(0);">111 articles</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-label-primary p-2 rounded me-2"
                        ><i class="ti ti-users ti-sm"></i
                      ></span>
                      <h5 class="fw-semibold mt-3 ms-1">Your Account</h5>
                    </div>
                    <ul>
                      <li class="text-primary py-1">
                        <a href="./pages-help-center-categories.html">Insights</a>
                      </li>
                      <li class="text-primary pb-1">
                        <a href="./pages-help-center-categories.html">Manage Your Orders</a>
                      </li>
                    </ul>
                    <p class="mb-0 fw-semibold">
                      <a href="javascript:void(0);">29 articles</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-label-danger p-2 rounded me-2"
                        ><i class="ti ti-world ti-sm"></i
                      ></span>
                      <h5 class="fw-semibold mt-3 ms-1">Domains and Email</h5>
                    </div>
                    <ul>
                      <li class="text-primary py-1">
                        <a href="./pages-help-center-categories.html">Access to Admin Account</a>
                      </li>
                      <li class="text-primary pb-1">
                        <a href="./pages-help-center-categories.html">Send Email From an Alias</a>
                      </li>
                    </ul>
                    <p class="mb-0 fw-semibold">
                      <a href="javascript:void(0);">22 articles</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-label-warning p-2 rounded me-2"
                        ><i class="ti ti-device-mobile ti-sm"></i
                      ></span>
                      <h5 class="fw-semibold mt-3 ms-1">Mobile Apps</h5>
                    </div>
                    <ul>
                      <li class="text-primary py-1">
                        <a href="./pages-help-center-categories.html">Getting Started with the App</a>
                      </li>
                      <li class="text-primary pb-1">
                        <a href="./pages-help-center-categories.html">Getting Started with Android</a>
                      </li>
                    </ul>
                    <p class="mb-0 fw-semibold">
                      <a href="javascript:void(0);">24 articles</a>
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-6 mb-4">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                      <span class="badge bg-label-secondary p-2 rounded me-2"
                        ><i class="ti ti-mail ti-sm"></i
                      ></span>
                      <h5 class="fw-semibold mt-3 ms-1">Email Marketing</h5>
                    </div>
                    <ul>
                      <li class="text-primary py-1">
                        <a href="./pages-help-center-categories.html">Getting Started</a>
                      </li>
                      <li class="text-primary pb-1">
                        <a href="./pages-help-center-categories.html">How does this work?</a>
                      </li>
                    </ul>
                    <p class="mb-0 fw-semibold">
                      <a href="javascript:void(0);">27 articles</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Knowledge Base -->

    <!-- Keep Learning -->
    <div class="help-center-keep-learning bg-help-center py-5">
      <div class="container-xl">
        <h3 class="text-center my-4">Keep Learning</h3>
        <div class="row">
          <div class="col-lg-10 mx-auto mb-4">
            <div class="row">
              <div class="col-md-4 mb-md-0 mb-4">
                <div class="card border shadow-none">
                  <div class="card-body text-center">
                    <svg
                      width="58"
                      height="58"
                      viewBox="0 0 58 58"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <g opacity="0.2">
                        <path
                          d="M9.0625 39.875V16.3125C9.0625 15.3511 9.44442 14.4291 10.1242 13.7492C10.8041 13.0694 11.7261 12.6875 12.6875 12.6875H45.3125C46.2739 12.6875 47.1959 13.0694 47.8758 13.7492C48.5556 14.4291 48.9375 15.3511 48.9375 16.3125V39.875H9.0625Z"
                          fill="currentColor" />
                        <path
                          d="M9.0625 39.875V16.3125C9.0625 15.3511 9.44442 14.4291 10.1242 13.7492C10.8041 13.0694 11.7261 12.6875 12.6875 12.6875H45.3125C46.2739 12.6875 47.1959 13.0694 47.8758 13.7492C48.5556 14.4291 48.9375 15.3511 48.9375 16.3125V39.875H9.0625Z"
                          fill="white"
                          fill-opacity="0.2" />
                      </g>
                      <path
                        d="M8.0625 39.875C8.0625 40.4273 8.51022 40.875 9.0625 40.875C9.61478 40.875 10.0625 40.4273 10.0625 39.875H8.0625ZM12.6875 12.6875L12.6875 11.6875L12.6875 12.6875ZM45.3125 12.6875V11.6875V12.6875ZM47.9375 39.875C47.9375 40.4273 48.3852 40.875 48.9375 40.875C49.4898 40.875 49.9375 40.4273 49.9375 39.875H47.9375ZM5.4375 39.875V38.875C4.88522 38.875 4.4375 39.3227 4.4375 39.875H5.4375ZM52.5625 39.875H53.5625C53.5625 39.3227 53.1148 38.875 52.5625 38.875V39.875ZM5.4375 43.5H4.4375H5.4375ZM32.625 20.9375C33.1773 20.9375 33.625 20.4898 33.625 19.9375C33.625 19.3852 33.1773 18.9375 32.625 18.9375V20.9375ZM25.375 18.9375C24.8227 18.9375 24.375 19.3852 24.375 19.9375C24.375 20.4898 24.8227 20.9375 25.375 20.9375V18.9375ZM10.0625 39.875V16.3125H8.0625V39.875H10.0625ZM10.0625 16.3125C10.0625 15.6163 10.3391 14.9486 10.8313 14.4563L9.41713 13.0421C8.54978 13.9095 8.0625 15.0859 8.0625 16.3125H10.0625ZM10.8313 14.4563C11.3236 13.9641 11.9913 13.6875 12.6875 13.6875L12.6875 11.6875C11.4609 11.6875 10.2845 12.1748 9.41713 13.0421L10.8313 14.4563ZM12.6875 13.6875H45.3125V11.6875H12.6875V13.6875ZM45.3125 13.6875C46.0087 13.6875 46.6764 13.9641 47.1687 14.4563L48.5829 13.0421C47.7155 12.1748 46.5391 11.6875 45.3125 11.6875V13.6875ZM47.1687 14.4563C47.6609 14.9486 47.9375 15.6163 47.9375 16.3125H49.9375C49.9375 15.0859 49.4502 13.9095 48.5829 13.0421L47.1687 14.4563ZM47.9375 16.3125V39.875H49.9375V16.3125H47.9375ZM5.4375 40.875H52.5625V38.875H5.4375V40.875ZM51.5625 39.875V43.5H53.5625V39.875H51.5625ZM51.5625 43.5C51.5625 44.1962 51.2859 44.8639 50.7937 45.3562L52.2079 46.7704C53.0752 45.903 53.5625 44.7266 53.5625 43.5H51.5625ZM50.7937 45.3562C50.3014 45.8484 49.6337 46.125 48.9375 46.125V48.125C50.1641 48.125 51.3405 47.6377 52.2079 46.7704L50.7937 45.3562ZM48.9375 46.125H9.0625V48.125H48.9375V46.125ZM9.0625 46.125C8.36631 46.125 7.69863 45.8484 7.20634 45.3562L5.79213 46.7704C6.65949 47.6377 7.83587 48.125 9.0625 48.125V46.125ZM7.20634 45.3562C6.71406 44.8639 6.4375 44.1962 6.4375 43.5H4.4375C4.4375 44.7266 4.92478 45.903 5.79213 46.7704L7.20634 45.3562ZM6.4375 43.5V39.875H4.4375V43.5H6.4375ZM32.625 18.9375H25.375V20.9375H32.625V18.9375Z"
                        fill="currentColor" />
                      <path
                        d="M8.0625 39.875C8.0625 40.4273 8.51022 40.875 9.0625 40.875C9.61478 40.875 10.0625 40.4273 10.0625 39.875H8.0625ZM12.6875 12.6875L12.6875 11.6875L12.6875 12.6875ZM45.3125 12.6875V11.6875V12.6875ZM47.9375 39.875C47.9375 40.4273 48.3852 40.875 48.9375 40.875C49.4898 40.875 49.9375 40.4273 49.9375 39.875H47.9375ZM5.4375 39.875V38.875C4.88522 38.875 4.4375 39.3227 4.4375 39.875H5.4375ZM52.5625 39.875H53.5625C53.5625 39.3227 53.1148 38.875 52.5625 38.875V39.875ZM5.4375 43.5H4.4375H5.4375ZM32.625 20.9375C33.1773 20.9375 33.625 20.4898 33.625 19.9375C33.625 19.3852 33.1773 18.9375 32.625 18.9375V20.9375ZM25.375 18.9375C24.8227 18.9375 24.375 19.3852 24.375 19.9375C24.375 20.4898 24.8227 20.9375 25.375 20.9375V18.9375ZM10.0625 39.875V16.3125H8.0625V39.875H10.0625ZM10.0625 16.3125C10.0625 15.6163 10.3391 14.9486 10.8313 14.4563L9.41713 13.0421C8.54978 13.9095 8.0625 15.0859 8.0625 16.3125H10.0625ZM10.8313 14.4563C11.3236 13.9641 11.9913 13.6875 12.6875 13.6875L12.6875 11.6875C11.4609 11.6875 10.2845 12.1748 9.41713 13.0421L10.8313 14.4563ZM12.6875 13.6875H45.3125V11.6875H12.6875V13.6875ZM45.3125 13.6875C46.0087 13.6875 46.6764 13.9641 47.1687 14.4563L48.5829 13.0421C47.7155 12.1748 46.5391 11.6875 45.3125 11.6875V13.6875ZM47.1687 14.4563C47.6609 14.9486 47.9375 15.6163 47.9375 16.3125H49.9375C49.9375 15.0859 49.4502 13.9095 48.5829 13.0421L47.1687 14.4563ZM47.9375 16.3125V39.875H49.9375V16.3125H47.9375ZM5.4375 40.875H52.5625V38.875H5.4375V40.875ZM51.5625 39.875V43.5H53.5625V39.875H51.5625ZM51.5625 43.5C51.5625 44.1962 51.2859 44.8639 50.7937 45.3562L52.2079 46.7704C53.0752 45.903 53.5625 44.7266 53.5625 43.5H51.5625ZM50.7937 45.3562C50.3014 45.8484 49.6337 46.125 48.9375 46.125V48.125C50.1641 48.125 51.3405 47.6377 52.2079 46.7704L50.7937 45.3562ZM48.9375 46.125H9.0625V48.125H48.9375V46.125ZM9.0625 46.125C8.36631 46.125 7.69863 45.8484 7.20634 45.3562L5.79213 46.7704C6.65949 47.6377 7.83587 48.125 9.0625 48.125V46.125ZM7.20634 45.3562C6.71406 44.8639 6.4375 44.1962 6.4375 43.5H4.4375C4.4375 44.7266 4.92478 45.903 5.79213 46.7704L7.20634 45.3562ZM6.4375 43.5V39.875H4.4375V43.5H6.4375ZM32.625 18.9375H25.375V20.9375H32.625V18.9375Z"
                        fill="white"
                        fill-opacity="0.2" />
                    </svg>

                    <h5 class="my-2">Blogging</h5>
                    <p class="mb-3">
                      Expert tips and tools to improve your website or online store using our blog.
                    </p>
                    <a class="btn btn-sm btn-label-primary" href="./pages-help-center-categories.html"
                      >Read More</a
                    >
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-md-0 mb-4">
                <div class="card border shadow-none">
                  <div class="card-body text-center">
                    <svg
                      width="58"
                      height="58"
                      viewBox="0 0 58 58"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <g opacity="0.2">
                        <path
                          d="M17.8304 37.8359C15.6726 36.1581 13.925 34.0112 12.7199 31.5579C11.5148 29.1045 10.8839 26.4091 10.8749 23.6757C10.8296 13.8429 18.7367 5.66403 28.5695 5.43747C32.375 5.34725 36.1123 6.45746 39.2514 8.61062C42.3904 10.7638 44.7719 13.8506 46.0581 17.4333C47.3442 21.016 47.4698 24.9127 46.4169 28.5707C45.364 32.2288 43.1861 35.4625 40.1921 37.8132C39.5308 38.3245 38.995 38.9802 38.6259 39.7302C38.2568 40.4802 38.0641 41.3047 38.0624 42.1406V43.5C38.0624 43.9807 37.8715 44.4417 37.5316 44.7816C37.1917 45.1215 36.7307 45.3125 36.2499 45.3125H21.7499C21.2692 45.3125 20.8082 45.1215 20.4683 44.7816C20.1284 44.4417 19.9374 43.9807 19.9374 43.5V42.1406C19.9318 41.3109 19.7394 40.4932 19.3747 39.748C19.0099 39.0029 18.4821 38.3493 17.8304 37.8359V37.8359Z"
                          fill="currentColor" />
                        <path
                          d="M17.8304 37.8359C15.6726 36.1581 13.925 34.0112 12.7199 31.5579C11.5148 29.1045 10.8839 26.4091 10.8749 23.6757C10.8296 13.8429 18.7367 5.66403 28.5695 5.43747C32.375 5.34725 36.1123 6.45746 39.2514 8.61062C42.3904 10.7638 44.7719 13.8506 46.0581 17.4333C47.3442 21.016 47.4698 24.9127 46.4169 28.5707C45.364 32.2288 43.1861 35.4625 40.1921 37.8132C39.5308 38.3245 38.995 38.9802 38.6259 39.7302C38.2568 40.4802 38.0641 41.3047 38.0624 42.1406V43.5C38.0624 43.9807 37.8715 44.4417 37.5316 44.7816C37.1917 45.1215 36.7307 45.3125 36.2499 45.3125H21.7499C21.2692 45.3125 20.8082 45.1215 20.4683 44.7816C20.1284 44.4417 19.9374 43.9807 19.9374 43.5V42.1406C19.9318 41.3109 19.7394 40.4932 19.3747 39.748C19.0099 39.0029 18.4821 38.3493 17.8304 37.8359V37.8359Z"
                          fill="white"
                          fill-opacity="0.2" />
                      </g>
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M38.6857 9.43527C35.7198 7.4009 32.1887 6.35195 28.5932 6.43719L28.5925 6.4372C28.3515 6.44275 28.1116 6.45338 27.8731 6.46896L28.5464 4.43773C32.5617 4.34269 36.5049 5.51414 39.817 7.78597C43.1293 10.0579 45.6422 13.3151 46.9993 17.0954C48.3564 20.8758 48.4889 24.9875 47.3779 28.8473C46.2669 32.7072 43.9688 36.1193 40.8097 38.5998L40.8037 38.6045L40.8037 38.6044C40.263 39.0224 39.8249 39.5585 39.5232 40.1717C39.2215 40.7847 39.0639 41.4585 39.0625 42.1416V42.1425V43.5C39.0625 44.2459 38.7661 44.9613 38.2387 45.4887C37.7112 46.0161 36.9959 46.3125 36.25 46.3125H21.75C21.004 46.3125 20.2887 46.0161 19.7612 45.4887C19.2338 44.9613 18.9375 44.2459 18.9375 43.5V42.1441C18.9323 41.4657 18.7748 40.7971 18.4765 40.1877C18.1781 39.5781 17.7466 39.0434 17.2138 38.6231L17.8866 36.5936C18.069 36.7483 18.255 36.8993 18.4442 37.0465L17.8304 37.836L18.4492 37.0504C19.2189 37.6567 19.8421 38.4284 20.2729 39.3084C20.7036 40.1884 20.9307 41.154 20.9374 42.1338L20.9375 42.1406L20.9375 43.5C20.9375 43.7155 21.0231 43.9221 21.1754 44.0745C21.3278 44.2269 21.5345 44.3125 21.75 44.3125H36.25C36.4654 44.3125 36.6721 44.2269 36.8245 44.0745C36.9768 43.9221 37.0625 43.7155 37.0625 43.5V42.1406V42.1387C37.0644 41.1503 37.2923 40.1754 37.7287 39.2886C38.1646 38.4029 38.7969 37.6285 39.5775 37.0244C42.4048 34.8035 44.4614 31.7492 45.4559 28.2941C46.4507 24.8379 46.3321 21.1562 45.1169 17.7712C43.9017 14.3862 41.6516 11.4696 38.6857 9.43527ZM17.8865 36.5936L17.8866 36.5936L27.8731 6.46896L27.8724 6.469L28.5458 4.43775C18.1651 4.67729 9.8275 13.3058 9.87496 23.6797C9.88451 26.5645 10.5504 29.4094 11.8223 31.9987C13.0938 34.5872 14.9375 36.8525 17.2138 38.6231L17.8865 36.5936ZM17.8865 36.5936C16.1041 35.0827 14.6499 33.2189 13.6175 31.117C12.4793 28.7998 11.8834 26.254 11.8749 23.6725L11.8749 23.6711C11.8332 14.6214 18.9246 7.05389 27.8724 6.469L17.8865 36.5936ZM18.9376 52.5625C18.9376 52.0102 19.3853 51.5625 19.9376 51.5625H38.0626C38.6149 51.5625 39.0626 52.0102 39.0626 52.5625C39.0626 53.1148 38.6149 53.5625 38.0626 53.5625H19.9376C19.3853 53.5625 18.9376 53.1148 18.9376 52.5625ZM31.0024 11.8828C30.4579 11.7905 29.9416 12.1571 29.8493 12.7016C29.757 13.2461 30.1236 13.7624 30.6681 13.8547C32.6793 14.1956 34.535 15.1524 35.9792 16.5929C37.4235 18.0334 38.385 19.8867 38.731 21.897C38.8247 22.4413 39.3419 22.8066 39.8862 22.7129C40.4304 22.6192 40.7957 22.102 40.702 21.5577C40.2857 19.1394 39.129 16.9098 37.3916 15.1769C35.6543 13.4439 33.4218 12.293 31.0024 11.8828Z"
                        fill="currentColor" />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M38.6857 9.43527C35.7198 7.4009 32.1887 6.35195 28.5932 6.43719L28.5925 6.4372C28.3515 6.44275 28.1116 6.45338 27.8731 6.46896L28.5464 4.43773C32.5617 4.34269 36.5049 5.51414 39.817 7.78597C43.1293 10.0579 45.6422 13.3151 46.9993 17.0954C48.3564 20.8758 48.4889 24.9875 47.3779 28.8473C46.2669 32.7072 43.9688 36.1193 40.8097 38.5998L40.8037 38.6045L40.8037 38.6044C40.263 39.0224 39.8249 39.5585 39.5232 40.1717C39.2215 40.7847 39.0639 41.4585 39.0625 42.1416V42.1425V43.5C39.0625 44.2459 38.7661 44.9613 38.2387 45.4887C37.7112 46.0161 36.9959 46.3125 36.25 46.3125H21.75C21.004 46.3125 20.2887 46.0161 19.7612 45.4887C19.2338 44.9613 18.9375 44.2459 18.9375 43.5V42.1441C18.9323 41.4657 18.7748 40.7971 18.4765 40.1877C18.1781 39.5781 17.7466 39.0434 17.2138 38.6231L17.8866 36.5936C18.069 36.7483 18.255 36.8993 18.4442 37.0465L17.8304 37.836L18.4492 37.0504C19.2189 37.6567 19.8421 38.4284 20.2729 39.3084C20.7036 40.1884 20.9307 41.154 20.9374 42.1338L20.9375 42.1406L20.9375 43.5C20.9375 43.7155 21.0231 43.9221 21.1754 44.0745C21.3278 44.2269 21.5345 44.3125 21.75 44.3125H36.25C36.4654 44.3125 36.6721 44.2269 36.8245 44.0745C36.9768 43.9221 37.0625 43.7155 37.0625 43.5V42.1406V42.1387C37.0644 41.1503 37.2923 40.1754 37.7287 39.2886C38.1646 38.4029 38.7969 37.6285 39.5775 37.0244C42.4048 34.8035 44.4614 31.7492 45.4559 28.2941C46.4507 24.8379 46.3321 21.1562 45.1169 17.7712C43.9017 14.3862 41.6516 11.4696 38.6857 9.43527ZM17.8865 36.5936L17.8866 36.5936L27.8731 6.46896L27.8724 6.469L28.5458 4.43775C18.1651 4.67729 9.8275 13.3058 9.87496 23.6797C9.88451 26.5645 10.5504 29.4094 11.8223 31.9987C13.0938 34.5872 14.9375 36.8525 17.2138 38.6231L17.8865 36.5936ZM17.8865 36.5936C16.1041 35.0827 14.6499 33.2189 13.6175 31.117C12.4793 28.7998 11.8834 26.254 11.8749 23.6725L11.8749 23.6711C11.8332 14.6214 18.9246 7.05389 27.8724 6.469L17.8865 36.5936ZM18.9376 52.5625C18.9376 52.0102 19.3853 51.5625 19.9376 51.5625H38.0626C38.6149 51.5625 39.0626 52.0102 39.0626 52.5625C39.0626 53.1148 38.6149 53.5625 38.0626 53.5625H19.9376C19.3853 53.5625 18.9376 53.1148 18.9376 52.5625ZM31.0024 11.8828C30.4579 11.7905 29.9416 12.1571 29.8493 12.7016C29.757 13.2461 30.1236 13.7624 30.6681 13.8547C32.6793 14.1956 34.535 15.1524 35.9792 16.5929C37.4235 18.0334 38.385 19.8867 38.731 21.897C38.8247 22.4413 39.3419 22.8066 39.8862 22.7129C40.4304 22.6192 40.7957 22.102 40.702 21.5577C40.2857 19.1394 39.129 16.9098 37.3916 15.1769C35.6543 13.4439 33.4218 12.293 31.0024 11.8828Z"
                        fill="white"
                        fill-opacity="0.2" />
                    </svg>

                    <h5 class="my-2">Inspiration Center</h5>
                    <p class="mb-3">Inspiration from experts to help you start and grow your big ideas.</p>
                    <a class="btn btn-sm btn-label-primary" href="./pages-help-center-categories.html"
                      >Read More</a
                    >
                  </div>
                </div>
              </div>

              <div class="col-md-4 mb-md-0 mb-4">
                <div class="card border shadow-none">
                  <div class="card-body text-center">
                    <svg
                      width="58"
                      height="58"
                      viewBox="0 0 58 58"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <g opacity="0.2">
                        <path
                          d="M22.8829 41.2571L20.1415 46.6946C19.9651 47.0654 19.6651 47.3632 19.293 47.5369C18.9209 47.7105 18.4999 47.7491 18.1024 47.6462C12.5517 46.2868 7.74854 43.9305 4.25947 40.8946C3.99643 40.6625 3.80541 40.3599 3.70904 40.0226C3.61267 39.6853 3.61499 39.3275 3.71572 38.9915L11.3962 13.3446C11.4709 13.0821 11.6062 12.8409 11.7912 12.6402C11.9761 12.4395 12.2055 12.285 12.461 12.1891C14.631 11.2989 16.875 10.6014 19.1673 10.1047C19.6078 10.0083 20.0684 10.0774 20.4612 10.2988C20.854 10.5203 21.1515 10.8787 21.297 11.3055L23.0868 16.7204C27.0103 16.1766 30.9899 16.1766 34.9134 16.7204V16.7204L36.7032 11.3055C36.8487 10.8787 37.1462 10.5203 37.539 10.2988C37.9318 10.0774 38.3924 10.0083 38.8329 10.1047C41.1252 10.6014 43.3692 11.2989 45.5392 12.1891C45.7947 12.285 46.0241 12.4395 46.209 12.6402C46.394 12.8409 46.5293 13.0821 46.604 13.3446L54.2845 38.9915C54.3852 39.3275 54.3875 39.6853 54.2912 40.0226C54.1948 40.3599 54.0038 40.6625 53.7407 40.8946C50.2517 43.9305 45.4485 46.2868 39.8978 47.6462C39.5003 47.7491 39.0793 47.7105 38.7072 47.5369C38.3351 47.3632 38.0351 47.0654 37.8587 46.6946L35.1173 41.2571C33.0907 41.5421 31.0467 41.6859 29.0001 41.6876C26.9535 41.6859 24.9095 41.5421 22.8829 41.2571V41.2571Z"
                          fill="currentColor" />
                        <path
                          d="M22.8829 41.2571L20.1415 46.6946C19.9651 47.0654 19.6651 47.3632 19.293 47.5369C18.9209 47.7105 18.4999 47.7491 18.1024 47.6462C12.5517 46.2868 7.74854 43.9305 4.25947 40.8946C3.99643 40.6625 3.80541 40.3599 3.70904 40.0226C3.61267 39.6853 3.61499 39.3275 3.71572 38.9915L11.3962 13.3446C11.4709 13.0821 11.6062 12.8409 11.7912 12.6402C11.9761 12.4395 12.2055 12.285 12.461 12.1891C14.631 11.2989 16.875 10.6014 19.1673 10.1047C19.6078 10.0083 20.0684 10.0774 20.4612 10.2988C20.854 10.5203 21.1515 10.8787 21.297 11.3055L23.0868 16.7204C27.0103 16.1766 30.9899 16.1766 34.9134 16.7204V16.7204L36.7032 11.3055C36.8487 10.8787 37.1462 10.5203 37.539 10.2988C37.9318 10.0774 38.3924 10.0083 38.8329 10.1047C41.1252 10.6014 43.3692 11.2989 45.5392 12.1891C45.7947 12.285 46.0241 12.4395 46.209 12.6402C46.394 12.8409 46.5293 13.0821 46.604 13.3446L54.2845 38.9915C54.3852 39.3275 54.3875 39.6853 54.2912 40.0226C54.1948 40.3599 54.0038 40.6625 53.7407 40.8946C50.2517 43.9305 45.4485 46.2868 39.8978 47.6462C39.5003 47.7491 39.0793 47.7105 38.7072 47.5369C38.3351 47.3632 38.0351 47.0654 37.8587 46.6946L35.1173 41.2571C33.0907 41.5421 31.0467 41.6859 29.0001 41.6876C26.9535 41.6859 24.9095 41.5421 22.8829 41.2571V41.2571Z"
                          fill="white"
                          fill-opacity="0.2" />
                      </g>
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M24.4688 32.625C24.4688 34.1265 23.2515 35.3438 21.75 35.3438C20.2485 35.3438 19.0312 34.1265 19.0312 32.625C19.0312 31.1235 20.2485 29.9062 21.75 29.9062C23.2515 29.9062 24.4688 31.1235 24.4688 32.625ZM38.9688 32.625C38.9688 34.1265 37.7515 35.3438 36.25 35.3438C34.7485 35.3438 33.5312 34.1265 33.5312 32.625C33.5312 31.1235 34.7485 29.9062 36.25 29.9062C37.7515 29.9062 38.9688 31.1235 38.9688 32.625Z"
                        fill="currentColor" />
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M24.4688 32.625C24.4688 34.1265 23.2515 35.3438 21.75 35.3438C20.2485 35.3438 19.0312 34.1265 19.0312 32.625C19.0312 31.1235 20.2485 29.9062 21.75 29.9062C23.2515 29.9062 24.4688 31.1235 24.4688 32.625ZM38.9688 32.625C38.9688 34.1265 37.7515 35.3438 36.25 35.3438C34.7485 35.3438 33.5312 34.1265 33.5312 32.625C33.5312 31.1235 34.7485 29.9062 36.25 29.9062C37.7515 29.9062 38.9688 31.1235 38.9688 32.625Z"
                        fill="white"
                        fill-opacity="0.2" />
                      <path
                        d="M16.8563 18.1251C20.7855 16.8936 24.8826 16.2821 29.0001 16.3126C33.1176 16.2821 37.2147 16.8936 41.1439 18.1251M41.1439 39.8751C37.2147 41.1065 33.1176 41.718 29.0001 41.6876C24.8826 41.718 20.7855 41.1065 16.8563 39.8751M35.1173 41.2571L37.8587 46.6946C38.0351 47.0654 38.3351 47.3632 38.7072 47.5368C39.0793 47.7105 39.5003 47.7491 39.8978 47.6462C45.4485 46.2868 50.2517 43.9305 53.7407 40.8946C54.0038 40.6625 54.1948 40.3599 54.2912 40.0226C54.3875 39.6853 54.3852 39.3275 54.2845 38.9915L46.604 13.3446C46.5293 13.0821 46.394 12.8409 46.209 12.6402C46.0241 12.4395 45.7947 12.285 45.5392 12.1891C43.3692 11.2989 41.1252 10.6014 38.8329 10.1047C38.3924 10.0083 37.9318 10.0774 37.539 10.2988C37.1462 10.5203 36.8487 10.8787 36.7032 11.3055L34.9134 16.7204M22.8829 41.2571L20.1415 46.6946C19.9651 47.0654 19.6651 47.3632 19.293 47.5368C18.9209 47.7105 18.4999 47.7491 18.1024 47.6462C12.5517 46.2868 7.74854 43.9305 4.25947 40.8946C3.99643 40.6625 3.80541 40.3599 3.70904 40.0226C3.61267 39.6853 3.61499 39.3275 3.71572 38.9915L11.3962 13.3446C11.4709 13.0821 11.6062 12.8409 11.7912 12.6402C11.9761 12.4395 12.2055 12.285 12.461 12.1891C14.631 11.2989 16.875 10.6014 19.1673 10.1047C19.6078 10.0083 20.0684 10.0774 20.4612 10.2988C20.854 10.5203 21.1515 10.8787 21.297 11.3055L23.0868 16.7204"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                      <path
                        d="M16.8563 18.1251C20.7855 16.8936 24.8826 16.2821 29.0001 16.3126C33.1176 16.2821 37.2147 16.8936 41.1439 18.1251M41.1439 39.8751C37.2147 41.1065 33.1176 41.718 29.0001 41.6876C24.8826 41.718 20.7855 41.1065 16.8563 39.8751M35.1173 41.2571L37.8587 46.6946C38.0351 47.0654 38.3351 47.3632 38.7072 47.5368C39.0793 47.7105 39.5003 47.7491 39.8978 47.6462C45.4485 46.2868 50.2517 43.9305 53.7407 40.8946C54.0038 40.6625 54.1948 40.3599 54.2912 40.0226C54.3875 39.6853 54.3852 39.3275 54.2845 38.9915L46.604 13.3446C46.5293 13.0821 46.394 12.8409 46.209 12.6402C46.0241 12.4395 45.7947 12.285 45.5392 12.1891C43.3692 11.2989 41.1252 10.6014 38.8329 10.1047C38.3924 10.0083 37.9318 10.0774 37.539 10.2988C37.1462 10.5203 36.8487 10.8787 36.7032 11.3055L34.9134 16.7204M22.8829 41.2571L20.1415 46.6946C19.9651 47.0654 19.6651 47.3632 19.293 47.5368C18.9209 47.7105 18.4999 47.7491 18.1024 47.6462C12.5517 46.2868 7.74854 43.9305 4.25947 40.8946C3.99643 40.6625 3.80541 40.3599 3.70904 40.0226C3.61267 39.6853 3.61499 39.3275 3.71572 38.9915L11.3962 13.3446C11.4709 13.0821 11.6062 12.8409 11.7912 12.6402C11.9761 12.4395 12.2055 12.285 12.461 12.1891C14.631 11.2989 16.875 10.6014 19.1673 10.1047C19.6078 10.0083 20.0684 10.0774 20.4612 10.2988C20.854 10.5203 21.1515 10.8787 21.297 11.3055L23.0868 16.7204"
                        stroke="white"
                        stroke-opacity="0.2"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round" />
                    </svg>

                    <h5 class="my-2">Community</h5>
                    <p class="mb-3">A group of people living in the same place or having a particular.</p>
                    <a class="btn btn-sm btn-label-primary" href="./pages-help-center-categories.html"
                      >Read More</a
                    >
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /Keep Learning --> --}}

    <!-- Help Area -->
    {{-- <div class="help-center-contact-us help-center-bg-alt">
      <div class="container-xl">
        <div class="row justify-content-center py-5">
          <div class="col-md-8 col-lg-6 text-center mt-4">
            <h3>Still need help?</h3>
            <p class="mb-3">
              Our specialists are always happy to help. Contact us during standard business hours or email us
              24/7 and we'll get back to you.
            </p>
            <div class="d-flex justify-content-center flex-wrap gap-4">
              <a href="javascript:void(0);" class="btn btn-primary">Visit our community</a>
              <a href="javascript:void(0);" class="btn btn-primary">Contact us</a>
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- /Help Area -->
  </div>
  <!-- / Content -->



  <div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
@endsection
