<!-- Modal -->
  <!-- Edit User Modal -->
  <div class="modal fade" id="addRoles" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
      <div class="modal-content p-3 p-md-5">
        <div class="modal-body">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="text-center mb-4">
            <h3 class="mb-2">Form Roles</h3>
            {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
          </div>
          <form id="frmRoles" class="row g-3" method="POST" action="{{route('roles.setting.save')}}">
            @csrf
            <input type="hidden" id="ref" name="ref" class="form-control"/>
            <div class="col-12 col-md-12">
              <label class="form-label" for="nama">Role Name</label>
              <input type="text" id="name" name="name" class="form-control"/>
            </div>
            <div class="col-12">
              <label class="form-label" for="address">Description</label>
              <textarea rows="5" class="form-control" id="description" name="description"></textarea>
            </div>
            
            <div class="col-12 text-center">
              <button type="submit" id="btnsave" class="btn btn-primary me-sm-3 me-1">Submit</button>
              <button type="reset" class="btn btn-label-secondary" id="btn-tutup" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<!--/ Edit User Modal -->  
