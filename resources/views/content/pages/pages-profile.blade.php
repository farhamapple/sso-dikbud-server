@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Profile Page')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/flatpickr/flatpickr.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('assets/vendor/libs/pickr/pickr.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/extended-ui-sweetalert2.js')}}"></script>
<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(document).ready(function(){

    //Flat-picker
    $('.flat-picker').flatpickr({
      monthSelectorType: 'static'
    });

    // Edit
    $('#btn-edit').on('click', function(e){
      e.preventDefault();
      let ref = $(this).data("ref");
      console.log(ref);

      // Define ID
      $('#first_name_edit').val('');
      $('#last_name_edit').val('');
      $('#username_edit').val('');
      $('#phone_edit').val('');
      $('#email_edit').val('');
      $('#email_external_edit').val('');
      $('#sex_edit').val('');
      $('#address_edit').val('');
      $('#identity_type_edit').val('');
      $('#identity_number_edit').val('');
      $('#nip_edit').val('');
      $('#instansi_edit').val('');
      $('#jabatan_edit').val('');
      $('#simpeg_id_edit').val('');
      $('#ref_edit').val('-');

      $.ajax({
        type:'POST',
        url:"{{ route('pages-user-show-detail') }}",
        data:{ref:ref},
        success:function(data){

            if(data.success){
              $('#first_name_edit').val(data.data.first_name);
              $('#last_name_edit').val(data.data.last_name);
              $('#username_edit').val(data.data.username);
              $('#phone_edit').val(data.data.phone);
              $('#email_edit').val(data.data.email);
              $('#email_external_edit').val(data.data.email_external);
              $('#address_edit').val(data.data.address);
              $('#ref_edit').val(data.data.ref);

              let optionValue = data.data.identity_type;
              $("#identity_type_edit").val(optionValue).find("option[value=" + optionValue +"]").attr('selected', true);

              $('#identity_number_edit').val(data.data.identity_number);
              $('#nip_edit').val(data.data.nip);
              $('#instansi_edit').val(data.data.instansi);
              $('#jabatan_edit').val(data.data.jabatan);
              $('#simpeg_id_edit').val(data.data.simpeg_id);

              if(data.data.birth_date != null){
                const birth_date_dmy = data.data.birth_date.split(" ");
                $('#birth_date_edit').val(birth_date_dmy[0]);
              }

              let optionSex = data.data.sex;
              $("#sex_edit").val(optionSex).find("option[value=" + optionSex +"]").attr('selected', true);

              // If Else
              console.log(data.data.is_asn);
              (data.data.is_external_account == '1') ? $('#is_external_account_edit').attr('checked', 'checked') : '';
              (data.data.is_asn == '1') ? $('#is_asn_edit').attr('checked', 'checked') : '';
              (data.data.is_active == '1') ? $('#is_active_edit').attr('checked', 'checked') : '';
              (data.data.role_id == '0') ? $('#role_id_edit').attr('checked', 'checked') : '';

              $('#editUser').modal('show');

            }else{

            }
        }
      });
    });


  });

