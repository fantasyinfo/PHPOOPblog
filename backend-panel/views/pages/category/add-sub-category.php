<?php
include("../../includes/header.inc.php");
include("../../../classes/class.Functions.inc.php");
if (!isset($_SESSION['email_id'])) {
    header("Location: " . SITE_ADMIN_URL . "views/sign-in.php");
}
#echo " Welcome to the Dashboard";
$fun = new Functions();
$allCat = $fun->showAllData('category');
if (isset($_POST['submit']) && !empty($_POST['cat_id']) && !empty($_POST['sub_cat_name'])) {
    $sendArg = array();
    $sendArg['cat_id'] = $_POST['cat_id'];
    $sendArg['sub_cat_name'] = $_POST['sub_cat_name'];
    $sendArg['status'] = 1;
    $addCat = $fun->insert('sub_category', $sendArg);
    ($addCat) ? header("Location: " . SITE_ADMIN_URL . "views/pages/category/view-category.php") : "";
}





include("../../includes/nav.inc.php");


?>
<main class="content">

    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">

            <div class="row justify-content-center form-bg-image"
                data-background-lg="../../assets/img/illustrations/signin.svg">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <h1 class="mb-0 h3">Add New Sub Category</h1>
                        </div>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" class="mt-4" method="POST">
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label>Select Category</label>
                                <select class="form-select" name="cat_id" aria-label="Default select example" required>

                                    <?php

                                    if (isset($allCat) && !empty($allCat)) {
                                        foreach ($allCat as $key => $value) { ?>
                                    <option value="<?= $value['id']; ?>"><?= $value['cat_name']; ?></option>
                                    <?php }
                                    }


                                    ?>


                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="email">Sub Category Name</label>
                                <div class="input-group">
                                    <input type="text" name="sub_cat_name" class="form-control" placeholder="Burger"
                                        id="email" autofocus required>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-gray-800" name="submit">Add Sub Category</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>
<?php include("../../includes/footer.inc.php"); ?>