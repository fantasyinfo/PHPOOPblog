<?php
include("../../includes/header.inc.php");
include("../../../classes/class.Functions.inc.php");
if (!isset($_SESSION['email_id'])) {
    header("Location: " . SITE_ADMIN_URL . "views/sign-in.php");
}
#echo " Welcome to the Dashboard";
$fun = new Functions();
$allCat = $fun->showAllData('category');
$subCat = $fun->showAllData('sub_category');
$postData = $fun->sqlData(
    "SELECT post.*, meta_data.*, category.*, sub_category.*, job_posting_schema.* FROM post 
LEFT JOIN meta_data ON post.meta_data_id = meta_data.post_id 
LEFT JOIN category ON post.cat_id = category.id 
LEFT JOIN sub_category ON post.sub_cat_id = sub_category.id 
LEFT JOIN job_posting_schema ON post.job_schema_id = job_posting_schema.post_id"
);


//include("../../includes/nav.inc.php");

$post_Id = "";
$metaData_Id = "";
$schemaData_Id = "";
$tagData_Id = "";

if (isset($_POST['submit'])) {
    $unique_id_for_all = uniqid() . time();
    if (isset($_POST['s_title']) && isset($_POST['s_body'])) {
        $s_title = $_POST['s_title'];
        $s_body = $_POST['s_body'];
        $s_currency = $_POST['s_currency'];
        $s_salary = $_POST['s_salary'];
        $s_payroll_time = $_POST['s_payroll_time'];
        $s_posted_date = $_POST['s_posted_date'];
        $s_expiry_date = $_POST['s_expiry_date'];
        $s_unpublish_when_expiry = $_POST['s_unpublish_when_expiry'];
        $s_emp_type_full_time = $_POST['s_emp_type_full_time'];
        $s_hiring_org_name = $_POST['s_hiring_org_name'];
        $s_hiring_org_url = $_POST['s_hiring_org_url'];
        $s_hiring_org_logo = $_POST['s_hiring_org_logo'];
        $s_job_posting_unique_id = $_POST['s_job_posting_unique_id'];
        $s_street_address = $_POST['s_street_address'];
        $s_city_name = $_POST['s_city_name'];
        $s_region = $_POST['s_region'];
        $s_zip_code = $_POST['s_zip_code'];
        $s_country = $_POST['s_country'];


        $s_param = array(

            'post_id' => $unique_id_for_all,
            's_title' => $s_title,
            's_body' => $s_body,
            'sal_currency' => $s_currency,
            'salary' => $s_salary,
            'payroll_time' => $s_payroll_time,
            'posted_date' => $s_posted_date,
            'expiry_date' => $s_expiry_date,
            'unpublish_when_exp' => 1,
            'emp_type' => $s_emp_type_full_time,
            'hiring_rog_name' => $s_hiring_org_name,
            'org_url' => $s_hiring_org_url,
            'org_logo' => $s_hiring_org_logo,
            'unique_id' => $s_job_posting_unique_id,
            'street_address' => $s_street_address,
            'locality' => $s_city_name,
            'region' => $s_region,
            'postal_code' => $s_zip_code,
            'country' => $s_country,
            'status' => 1
        );
        $fun->insert('job_posting_schema', $s_param);
    }


    if (isset($_POST['cat_id']) && isset($_POST['sub_cat_id'])) {
        $cat_id = $_POST['cat_id'];
        $sub_cat_id = $_POST['sub_cat_id'];
    }

    if (isset($_POST['m_title']) && isset($_POST['m_body'])) {
        $m_title = $_POST['m_title'];
        $m_body = $_POST['m_body'];
        $m_keywords = $_POST['m_keywords'];

        $m_param = array(
            'meta_title' => $m_title,
            'meta_desc' => $m_body,
            'meta_keyword' => $m_keywords,
            'post_id' => $unique_id_for_all,
            'status' => 1,
        );

        $fun->insert('meta_data', $m_param);
    }

    if (isset($_POST['p_title']) && isset($_POST['p_body'])) {
        $p_title = $_POST['p_title'];
        $p_body = $_POST['p_body'];

        $p_param = array(
            'cat_id' => $cat_id,
            'sub_cat_id' => $sub_cat_id,
            'user_id' => 1, // replace with user $_SESSION['id']
            'meta_data_id' => $unique_id_for_all,
            'job_schema_id' => $unique_id_for_all,
            'tag_id' => $unique_id_for_all,
            'title' => $p_title,
            'body' => $p_body,
            'status' => 1
        );

        $fun->insert('post', $p_param);
    }
}



