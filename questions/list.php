<?php require_once "../component/header.php"; ?>
<!-- Sidebar Start -->
<?php require_once "../component/sidebar.php"; ?>
<!-- Sidebar End -->

<div class="main-content">
    <div class="row">
        <div class="col-12">
            <h3>Questions</h3>
            <a href="create.php?exam_id=<?= $_GET['exam_id'] ?>" class="btn btn-primary">Add Question</a>
        </div>
    </div>
    <div class="mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-body p-0">
                <div class="table-responsive table-rounded-top">
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Options</th>
                                <th>Correct Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM questions WHERE exam_id = {$_GET['exam_id']} AND deleted_at IS NULL";
                            $result = $crud->common_query($sql);
                            $i = 1;
                            foreach ($result['data'] as $q) {
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= htmlspecialchars($q->question) ?></td>
                                <td>
                                    <strong>A.</strong> <?= htmlspecialchars($q->option_a) ?><br>
                                    <strong>B.</strong> <?= htmlspecialchars($q->option_b) ?><br>
                                    <strong>C.</strong> <?= htmlspecialchars($q->option_c) ?><br>
                                    <strong>D.</strong> <?= htmlspecialchars($q->option_d) ?><br>
                                </td>
                                <td>
                                    <?php 
                                    
                                    $correct = $q->correct_answer;
                                    if ($correct == 1) echo 'A';
                                    elseif ($correct == 2) echo 'B';
                                    elseif ($correct == 3) echo 'C';
                                    elseif ($correct == 4) echo 'D';
                                    else echo 'N/A';
                                    ?>
                                </td>
                                <td>
                                    <a href="edit.php?id=<?= $q->id ?>" class="btn btn-sm btn-primary">Edit</a>
                                    <a href="delete.php?id=<?= $q->id ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "../component/footer.php"; ?>