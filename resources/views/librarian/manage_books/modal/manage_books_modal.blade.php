<div class="modal modal-blur fade" id="add-book-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Add Book</h5>
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
                <form method="POST" action="{{ route('librarian.manageBooks.store')}}" id="addBookForm">
                @csrf
                <div class="mb-3">
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">ISBN</label>
                            <input type="text" class="form-control" name="isbn" placeholder="ISBN" maxlength="15">
                        </div>
                        <div class="col-6">
                            <label class="form-label required">Category</label>
                            <select class="form-select" id="category" name="category">
                            <option value="" selected disabled>Select Category</option>
                            @if ($category)
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Title" maxlength="100">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" name="description" placeholder="Description" maxlength="200">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Author/s</label>
                        <select id="authors" name="authors[]" class="form-select" multiple placeholder="Select Author/s" autocomplete="off">
                            @if ($authors)
                                @foreach ($authors as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6 col-md-8">
                            <label class="form-label required">Publisher</label>
                            <input type="text" class="form-control" name="publisher" placeholder="Publisher" maxlength="50">
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label required">Year Published</label>
                            <input type="text" class="form-control" id="year_published" name="year_published" placeholder="Year Published" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="addBookSubmit">
                    Submit
                </button>
            </div>
                
            </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-book-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Edit Book</h5>
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
                <form method="POST" action="{{ route('librarian.manageBooks.update')}}" id="editBookForm">
                @csrf
                <input type="hidden" name="edit_book_id" id="edit_book_id">
                <div class="mb-3">
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">ISBN</label>
                            <input type="text" class="form-control" id="edit_isbn" name="edit_isbn" placeholder="ISBN" maxlength="15">
                        </div>
                        <div class="col-6">
                            <label class="form-label required">Category</label>
                            <select class="form-select" id="edit_category" name="edit_category">
                            <option value="" selected disabled>Select Category</option>
                            @if ($category)
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Title</label>
                        <input type="text" class="form-control" name="edit_title" id="edit_title" placeholder="Title" maxlength="100">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Description</label>
                        <input type="text" class="form-control" name="edit_description" id="edit_description" placeholder="Description" maxlength="200">
                    </div>
                    <div class="col-12 mt-3">
                        <label class="form-label required">Author/s</label>
                        <select id="edit_authors" name="edit_authors[]" class="form-select" multiple placeholder="Select Author/s" autocomplete="off">
                            @if ($authors)
                                @foreach ($authors as $item)
                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6 col-md-8">
                            <label class="form-label required">Publisher</label>
                            <input type="text" class="form-control" id="edit_publisher" name="edit_publisher" placeholder="Publisher" maxlength="50">
                        </div>
                        <div class="col-6 col-md-4">
                            <label class="form-label required">Year Published</label>
                            <input type="text" class="form-control" id="edit_year_published" name="edit_year_published" placeholder="Year Published" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="editBookSubmit">
                    Submit
                </button>
            </div>
                
            </form>
        </div>
    </div>
</div>  