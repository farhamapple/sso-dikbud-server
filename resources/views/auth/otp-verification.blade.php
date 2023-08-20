@php
$customizerHidden = 'customizer-hide';
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login - Pages')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />
@endsection

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/pages-auth.js')}}"></script>
<script src="{{asset('assets/js/pages-auth-two-steps.js')}}"></script>
@endsection
@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img
          src="{{ asset('assets/img/illustrations/auth-two-step-illustration-light.png') }}"
          alt="auth-login-cover"
          class="img-fluid my-5 auth-illustration"
          data-app-light-img="illustrations/auth-two-step-illustration-light.png"
          data-app-dark-img="illustrations/auth-two-step-illustration-dark.png" />

        <img
          src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
          alt="auth-login-cover"
          class="platform-bg"
          data-app-light-img="illustrations/bg-shape-image-light.png"
          data-app-dark-img="illustrations/bg-shape-image-dark.png" />
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
              @include('_partials.macros',["height"=>60,"withbg"=>'fill: #fff;'])
          </a>
        </div>
        <!-- /Logo -->
        <h3 class="mb-1 fw-bold">Two Step Verification 💬</h3>
        <p class="mb-4">Kami mengirimkan kode verifikasi ke ponsel Anda. Masukkan kode dari ponsel di kolom di bawah ini</p>
        @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
          {{ $message }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
          {!! $message !!}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <p class="mb-0 fw-semibold">Type your 6 digit security code</p>
            <form id="twoStepsForm" action="{{route('send.otp.verification',$ref_user)}}" method="POST">
              @csrf
              <div class="mb-3">
                <div
                  class="auth-input-wrapper d-flex align-items-center justify-content-sm-between numeral-mask-wrapper">
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1"
                    autofocus />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1" />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1" />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1" />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1" />
                  <input
                    type="text"
                    class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                    maxlength="1" />
                </div>
                <!-- Create a hidden field which is combined by 3 fields above -->
                <input type="hidden" name="otp" />
              </div>
              <button type="submit" class="btn btn-primary d-grid w-100 mb-3">Verify my account</button>
              <div class="text-center">
                Didn't get the code?
                <a href="javascript:void(0);"> Resend </a>
              </div>
            </form>
      </div>
    </div>
    <!-- /Login -->
  </div>
</div>
@endsection
