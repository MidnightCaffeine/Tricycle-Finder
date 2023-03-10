<script src="assets/js/sweetalert.js"></script>
<?php
$page = "Add User";
include_once 'lib/connection.php';
session_start();
if (!isset($_SESSION['username'])) {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}
date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
$t = date("h:i:s A");
if (isset($_POST['btn_adduser'])) {

    $firstname = ucwords(strtolower($_POST['firstname']));
    $lastname = ucwords(strtolower($_POST['lastname']));
    $middlename = ucwords(strtolower($_POST['middlename']));
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $position = 'User';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $suffix = $_POST['suffix'];
    $gender = $_POST['sex'];
    $phone = $_POST['phone'];

    $action = 'Registered ' . $firstname . ' ' . $middlename . ' ' . $lastname . ' to client list';

    if (isset($_POST['email']) or isset($_POST['username'])) {

        $select = $pdo->prepare("SELECT email from user_list where email='$email'");
        $select->execute();

        if ($select->rowCount() > 0) {

            echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Warning!",
text: "Email Already Exist : Please try from different Email !!",
icon: "warning",
button: "Ok",
});


});

</script>';
        }

        $select = $pdo->prepare("SELECT username from user_list where username='$username'");
        $select->execute();
        if ($select->rowCount() > 0) {

            echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Warning!",
text: "Username Already Exist : Please try from different username !!",
icon: "warning",
button: "Ok",
});


});

</script>';
        }
        $select = $pdo->prepare("SELECT phone_number from user_list where phone_number='$phone'");
        $select->execute();

        if ($select->rowCount() > 0) {

            echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Warning!",
text: "Number Already Exist : Please try from different Number !!",
icon: "warning",
button: "Ok",
});


});

</script>';
        } else {


            $insert = $pdo->prepare("INSERT into user_list(username,password,phone_number,email,position) values(:name,:pass,:phone,:email,:position)");

            $insert->bindParam(':name', $username);
            $insert->bindParam(':pass', $hashedPassword);
            $insert->bindParam(':phone', $phone);
            $insert->bindParam(':email', $email);
            $insert->bindParam(':position', $position);


            if ($insert->execute()) {

                $select = $pdo->prepare("SELECT user_id FROM user_list WHERE username='$username'");
                $select->execute();

                while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                    $id = $row['user_id'];
                }

                $insert = $pdo->prepare("INSERT into client_list(user_id ,client_firstname,client_middlename ,client_lastname, client_suffix, gender ) values(:id, :firstname, :middlename, :lastname, :suffix , :gender)");

                $insert->bindParam(':id', $id);
                $insert->bindParam(':firstname', $firstname);
                $insert->bindParam(':middlename', $middlename);
                $insert->bindParam(':lastname', $lastname);
                $insert->bindParam(':suffix', $suffix);
                $insert->bindParam(':gender', $gender);

                if ($insert->execute()) {
                    $insertLog = $pdo->prepare("INSERT INTO user_log(user_id, username, action, logDate, logTime) values(:id, :user, :action, :logDate, :logTime)");

                    $insertLog->bindParam(':id', $id);
                    $insertLog->bindParam(':user', $username);
                    $insertLog->bindParam(':action', $action);
                    $insertLog->bindParam(':logDate', $d);
                    $insertLog->bindParam(':logTime', $t);
                    $insertLog->execute();
                }


                echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Good Job!",
text: "Your Registration is Successfull",
icon: "success",
button: "Ok",
});


});

</script>';

                $_SESSION['status'] = "asuccess";
                header('refresh:1;users.php');
            } else {

                echo '<script type="text/javascript">
jQuery(function validation(){


swal({
title: "Error!",
text: "Registration Fail !!!",
icon: "error",
button: "Ok",
});


});

</script>';
            }
        }
    } // end if txtemail

}
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php'; ?>

<script>
    $().ready(function() {

        // validate signup form on keyup and submit
        $("#addStudentForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                middlename: {
                    required: false,
                    minlength: 2
                },
                department: "required",
                username: {
                    required: true,
                    minlength: 5
                },
                password: {
                    required: true,
                    minlength: 4
                },
                confirm_password: {
                    required: true,
                    minlength: 4,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                },
            },
            messages: {
                firstname: "Please enter your firstname",
                lastname: "Please enter your lastname",
                department: "Please select a department",
                middlename: {
                    minlength: "Middlename not middle inittial"
                },
                username: {
                    required: "Please enter a username",
                    minlength: "Your username must consist of at least 5 characters"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long",
                    equalTo: "Please enter the same password as above"
                },
                email: "Please enter a valid email address",
            }
        });
    });
</script>

</head>

<body>
    <?php
    include 'includes/navigation.php';
    include 'includes/side_nav.php';
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Add Student</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item">Student</li>
                    <li class="breadcrumb-item active">Add Student</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row ms-3 me-3">
                <div>
                    <a type="button" class="btn btn-primary ms-auto mb-2" href="users.php"><i class='bx bx-arrow-back'></i> Back</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <form id="addStudentForm" action="" method="post">
                                <div class="">
                                    <fieldset>
                                        <div class="col-12">
                                            <label for="firstname" class="form-label">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" id="firstname" required>
                                            <div class="invalid-feedback">Please, enter your Firstname!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="middlename" class="form-label">Middlename</label>
                                            <input type="text" name="middlename" class="form-control" id="middlename" required>
                                            <div class="invalid-feedback">Please, enter your Middlename!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="lastname" class="form-label">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname" required>
                                            <div class="invalid-feedback">Please, enter your Lastname!</div>
                                        </div>
                                        <div class="col-12 ">
                                            <label for="suffix" class="form-label">Suffix</label>
                                            <input type="text" name="suffix" class="form-control" id="suffix" required>
                                            <div class="invalid-feedback">Please, enter your Suffix!</div>
                                        </div>

                                        <div class="input-group mt-3">
                                            <label class="input-group-text" for="sex">Sex</label>
                                            <select class="form-select" aria-label="Default select example" id="sex" name="sex" required>
                                                <option value="Male" selected>Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="username" required>
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" id="phone" required>
                                            <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <input type="password" name="password" class="form-control" id="password" required>
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                </span>
                                                <div class="invalid-feedback">Please enter your password!</div>
                                            </div>
                                        </div>

                                        <input name="btn_adduser" id="signup" class="btn btn-block btn-primary" type="submit" value="Add User" />
                                    </fieldset>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </section>
    </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php
    include 'includes/footer.php';
    include 'includes/script_list.php';
    ?>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {

            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            // toggle the eye icon
            this.classList.toggle('bi-eye');
            this.classList.toggle('bi-eye-slash');
        });
    </script>
</body>

</html>