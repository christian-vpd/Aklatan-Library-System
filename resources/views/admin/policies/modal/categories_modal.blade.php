<div class="modal modal-blur fade" id="add-category-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Policy Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <div class="alert-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                    </svg>
                    </div>
                    Please fill up the required fields.
                </div>
                <form method="POST" action="{{ route('admin.policies.category.store') }}" id="addCategoryForm">
                    @csrf
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Add Name" maxlength="20">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Add Description" maxlength="80">
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addCategorySubmit">
                        Submit
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-category-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Policy Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info" role="alert">
                    <div class="alert-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                    </svg>
                    </div>
                    Please fill up the required fields.
                </div>
                <form method="POST" action="{{ route('admin.policies.category.update') }}" id="editCategoryForm">
                    @csrf
                    <input type="hidden" name="edit_category_id" id="edit_category_id">
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Add Name" maxlength="20">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="edit_description" placeholder="Add Description" maxlength="80">
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editCategorySubmit">
                        Update
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>