</script>
@endsection
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> My Profile</h4>
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-6 col-lg-6 col-md-6 order-1 order-md-0">
      <!-- User Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              <img
                class="img-fluid rounded mb-3 pt-1 mt-4"
                src="{{ asset('assets/img/avatars/1.png') }}"
                height="100"
                width="100"
                alt="User avatar" />
              <div class="user-info text-center">
                <h4 class="mb-2">{{ $userData->name }}</h4>
                <span class="badge bg-label-secondary mt-1">{{ $userData->role->name }}</span>
              </div>
            </div>
          </div>
          <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
            <div class="d-flex align-items-start me-4 mt-3 gap-2">
              <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-registered ti-sm"></i></span>
              <div>
                <p class="mb-0 fw-semibold">{{  \Carbon\Carbon::parse($userData->created_at)->isoFormat('D MMMM Y') }}</p>
                <small>First Register</small>
              </div>
            </div>
            <div class="d-flex align-items-start mt-3 gap-2">
              <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-history-toggle ti-sm"></i></span>
              <div>
                <p class="mb-0 fw-semibold">17 Juli 2023</p>
                <small>Last Login</small>
              </div>
            </div>
          </div>
          @if (session('notifikasi-error'))
          <div class="card-body">
            @foreach (session('notifikasi-error') as $key => $item)
              <div class="alert alert-danger alert-dismissible" role="alert">
              {{ $item[0] }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endforeach
          </div>
          @endif

          @if (session('notifikasi-error-try-catch'))
          <div class="card-body">
              <div class="alert alert-danger alert-dismissible" role="alert">
              {{ session('notifikasi-error-try-catch') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
          @endif

          <!--- success -->
          @if (session('notifikasi-success'))
          <div class="card-body">
              <div class="alert alert-success alert-dismissible" role="alert">
              {{ session('notifikasi-success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          </div>
          @endif

          <p class="mt-4 small text-uppercase text-muted">Details</p>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-2">
                <span class="fw-semibold me-1">Username : </span>
                <span>{{ $userData->username }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Email : </span>
                <span>{{ $userData->email }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Email Eksternal : </span>
                <span>{{ $userData->email_external }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Phone : </span>
                <span>{{ $userData->phone }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">First Name : </span>
                <span>{{ $userData->first_name }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Last Name : </span>
                <span>{{ $userData->last_name }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Address : </span>
                <span>{{ $userData->address }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Sex : </span>
                @if ($userData->sex == 'Man')
                <span class="badge bg-label-success">Man</span>
                @else
                <span class="badge bg-label-warning">Woman</span>
                @endif

              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Birth Date : </span>
                <span>{{ $userData->birth_date }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Identity Type : </span>
                @switch($userData->identity_type)
                    @case('1')
                    <span class="badge bg-label-success">KTP</span>
                        @break
                    @case('2')
                    <span class="badge bg-label-success">SIM</span>
                        @break
                    @case('3')
                    <span class="badge bg-label-success">Passport</span>
                        @break
                    @default

                @endswitch
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Identity Number : </span>
                <span>{{ $userData->identity_number }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">User Type:</span>
                @if ($userData->is_external_accoount == '1')
                <span class="badge bg-label-success">Internal</span>
                @else
                <span class="badge bg-label-warning">Eksternal</span>
                @endif
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Ref : </span>
                <span>{{ $userData->ref }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Jenis Pekerjaan:</span>
                @if ($userData->is_asn == '1')
                <span class="badge bg-label-success">ASN</span>
                @else
                <span class="badge bg-label-danger">NON ASN</span>
                @endif
              </li>
              @if ($userData->is_asn == '1')
                <hr>
                <li class="mb-2 pt-1">
                  <span class="fw-semibold me-1">Instansi : </span>
                  <span>{{ $userData->instansi }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-semibold me-1">NIP : </span>
                  <span>{{ $userData->nip }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-semibold me-1">Email Isntansi: </span>
                  <span>{{ $userData->email }}</span>
                </li>
                <li class="mb-2 pt-1">
                  <span class="fw-semibold me-1">Jabatan : </span>
                  <span>{{ $userData->jabatan }}</span>
                </li>
              @endif



            </ul>
            <div class="d-flex justify-content-center">
              <a
                class="btn btn-primary me-3" id='btn-edit'
                href="#" data-ref="{{ $userData->ref }}"
                >Edit</a
              >
              <a href="javascript:;" class="btn btn-label-success suspend-user">Active</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->

    <!-- User Content -->
    <div class="col-xl-6 col-lg-6 col-md-6 order-0 order-md-1">
      <!-- User Pills -->
      <ul class="nav nav-pills flex-column flex-md-row mb-4">
        <li class="nav-item">
          <a class="nav-link active"
            ><i class="ti ti-user-check ti-xs me-1"></i>Account</a
          >
        </li>

      </ul>
      <!--/ User Pills -->

      <!-- Project table -->
      <div class="card mb-4">
        <h5 class="card-header">Last Activity</h5>
        <div class="table-responsive mb-3">
          <table class="table datatable-project border-top">
            <thead>
              <tr>
                <th></th>
                <th>Project</th>
                <th class="text-nowrap">Total Task</th>
                <th>Progress</th>
                <th>Hours</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <!-- /Project table -->


    </div>
    <!--/ User Content -->
  </div>

</div>
@include('content.pages.users.page-modal-user-edit')
@endsection
