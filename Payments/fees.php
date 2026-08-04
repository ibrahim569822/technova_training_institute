<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fees</title>
    <!-- Stylesheets -->
    <link rel="shortcut icon" href="./assets/images/favicon.ico" type="image/x-icon">
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/icons/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="./assets/icons/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="./assets/icons/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="./assets/plugin/quill/quill.snow.css" rel="stylesheet">
    <link href="./assets/css/style.css" rel="stylesheet">
</head>
<body>
    
    <!--Create  Modal -->
    <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content rounded-0">
            <div class="modal-body p-4 position-relative">
              <button type="button" class="btn position-absolute end-1" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
              <h2 class="h5 text-color-2 py-2">Create Fees</h2>
              <form class="row g-3">
                <div class="col-12">
                    <label for="UserName" class="form-label text-color-2 text-normal">Student name</label>
                    <input type="text" class="form-control" id="UserName" placeholder="Enter name">
                  </div>
                <div class="col-6">
                  <label for="UserRoll" class="form-label text-color-2 text-normal">Roll no.</label>
                  <input type="text" class="form-control" id="UserRoll" placeholder="Enter roll no.">
                </div>
                <div class="col-6">
                  <label for="UserClass" class="form-label text-color-2 text-normal">Class</label>
                  <input type="number" class="form-control" id="UserClass" placeholder="Enter class">
                </div>
                <div class="col-6">
                    <label for="fees" class="form-label text-color-2 text-normal">Amount</label>
                    <input type="text" class="form-control" id="fees" placeholder="Enter fees">
                </div>
                <div class="col-6">
                <label for="UserMode" class="form-label text-color-2 text-normal">Payment mode</label>
                <select id="UserMode" class="form-select text-normal">
                    <option value="">Choose mode</option>
                    <option value="Cash">Cash</option>
                    <option value="Online">Online</option>
                </select>
                </div>
                <div class="col-12 mt-5">
                  <button type="submit" class="btn bg-white bg-primary text-white d-flex align-items-center px-4 py-2 rounded-2 text-normal fw-bolder letter-spacing-26">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
    </div>

<!-- Scripts -->
<script  src="./assets/js/jquery-3.6.0.min.js"></script>
<script  src="./assets/js/bootstrap.bundle.min.js"></script>
<script  src="./assets/plugin/chart/chart.js"></script>
<script  src="./assets/plugin/quill/quill.js"></script>
<script  src="./assets/js/chart.js"></script>
<script  src="./assets/js/main.js"></script>
</body>
</html>