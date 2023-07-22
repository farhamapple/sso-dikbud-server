@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Oauth Client')

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
  $(function(){
      let dt = $('#dt-oauth-client').DataTable();
  });
</script>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Oauth Client</h4>
    <!-- DataTable with Buttons -->
    <div class="card">
      <div class="card-header header-elements">
        <span class="me-2"><h5>Oauth Client</h5></span>

        <div class="card-header-elements ms-auto">
          <button type="button" class="btn btn-xs btn-primary waves-effect waves-light">
            <span class="tf-icon ti ti-plus ti-xs me-1"></span>Add Client
          </button>
        </div>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table" id="dt-oauth-client">
          <thead>
            <tr>
              <th width="20%">Client Name</th>
              <th width="10%">Secret</th>
              <th width="10%">Redirect</th>
              <th width="10%">Personal Acces <br> Client</th>
              <th width="10%">Password <br> Client</th>
              <th width="10%">Revoke</th>
              <th width="10%">Diubah</th>
              <th width="5%">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($oauthClientData as $item)


              <tr>
                <td>{{ $item->name}}</td>
                <td><button type="button" class="btn btn-xs btn-primary waves-effect waves-light">copy</button></td>
                <td>{{ $item->redirect }}</td>
                <td>
                  @if ($item->personal_access_client)
                    <span class="badge bg-label-success">Yes</span>
                  @else
                    <span class="badge bg-label-danger">No</span>
                  @endif
                </td>
                <td>
                  @if ($item->password_client)
                  <span class="badge bg-label-success">Yes</span>
                  @else
                    <span class="badge bg-label-danger">No</span>
                  @endif
                <td>
                  @if ($item->revoke)
                  <span class="badge bg-label-success">Yes</span>
                  @else
                    <span class="badge bg-label-danger">No</span>
                  @endif
                </td>
                <td>{{ $item->updated_at}}</td>
                <td>{{ $item->updated_at}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
@endsection
