<?php
include 'lib/connection.php';
session_start();


if (!isset($_SESSION['username'])) {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}

if (isset($_POST['completeBooking'])) {

    $booking_id = $_POST['booking_id'];


    $update = $pdo->prepare("UPDATE `bookings` SET `booking_status` = 'success' WHERE `bookings`.`booking_id` = '$booking_id'");
    $update->execute();
}

?>
<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Manila');
$page = 'Successfull Booking';
include 'lib/connection.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/side_nav.php';
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Successfull Bookings</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Successfull Bookings</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">


            <table id="que" class="display table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Fare</th>
                        <th scope="col">Driver Name</th>
                        <th scope="col">Plate Number</th>
                        <th scope="col">MTOP</th>
                        <th scope="col">TODA</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $name = ''.$_SESSION['fullname'];
                    if ($_SESSION['position'] == 'User') {
                        $select = $pdo->prepare("SELECT * FROM `bookings` WHERE `booking_status` = 'success' AND `client_name` = '$name' ORDER BY booking_id ASC");
                    }elseif ($_SESSION['position'] == 'Driver') {
                        $select = $pdo->prepare("SELECT * FROM `bookings` WHERE `booking_status` = 'success' AND `driver_name` = '$name' ORDER BY booking_id ASC");
                    }else{
                        $select = $pdo->prepare("SELECT * FROM `bookings` WHERE `booking_status` = 'success' ORDER BY booking_id ASC");
                    }
                    $select->execute();

                    $count = 0;
                    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
                        $count++;

                    ?>
                        <tr>
                            <form method="POST">
                                <input name="booking_id" value="<?php echo $row['booking_id']; ?>" hidden>
                                <td><?php echo $count; ?></td>
                                <td><?php echo $row['destination_details']; ?></td>
                                <td>₱ <?php echo $row['fare']; ?></td>
                                <td><?php echo $row['driver_name']; ?></td>
                                <td><?php echo $row['plate_number']; ?></td>
                                <td><?php echo $row['mtop']; ?></td>
                                <td><?php echo $row['toda']; ?></td>
                            </form>
                        </tr>

                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </section>
</main>


<?php
include 'includes/footer.php';
include 'includes/script_list.php';
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhJTfM7zUxZ6B8DY0i2YMAksOs6huSJDs&libraries=places&callback=initMap" async defer></script>

</body>

</html>