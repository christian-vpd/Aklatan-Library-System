<div class="modal modal-blur fade" id="add-author-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('librarian.author.store') }}" id="addAuthorForm">
                    @csrf
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Add Name" maxlength="30">
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addAuthorSubmit">
                        Submit
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-author-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Author</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('librarian.author.update') }}" id="editAuthorForm">
                    @csrf
                    <input type="hidden" id="edit_author_id" name="edit_author_id">
                    <div class="col-12">
                        <label class="form-label required">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="edit_name" placeholder="Add Name" maxlength="30">
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editAuthorSubmit">
                        Update
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>