@php
$configData = Helper::appClasses();
@endphp
@extends('layouts/layoutMaster')
@section('title', "Setting")
@section('vendor-style')
<!-- Vendor -->
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css') }}" />
<style>

.indicator-progress {
  display: none;
}
[data-kt-indicator=on] > .indicator-progress {
  display: inline-block;
}

[data-kt-indicator=on] > .indicator-label {
  display: none;
}

</style>
@endsection
@section('vendor-script')
<script src="{{asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
<script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>
<script src="{{asset('assets/js/roles/roles.js')}}"></script>
@endsection

@section('content')
    <!--begin:::Tabs-->
    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-4">
                
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_wr">General Setting</a>
        </li>
        <!--end:::Tab item-->
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_wa">Setting WA</a>
        </li>
        <!--end:::Tab item-->
        <!--begin:::Tab item-->
        <li class="nav-item">
            <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#kt_email">Setting Email</a>
        </li>
    <!--end:::Tab item-->
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="kt_wr" role="tabpanel">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Card-->
                <div class="">
                    <!--begin::Form-->
                        <form data-kt-search-element="form" action="{{route('setting.update')}}" class="w-100 position-relative mb-3" method="POST" id="frm-setting" autocomplete="off">
                        @csrf
                        <input type="hidden" class="form-control" name="ref" value="{{ $record->ref??"" }}">
                        <!--begin::Card body-->
                        <div class="card-body p-9">
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Nama Aplikasi</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <input type="text" class="form-control form-control-solid" name="sitetitle" value="{{$title}}">
                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                            </div>
                            <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                                <!--begin::Col-->
                                <div class="col-xl-3">
                                    <div class="fs-6 fw-bold mt-2 mb-3">Sumber Data Pegawai</div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                    <select name="sumberapi" class="form-control form-control-solid">
                                        <option value="1" {{ $sumberapi== "1" ? "selected" : "" }}>DikbudHr</option>
                                        <option value="2" {{ $sumberapi== "2" ? "selected" : "" }}>SIASN</option>
                                    </select>
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Card body-->
                        </form>
                        <!--begin::Card footer-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            
                            <button type="submit" id="btn-save-setting" class="btn btn-primary">
                                <span class="indicator-label">Simpan <i class="fas fa-save"></i></span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Card footer-->
                    
                    <!--end:Form-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Container-->
        </div>
        <div class="tab-pane fade show" id="kt_wa" role="tabpanel">
            @if ($statusWa && $statusWa->isConnected)
                <div class="alert alert-warning mb-3" role="alert">
                    <h5 class="alert-heading mb-1">Connected</h5>
                    <span>Nomor : {{$statusWa->phoneNumber}}</span>
                </div>
                
            @else
            <iframe src="{{App\Models\SettingsModel::getData('wa.url')}}/qr" width="100%" height="500px"></iframe>
            @endif
            <!--begin::Form-->
            <form data-kt-search-element="form" action="{{route('setting.update.wa')}}" class="w-100 position-relative mb-3" method="POST" id="frm-setting-wa" autocomplete="off">
                @csrf
                <input type="hidden" class="form-control" name="ref" value="{{ $record->ref??"" }}">
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">Url</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-9 fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" name="waurl" value="{{App\Models\SettingsModel::getData('wa.url')}}">
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">WA Token</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-9 fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" name="watoken" value="{{App\Models\SettingsModel::getData('wa.token')}}">
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">WA Username</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-9 fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" name="wausername" value="{{App\Models\SettingsModel::getData('wa.username')}}">
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">WA Password</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-9 fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" name="wapassword" value="{{App\Models\SettingsModel::getData('wa.password')}}">
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">Sender Number</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-9 fv-row fv-plugins-icon-container">
                            <input type="text" class="form-control form-control-solid" name="wanumber" value="{{App\Models\SettingsModel::getData('wa.number')}}">
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    </div>
                    <!--end::Row-->
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-3">
                            <div class="fs-6 fw-bold mt-2 mb-3">Message Template</div>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-9 fv-row fv-plugins-icon-container">
                            <textarea class="form-control form-control-solid" name="watemplate" rows="10">{{App\Models\SettingsModel::getData('wa.templatemessage')}}</textarea>
                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                    </div>
                    <!--end::Row-->
            
                </div>
                <!--end::Card body-->
                </form>
                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" id="btn-save-setting-wa" class="btn btn-primary">
                        <span class="indicator-label">Simpan Setting WA <i class="fas fa-save"></i></span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <button type="button" id="btn-test-kirim" class="btn btn-info">
                        <span class="indicator-label">Test Kirim <i class="fas fa-send"></i></span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Card footer-->
            
            <!--end:Form-->
        </div>
        <div class="tab-pane fade show" id="kt_email" role="tabpanel">
            <div class="card-body pt-0 pb-5">
                <div class="card-body p-9">
                    <!--begin::Form-->
                    <form data-kt-search-element="form" action="{{route('setting.update.email')}}" class="w-100 position-relative mb-3" method="POST" id="frm-setting-email" autocomplete="off">
                    @csrf
                    <input type="hidden" class="form-control" name="ref" value="{{ $record->ref??"" }}">
                    <!--begin::Card body-->
                    
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Sender</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="sender_email" value="{{App\Models\SettingsModel::getData('sender_email')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">SMTP Host</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="smtp_host" value="{{App\Models\SettingsModel::getData('smtp_host')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">SMTP User</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="smtp_user" value="{{App\Models\SettingsModel::getData('smtp_user')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Protocol</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="protocol" value="{{{App\Models\SettingsModel::getData('protocol')}}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Mailtype</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="mailtype" value="{{App\Models\SettingsModel::getData('mailtype')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">MailPath</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="mailtype" value="{{App\Models\SettingsModel::getData('mailpath')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Smtp Timeout</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="smtp_timeout" value="{{App\Models\SettingsModel::getData('smtp_timeout')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                            <!--begin::Row-->
                            <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Smtp Port</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="smtp_port" value="{{App\Models\SettingsModel::getData('smtp_port')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--begin::Row-->
                        <div class="row mb-8">
                            <!--begin::Col-->
                            <div class="col-xl-3">
                                <div class="fs-6 fw-bold mt-2 mb-3">Smtp Timeout</div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-xl-9 fv-row fv-plugins-icon-container">
                                <input type="text" class="form-control form-control-solid" name="smtp_timeout" value="{{App\Models\SettingsModel::getData('smtp_timeout')}}">
                            <div class="fv-plugins-message-container invalid-feedback"></div></div>
                        </div>
                        <!--end::Row-->
                        <!--end::Card body-->
                    </form>
                </div>
                <!--begin::Card footer-->
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="submit" id="btn-save-setting-email" class="btn btn-primary">
                        <span class="indicator-label">Simpan <i class="fas fa-save"></i></span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Card footer-->
            </div>
        </div>
    </div>
@endsection
@section('page-script')
<!-- jQuery -->
<script>
var btn_save_setting = document.querySelector("#btn-save-setting");
$('#btn-save-setting').click(function(){
    this.setAttribute("data-kt-indicator", "on");
    var postForm = $("#frm-setting").serialize();
    postForm
        $.ajax({
            type:'POST',
            url:"{{route('setting.update')}}",
            data : postForm,  
            success:function(result){
                if(result.success){
                    Swal.fire({
                        text: result.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    btn_save_setting.removeAttribute("data-kt-indicator");
                }else{
                    Swal.fire({
                        text: result.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            }
        });
});
$('#btn-save-setting-email').click(function(){
    var postForm = $("#frm-setting-email").serialize();
    postForm
        $.ajax({
            type:'POST',
            url:"{{route('setting.update.email')}}",
            data : postForm,  
            success:function(result){
                if(result.success){
                    Swal.fire({
                        text: result.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }else{
                    Swal.fire({
                        text: result.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            }
        });
});
$('#btn-save-setting-wa').click(function(){
    var postForm = $("#frm-setting-wa").serialize();
    postForm
        $.ajax({
            type:'POST',
            url:"{{route('setting.update.wa')}}",
            data : postForm,  
            success:function(result){
                if(result.success){
                    Swal.fire({
                        text: result.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }else{
                    Swal.fire({
                        text: result.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            }
        });
});
$('#btn-test-kirim').click(function(){
    var postForm = $("#frm-setting-wa").serialize();
    postForm
        $.ajax({
            type:'POST',
            url:"{{route('setting.testwa')}}",
            data : postForm,  
            success:function(result){
                if(result.success){
                    Swal.fire({
                        text: result.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }else{
                    Swal.fire({
                        text: result.message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, Terimakasih!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            }
        });
});
</script>
@endsection