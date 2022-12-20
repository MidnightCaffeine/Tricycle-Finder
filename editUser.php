<?php
session_start();
$page = "Edit User";
if (!isset($_SESSION['username'])) {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}
// include database connection file
include_once("lib/connection.php");

// Check if form is submitted for user update, then redirect to homepage after update
if (isset($_POST['update'])) {
    $uid = $_POST['uid'];


    $ufirstname = ucwords(strtolower($_POST['firstname']));
    $ulastname = ucwords(strtolower($_POST['lastname']));
    $umiddlename = ucwords(strtolower($_POST['middlename']));
    $suffix = $_POST['suffix'];
    $gender = $_POST['sex'];

    $update = $pdo->prepare("UPDATE `client_list` SET `client_firstname` = '$ufirstname', `client_middlename` = '$umiddlename', `client_lastname` = '$ulastname', `client_suffix` = '$suffix', `gender` = '$gender' WHERE `client_list`.`user_id` = '$uid'");
    if ($update->execute()) {
        $_SESSION['status'] = "usuccess";

        // Redirect to homepage to display updated user in list
        header("Location: ./users.php");
    }
}
?>
<?php
// Display selected user data based on id
// Getting id from url
$id = $_GET['id'];

// Fetech user data based on id

$select = $pdo->prepare("SELECT * FROM client_list WHERE `user_id` = '$id' ");

$select->execute();
while ($row = $select->fetch(PDO::FETCH_ASSOC)) {

    $firstname = $row['client_firstname'];
    $lastname = $row['client_lastname'];
    $middlename = $row['client_middlename'];
    $suffix = $row['client_suffix'];
    $gender = $row['gender'];
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
include 'includes/head.php';
?>

<body>
    <?php
    include 'includes/navigation.php';
    include 'includes/side_nav.php';
    ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Edit Student</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Manage</li>
                    <li class="breadcrumb-item">Users</li>
                    <li class="breadcrumb-item">Student</li>
                    <li class="breadcrumb-item active"><?php
                                                        echo $lastname . ', ' . $firstname . ' ' . substr($middlename, 0, 1) . '.';
                                                        ?></li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div>
                    <a type="button" class="btn btn-primary ms-auto mb-2" href="users.php"><i class='bx bx-arrow-back'></i> Back</a>
                </div>

                <form name="update_user" method="post" action="editUser.php">
                    <fieldset>
                        <div class="row mb-2">
                            <div class="col-sm-5 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" name="firstname" class="form-control" value="<?php echo $firstname ?>" required />
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-6 mb-2">
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" name="lastname" class="form-control" value="<?php echo $lastname ?>" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="middlename">Middlename</label>
                            <input type="middlename" name="middlename" class="form-control" value="<?php echo $middlename ?>" />
                        </div>
                        <div class="col-12 ">
                            <label for="suffix" class="form-label">Suffix</label>
                            <input type="text" name="suffix" class="form-control" id="suffix" value="<?php echo $suffix; ?>" required>
                            <div class="invalid-feedback">Please, enter your Suffix!</div>
                        </div>

                        <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="sex">Sex</label>
                            <select class="form-select" aria-label="Default select example" id="sex" name="sex" required>
                                <option value="Male" <?php if ($gender == "Male") {
                                                            echo "selected";
                                                        } ?>>Male</option>
                                <option value="Female" <?php if ($gender == "Female") {
                                                            echo "selected";
                                                        } ?>>Female</option>
                            </select>
                        </div>
                        <input type="text" name="uid" hidden value="<?php echo $id; ?>">
                        <input class="btn btn-primary ms-auto" type="submit" name="update" value="Save Changes">
                    </fieldset>
                </form>
            </div>
        </section>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    <?php
include 'includes/footer.php';
include 'includes/script_list.php';
?>
</body>

</html>