<?php
    require_once "../component/connection.php";

    $questions=$crud->common_query("SELECT * FROM `questions` WHERE exam_id = {$_POST['exam_id']}");
    $exam=$crud->common_query("SELECT * FROM `exams` WHERE id = {$_POST['exam_id']}");
    $total_correct=0;
    foreach($questions['data'] as $q){
        $answer = isset($_POST['answers'][$q->id]) ? $_POST['answers'][$q->id] : null;
        $is_correct = ($answer == $q->correct_answer) ? 1 : 0;
        $total_correct += $is_correct;
        $total_marks = $questions['data'][0]->mark * $total_correct;
        $pass_status = ($total_marks >= $exam['data'][0]->pass_marks) ? 1 : 0;
        $insert_data = [
            'exam_id' => $_POST['exam_id'],
            'question_id' => $q->id,
            'student_id' => $_SESSION['user_id'],
            'selected_option' => $answer,
            'is_correct' => $is_correct,

            'created_at' => time()
        ];

        $crud->common_insert("student_answers", $insert_data);
    }

    $student_exam['finish_at']=time();
    $student_exam['total_marks']=$total_marks;
    $student_exam['pass_status']=$pass_status;
    $check_student_exam = $crud->common_query("SELECT * FROM student_exam WHERE student_id={$_SESSION['user_id']} AND exam_id={$_POST['exam_id']}");
    if($check_student_exam['data']){
        $crud->common_update("student_exam", $student_exam, ["student_id" => $_SESSION['user_id'], "exam_id" => $_POST['exam_id']]);
    }

echo "<script>alert('Your exam has been submitted successfully. You scored {$total_marks} marks.');window.location.href = '" . $base_url . "exams/result.php?exam_id=" . $_POST['exam_id'] . "'</script>";