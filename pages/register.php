<?php

$db = new Database();

$errors = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'gender' => '',
    'image' => ''
];

$oldValue = [
    'name' => '',
    'email' => '',
    'password' => '',
    'confirm_password' => '',
    'gender' => 'gender'
];

if (!empty($_POST)) {


    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[$key] = "This field is required";
        } else {
            $oldValue[$key] = $value;
        }
    }

    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid Email";
    }

    $password = md5($_POST['password']);
    $confirm_password = md5($_POST['confirm_password']);
    if ($password != $confirm_password) {
        $errors['confirm_password'] = "Password does not match";
    }
    $name = $_POST['name'];
    $gender = $_POST['gender'];

    if (!array_filter($errors)) {
        $data['name'] = $name;
        $data['email'] = $email;
        $data['password'] = $password;
        $data['gender'] = $gender;
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $db->insert('users', $data);
        $_SESSION['success'] = "User Registered Successfully";
        redirect_back();

    }
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Register Page</h1>
            <?php messages();?>
        </div>
        <div class="col-md-12">
            <form action="" method="post">
                <div class="form-group mb-2">
                    <label for="name">Name:
                        <span class="text-danger"><?= $errors['name'] ?></span>
                    </label>
                    <input type="text" name="name" value="<?= $oldValue['name'] ?>" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email:
                        <span class="text-danger"><?= $errors['email'] ?></span>
                    </label>
                    <input type="text" name="email" value="<?= $oldValue['email'] ?>" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password:
                        <span class="text-danger"><?= $errors['password'] ?></span>
                    </label>
                    <input type="password" name="password" value="<?= $oldValue['password'] ?>" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Confirm Password:
                        <span class="text-danger"><?= $errors['confirm_password'] ?></span>
                    </label>
                    <input type="password" name="confirm_password" value="<?= $oldValue['confirm_password'] ?>" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="gender">Gender:
                        <span class="text-danger"><?= $errors['gender'] ?></span>
                    </label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="" readonly>----Select Gender-----</option>
                        <option value="male" <?= $oldValue['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                        <option value="female" <?= $oldValue['gender'] == 'female' ? 'selected' : '' ?>>Female</option>

                    </select>
                </div>

                <div class="form-group mb-2">
                    <button class="btn btn-primary">Register</button>
                </div>

            </form>
        </div>
    </div>
</div>