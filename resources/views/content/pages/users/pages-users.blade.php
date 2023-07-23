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
@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
@endsection

@section('page-script')

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

    $('.btn-go-to-inactive').on('click', function(e){
      e.preventDefault();
        let ref = $(this).data("ref")
        $.ajax({
           type:'POST',
           url:"{{ route('pages-user-go-to-inactive') }}",
           data:{ref:ref},
           success:function(data){
              console.log(data);
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
                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false">
                      <i class="ti ti-dots-vertical"></i>
                    </button>
                    <div class="dropdown-menu" style="">
                      <a class="dropdown-item btn-go-to-inactive" href="#" data-ref="{{ $item->ref }}"><i class="ti ti-user-off me-1 text-danger"></i> Inactive</a>
                      <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-eye me-1 text-info"></i> View</a>
                      <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                      <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1 text-danger"></i> Delete</a>
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
@endsection
