<?php
$db = new Database();

$loginId = $_SESSION['auth']->id;

$sql = "SELECT * FROM users WHERE id=$loginId";

$findData = $db->customQuery($sql);
$user = $findData[0];


$errors = [
    'name' => '',
    'email' => '',
    'gender' => '',
    'image' => '',
    'password' => '',
    'confirm_password' => '',
    'old_password' => ''
];

$oldValue = [
    'name' => '',
    'email' => '',
    'gender' => 'gender'
];


if (isset($_POST['update_profile'])) {
    unset($_POST['update_profile']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }
    if (!empty($_FILES['image']['name'])) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $fileName = md5(microtime()) . ".$ext";
        $uploadPath = public_path("users/$fileName");
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $errors['image'] = "Image Upload Failed";
            redirect_back();
        } else {
            $data['image'] = '/public/users/' . $fileName;
        }
    }

    if (!array_filter($errors)) {
        $data['name'] = $_POST['name'];
        $data['gender'] = $_POST['gender'];
        $db->Update('users', $data, 'id', $loginId);
        $_SESSION['success'] = "Profile Updated Successfully";
        redirect_back();
    }

}


if (isset($_POST['change_password'])) {
    unset($_POST['change_password']);
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }

    $findData = $db->customQuery("SELECT * FROM users WHERE id=$loginId");
    $user = $findData[0];
    $odlP = $user->password;
    $oldPassword = md5($_POST['old_password']);
    if ($odlP != $oldPassword) {
        $errors['old_password'] = "Old password not match";
    }

    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    if ($password != $confirm_password) {
        $errors['confirm_password'] = "Password does not match";
    }

    if (!array_filter($errors)) {
        $data['password'] = $password;
        $db->Update('users', $data, 'id', $loginId);
        $_SESSION['success'] = "Password was successfully changed";
//        session_destroy();
//        header('Location:' . url('login'));
//        exit();
        redirect_back();

    }

    print_r($errors);

}


?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>General Setting</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="name">Name:
                                        <span class="text-danger"><?= $errors['name'] ?></span>
                                    </label>
                                    <input type="text" name="name" value="<?= $user->name ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="email">Email:
                                        <span class="text-danger"><?= $errors['email'] ?></span>
                                    </label>
                                    <input type="text" name="email" readonly disabled value="<?= $user->email ?>"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label for="gender">Gender:
                                        <span class="text-danger"><?= $errors['gender'] ?></span>
                                    </label>
                                    <select name="gender" id="gender" class="form-control">
                                        <option value="male" <?= $user->gender == 'male' ? 'selected' : '' ?>>Male
                                        </option>
                                        <option value="female" <?= $user->gender == 'female' ? 'selected' : '' ?>>
                                            Female
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="form-group mb-2">
                            <button name="update_profile" class="btn btn-primary">Update</button>
                        </div>

                    </form>


                </div>


            </div>

        </div>
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Change Password</h3>
                    <?php messages(); ?>
                </div>
                <div class="card-body">
                    <form action="" method="post">

                        <div class="form-group mb-2">
                            <label for="old_password">Old Password:
                                <span class="text-danger"><?= $errors['old_password'] ?></span>
                            </label>
                            <input type="password" name="old_password" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Password:
                                <span class="text-danger"><?= $errors['password'] ?></span>
                            </label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <div class="form-group mb-2">
                            <label for="password">Confirm Password:
                                <span class="text-danger"><?= $errors['confirm_password'] ?></span>
                            </label>
                            <input type="password" name="confirm_password" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <button name="change_password" class="btn btn-primary">Change Password</button>
                        </div>

                    </form>
                </div>


            </div>

        </div>
    </section>

</main><!-- End #main -->

