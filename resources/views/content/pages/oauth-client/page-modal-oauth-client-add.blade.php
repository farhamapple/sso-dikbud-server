<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="addClient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Add Oauth Client</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="editUserForm" class="row g-3" method="POST" action="{{ route('oauth-client.store')}}">
            @csrf
            <div class="col-12 col-md-12">
              <label class="form-label" for="name">Client Name</label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                placeholder="Dikbud HR" />
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="secret">Secret ID</label>
              <input
                type="text"
                id="secret"
                name="secret"
                class="form-control"
                placeholder="Kosongkan jika akan Generate Otomatis" />
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="redirect">Redirect</label>
              <input
                type="text"
                id="redirect"
                name="redirect"
                class="form-control"
                placeholder="http://localhost/auth/callback" />
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="provider">Provider</label>
              <input
                type="text"
                id="provider"
                name="provider"
                class="form-control"
                placeholder="Boleh Kosong" />
            </div>

            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name='personal_access_client'/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" value='1'></span>
                  <span class="switch-off" value='0'></span>
                </span>
                <span class="switch-label">Personal Access Client?</span>
              </label>
            </div>

            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name='password_client'/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" value='1'></span>
                  <span class="switch-off" value='0'></span>
                </span>
                <span class="switch-label">Password Client?</span>
              </label>
            </div>

            <div class="col-12 col-md-6">
              <label class="switch">
                <input type="checkbox" class="switch-input" name='revoked'/>
                <span class="switch-toggle-slider">
                  <span class="switch-on" value='1'></span>
                  <span class="switch-off" value='0'></span>
                </span>
                <span class="switch-label">Revoked?</span>
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
