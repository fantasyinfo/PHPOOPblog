<?php
include("views/includes/header.inc.php");
if (!isset($_SESSION['email_id'])) {
    header("Location: " . SITE_ADMIN_URL . "views/sign-in.php");
} else {
    header("Location: " . SITE_ADMIN_URL . "views/pages/dashboard.php");
}