<div class="modal modal-blur fade" id="add-categories-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('librarian.category.store') }}" id="addCategoryForm">
                    @csrf
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Add Name" maxlength="30">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Add Description" maxlength="200">
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

<div class="modal modal-blur fade" id="edit-categories-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('librarian.category.update') }}" id="editCategoryForm">
                    @csrf
                    <input type="hidden" name="edit_category_id" id="edit_category_id">
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Add Name" maxlength="30">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="edit_description" placeholder="Add Description" maxlength="200">
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editCategorySubmit">
                        Submit
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>