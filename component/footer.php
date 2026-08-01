<!-- Footer -->
             <div class="footer text-center bg-white shadow-sm py-3 mt-5">
                <p class="m-0">Copyright © 2024. All Rights Reserved. <a href="https://www.templaterise.com/" class="text-primary" target="_blank" >Themes By TemplateRise</a></p>
            </div>
    </div>
     <!-- Scripts -->
    <script  src="<?= $base_url ?>assets/js/jquery-3.6.0.min.js"></script>
    <script  src="<?= $base_url ?>assets/js/bootstrap.bundle.min.js"></script>
    <script  src="<?= $base_url ?>assets/plugin/chart/chart.js"></script>
    <script  src="<?= $base_url ?>assets/js/chart.js"></script>
    <script  src="<?= $base_url ?>assets/js/main.js"></script>
    <script  src="<?= $base_url ?>assets/plugin/jquery.toaster-master/jquery.toaster.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            <?php if (isset($_SESSION['message'])): ?>
                $.toaster({
                    priority: '<?php echo $_SESSION['message'][0]; ?>',
                    title: '<?php echo $_SESSION['message'][1]; ?>',
                    message: '<?php echo $_SESSION['message'][2]; ?>'
                });
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        });

        function logout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "<?= $base_url ?>logout.php";
            }
        }
        function courseDetails(id) {
            window.location.href = "<?= $base_url ?>courses/course_details.php?id=" + id;
        }
        function deleteCourse(id) {
            if (confirm("Are you sure you want to delete this course?")) {
                window.location.href = "<?= $base_url ?>courses/delete.php?id=" + id;
            }
        }
    </script>
</body>
</html>