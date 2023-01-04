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

if (isset($_POST['btn_addtoda'])) {

    $toda = strtoupper($_POST['toda']);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $position = 'TODA-Admin';
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $phone = $_POST['phone'];

    $action = 'Registered ' . $username .  ' to client list';

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

                $insert = $pdo->prepare("INSERT into admin_toda(admin_id ,toda ) values(:id, :toda)");

                $insert->bindParam(':id', $id);
                $insert->bindParam(':toda', $toda);
                $insert->execute();


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
                header('refresh:1; coAdmins.php');
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
            <h1>Add TODA - Admin</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item">TODA - Admin</li>
                    <li class="breadcrumb-item active">Add TODA - Admin</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row ms-3 me-3">
                <div>
                    <a type="button" class="btn btn-primary ms-auto mb-2" href="coAdmins.php"><i class='bx bx-arrow-back'></i> Back</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <form id="addStudentForm" action="" method="post">
                                <div class="">
                                    <fieldset>
                                        <div class="col-12">
                                            <label for="toda" class="form-label">TODA</label>
                                            <input type="text" name="toda" class="form-control" id="toda" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email" required>
                                        </div>

                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="text" name="username" class="form-control" id="username" required>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="phone" class="form-label">Phone Number</label>
                                            <input type="text" name="phone" class="form-control" id="phone" onkeypress="return checkNumber(event)" maxlength="11" required>
                                        </div>

                                        <div class="col-12 mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <input type="password" name="password" class="form-control" id="password" required>
                                                <span class="input-group-text" id="inputGroupPrepend">
                                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                </span>
                                            </div>
                                        </div>

                                        <input name="btn_addtoda" id="signup" class="btn btn-block btn-primary" type="submit" value="Add Admin TODA" />
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

    <script>
        function checkNumber(event) {

            var aCode = event.which ? event.which : event.keyCode;

            if (aCode > 31 && (aCode < 48 || aCode > 57)) return false;

            return true;

        }
    </script>
</body>

</html>