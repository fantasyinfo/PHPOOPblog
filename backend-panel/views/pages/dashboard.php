<?php
include("../includes/header.inc.php");
if (!isset($_SESSION['email_id'])) {
    header("Location: " . SITE_ADMIN_URL . "views/sign-in.php");
}
#echo " Welcome to the Dashboard";
include("../includes/nav.inc.php");


?>



<main class="content">
    <?php include("../includes/top-nav.inc.php"); ?>
    <div class="py-4">
        <div class="row">
            Dashboard Page
        </div>
    </div>

</main>
<?php include("../includes/footer.inc.php"); ?>