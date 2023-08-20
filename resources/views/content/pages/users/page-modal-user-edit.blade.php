<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Edit User</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="editUserForm" class="row g-3" method="POST" action="{{ route('pages-user-update')}}">
            @csrf
            <div class="col-12 col-md-6">
              <label class="form-label" for="first_name_edit">First Name</label>
              <input
                type="text"
                id="first_name_edit"
                name="first_name"
                class="form-control"
                placeholder="John" required/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="last_name_edit">Last Name</label>
              <input
                type="text"
                id="last_name_edit"
                name="last_name"
                class="form-control"
                placeholder="Doe" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="username_edit">Username</label>
              <input
                type="text"
                id="username_edit"
                name="username"
                class="form-control"
                placeholder="Jika Kosong akan disamakan dengan Email" readonly/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserPhone">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">ID (+62)</span>
                <input
                  type="text"
                  id="phone_edit"
                  name="phone"
                  class="form-control phone-number-mask"
                  placeholder="85712341234" />
              </div>
            </div>
            {{-- <div class="col-12 col-md-6">
              <label class="form-label" for="password">Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="Kosongkan Jika tidak update" autocomplete="off"
                />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="password_confirm">Repeat Password</label>
              <input
                type="password"
                id="password_confirm"
                name="password_confirm"
                class="form-control"
                placeholder="Kosongkan Jika tidak update" autocomplete="off"
                 />
            </div> --}}
            <div class="col-12 col-md-6">
              <label class="form-label" for="email">Email</label>
              <input
                type="text"
                id="email_edit"
                name="email"
                class="form-control"
                placeholder="example@domain.com" required/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="email_external_edit">Email Eksternal</label>
              <input
                type="text"
                id="email_external_edit"
                name="email_external"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="sex_edit">Sex</label>
              <select
              id="sex_edit"
              name="sex"
              class="form-select"
              aria-label="Default select example">
              <option value="1" selected>Man</option>
              <option value="2">Women</option>
            </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="birth_date_edit">Birth Date</label>
              <input
                type="text"
                id="birth_date_edit"
                name="birth_date"
                class="form-control flat-picker"
                placeholder="1990-01-01" />
            </div>
            <div class="col-12">
              <label class="form-label" for="address">Address</label>
             <textarea rows="5" class="form-control" name="address" id="address_edit"></textarea>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="identity_type_edit">Identity Type</label>
              <select
              id="identity_type_edit"
              name="identity_type"
              class="form-select"
              aria-label="Default select example">
              <option value="KTP">KTP</option>
              <option value="SIM">SIM</option>
              <option value="Passport">Passport</option>
            </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="identity_number_edit">Identity Number</label>
              <input
                type="text"
                id="identity_number_edit"
                name="identity_number"
                class="form-control modal-edit-tax-id"
                placeholder="317412341234" />
            </div>
            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" id="is_external_account_edit" name="is_external_account"/>
                <span class="switch-toggle-slider">
                  <span class="switch-on"></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">Eksternal User?</span>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name="is_asn" id="is_asn_edit"/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" checked></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">ASN ?</span>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="nip">NIP</label>
              <input
                type="text"
                id="nip_edit"
                name="nip"
                class="form-control modal-edit-tax-id"
                placeholder="19902012012012001" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="instansi_edit">Instansi</label>
              <input
                type="text"
                id="instansi_edit"
                name="instansi"
                class="form-control modal-edit-tax-id"
                placeholder="Kementerian BUMN" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="jabatan_edit">Jabatan</label>
              <input
                type="text"
                id="jabatan_edit"
                name="jabatan"
                class="form-control modal-edit-tax-id"
                placeholder="Pranata Komputer Muda" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="simpeg_id_edit">Simpeg ID</label>
              <input
                type="text"
                id="simpeg_id_edit"
                name="simpeg_id"
                class="form-control modal-edit-tax-id"
                placeholder="100" />
            </div>
            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name='is_active' id='is_active_edit'/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" checked></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">Aktif?</span>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name="role_id" id="role_id_edit"/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" checked></span>
                  <span class="switch-off"></span>
                </span>
                <span class="switch-label">Admin ?</span>
              </label>
            </div>
            <input type="hidden" id='ref_edit' name='ref' />
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary me-sm-3 me-1">Save</button>
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
