<div class="modal modal-blur fade" id="add-policy-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Policy</h5>
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
                <form method="POST" action="{{ route('admin.policies.store') }}" id="addPolicyForm">
                    @csrf
                    <input type="hidden" name="policy_category_id" id="policy_category_id">
                    <div class="col-12">
                        <label class="form-label required">Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Add Title" maxlength="50">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Body</label>
                        <input type="text" class="form-control" id="body" name="body" placeholder="Add Body" maxlength="200">
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="addPolicySubmit">
                        Submit
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-policy-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Policy</h5>
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
                <form method="POST" action="{{ route('admin.policies.update') }}" id="editPolicyForm">
                    @csrf
                    <input type="hidden" name="policy_id" id="policy_id">
                    <div class="col-12">
                        <label class="form-label required">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title" placeholder="Add Title" maxlength="50">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Body</label>
                        <input type="text" class="form-control" id="edit_body" name="edit_body" placeholder="Add Body" maxlength="200">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-check form-switch form-switch-3">
                            <input class="form-check-input" type="checkbox" id="edit_is_active" name="edit_is_active">
                            <span class="form-check-label fw-bold">Active</span>
                        </label>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="editPolicySubmit">
                        Update
                    </button>
                </div>
                
                </form>
        </div>
    </div>
</div>