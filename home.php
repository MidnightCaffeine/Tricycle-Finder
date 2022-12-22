<?php
include 'lib/connection.php';
session_start();



if (isset($_POST['book_now'])) {

   $select = $pdo->prepare("SELECT * FROM `queuing` WHERE `que_status` = 'Available' ORDER BY que_id ASC LIMIT 1");
   $select->execute();

   while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
      $did = $row['driver_id'];
      $d_name = $row['driver_name'];
      $que_id = $row['que_id'];
   }

   $startCoordinates = str_replace(array('(', ')'), '', $_POST['startcoordinates']);
   $originCoordinates = explode(", ", $startCoordinates);
   $originLatitude = $originCoordinates[0];
   $originLongitude = $originCoordinates[1];

   $select = $pdo->prepare("SELECT * FROM user_list WHERE user_id='$did' LIMIT 1");
   $select->execute();

   while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
      $phone_number = $row['phone_number'];
   }

   $endCoordinates = str_replace(array('(', ')'), '', $_POST['endcoordinates']);
   $destinationCoordinates = explode(", ", $endCoordinates);
   $destinationLatitude = $destinationCoordinates[0];
   $destinationLongitude = $destinationCoordinates[1];

   $select = $pdo->prepare("SELECT * FROM driver_list WHERE user_id='$did' LIMIT 1");
   $select->execute();

   while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
      $plate = $row['plate_number'];
      $mtop = $row['mtop'];
      $toda = $row['toda'];
   }

   $name = $_POST['fullname'];
   $distance = $_POST['distance'];
   $fare = $_POST['fare'];
   $desination = $_POST['place'];

   $id = $_SESSION['username'];

   $select = $pdo->prepare("SELECT phone_number FROM user_list WHERE username='$id'");
   $select->execute();

   while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
      $phone = $row['phone_number'];
   }

   $insert = $pdo->prepare("INSERT into bookings(client_name, origin_latitude, origin_longitude, destination_latitude, destination_longitude, client_phone, driver_name, driver_phone, fare, toda, plate_number, mtop) values(:name, :originLatitude , :originLongitude, :destinationLatitude, :destinationLongitude, :phone, :driver_name, :phone_number, :fare ,:toda, :plate, :mtop)");

   $insert->bindParam(':name', $name);
   $insert->bindParam(':originLatitude', $originLatitude);
   $insert->bindParam(':originLongitude', $originLongitude);
   $insert->bindParam(':destinationLatitude', $destinationLatitude);
   $insert->bindParam(':destinationLongitude', $destinationLongitude);
   $insert->bindParam(':phone', $phone);
   $insert->bindParam(':driver_name', $d_name);
   $insert->bindParam(':phone_number', $phone_number);
   $insert->bindParam(':fare', $fare);
   $insert->bindParam(':toda', $toda);
   $insert->bindParam(':plate', $plate);
   $insert->bindParam(':mtop', $mtop);
   if($insert->execute()){
      $update = $pdo->prepare("UPDATE `queuing` SET `que_status` = 'Done' WHERE `queuing`.`que_id` = '$que_id'");
      $update->execute();
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Manila');
$page = 'Home';
session_start();
include 'lib/connection.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/side_nav.php';
?>
<main id="main" class="main">
   <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
         <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="home.php">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
         </ol>
      </nav>
   </div>
   <section class="section dashboard">
      <div class="row">
         <?php
         if ($_SESSION['position'] == 'User') { ?>


            <div class="row">
               <div class="col-sm-8">

                  <div class="content-map">
                     <div class="mappings">
                        <div id="map"> </div>
                     </div>
                  </div>

               </div>
               <div class="col-sm-4">
                  <div class="card mb-3">
                     <div class="card-body">

                        <form method="POST" action="">
                           <div class="pt-2 pb-2">
                              <h5 class="card-title text-center pb-0 fs-4">Book A Ride</h5>
                           </div>
                           <div class="col-12 mb-2">
                              <label for="fullname" class="form-label">Name</label>
                              <input type="text" name="fullname" class="form-control" id="fullname" value="<?php echo $_SESSION['fullname'] ?>" readonly>
                              <div class="invalid-feedback">Please, enter your Firstname!</div>
                           </div>

                           <div class="col-12 mb-2">
                              <label for="distance" class="form-label">Distance</label>
                              <input type="text" name="distance" class="form-control" id="distance" readonly>
                              <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                           </div>
                           <div class="col-12 mb-2">
                              <label for="fare" class="form-label">Fare</label>
                              <div class="input-group flex-nowrap">
                                 <span class="input-group-text" id="pesoSign">₱</span>
                                 <input type="text" class="form-control" aria-label="fare" aria-describedby="pesoSign" name="fare" id="fare" readonly>
                              </div>
                           </div>

                           <div class="col-12 mb-3">
                              <label for="place" class="form-label">Destination</label>
                              <input type="text" name="place" class="form-control" id="place" readonly>
                              <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                           </div>

                           <input type="text" name="endcoordinates" class="form-control" id="endcoordinates" hidden>
                           <input type="text" name="startcoordinates" class="form-control" id="startcoordinates" hidden>

                           <div class="d-grid gap-2 mt-2">
                              <button type="submit" class="btn btn-success" name="book_now">Book</button>
                           </div>

                        </form>

                     </div>
                  </div>
               </div>
            </div>

         <?php
         } elseif ($_SESSION['position'] == 'Administrator') {
            include 'lib/admin_dash.php';
         } elseif ($_SESSION['position'] == 'TODA-Admin') {
            include 'lib/coAdmin_dash.php';
         }
         ?>
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