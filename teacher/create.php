<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->
<!--Create  Modal -->
    <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content rounded-0">
            <div class="modal-body p-4 position-relative">
              <button type="button" class="btn position-absolute end-1" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
              <h2 class="h5 text-color-2 py-2">Create teacher</h2>
                <form class="row g-3">
                    <div class="col-12">
                        <label for="UserName" class="form-label text-color-2 text-normal">Name</label>
                        <input type="text" class="form-control" id="UserName" placeholder="Enter name">
                      </div>
                    <div class="col-6">
                      <label for="UserEmail" class="form-label text-color-2 text-normal">Email</label>
                      <input type="email" class="form-control" id="UserEmail" placeholder="Enter email">
                    </div>
                    <div class="col-6">
                      <label for="UserMobile" class="form-label text-color-2 text-normal">Mobile</label>
                      <input type="number" class="form-control" id="UserMobile" placeholder="Enter mobile">
                    </div>
                    <div class="col-6">
                      <label for="UserEducation" class="form-label text-color-2 text-normal">Education</label>
                      <select id="UserEducation" class="form-select text-normal">
                        <option value="">Choose Education</option>
                        <option value="B.tech">B.Tech</option>
                        <option value="M.Tech">M.Tech</option>
                      </select>
                    </div>
                    <div class="col-6">
                        <label for="UserEducation" class="form-label text-color-2 text-normal">Department</label>
                        <select id="UserEducation" class="form-select text-normal">
                          <option value="">Choose Education</option>
                          <option value="B.tech">B.Tech</option>
                          <option value="M.Tech">M.Tech</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="UserEducation" class="form-label text-color-2 text-normal">Gender</label>
                        <select id="UserEducation" class="form-select text-normal">
                          <option value="">Choose gender</option>
                          <option value="B.tech">B.Tech</option>
                          <option value="M.Tech">M.Tech</option>
                        </select>
                    </div>
                    <div class="col-6">
                      <label class="form-label text-color-2 text-normal">Profile Image</label>
                      <div class="file-input-container max-w-100">
                        <input type="file" id="fileInput" class="file-input">
                        <label for="fileInput" class="file-label">
                          <span class="file-name">Choose file</span>
                          <span class="file-button">Browse</span>
                        </label>
                      </div>
                    </div>
                    <div class="col-6">
                        <label for="Designation" class="form-label text-color-2 text-normal">Designation</label>
                        <input type="text" class="form-control" id="Designation" placeholder="Enter Designation">
                    </div>
                    <div class="col-6">
                        <label for="birthDate" class="form-label text-color-2 text-normal">Date of Birth</label>
                        <input type="date" class="form-control" id="birthDate" placeholder="Date of Birth">
                    </div>
                    <div class="col-6">
                        <label for="Password" class="form-label text-color-2 text-normal">Password</label>
                        <input type="password" class="form-control" id="Password" placeholder="Password">
                    </div>
                    <div class="col-6">
                        <label for="ConfirmPassword" class="form-label text-color-2 text-normal">Confirm Password</label>
                        <input type="password" class="form-control" id="ConfirmPassword" placeholder="Confirm Password">
                    </div>
                    <div class="col-12 mt-5">
                      <button type="submit" class="btn bg-white bg-primary text-white d-flex align-items-center px-4 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">Save Informations</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
    </div>
