<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Exams List
            
            </h3>
        </div>
    </div>
    <div class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Exam Name</th>
                    <th>Date</th>
                    <th>Batch</th>
                    <th>Total Marks</th>
                    <th>Pass Marks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $student_id = $_SESSION['user_id'] ?? null;
                $sql = "SELECT exams.*, batches.batch_name FROM exams LEFT JOIN batches ON exams.batch_id = batches.id WHERE exams.deleted_at IS NULL";
                $result = $crud->common_query($sql);
                // $student_exams = $crud->common_query("SELECT * FROM student_exam WHERE student_id = $student_id");
                // print_r($student_exams); // Debugging line to check the student exams data
                if ($result['status']) {
                    foreach ($result['data'] as $exam) {
                $student_exams = $crud->common_query("SELECT finish_at FROM student_exam WHERE student_id = $student_id AND exam_id = {$exam->id}");
                ?>
                <tr>
                    <td><?= $exam->exam_name ?></td>
                    <td><?= $exam->exam_date ?></td>
                    <td><?= $exam->batch_name ?></td>
                    <td><?= $exam->total_marks ?></td>
                    <td><?= $exam->pass_marks ?></td>
                    <td>
                        <a href="<?= $base_url; ?>exams/questions.php?exam_id=<?= $exam->id ?>" class="btn btn-sm btn-info">
                            <?php if ($student_exams['data'][0]->finish_at == 0) { ?>
                                View Questions
                            <?php } else { ?>
                                Result
                            <?php } ?>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='6'>No exams found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once "../component/footer.php"; ?>