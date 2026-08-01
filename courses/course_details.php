<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<?php
  $id = $_GET['id'];
  $course = $crud->common_select("courses", "*", ['id' => $id]);
  if (!$course['status'] || empty($course['data'])) {
    echo "<script>window.location.href = '".$base_url."courses/courselist.php';</script>";
    exit;
  }

  $course = $course['data'][0];

?>
            <!-- Main Content -->
            <div class="main-content">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center  flex-column flex-md-row flex-lg-row mt-3">
                            <div class="flex-grow-1">
                                <h3 class="mb-2 text-color-2">Courses Details</h3>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <div class="mt-4">
                  <div class="row g-4">
                    <!-- Main Content -->
                    <div class="col-lg-12">
                      <div class="card shadow-sm border-0">
                        <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <h1 class="text-size-26 mb-0 font-weight-600 "><?= $course->course_name ?></h1>
                                <div class="d-flex gap-3">
                                    <button class="btn btn-light"><i class="fas fa-share"></i></button>
                                    <button class="btn btn-light"><i class="fas fa-bookmark"></i></button>
                                </div>
                            </div>
                            <div class="text-muted"><?=$course->id ?></div>
                            <div class="badge bg-primary mt-2"><?= $course->category ?></div>
                        </div>
                        <div class="mb-4">
                            <img
                                src="<?= !empty($course->image) ? '../assets/uploads/courses/images/' . $course->image : '../assets/images/avatar-1.jpg' ?>"
                                alt="<?= htmlspecialchars($course->course_name) ?>"
                                class="img-fluid w-100 rounded shadow"
                                style="height:150px;  object-fit:cover;"
                            >
                        </div>
                        </div>
                        </div>
                        
                        <!-- About description -->
                        <div class="mb-5">
                            <h3 class="text-size-18">About this course</h3>
                            <p class="text-muted text-size-15"><?= $course->description ?></p>
                        </div>
        
                        
                        <!-- Course Features -->
                         <!-- <div>
                          <h3 class="text-size-18 mb-3">This Course Includes</h3>
                          <div class="row g-3 course-features mb-5 text-size-15">
                            <div class="col-md-6">
                                <div><i class="fas fa-clock"></i> 1.3 Hours on-demand video</div>
                            </div>
                            <div class="col-md-6">
                                <div><i class="fas fa-question-circle"></i> 35 Quizes</div>
                            </div>
                            <div class="col-md-6">
                                <div><i class="fas fa-pencil-alt"></i> 7 Design Exercise</div>
                            </div>
                            <div class="col-md-6">
                                <div><i class="fas fa-book"></i> Lectures: 19</div>
                            </div>
                            <div class="col-md-6">
                                <div><i class="fas fa-video"></i> vide48 Articlesо</div>
                            </div>
                            <div class="col-md-6">
                                <div><i class="fas fa-closed-captioning"></i> Captions: Yes</div>
                            </div>
                            <div class="col-md-6">
                                <div><i class="fas fa-download"></i> 120 Download Resources</div>
                            </div>
                            <div class="col-md-6">
                                <div><i class="fas fa-globe"></i> Language English</div>
                            </div>
                         </div> -->

                         </div>
                      
        
                        <!-- Instructor -->
                        <!-- <div class="mb-5">
                            <h3 class="text-size-18">Instructor</h3>
                            <div class="d-flex align-items-center gap-3 mt-3">
                                <img src="./assets/images/avatar-1.jpg" alt="Brooklyn Simmons" class="instructor-avatar">
                                <div>
                                    <h5 class="mb-0 text-size-15">Brooklyn Simmons</h5>
                                    <div class="text-muted mb-0 text-size-14">Web Design Instructor</div>
                                    <div class="rating-stars text-size-14">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <span class="text-muted ms-2">4.9 (12k)</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                  </div>
                    </div>
                </div>
            </div>
         <!-- Footer -->
       <?php require_once "../component/footer.php"; ?>  