?>
<main class="content">

    <section class="mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" class="mt-4" method="POST">
                <div class="row">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-12 d-flex align-items-center justify-content-center">
                                <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100">
                                    <div class="text-center text-md-center mb-4 mt-md-0">
                                        <h1 class="mb-0 h3">Add New Post</h1>
                                    </div>

                                    <!-- Form -->
                                    <div class="form-group mb-4">
                                        <label for="title">Title</label>
                                        <div class="input-group">
                                            <input type="text" name="p_title" class="form-control" placeholder="Jobs in Delhi" id="title" autofocus required>
                                        </div>
                                    </div>


                                    <div class="form-group mb-4">
                                        <label for="title">Body</label>
                                        <textarea class="form-control" name="p_body" id="pbody" rows="10"></textarea>
                                    </div>

                                    <hr>
                                    <div class="text-center text-md-center mb-4 mt-md-0">
                                        <h3 class="mb-0 h3">Add Meta Data</h3>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="title">Meta Title</label>
                                        <div class="input-group">
                                            <input type="text" name="m_title" class="form-control" placeholder="Jobs in Delhi" id="title" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">

                                        <label for="mbody">Meta Body</label>
                                        <textarea class="form-control" name="m_body" id="mbody" rows="3"></textarea>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="mbody">Meta Keywords</label>
                                        <input type="text" name="m_keywords" class="form-control" autofocus>
                                    </div>
                                    <hr>
                                    <div class="text-center text-md-center mb-4 mt-md-0">
                                        <h3 class="mb-0 h3">Add Job Posting Schema Data</h3>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Schema Title</label>
                                        <div class="input-group">
                                            <input type="text" name="s_title" class="form-control" placeholder="Jobs in Delhi" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">

                                        <label for="s_body">Schema Body</label>
                                        <textarea class="form-control" name="s_body" id="sbody" rows="3"></textarea>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Salary Currency</label>
                                        <div class="input-group">
                                            <input type="text" name="s_currency" class="form-control" placeholder="INR" value="INR" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Salary</label>
                                        <div class="input-group">
                                            <input type="text" name="s_salary" class="form-control" placeholder="10,000" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Payroll Time</label>
                                        <div class="input-group">
                                            <input type="text" name="s_payroll_time" class="form-control" placeholder="Montly" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Posted Date</label>
                                        <div class="input-group">
                                            <input type="date" name="s_posted_date" class="form-control" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Expiry Date</label>
                                        <div class="input-group">
                                            <input type="date" name="s_expiry_date" class="form-control" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-check mb-4">

                                        <input type="checkbox" name="s_unpublish_when_expiry" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Unpublish When
                                            Expiry</label>

                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Employment Type</label>
                                        <div class="form-check">
                                            <input type="checkbox" name="s_emp_type_full_time" class="form-check-input" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck1">Full Time</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Hiring Organization Name</label>
                                        <div class="input-group">
                                            <input type="text" name="s_hiring_org_name" class="form-control" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Hiring Organization URL</label>
                                        <div class="input-group">
                                            <input type="text" name="s_hiring_org_url" class="form-control" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Hiring Organization Logo</label>
                                        <div class="input-group">
                                            <input type="text" name="s_hiring_org_logo" class="form-control" id="title" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group mb-4">
                                        <label for="title">Job Posting Unique Id</label>
                                        <div class="input-group">
                                            <input type="text" name="s_job_posting_unique_id" class="form-control" id="title" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputAddress">Street Address</label>
                                        <input type="text" class="form-control" name="s_street_address" id="inputAddress" placeholder="1234 Main St">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputCity">City</label>
                                        <input type="text" class="form-control" name="s_city_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">Region</label>
                                        <input type="text" class="form-control" name="s_region">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputZip">Zip Code</label>
                                        <input type="text" class="form-control" name="s_zip_code">
                                    </div>
                                    <div class="form-group ">
                                        <label for="inputZip">Country</label>
                                        <input type="text" class="form-control" name="s_country">
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 bg-white">

                        <div class="text-left text-md-left mb-4  mt-5">
                            <h3 class="mb-0 h3">SideBar</h3>
                        </div>
                        <div class="text-left text-md-left mb-4">
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
                                <label>Select Sub Category</label>
                                <select class="form-select" name="sub_cat_id" aria-label="Default select example" required>

                                    <?php

                                    if (isset($subCat) && !empty($subCat)) {
                                        foreach ($subCat as $key => $value) { ?>
                                            <option value="<?= $value['id']; ?>"><?= $value['sub_cat_name']; ?></option>
                                    <?php }
                                    }


                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-gray-800" name="submit">Add New Post</button>
                        </div>

                    </div>
                </div>

            </form>
        </div>
    </section>

</main>

<?php

$scriptTag = "  <script>

tinymce.init({
  selector: 'textarea#pbody',
  height: 400,
  menubar: true,
  plugins: [
  'advlist autolink lists link image charmap print preview anchor',
  'searchreplace visualblocks advcode fullscreen',
  'insertdatetime media table contextmenu powerpaste tinymcespellchecker a11ychecker linkchecker mediaembed',
  'wordcount'],

  toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | advcode spellchecker  a11ycheck code',
  table_toolbar: 'tableprops cellprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
  powerpaste_allow_local_images: true,
  powerpaste_word_import: 'prompt',
  powerpaste_html_import: 'prompt',
  spellchecker_language: 'en',
  spellchecker_dialog: true,
  content_css: [
  '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
  '//www.tiny.cloud/css/codepen.min.css'] });

</script>";




?>
<?php include("../../includes/footer.inc.php"); ?>