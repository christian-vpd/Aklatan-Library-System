<div class="modal modal-blur fade" id="edit-libraryHours-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Library Hours</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.library_hours.update')}}" id="editHourForm">
                    @csrf
                    <input type="hidden" name="hourId" id="hourId">
                    <div class="col-12">
                        <small class="text-info">Switch this if the day is Closed Day.</small>
                        <label class="form-check form-switch form-switch-3">
                            <input class="form-check-input" type="checkbox" id="close" name="close">
                            <span class="form-check-label fw-bold">Closed Day</span>
                        </label>
                    </div>
                    <div class="row mt-5">
                        <div class="col-6">
                              <label class="form-label">Opening Hours</label>
                              <input type="time" class="form-control" id="opening_hours" name="opening_hours" placeholder="Opening Hours">
                        </div>
                        <div class="col-6">
                              <label class="form-label">Closing Hours</label>
                              <input type="time" class="form-control" id="closing_hours" name="closing_hours" placeholder="Closing Hours">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editHourSubmit">
                        Submit
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>