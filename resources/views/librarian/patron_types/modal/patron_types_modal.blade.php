<div class="modal modal-blur fade" id="add-patronTypes-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Patron Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('librarian.patronType.store') }}" id="addPatronTypeForm">
                    @csrf
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Add Name" maxlength="20">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Add Description" maxlength="60">
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label required">Max Books</label>
                            <small class="text-info">How many books that can a Patron borrow?</small>
                            <input type="text" name="maxBooks" class="form-control" placeholder="Add Max Books" autocomplete="off" maxlength="2" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label required">Borrow Days</label>
                            <small class="text-info">How many days that Patron can borrow?</small>
                            <input type="text" name="borrowDays" class="form-control" placeholder="Add Borrow Days" autocomplete="off" maxlength="2" inputmode="numeric" pattern="[0-9]*">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addPatronTypeSubmit">
                        Submit
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-patronTypes-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Patron Type</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('librarian.patronType.update') }}" id="editPatronTypeForm">
                    @csrf
                    <input type="hidden" name="patron_type_id" id="patron_type_id">
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Add Name" maxlength="20">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="edit_description" placeholder="Add Description" maxlength="60">
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label required">Max Books</label>
                            <small class="text-info">How many books that can a Patron borrow?</small>
                            <input type="text" name="edit_maxBooks" id="edit_maxBooks" class="form-control" placeholder="Add Max Books" autocomplete="off" maxlength="2" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label required">Borrow Days</label>
                            <small class="text-info">How many days that Patron can borrow?</small>
                            <input type="text" id="edit_borrowDays" name="edit_borrowDays" class="form-control" placeholder="Add Borrow Days" autocomplete="off" maxlength="2" inputmode="numeric" pattern="[0-9]*">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editPatronTypeSubmit">
                        Submit
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>