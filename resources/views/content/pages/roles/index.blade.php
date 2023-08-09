@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', "Mesjid")
@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css') }}" />
@endsection
@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/js/roles/roles.js')}}"></script>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
  <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Roles</h4>
    <!-- DataTable with Buttons -->
    <div class="card">
      <div class="card-header header-elements">
        <h5 class="card-header">Daftar Role</h5>
        <div class="card-header-elements ms-auto">
          <button type="button" class="btn btn-primary waves-effect waves-light" data-ref="" data-bs-target="#addRoles" data-bs-toggle="modal">
            <span class="tf-icon ti ti-plus me-1"></span>Add Role
          </button>
        </div>
      </div>
      <div class="card-datatable table-responsive card-body">
        <table class="table table-data" id="dttable">
          <thead class="table-light">
            <tr>
              <th>Nama</th>
              <th>Keterangan</th>
              <th>#</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@include('content.pages.roles.add')
@endsection
@section('page-script')
<script type="text/javascript">
   $table = $("#dttable").DataTable({
      processing: true,
      serverSide: true,
      "pageLength": 10,
      "columnDefs": [
                      { "targets": [1]},
                      { "targets": [0], "orderable": true }
                  ],
      ajax: {
          "url": "{{ route('master.roles.index') }}",
          "data": function(d) {
              // d.form_search_values = $("#form-search").serializeArray();
          }
      },
      "aoColumns": [
            {
                "mData": "name",
                "searchable": true,
                'class': ''
            },
            {
                "mData": "description",
                "searchable": true,
                'class': ''
            },
            
            {
                "mData": null,
                "orderable": false,
                "searchable": false,
                'sWidth': '150px',
                'class': 'text-center',
                "mRender": function(data, type, full) {
                    var actions = [];
                    actions.push("<div class='btn-group'>");
                    if (full.edit_url) {
                        actions.push("<a data-toggle='tooltip' title='Edit' data-ref='"+full.ref+"' href='" + full.edit_url + "' data-bs-target='#addRoles' data-bs-toggle='modal' class='btn btn-sm btn-warning'><i class='fa fa-edit'></i></a>");
                    }
                    if (full.delete_url) {
                        actions.push("<a data-toggle='tooltip' title='Delete' link='" + full.delete_url + "' class='btn btn-sm btn-danger btn-delete'><i class='fa fa-trash'></i></a>");
                    }
                    actions.push("</div>");
                    return actions.join('');
                }
            }
        ]
  });
 
$('#addRoles').on('shown.bs.modal', function(event) {
  document.getElementById("frmRoles").reset();
  let reference_tag = $(event.relatedTarget); 
  let ref = reference_tag.data('ref');
  if(ref != ""){
    var json_url = "/getroles/"+ref;
      $.getJSON(json_url,function(data){
        if(data.data != null){
          $("#ref").val(data.data.ref);
          $("#name").val(data.data.name);
          $("#description").val(data.data.description);
        }
      });
  }
})
$('body').on('click','.btn-delete',function () { 
  Swal.fire({
    title: 'Anda Yakin?',
    text: "Hapus data ini!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
    if (result.isConfirmed) {
        var postForm = { 
            '_token'    : "{{ csrf_token() }}",
            'link'      : $(this).attr("link"),
        };
		$.ajax({    
		 	type: "POST",
			url: $(this).attr("link"),
			data: postForm,
			success: function(data){ 
                if(data.success){
                    Swal.fire({
                        text: "Berhasil,"+data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {
                        $table.ajax.reload(null,true);
                    });
                    
                }
                else {
                    Swal.fire({
                        text: "Maaf, Ada kesalahan "+data.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Saya Perbaiki!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
			},
            error: function (jqXHR, textStatus, errorMessage) {
                Swal.fire({
                    text: "Maaf, Ada kesalahan "+errorMessage,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, Saya perbaiki!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            },
        });
    }
    })
}); 
</script>
@endsection