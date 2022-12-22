<?php
include 'lib/connection.php';
session_start();


$page = 'Edit Driver';

if (isset($_POST['btn_EditDriver'])) {
    $uid = $_POST['uid'];


    $firstname = ucwords(strtolower($_POST['firstname']));
    $lastname = ucwords(strtolower($_POST['lastname']));
    $middlename = ucwords(strtolower($_POST['middlename']));
    $suffix = $_POST['suffix'];
    $sex = $_POST['sex'];
    $plateNumber = $_POST['plateNumber'];
    $license = $_POST['license'];
    $toda = $_POST['toda'];
    $mtop = $_POST['mtop'];

    $update = $pdo->prepare("UPDATE `driver_list` SET `driver_firstname` = '$firstname', `driver_middlename` = '$middlename', `driver_lastname` = '$lastname', `driver_sufix` = '$suffix', `gender` = '$sex',  `plate_number` = '$plateNumber' , `license` = '$license', `toda` = '$toda', `mtop` = '$mtop' WHERE `driver_list`.`user_id` = '$uid'");
    if ($update->execute()) {
        $_SESSION['status'] = "usuccess";

        // Redirect to homepage to display updated user in list
        header("Location: drivers.php");
    }
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id

$select = $pdo->prepare("SELECT * FROM driver_list WHERE `user_id` = '$id' ");

$select->execute();
while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

    $firstname = $row['driver_firstname'];
    $lastname = $row['driver_lastname'];
    $middlename = $row['driver_middlename'];
    $sufix = $row['driver_sufix'];
    $gender = $row['gender'];
    $plate_number = $row['plate_number'];
    $license = $row['license'];
    $toda = $row['toda'];
    $mtop = $row['mtop'];
}
?>

?>
<!DOCTYPE html>
<html lang="en">

<?php include 'includes/head.php';
?>

<body>
    <?php
    include 'includes/navigation.php';
    include 'includes/side_nav.php';
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Driver</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item">Driver</li>
                    <li class="breadcrumb-item active">Edit Driver</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row ms-3 me-3">
                <div>
                    <a type="button" class="btn btn-primary ms-auto mb-2" href="driver.php"><i class='bx bx-arrow-back'></i> Back</a>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            <form id="addStudentForm" action="" method="post">
                                <div class="">
                                    <fieldset>
                                    <input type="text" name="uid" class="form-control" id="uid" value="<?php echo $id; ?>" required hidden>
                                        <div class="col-12">
                                            <label for="firstname" class="form-label">Firstname</label>
                                            <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo $firstname; ?>" required>
                                            <div class="invalid-feedback">Please, enter your Firstname!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="middlename" class="form-label">Middlename</label>
                                            <input type="text" name="middlename" class="form-control" id="middlename" value="<?php echo $middlename; ?>" required>
                                            <div class="invalid-feedback">Please, enter your Middlename!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="lastname" class="form-label">Lastname</label>
                                            <input type="text" name="lastname" class="form-control" id="lastname" value="<?php echo  $lastname; ?>" required>
                                            <div class="invalid-feedback">Please, enter your Lastname!</div>
                                        </div>
                                        <div class="col-12 ">
                                            <label for="suffix" class="form-label">Suffix</label>
                                            <input type="text" name="suffix" class="form-control" id="suffix" value="<?php echo $sufix ?>" required>
                                            <div class="invalid-feedback">Please, enter your Suffix!</div>
                                        </div>

                                        <div class="input-group mt-3">
                                            <label class="input-group-text" for="sex">Sex</label>
                                            <select class="form-select" aria-label="Default select example" id="sex" name="sex" required>
                                                <option value="Male" <?php
                                                                        if ($gender == 'Male') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>Male</option>
                                                <option value="Female" <?php
                                                                        if ($gender == 'Female') {
                                                                            echo 'selected';
                                                                        }
                                                                        ?>>Female</option>
                                            </select>
                                        </div>

                                        <div class="col-12">
                                            <label for="plateNumber" class="form-label">Plate Number</label>
                                            <input type="text" name="plateNumber" class="form-control" id="plateNumber" value="<?php echo $plate_number;?>" required>
                                            <div class="invalid-feedback">Please enter your Plate Number!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="license" class="form-label">License</label>
                                            <input type="text" name="license" class="form-control" id="license" value="<?php echo $license;?>" required>
                                            <div class="invalid-feedback">Please enter your License number!</div>
                                        </div>
                                        <div class="col-12">
                                            <label for="toda" class="form-label">TODA</label>
                                            <input type="text" name="toda" class="form-control" id="toda" value="<?php echo $toda;?>" required>
                                            <div class="invalid-feedback">Please enter your TODA!</div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label for="mtop" class="form-label">MTOP</label>
                                            <input type="text" name="mtop" class="form-control" id="mtop" value="<?php echo $mtop ;?>" required>
                                            <div class="invalid-feedback">Please enter your MTOP!</div>
                                        </div>


                                        <input name="btn_EditDriver" id="signup" class="btn btn-block btn-primary" type="submit" value="Save Changes" />
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