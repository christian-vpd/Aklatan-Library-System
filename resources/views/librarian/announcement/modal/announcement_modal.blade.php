<div class="modal modal-blur fade" id="add-announcement-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Add Announcement</h5>
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
                <form method="POST" action="{{ route('librarian.announcement.store') }}" id="addAnnouncementForm">
                @csrf
                <div class="mb-3">
                    <div class="col-12">
                        <label class="form-label required">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Add Title" maxlength="100">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Type</label>
                        <select class="form-select" name="type">
                            <option value="" disabled selected>Select Type</option>
                            <option value="announcement">Announcement</option>
                            <option value="reminder">Reminder</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Body</label>
                        <textarea class="form-control" name="body" rows="3" placeholder="Type Something..." maxlength="2000"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="addAnnouncementSubmit">
                    Submit
                </button>
            </div>
                
            </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-announcement-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Edit Announcement</h5>
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
                <form method="POST" action="{{ route('librarian.announcement.update') }}" id="editAnnouncementForm">
                @csrf
                <input type="hidden" id="edit_announcement_id" name="edit_announcement_id">
                <div class="mb-3">
                    <div class="col-12">
                        <label class="form-label required">Title</label>
                        <input type="text" class="form-control" id="edit_title" name="edit_title" placeholder="Add Title" maxlength="100">
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label class="form-label required">Type</label>
                            <select class="form-select" id="edit_type" name="edit_type">
                                <option value="" disabled selected>Select Type</option>
                                <option value="announcement">Announcement</option>
                                <option value="reminder">Reminder</option>
                                <option value="urgent">Urgent</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label required">Status <span class="text-info">(Change at your own)</span></label>
                            <select class="form-select" id="edit_active" name="edit_active">
                                <option value="" disabled selected>Select Status</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Body</label>
                        <textarea class="form-control" id="edit_body" name="edit_body" rows="3" placeholder="Type Something..." maxlength="2000"></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="editAnnouncementSubmit">
                    Submit
                </button>
            </div>
                
            </form>
        </div>
    </div>
</div>