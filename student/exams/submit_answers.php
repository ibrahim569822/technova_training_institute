<?php
    require_once "../component/connection.php";

    $questions=$crud->common_query("SELECT * FROM `questions` WHERE exam_id = {$_POST['exam_id']}");
    $total_correct=0;
    foreach($questions['data'] as $q){
        $answer = isset($_POST['answers'][$q->id]) ? $_POST['answers'][$q->id] : null;
        $is_correct = ($answer == $q->correct_answer) ? 1 : 0;
        $total_correct += $is_correct;
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
    $student_exam['total_marks']=$total_correct;
    $check_student_exam = $crud->common_query("SELECT * FROM student_exam WHERE student_id={$_SESSION['user_id']} AND exam_id={$_POST['exam_id']}");
    if($check_student_exam['data']){
        $crud->common_update("student_exam", $student_exam, ["student_id" => $_SESSION['user_id'], "exam_id" => $_POST['exam_id']]);
    }

echo "<script>alert('Your exam has been submitted successfully. You scored {$total_correct} marks.');window.location.href = '" . $base_url . "exams/list.php';</script>";