<?php


$db = new Database();
$errors = [
    'email' => '',
    'password' => '',
];
$oldValue = [
    'email' => '',
    'password' => '',
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
    if (!array_filter($errors)) {
        $email=$_POST['email'];
        $password=md5($_POST['password']);
        $sql="SELECT * FROM users WHERE email='$email' AND password='$password'";
        $response = $db->customQuery($sql);

        if($response) {
            $user = $response[0];
            unset($user->password);
            $_SESSION['auth'] = $user;
            $_SESSION['is_login'] =true;
            header('Location:admin');
        }else{
            $_SESSION['error']="Invalid Email or Password";
            redirect_back();
        }

    }
}

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Login Page</h1>
            <?php messages();?>
        </div>
        <div class="col-md-12">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="form-group mb-2">
                    <label for="email">Email:
                        <span class="text-danger"><?= $errors['email'] ?></span>
                    </label>
                    <input type="text" id="email" name="email" value="<?= $oldValue['email'] ?>" class="form-control">
                </div>
                <div class="form-group mb-2">
                    <label for="password">Password:
                        <span class="text-danger"><?= $errors['password'] ?></span>
                    </label>
                    <input type="password" id="password" name="password" value="<?= $oldValue['password'] ?>" class="form-control">
                </div>


                <div class="form-group mb-2">
                    <button class="btn btn-primary">Register</button>
                </div>

            </form>
        </div>
    </div>
</div>