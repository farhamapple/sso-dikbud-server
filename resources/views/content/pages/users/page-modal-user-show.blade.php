<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="showDetailUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">View User</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="showUserForm" class="row g-3" method="POST" action="">
            <div class="col-12 col-md-6">
              <label class="form-label" for="first_name_view">First Name</label>
              <input
                type="text"
                id="first_name_view"
                name="first_name_view"
                class="form-control"
                placeholder="John" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="last_name_view">Last Name</label>
              <input
                type="text"
                id="last_name_view"
                name="last_name_view"
                class="form-control"
                placeholder="Doe" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="username_view">Username</label>
              <input
                type="text"
                id="username_view"
                name="username_view"
                class="form-control"
                placeholder="Jika Kosong akan disamakan dengan Email" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="modalEditUserPhone">Phone Number</label>
              <div class="input-group">
                <span class="input-group-text">ID (+62)</span>
                <input
                  type="text"
                  id="phone_view"
                  name="phone_view"
                  class="form-control phone-number-mask"
                  placeholder="85712341234" disabled/>
              </div>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="email">Email</label>
              <input
                type="text"
                id="email_view"
                name="email_view"
                class="form-control"
                placeholder="example@domain.com" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="email_external">Email Eksternal</label>
              <input
                type="text"
                id="email_external_view"
                name="email_external_view"
                class="form-control"
                placeholder="example@domain.com" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="sex_view">Sex</label>
              <div id='sex_view'></div>
            </select>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="birth_date">Birth Date</label>
              <input
                type="text"
                id="birth_date_view"
                name="birth_date_view"
                class="form-control"
                placeholder="1990-01-01" disabled/>
            </div>
            <div class="col-12">
              <label class="form-label" for="address">Address</label>
             <textarea rows="5" class="form-control" name="address_view" id="address_view" disabled></textarea>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="identity_type_view">Identity Type</label>
              <select
              id="identity_type_view"
              name="identity_type_view"
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
                id="identity_number_view"
                name="identity_number_view"
                class="form-control modal-edit-tax-id"
                placeholder="317412341234" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="identity_number">Jenis User</label>
              <div id='jenis_user_view'></div>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="identity_number">ASN / Non ASN</label>
              <div id='is_asn_view'></div>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="nip">NIP</label>
              <input
                type="text"
                id="nip_view"
                name="nip_view"
                class="form-control modal-edit-tax-id"
                placeholder="19902012012012001" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="instansi">Instansi</label>
              <input
                type="text"
                id="instansi_view"
                name="instansi_view"
                class="form-control modal-edit-tax-id"
                placeholder="Kementerian BUMN" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="jabatan">Jabatan</label>
              <input
                type="text"
                id="jabatan_view"
                name="jabatan_view"
                class="form-control modal-edit-tax-id"
                placeholder="Pranata Komputer Muda" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="simpeg_id">Simpeg ID</label>
              <input
                type="text"
                id="simpeg_id_view"
                name="simpeg_id_view"
                class="form-control modal-edit-tax-id"
                placeholder="100" disabled/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="simpeg_id">Status</label>
              <div id='is_active_view'></div>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="simpeg_id">Role</label>
              <div id='is_admin_view'></div>
            </div>
            <div class="col-12 text-center">
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
