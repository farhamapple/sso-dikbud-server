<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="resetPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Reset Password</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="resetPasswordForm" class="row g-3" method="POST" action="{{ route('pages-user-update-password')}}">
            @csrf
            <input
                type="hidden"
                id="ref_update_password"
                name="ref"
                class="form-control"
                placeholder=""/>
            <div class="col-12 col-md-6">
              <label class="form-label" for="first_name">New Password</label>
              <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                placeholder="" required/>
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="last_name">Repeat Password</label>
              <input
                type="password"
                id="repeat_password"
                name="repeat_password"
                class="form-control"
                placeholder="" required/>
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
