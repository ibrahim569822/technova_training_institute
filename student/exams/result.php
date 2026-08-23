<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->
<?php

$exam_id = (int) ($_GET['exam_id'] ?? 0);
$student_id = $_SESSION['user_id'] ?? null;
$student_exam = $crud->common_query("SELECT total_marks, pass_status FROM student_exam WHERE student_id={$student_id} AND exam_id={$exam_id}");
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
                            $sql = "SELECT questions.*, student_answers.selected_option FROM questions JOIN student_answers ON questions.id = student_answers.question_id WHERE deleted_at IS NULL";
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
                                    <label for="answer_<?= $q->id ?>_1" <?php if ($q->correct_answer == 1) echo "class='bg-success text-white'"; ?>>
                                        <input type="radio" id="answer_<?= $q->id ?>_1" name="answers[<?= $q->id ?>]" value="1"
                                            <?= ($q->selected_option == 1) ? 'checked' : '' ?> >
                                        <strong>A.</strong> <?= htmlspecialchars($q->option_a) ?>
                                    </label>
                                    <br>
                                    <label for="answer_<?= $q->id ?>_2" <?php if ($q->correct_answer == 2) echo "class='bg-success text-white'"; ?>>
                                        <input type="radio" id="answer_<?= $q->id ?>_2" name="answers[<?= $q->id ?>]" value="2"
                                            <?= ($q->selected_option == 2) ? 'checked' : '' ?> >
                                        <strong>B.</strong> <?= htmlspecialchars($q->option_b) ?>
                                    </label>
                                    <br>
                                    <label for="answer_<?= $q->id ?>_3" <?php if ($q->correct_answer == 3) echo "class='bg-success text-white'"; ?>>
                                        <input type="radio" id="answer_<?= $q->id ?>_3" name="answers[<?= $q->id ?>]" value="3"
                                            <?= ($q->selected_option == 3) ? 'checked' : '' ?>>
                                        <strong>C.</strong> <?= htmlspecialchars($q->option_c) ?>
                                    </label>
                                    <br>
                                    <label for="answer_<?= $q->id ?>_4" <?php if ($q->correct_answer == 4) echo "class='bg-success text-white'"; ?>>
                                        <input type="radio" id="answer_<?= $q->id ?>_4" name="answers[<?= $q->id ?>]" value="4"
                                            <?= ($q->selected_option == 4) ? 'checked' : '' ?> >
                                        <strong>D.</strong> <?= htmlspecialchars($q->option_d) ?>
                                    </label>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php echo "Your Score: " . $student_exam->total_marks; echo "Student Pass Status: " . $student_exam->pass_status; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>