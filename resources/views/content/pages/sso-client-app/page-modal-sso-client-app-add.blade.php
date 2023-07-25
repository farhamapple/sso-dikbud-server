<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="addClient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Add SSO Client App</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="editUserForm" class="row g-3" method="POST" action="{{ route('sso-client-app.store')}}">
            @csrf
            <div class="col-12 col-md-12">
              <label class="form-label" for="name">App Name</label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                placeholder="Dikbud HR" />
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="link_redirect">Link</label>
              <input
                type="text"
                id="link_redirect"
                name="link_redirect"
                class="form-control"
                placeholder="Doe" />
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="icon">Icon</label>
              <input
                type="text"
                id="icon"
                name="icon"
                class="form-control"
                placeholder="Doe" />
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
