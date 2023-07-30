@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', $tipe_user)

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
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
  $(function(){
      let dt = $('#dt-user').DataTable();
  });

  $(document).ready(function(){

    //Flat-picker
    $('.flat-picker').flatpickr({
      monthSelectorType: 'static'
    });

    // go To Inactive
    $('.btn-go-to-inactive').on('click', function(e){
      e.preventDefault();
      let ref = $(this).data("ref")
        Swal.fire({
          title: 'Are you sure?',
          text: "Inactive User",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, Sure!',
          customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {

            $.ajax({
              type:'POST',
              url:"{{ route('pages-user-go-to-inactive') }}",
              data:{ref:ref},
              success:function(data){
                  if(data.success){
                    Swal.fire({
                      icon: 'success',
                      title: 'Inactive!',
                      text: 'User Has Been Inactive',
                      customClass: {
                        confirmButton: 'btn btn-success'
                      }
                    });
                    setTimeout(
                    function()
                    {
                      //do something special
                      location.reload();
                    }, 3000);

                  }else{
                    Swal.fire({
                      title: 'Error!',
                      text: ' Got Problem',
                      icon: 'error',
                      customClass: {
                        confirmButton: 'btn btn-primary'
                      },
                      buttonsStyling: false
                    });
                  }
              }
            });


          }
        });
    });

    // View
    $('.btn-show').on('click', function(e){
      e.preventDefault();
      let ref = $(this).data("ref");

      // id
      $('#first_name_view').val('');
      $('#last_name_view').val('');
      $('#username_view').val('');
      $('#phone_view').val('');
      $('#email_view').val('');
      $('#email_external_view').val('');
      $('#sex_view').val('');
      $('#address_view').val('');
      $('#identity_type_view').val('');
      $('#identity_number_view').val('');
      $('#nip_view').val('');
      $('#instansi_view').val('');
      $('#jabatan_view').val('');
      $('#simpeg_id_view').val('');


      $.ajax({
        type:'POST',
        url:"{{ route('pages-user-show-detail') }}",
        data:{ref:ref},
        success:function(data){
            console.log(data.data.identity_type)
            if(data.success){
              $('#first_name_view').val(data.data.first_name);
              $('#last_name_view').val(data.data.last_name);
              $('#username_view').val(data.data.username);
              $('#phone_view').val(data.data.phone);
              $('#email_view').val(data.data.email);
              $('#email_external_view').val(data.data.email_external);
              $('#sex_view').val(data.data.sex);
              $('#address_view').val(data.data.address);
              switch (data.data.identity_type) {
                case '1':
                $('#identity_type_view').html('<span class="badge bg-label-success me-1">KTP</span>');
                  break;
                case '2':
                $('#identity_type_view').html('<span class="badge bg-label-success me-1">SIM</span>');
                  break;
                case '3':
                $('#identity_type_view').html('<span class="badge bg-label-success me-1">Passport</span>');
                  break;

                default:
                $('#identity_type_view').html('<span class="badge bg-label-success me-1">Lain-lain</span>');
                  break;
              }


              $('#identity_number_view').val(data.data.identity_number);
              $('#nip_view').val(data.data.nip);
              $('#instansi_view').val(data.data.instansi);
              $('#jabatan_view').val(data.data.jabatan);
              $('#simpeg_id_view').val(data.data.simpeg_id);
              // If Else
              $('#sex_view').html((data.data.sex == '1') ? ' <span class="badge bg-label-primary me-1">Man</span>' : ' <span class="badge bg-label-warning me-1">Women</span>');
              $('#jenis_user_view').html((data.data.is_external_account == '0') ? ' <span class="badge bg-label-primary me-1">Internal</span>' : ' <span class="badge bg-label-danger me-1">Eksternal</span>');
              $('#is_asn_view').html((data.data.is_asn == '0') ? ' <span class="badge bg-label-danger me-1">Non ASN</span>' : ' <span class="badge bg-label-primary me-1">ASN</span>');
              $('#is_active_view').html((data.data.is_active == '0') ? ' <span class="badge bg-label-danger me-1">InAktif</span>' : ' <span class="badge bg-label-primary me-1">Aktif</span>');
              $('#is_admin_view').html((data.data.role_id != '0') ? ' <span class="badge bg-label-danger me-1">Guest</span>' : ' <span class="badge bg-label-primary me-1">Admin</span>');

              $('#showDetailUser').modal('show');
            }else{

            }
        }
      });
    });

    // Edit
    $('.btn-edit').on('click', function(e){
      e.preventDefault();
      let ref = $(this).data("ref");

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

    // Destroy
    $('.btn-destroy').on('click', function(e){
      e.preventDefault();
      let ref = $(this).data("ref")
        Swal.fire({
          title: 'Are you sure?',
          text: "Delete User",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, Sure!',
          customClass: {
            confirmButton: 'btn btn-primary me-3',
            cancelButton: 'btn btn-label-secondary'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {

            $.ajax({
              type:'POST',
              url:"{{ route('pages-user-destroy') }}",
              data:{ref:ref},
              success:function(data){
                  if(data.success){
                    Swal.fire({
                      icon: 'success',
                      title: 'Delete!',
                      text: 'User Has Been Delete',
                      customClass: {
                        confirmButton: 'btn btn-success'
                      }
                    });
                    setTimeout(
                    function()
                    {
                      //do something special
                      location.reload();
                    }, 3000);

                  }else{
                    Swal.fire({
                      title: 'Error!',
                      text: ' Got Problem',
                      icon: 'error',
                      customClass: {
                        confirmButton: 'btn btn-primary'
                      },
                      buttonsStyling: false
                    });
                  }
              }
            });


          }
        });
    });

  });


</script>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">All User / {{ $tipe_user }}</h4>
    <!-- DataTable with Buttons -->
    <div class="card">
      <div class="card-header header-elements">
        <span class="me-2"><h5>{{ $tipe_user }}</h5></span>

        <div class="card-header-elements ms-auto">


          <a
          href="javascript:;"
          class="btn btn-md btn-primary waves-effect waves-light"
          data-bs-target="#addUser"
          data-bs-toggle="modal"
          >Add User</a
        >
        </div>
      </div>
      <!-- Error -->
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


      <div class="card-datatable table-responsive">
        <table class="table" id="dt-user">
          <thead>
            <tr>
              <th width="20%">Name</th>
              <th width="10%">Email</th>
              <th width="10%">Email Eksternal</th>
              <th width="10%">Phone</th>
              <th width="10%">Tipe</th>
              <th width="10%">Dibuat</th>
              <th width="10%">Diubah</th>
              <th width="5%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($usersData as $item)
              <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->email_external }}</td>
                <td>{{ $item->phone }}</td>
                <td>
                  @if ($item->is_asn == "0")
                  <span class="badge bg-label-danger me-1">Non ASN</span>
                  @else
                  <span class="badge bg-label-primary me-1">ASN</span>
                  @endif
                </td>

                <td>{{ $item->created_at }}</td>
                <td>{{ $item->updated_at }}</td>
                <td>
                  <div class="dropdown">
                    <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                      <a class="dropdown-item btn-show" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-eye me-1 text-info"></i> View</a>
                      <a class="dropdown-item btn-edit" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                      <a class="dropdown-item btn-go-to-inactive" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-user-off me-1 text-danger"></i> Inactive</a>
                      <a class="dropdown-item btn-destroy" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-trash me-1 text-danger"></i> Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@include('content.pages.users.page-modal-user-add')
@include('content.pages.users.page-modal-user-show')
@include('content.pages.users.page-modal-user-edit')
@endsection
