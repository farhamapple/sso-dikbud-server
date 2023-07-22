<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="addUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Add User</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="editUserForm" class="row g-3" onsubmit="return false">
            <div class="col-12 col-md-6">
              <label class="form-label" for="first_name">First Name</label>
              <input
                type="text"
                id="first_name"
                name="first_name"
                class="form-control"
                placeholder="John" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="last_name">Last Name</label>
              <input
                type="text"
                id="last_name"
                name="last_name"
                class="form-control"
                placeholder="Doe" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="username">Username</label>
              <input
                type="text"
                id="username"
                name="username"
                class="form-control"
                placeholder="john.doe.007" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserPhone">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">ID (+62)</span>
                <input
                  type="text"
                  id="phone"
                  name="phone"
                  class="form-control phone-number-mask"
                  placeholder="85712341234" />
              </div>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="email">Email</label>
              <input
                type="text"
                id="email"
                name="email"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="email_external">Email Eksternal</label>
              <input
                type="text"
                id="email_external"
                name="email_external"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="sex">Sex</label>
              <select
              id="sex"
              name="sex"
              class="form-select"
              aria-label="Default select example">
              <option value="1" selected>Man</option>
              <option value="2">Women</option>
            </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="birth_date">Birth Date</label>
              <input
                type="text"
                id="birth_date"
                name="birth_date"
                class="form-control"
                placeholder="example@domain.com" />
            </div>
            <div class="col-12">
              <label class="form-label" for="address">Address</label>
             <textarea rows="5" class="form-control" name="address"></textarea>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="identity_type">Identity Type</label>
              <select
              id="identity_type"
              name="identity_type"
              class="form-select"
              aria-label="Default select example">
              <option value="1" selected>KTP</option>
              <option value="2">SIM</option>
              <option value="2">Passport</option>
            </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="identity_number">Identity Number</label>
              <input
                type="text"
                id="identity_number"
                name="identity_number"
                class="form-control modal-edit-tax-id"
                placeholder="123 456 7890" />
            </div>

            <div class="col-12">
              <label class="switch">
                <input type="checkbox" class="switch-input" name="is_asn"/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" value='1'></span>
                  <span class="switch-off" value='0'></span>
                </span>
                <span class="switch-label">ASN ?</span>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="nip">NIP</label>
              <input
                type="text"
                id="nip"
                name="nip"
                class="form-control modal-edit-tax-id"
                placeholder="123 456 7890" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="instansi">Instansi</label>
              <input
                type="text"
                id="instansi"
                name="instansi"
                class="form-control modal-edit-tax-id"
                placeholder="123 456 7890" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="jabatan">Jabatan</label>
              <input
                type="text"
                id="jabatan"
                name="jabatan"
                class="form-control modal-edit-tax-id"
                placeholder="123 456 7890" />
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="simpeg_id">Simpeg ID</label>
              <input
                type="text"
                id="simpeg_id"
                name="simpeg_id"
                class="form-control modal-edit-tax-id"
                placeholder="123 456 7890" />
            </div>
            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name="is_external_account"/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" value='1'></span>
                  <span class="switch-off" value='0'></span>
                </span>
                <span class="switch-label">Eksternal User?</span>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name='is_active'/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" value='1'></span>
                  <span class="switch-off" value='0'></span>
                </span>
                <span class="switch-label">Aktif?</span>
              </label>
            </div>
            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name="role_id"/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" value='1'></span>
                  <span class="switch-off" value='0'></span>
                </span>
                <span class="switch-label">Admin ?</span>
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
