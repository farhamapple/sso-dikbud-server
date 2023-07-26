<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="showClient" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">View Oauth Client</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="showFormClient" class="row g-3" method="POST" action="">
            @csrf
            <div class="col-12 col-md-12">
              <label class="form-label" for="name">Client Name</label>
              <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                placeholder="Dikbud HR" readonly/>
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="client_id">Client ID</label>
              <input
                type="text"
                id="client_id"
                name="client_id"
                class="form-control"
                placeholder="Kosongkan jika akan Generate Otomatis" readonly/>
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="secret">Secret ID</label>
              <input
                type="text"
                id="secret"
                name="secret"
                class="form-control"
                placeholder="Kosongkan jika akan Generate Otomatis" readonly/>
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="redirect">Redirect</label>
              <input
                type="text"
                id="redirect"
                name="redirect"
                class="form-control"
                placeholder="http://localhost/auth/callback" readonly/>
            </div>
            <div class="col-12 col-md-12">
              <label class="form-label" for="provider">Provider</label>
              <input
                type="text"
                id="provider"
                name="provider"
                class="form-control"
                placeholder="Boleh Kosong" readonly/>
            </div>

            <div class="col-12 col-md-6">
              <label class="form-label" for="provider">Personal Access Client</label>

            </div>

            <div class="col-12 col-md-6">
              <label class="form-label" for="provider">Password Client</label>

            </div>

            <div class="col-12 col-md-6">
              <label class="form-label" for="provider">Revoked</label>

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
