{{-- Add Librarian Modal --}}
<div class="modal modal-blur fade" id="add-librarian-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
                <h5 class="modal-title">Add Librarian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetAddLibrarian()"></button>
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
                <div class="alert alert-info" role="alert">
                    <div class="alert-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon icon-2">
                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
                        <path d="M12 9h.01"></path>
                        <path d="M11 12h1v4h1"></path>
                    </svg>
                    </div>
                    <span>
                        To access librarian account, Username and Password is the <span class="fw-bold">Librarian Code.</span> Please change your password once you get access to the account.
                    </span>
                </div>
                <form method="POST" action="{{ route('admin.manage_librarians.store') }}" id="addLibrarianForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Librarian Code</label>
                    <div class="row d-flex align-items-center">
                        <div class="col-8">
                            <input type="text" class="form-control" name="libraryCode" placeholder="Auto-Generated Librarian Code" id="libraryCode" maxlength="20" disabled>
                        </div>
                        <div class="col-4">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" onclick="toggleAddCustomCode()" name="customCodeCheck" id="customCodeCheck">
                                <span class="form-check-label">Custom Code</span>
                            </label>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">Last Name</label>
                            <input type="text" class="form-control no-numbers" name="lastName" placeholder="Last Name" maxlength="20">
                        </div>
                        <div class="col-6">
                            <label class="form-label required">First Name</label>
                            <input type="text" class="form-control no-numbers" name="firstName" placeholder="First Name" maxlength="20">
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control no-numbers" name="middleName" placeholder="Middle Name" maxlength="20">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Suffix</label>
                            <select class="form-select" name="suffix">
                            <option value="">No suffix</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">Contact Number</label>
                            <input type="text" name="contactNumber" class="form-control" data-mask="09123456789" data-mask-visible="true" placeholder="09123456789" autocomplete="off" maxlength="11" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div class="col-6">
                            <label class="form-label required">Email Address</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Email Address" maxlength="30">
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">Gender</label>
                            <select class="form-select" name="gender">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Upload Profile Picture <small class="text-info fw-normal">(PNG and JPG only)</small></label>
                            <input type="file" class="form-control" accept="image/jpeg, image/png" name="profilePicture">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="addLibrarianSubmit">
                    Submit
                </button>
            </div>
                
            </form>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="edit-librarian-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Librarian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="resetEditLibrarian()"></button>
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

                <form method="POST" action="{{ route('admin.manage_librarians.update') }}" id="editLibrarianForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <input type="hidden" id="edit_user_id" name="edit_user_id">
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">Last Name</label>
                            <input type="text" class="form-control no-numbers"" name="edit_lastName" id="edit_lastName" placeholder="Last Name" maxlength="20">
                        </div>
                        <div class="col-6">
                            <label class="form-label required">First Name</label>
                            <input type="text" class="form-control no-numbers"" name="edit_firstName" id="edit_firstName" placeholder="First Name" maxlength="20">
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label">Middle Name</label>
                            <input type="text" class="form-control no-numbers"" name="edit_middleName" id="edit_middleName" placeholder="Middle Name" maxlength="20">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Suffix</label>
                            <select class="form-select" name="edit_suffix" id="edit_suffix">
                            <option value="">No suffix</option>
                            <option value="Jr.">Jr.</option>
                            <option value="Sr.">Sr.</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            </select>
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">Contact Number</label>
                            <input type="text" name="edit_contactNumber" id="edit_contactNumber" class="form-control" data-mask="09123456789" data-mask-visible="true" placeholder="09123456789" autocomplete="off" maxlength="11" inputmode="numeric" pattern="[0-9]*">
                        </div>
                        <div class="col-6">
                            <label class="form-label required">Email Address</label>
                            <input type="email" id="edit_email" class="form-control" name="edit_email" placeholder="Email Address" maxlength="30">
                        </div>
                    </div>
                    <div class="row d-flex align-items-center mt-3">
                        <div class="col-6">
                            <label class="form-label required">Gender</label>
                            <select class="form-select" name="edit_gender" id="edit_gender">
                            <option value="" selected disabled>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Upload Profile Picture <small class="text-info fw-normal">(PNG and JPG only)</small></label>
                            <input type="file" class="form-control" accept="image/jpeg, image/png" name="edit_profilePicture">
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="editLibrarianSubmit">
                    Submit
                </button>
            </div>
                
            </form>

        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="view-inactive-librarian-modal" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inactive Librarians</h5>
            </div>
            <div class="modal-body">
                <table class="table datatable table-selectable table-vcenter text-nowrap table-responsive" id="inactiveLibrarianTable">
                    <thead>
                        <tr>
                            <th>Librarian Code</th>
                            <th>Profile</th>
                            <th>Gender</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="inactiveLibrarianTbody">
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-primary" class="btn-close" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
                

        </div>
    </div>
</div>