<?php
include("../../includes/header.inc.php");
include("../../../classes/class.Functions.inc.php");
if (!isset($_SESSION['email_id'])) {
    header("Location: " . SITE_ADMIN_URL . "views/sign-in.php");
}
$fun = new Functions();
$catList = $fun->sqlData("SELECT c.cat_name as CatName, c.id as CatId, c.status as CStatus, c.created_at, sc.status as SCstatus, sc.id subCatId, sc.sub_cat_name as SubCatName FROM category c LEFT JOIN sub_category sc ON c.id = sc.cat_id");
if (isset($_GET['action']) && isset($_GET['cat_id'])) {
    $fun->unsetSession('msg');
    $fun->unsetSession('msg-class');
    if ($_GET['action'] == 'edit') {
    } else if ($_GET['action'] == 'delete') {
        if ($fun->deleteData('category', $_GET['cat_id'])) {
            $fun->setSession('msg', 'Category Deleted Successfully');
            $fun->setSession('msg-class', 'success');
            header("Location: " . SITE_ADMIN_URL . "views/pages/category/view-category.php");
        } else {
            $fun->setSession('msg', 'ERROR: ! Category Not Deleted');
            $fun->setSession('msg-class', 'danger');
        }
    }
}



include("../../includes/nav.inc.php");


?>
<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="pt-4">Categories</h1>
            </div>
            <?php if (isset($_SESSION['msg'])) { ?>
            <div class="col-md-12">
                <div class="alert alert-<?= $_SESSION['msg-class']; ?>" role="alert">
                    <?= $_SESSION['msg']; ?>
                </div>
            </div>
            <?php } ?>

            <div class="col-md-12">
                <div class="table-responsive py-4">
                    <table class="table table-flush shadow" id="table-cat">
                        <thead class="thead-dark">
                            <tr>
                                <th>Id</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if (!empty($catList)) {

                                foreach ($catList as $key => $value) { ?>
                            <tr>
                                <td><?= $value['CatId']; ?></td>
                                <td><?= $value['CatName']; ?></td>
                                <td><?= $value['SubCatName']; ?></td>
                                <td><?= $value['CStatus']; ?></td>
                                <td><?= $value['created_at']; ?></td>
                                <td>
                                    <a href="<?= SITE_ADMIN_URL ?>views/pages/category/edit-category.php?cat_id=<?= $value['CatId'] ?>&action=edit"
                                        class="btn btn-warning btn-small">Edit</a>
                                    <a href="<?= $_SERVER['PHP_SELF'] ?>?cat_id=<?= $value['CatId'] ?>&action=delete"
                                        class="btn btn-danger btn-small">Delete</a>
                                </td>
                            </tr>
                            <?php }
                            }


                            ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</main>
<?php

$footerData = "<script> 
jQuery(document).ready(function() 
{
    jQuery('#table-cat').DataTable();
} );
</script>";



include("../../includes/footer.inc.php");


?>