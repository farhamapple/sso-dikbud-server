@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Profile Page')

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
                href="javascript:;"
                class="btn btn-primary me-3"
                data-bs-target="#editUser"
                data-bs-toggle="modal"
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
          <a class="nav-link active" href="javascript:void(0);"
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

  <!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Edit Profile</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="editUserForm" class="row g-3" onsubmit="return false">
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserFirstName">First Name</label>
              <input
                type="text"
                id="modalEditUserFirstName"
                name="modalEditUserFirstName"
                class="form-control"
                placeholder="John" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserLastName">Last Name</label>
              <input
                type="text"
                id="modalEditUserLastName"
                name="modalEditUserLastName"
                class="form-control"
                placeholder="Doe" />
            </div>
            <div class="col-12">
              <label class="form-label" for="modalEditUserName">Username</label>
              <input
                type="text"
                id="modalEditUserName"
                name="modalEditUserName"
                class="form-control"
                placeholder="john.doe.007" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserEmail">Email</label>
              <input
                type="text"
                id="modalEditUserEmail"
                name="modalEditUserEmail"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserEmail">Email Eksternal</label>
              <input
                type="text"
                id="modalEditUserEmail"
                name="modalEditUserEmail"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserEmail">Sex</label>
              <input
                type="text"
                id="modalEditUserEmail"
                name="modalEditUserEmail"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserEmail">Birth Date</label>
              <input
                type="text"
                id="modalEditUserEmail"
                name="modalEditUserEmail"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserStatus">Status</label>
              <select
                id="modalEditUserStatus"
                name="modalEditUserStatus"
                class="form-select"
                aria-label="Default select example">
                <option selected>Status</option>
                <option value="1">Active</option>
                <option value="2">Inactive</option>
                <option value="3">Suspended</option>
              </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditTaxID">Tax ID</label>
              <input
                type="text"
                id="modalEditTaxID"
                name="modalEditTaxID"
                class="form-control modal-edit-tax-id"
                placeholder="123 456 7890" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserPhone">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">US (+1)</span>
                <input
                  type="text"
                  id="modalEditUserPhone"
                  name="modalEditUserPhone"
                  class="form-control phone-number-mask"
                  placeholder="202 555 0111" />
              </div>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserLanguage">Language</label>
              <select
                id="modalEditUserLanguage"
                name="modalEditUserLanguage"
                class="select2 form-select"
                multiple>
                <option value="">Select</option>
                <option value="english" selected>English</option>
                <option value="spanish">Spanish</option>
                <option value="french">French</option>
                <option value="german">German</option>
                <option value="dutch">Dutch</option>
                <option value="hebrew">Hebrew</option>
                <option value="sanskrit">Sanskrit</option>
                <option value="hindi">Hindi</option>
              </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserCountry">Country</label>
              <select
                id="modalEditUserCountry"
                name="modalEditUserCountry"
                class="select2 form-select"
                data-allow-clear="true">
                <option value="">Select</option>
                <option value="Australia">Australia</option>
                <option value="Bangladesh">Bangladesh</option>
                <option value="Belarus">Belarus</option>
                <option value="Brazil">Brazil</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="India">India</option>
                <option value="Indonesia">Indonesia</option>
                <option value="Israel">Israel</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Korea">Korea, Republic of</option>
                <option value="Mexico">Mexico</option>
                <option value="Philippines">Philippines</option>
                <option value="Russia">Russian Federation</option>
                <option value="South Africa">South Africa</option>
                <option value="Thailand">Thailand</option>
                <option value="Turkey">Turkey</option>
                <option value="Ukraine">Ukraine</option>
                <option value="United Arab Emirates">United Arab Emirates</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
              </select>
            </div>
            <div class="col-12">
              <label class="switch">
                <input type="checkbox" class="switch-input" />
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">Use as a billing address?</span>
              </label>
            </div>
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
              <button
                type="reset"
                class="btn btn-label-secondary"
                data-bs-dismiss="modal"
                aria-label="Close">
                Cancel
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Edit User Modal -->

  <!-- Add New Credit Card Modal -->
  <div class="modal fade" id="upgradePlanModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-plan">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Upgrade Plan</h3>
            <p>Choose the best plan for user.</p>
          </div>
          <form id="upgradePlanForm" class="row g-3" onsubmit="return false">
            <div class="col-sm-8">
              <label class="form-label" for="choosePlan">Choose Plan</label>
              <select id="choosePlan" name="choosePlan" class="form-select" aria-label="Choose Plan">
                <option selected>Choose Plan</option>
                <option value="standard">Standard - $99/month</option>
                <option value="exclusive">Exclusive - $249/month</option>
                <option value="Enterprise">Enterprise - $499/month</option>
              </select>
            </div>
            <div class="col-sm-4 d-flex align-items-end">
              <button type="submit" class="btn btn-primary">Upgrade</button>
            </div>
          </form>
        </div>
        <hr class="mx-md-n5 mx-n3" />
        <div class="modal-body">
          <p class="mb-0">User current plan is standard plan</p>
          <div class="d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex justify-content-center me-2">
              <sup class="h6 pricing-currency pt-1 mt-3 mb-0 me-1 text-primary">$</sup>
              <h1 class="display-5 mb-0 text-primary">99</h1>
              <sub class="h5 pricing-duration mt-auto mb-2 text-muted">/month</sub>
            </div>
            <button class="btn btn-label-danger cancel-subscription mt-3">Cancel Subscription</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Add New Credit Card Modal -->

  <!-- /Modal -->
</div>
@endsection
