<?php
$db = new Database();

$loginId = $_SESSION['auth']->id;

$categoryData = $db->All('category');



$errors = [
    'cat_name' => '',

];

$oldValue = [
    'cat_name' => '',
];


if (isset($_POST['add_category'])) {
    unset($_POST['add_category']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }

    $catName = $_POST['cat_name'];
    $sql = "SELECT count(*) as total FROM category WHERE cat_name = '$catName'";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['cat_name'] = "Category already exists";
    }

    if (!array_filter($errors)) {
        $data['cat_name'] = $_POST['cat_name'];
        $db->Insert('category', $data);
        $_SESSION['success'] = "Category Created Successfully";
        redirect_back();
    }

}


$editId = isset($_GET['edit']) ? $_GET['edit'] : '';

if($editId){
    $sql = "SELECT * FROM category WHERE cid = $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    $oldValue['cat_name'] = $result->cat_name;

}


if(isset($_POST['update_category'])){
    unset($_POST['update_category']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }

    $catName = $_POST['cat_name'];
    $sql = "SELECT count(*) as total FROM category WHERE cat_name = '$catName' AND cid != $editId";
    $result = $db->customQuery($sql);
    $result = $result[0];
    if ($result->total > 0) {
        $errors['cat_name'] = "Category already exists";
    }

    if (!array_filter($errors)) {
        $data['cat_name'] = $_POST['cat_name'];
        $db->Update('category',$data,'cid',$editId);
        $_SESSION['success'] = "Category Updated Successfully";
        header('Location:'.url('admin/manage-category'));
        exit();
    }

}


if(isset($_GET['delete'])){
    $deleteId = $_GET['delete'];
    $db->Delete('category','cid',$deleteId);
    $_SESSION['success'] = "Category Deleted Successfully";
    header('Location:'.url('admin/manage-category'));
    exit();
}



?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <?php if($editId) : ?>
            <div class="card">
                <div class="card-header">
                    <h3>Update Category</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="row">

                            <div class="form-group mb-2">
                                <label for="cat_name">Name:
                                    <span class="text-danger"><?= $errors['cat_name'] ?></span>
                                </label>
                                <input type="text" id="cat_name" name="cat_name"
                                       value="<?= $oldValue['cat_name'] ?>" class="form-control">
                            </div>

                            <div class="form-group mb-2">
                                <button name="update_category" class="btn btn-primary">Update Category</button>
                            </div>

                    </form>


                </div>


            </div>
            <?php else:  ?>

                <div class="card">
                    <div class="card-header">
                        <h3>Manage Category</h3>
                        <?php messages(); ?>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="row">

                                <div class="form-group mb-2">
                                    <label for="cat_name">Name:
                                        <span class="text-danger"><?= $errors['cat_name'] ?></span>
                                    </label>
                                    <input type="text" id="cat_name" name="cat_name"
                                           value="<?= $oldValue['cat_name'] ?>" class="form-control">
                                </div>

                                <div class="form-group mb-2">
                                    <button name="add_category" class="btn btn-primary">Add Category</button>
                                </div>

                        </form>


                    </div>


                </div>

            <?php endif; ?>

        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Category List</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>S.n</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        foreach ($categoryData as $category) {
                            ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $category->cat_name ?></td>
                                <td>
                                    <a href="<?= url('admin/manage-category') ?>?edit=<?= $category->cid ?>"
                                       class="btn btn-primary">Edit</a>
                                    <a href="<?= url('admin/manage-category') ?>?delete=<?= $category->cid ?>"
                                       class="btn btn-danger">Delete</a>

                                </td>

                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>

                </div>


            </div>

        </div>
    </section>

</main><!-- End #main -->

