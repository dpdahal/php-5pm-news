<?php
$db = new Database();

$loginId=$_SESSION['auth']->id;

$sql="SELECT * FROM users WHERE id!=$loginId";

$userData = $db->customQuery($sql);
//var_dump($userData);
//die();


?>

<main id="main" class="main">
    <section class="section dashboard">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3>Users</h3>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($userData as $key => $user) {
                            ?>
                            <tr>
                                <td><?= ++$key; ?></td>
                                <td><?= $user->name; ?></td>
                                <td><?= $user->email; ?></td>
                                <td><?= $user->gender; ?></td>
                                <td><?= $user->role; ?></td>
                                <td>
                                    <a href="">Edit</a>
                                    <a href="">Delete</a>
                                </td>

                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </section>

</main><!-- End #main -->

