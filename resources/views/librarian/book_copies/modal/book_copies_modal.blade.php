<div class="modal modal-blur fade" id="add-bookCopies-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Add Book Copy</h5>
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
                <form method="POST" action="{{ route('librarian.bookCopies.store')}}" id="addBookCopyForm">
                @csrf
                <input type="hidden" id="add_book_id" name="add_book_id" value="{{$book->id}}">
                <div class="mb-3">
                    <div class="col-12 mt-3">
                        <label class="form-label required">Barcode</label>
                        <input type="text" class="form-control" id="barcode" name="barcode" placeholder="Barcode" maxlength="40">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Condition</label>
                        <select name="condition" class="form-select" placeholder="Select Condition" autocomplete="off">
                            <option value="" disabled selected>Select Condition</option>
                            <option value="good">Good</option>
                            <option value="fair">Fair</option>
                            <option value="new">New</option>
                            <option value="poor">Poor</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="addBookCopySubmit">
                    Submit
                </button>
            </div>
                
            </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-bookCopies-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Edit Book Copy</h5>
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
                <form method="POST" action="{{ route('librarian.bookCopies.update')}}" id="editBookCopyForm">
                @csrf
                <input type="hidden" id="edit_book_copy_id" name="edit_book_copy_id">
                <div class="mb-3">
                    <div class="col-12 mt-3">
                        <label class="form-label required">Barcode</label>
                        <input type="text" class="form-control" id="edit_barcode" name="edit_barcode" placeholder="Barcode" maxlength="40">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Condition</label>
                        <select id="edit_condition" name="edit_condition" class="form-select" placeholder="Select Condition" autocomplete="off">
                            <option value="" disabled selected>Select Condition</option>
                            <option value="good">Good</option>
                            <option value="fair">Fair</option>
                            <option value="new">New</option>
                            <option value="poor">Poor</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="editBookCopySubmit">
                    Submit
                </button>
            </div>
                
            </form>
        </div>
    </div>
</div>