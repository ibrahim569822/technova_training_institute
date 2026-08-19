<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->
<?php

    $student_exam['student_id']=$_SESSION['user_id'];
    $student_exam['exam_id']=$_GET['exam_id'];
    $student_exam['start_at']=time();
    $student_exam['finish_at']=0;
    $student_exam['exam_date']=date('Y-m-d');
    $student_exam['total_marks']=0;
    $student_exam['pass_status']=0;
    $check_student_exam = $crud->common_query("SELECT * FROM student_exam WHERE student_id={$_SESSION['user_id']} AND exam_id={$_GET['exam_id']}");
    if(!$check_student_exam['data']) {
        $result = $crud->common_insert("student_exam", $student_exam);
    }else if($check_student_exam['data'][0]->finish_at!=0){
        echo "<script>alert('You have already completed this exam. Your score is: " . $check_student_exam['data'][0]->total_marks . "');window.location.href = '" . $base_url . "exams/list.php?exam_id=" . $_GET['exam_id'] . "';</script>";
    }
?>




<!-- this page is for studen exam questions list with checkbox for each question and a submit button to submit the answers -->
<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Questions</h3>
            
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive table-rounded-top">
                    <form action="submit_answers.php" method="POST">
                        <input type="hidden" name="exam_id" value="<?= $_GET['exam_id'] ?>">
                        <?php
                            $sql = "SELECT * FROM questions WHERE exam_id = {$_GET['exam_id']} AND deleted_at IS NULL";
                            $result = $crud->common_query($sql);
                            $i = 1;
                            foreach ($result['data'] as $q) {
                        ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="card-title mb-2">
                                    <h5 class="card-title mb-0">Question <?= $i++ ?>. <?= htmlspecialchars($q->question) ?></h5>
                                </div>
                                <div class="card-text">
                                    <label for="answer_<?= $q->id ?>_1"><input type="radio" id="answer_<?= $q->id ?>_1" name="answers[<?= $q->id ?>]" value="1">
                                    <strong>A.</strong> <?= htmlspecialchars($q->option_a) ?></label>
                                    <br>
                                    <label for="answer_<?= $q->id ?>_2"><input type="radio" id="answer_<?= $q->id ?>_2" name="answers[<?= $q->id ?>]" value="2">
                                    <strong>B.</strong> <?= htmlspecialchars($q->option_b) ?></label>
                                    <br>
                                    <label for="answer_<?= $q->id ?>_3"><input type="radio" id="answer_<?= $q->id ?>_3" name="answers[<?= $q->id ?>]" value="3">
                                    <strong>C.</strong> <?= htmlspecialchars($q->option_c) ?></label>
                                    <br>
                                    <label for="answer_<?= $q->id ?>_4"><input type="radio" id="answer_<?= $q->id ?>_4" name="answers[<?= $q->id ?>]" value="4">
                                    <strong>D.</strong> <?= htmlspecialchars($q->option_d) ?></label>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <button type="submit" class="btn btn-primary mb-3">Submit Answers</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>