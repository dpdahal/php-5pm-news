<?php
$db = new Database();

$loginId = $_SESSION['auth']->id;

$categoryData = $db->All('category');


$errors = [
    'category_id' => '',
    'title' => '',
    'slug' => '',
    'summary' => '',
    'description' => '',

];

$oldValue = [
    'category_id' => '',
    'title' => '',
    'slug' => '',
    'summary' => '',
    'description' => '',
];


if (!empty($_POST)) {

    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }

    if(!array_filter($errors)){
        $data=$_POST;
        $data['posted_by']=$loginId;
        $db->Insert('news',$data);
        $_SESSION['success']="News Added Successfully";
        redirect_back();
    }


}



?>

<main id="main" class="main">
    <section class="section dashboard">

        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Add News</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group mb-2 mb-2">
                            <label for="category_id">Category:</label>
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" selected disabled>Select Category</option>
                                <?php foreach ($categoryData as $category) : ?>
                                    <option value="<?= $category->cid ?>"
                                        <?= $oldValue['category_id'] == $category->cid ? 'selected' : '' ?>

                                    ><?= $category->cat_name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <small class="text-danger"><?= $errors['category_id'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control"
                                   value="<?= $oldValue['title'] ?>">
                            <small class="text-danger"><?= $errors['title'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="slug">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   value="<?= $oldValue['slug'] ?>">
                            <small class="text-danger"><?= $errors['slug'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="summary">Summary</label>
                            <textarea name="summary" id="summary" class="form-control"
                                      rows="5"><?= $oldValue['summary'] ?></textarea>
                            <small class="text-danger"><?= $errors['summary'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control"
                                      rows="10"><?= $oldValue['description'] ?></textarea>
                            <small class="text-danger"><?= $errors['description'] ?></small>
                        </div>
                        <div class="form-group mb-2">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <button class="btn btn-primary">Add News</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

