@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Sso Client App')

@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/sweetalert2/sweetalert2.js')}}"></script>
@endsection

@section('page-script')

<script>
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $(function(){
      let dt = $('#dt-oauth-client').DataTable();
  });

  $(document).ready(function() {
    //Show Function
    // $('body').on('click', '.btn-show', function(e) {
    //   e.preventDefault();
    //   let id = $(this).data("id");

    //   $('#name_show').val('');
    //   $('#client_id_show').val('');
    //   $('#secret_show').val('');
    //   $('#redirect_show').val('');
    //   $('#provider_show').val('');
    //   // Checkbox
    //   $.ajax({
    //     type:'POST',
    //     url:"{{ route('oauth-client.edit') }}",
    //     data:{id:id},
    //     success:function(data){
    //       console.log(data.data);
    //       $('#name_show').val(data.data.name);
    //       $('#client_id_show').val(data.data.id);
    //       $('#secret_show').val(data.data.secret);
    //       $('#redirect_show').val(data.data.redirect);
    //       $('#provider_show').val(data.data.provider);
    //       //Checkbox
    //       (data.data.personal_access_client) ? $('#personal_access_client_show').html('<span class="badge bg-label-success">Yes</span>') : $('#personal_access_client_show').html('<span class="badge bg-label-danger">No</span>');
    //       (data.data.password_client) ? $('#password_client_show').html('<span class="badge bg-label-success">Yes</span>') : $('#password_client_show').html('<span class="badge bg-label-danger">No</span>');
    //       (data.data.revoked) ? $('#revoked_show').html('<span class="badge bg-label-success">Yes</span>') : $('#revoked_show').html('<span class="badge bg-label-danger">No</span>');

    //       $('#showOauthClient').modal('show');
    //     }
    //   });
    // });

    // Edit Function
    $('body').on('click', '.btn-edit', function(e) {
      e.preventDefault();
      let ref = $(this).data("ref");

      $('#name_edit').val('');
      $('#link_redirect_edit').val('');
      $('#icon_edit').val('');
      $('#ref_edit').val('');
      // Checkbox
      $.ajax({
        type:'POST',
        url:"{{ route('sso-client-app.edit') }}",
        data:{ref:ref},
        success:function(data){
          console.log(data.data);
          $('#name_edit').val(data.data.name);
          $('#link_redirect_edit').val(data.data.link_redirect);
          $('#icon_edit').val(data.data.icon);
          $('#ref_edit').val(data.data.ref);
          // //Checkbox
          (data.data.is_active == 1) ? $('#is_active_edit').attr('checked', 'checked') : '';

          $('#editSsoClient').modal('show');
        }
      });
    });

      // Delete Function
    $('body').on('click', '.btn-delete', function(e) {
      e.preventDefault();
      let ref = $(this).data("ref");

      Swal.fire({
        title: 'Are you sure?',
        text: "Delete Sso Client",
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
            url:"{{ route('sso-client-app.destroy') }}",
            data:{ref:ref},
            success:function(data){
                if(data.success){
                  Swal.fire({
                    icon: 'success',
                    title: 'Delete!',
                    text: data.message,
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
                    text: data.message,
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
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Sso Client app</h4>
    <!-- DataTable with Buttons -->
    <div class="card">
      <div class="card-header header-elements">
        <span class="me-2"><h5>Sso Client app</h5></span> <br><a href="https://tabler-icons.io/" target="_blank" class="btn btn-xs btn-success waves-effect waves-light"><span class="tf-icon ti ti-link ti-xs me-1"></span>Referensi Icon</a>

        <div class="card-header-elements ms-auto">

          <a
          href="javascript:;"
          class="btn btn-md btn-primary waves-effect waves-light"
          data-bs-target="#addClient"
          data-bs-toggle="modal"
          >Add Client</a
        >
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
      <div class="card-datatable table-responsive">
        <table class="table" id="dt-oauth-client">
          <thead>
            <tr>
              <th width="20%" class="text-center">Apps Name</th>
              <th width="10%" class="text-center">Icon</th>
              <th width="10%" class="text-center">Link</th>
              <th width="10%" class="text-center">Active</th>
              <th width="10%" class="text-center">Diubah</th>
              <th width="5%" class="text-center">Action</th>
            </tr>
          </thead>
          <tbody>
            @isset($dataSsoClientApp)
            @foreach ($dataSsoClientApp as $item)


            <tr>
              <td>{{ $item->name}}</td>
              <td class="text-center"> <span class="tf-icon {!! $item->icon !!} ti-xs me-1"></span> <br>{{ $item->icon }}</td>
              <td>{{ $item->link_redirect }}</td>
              <td class="text-center">
                @if ($item->is_active == '1')
                  <span class="badge bg-label-success">Yes</span>
                @else
                  <span class="badge bg-label-danger">No</span>
                @endif
              </td>

              <td>{{ $item->updated_at}}</td>
              <td>
                <div class="dropdown">
                  <button type="button" class="btn btn-primary btn-icon rounded-pill dropdown-toggle hide-arrow waves-effect waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical"></i>
                  </button>
                  <div class="dropdown-menu" style="">
                    {{-- <a class="dropdown-item btn-go-to-inactive" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-unlink me-1 text-danger"></i> Inactive</a> --}}
                    <a class="dropdown-item btn-edit" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-pencil me-1"></i> Edit</a>
                    <a class="dropdown-item btn-delete" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-trash me-1 text-danger"></i> Delete</a>
                  </div>
                </div>
              </td>
            </tr>
          @endforeach
            @endisset

          </tbody>
        </table>
      </div>
    </div>
</div>
@include('content.pages.sso-client-app.page-modal-sso-client-app-add')
@include('content.pages.sso-client-app.page-modal-sso-client-app-edit')
@endsection
