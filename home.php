<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>

<?php
include 'lib/connection.php';
session_start();

if (!isset($_SESSION['username'])) {
   session_unset();
   session_write_close();
   session_destroy();
   header("Location: index.php");
}


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
   $destination = $_POST['place'];

   $id = $_SESSION['username'];
   $booking_status = 'pending';

   $select = $pdo->prepare("SELECT phone_number FROM user_list WHERE username='$id'");
   $select->execute();

   while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
      $phone = $row['phone_number'];
   }

   $insert = $pdo->prepare("INSERT into bookings(client_name, origin_latitude, origin_longitude, destination_latitude, destination_longitude, client_phone, driver_name, driver_phone, fare, toda, plate_number, mtop, booking_status, destination_details) values(:name, :originLatitude , :originLongitude, :destinationLatitude, :destinationLongitude, :phone, :driver_name, :phone_number, :fare ,:toda, :plate, :mtop, :booking_status, :destination)");

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
   $insert->bindParam(':booking_status', $booking_status);
   $insert->bindParam(':destination', $destination);
   if ($insert->execute()) {
      $update = $pdo->prepare("UPDATE `queuing` SET `que_status` = 'Done' WHERE `queuing`.`que_id` = '$que_id'");
      if ($update->execute()) {


         echo '<script type="text/javascript">
            jQuery(function validation() {

               swal({
                  title: "You Successfully Booked a Ride!!!",
                  text: "Wait for your driver " + $d_name + " to arrive",
                  icon: "success",
                  button: "Redirecting to pending bookings",
               });
            });
         </script>';


         /*
         *   Send an sms notification to the commutter 
         *   
         */
         $key = "0F214580-B450-82F6-BA9A-A5BD236EE2F5";

         $phoneNumber = $phone;

         // Notification Message
         $message = "Good day! 
         Thankyou for booking on Trider. Your assigned tricycle driver will arrive in a minute in your location point." . "<br>" . "Here are some of the information of your driver:" . "<br>" . "Name: " . $d_name . "<br>" . "MTOP #: " . $mtop . "<br>" . "Plate Number: " . $plate . "<br>" . "Contact #: " . $phone_number;


         $curl = curl_init();

         curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=mjalgarne@gmail.com&key=0F214580-B450-82F6-BA9A-A5BD236EE2F5&to=" . $phoneNumber . "&senderid=Trider&message=" . $message . "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
               "authorization: " . $key,
               "accept: */*",
               "cache-control: no-cache",
               "content-type: application/x-www-form-urlencoded"
            ),
         ));

         $response = curl_exec($curl);
         $err = curl_error($curl);

         curl_close($curl);

         /*
         *   Send an sms notification to the driver 
         *   
         */

         $phoneNumber = $phone_number;

         // Notification Message
         $message = "Good day! " . $d_name . "<br>" . $name . "Booked a ride to " . $destination . "<br>" . "This are the details of the ride" . "<br>" . "Commuter Name: " . $name . "<br>" . "Destination:  " . $destination . "<br>" . "Amount to pay: " . $fare . "<br>" . "Contact number: " . $phone . "<br>" . "Check your pending bookings for more details. Ride safe! ";


         $curl = curl_init();

         curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api-mapper.clicksend.com/http/v2/send.php?method=http&username=mjalgarne@gmail.com&key=0F214580-B450-82F6-BA9A-A5BD236EE2F5&to=" . $phoneNumber . "&senderid=Trider&message=" . $message . "",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
               "authorization: " . $key,
               "accept: */*",
               "cache-control: no-cache",
               "content-type: application/x-www-form-urlencoded"
            ),
         ));

         $response = curl_exec($curl);
         $err = curl_error($curl);

         curl_close($curl);

         header('refresh:0;pending_bookings.php');
      }
   }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Manila');
$page = 'Home';
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
         if ($_SESSION['position'] == 'User') {
            include 'lib/user_map.php';
         } elseif ($_SESSION['position'] == 'Administrator') {
            include 'lib/admin_dash.php';
         } elseif ($_SESSION['position'] == 'TODA-Admin') {
            include 'lib/coAdmin_dash.php';
         } elseif ($_SESSION['position'] == 'Driver') { ?>

            <div class="col-6 mb-4">
               <div class="card">
                  <h4 class="card-title ms-4">Pending Bookings</h4>
                  <p class="card-text ms-4">View details of pending bookings.</p>
                  <div class="d-grid gap-2 ms-4 mb-4 me-4">
                     <a class="btn btn-primary" href="pending_bookings.php">View Pending Bookings</a>
                  </div>
               </div>
            </div>
            <div class="col-6">
               <div class="card">
                  <div class="card-block">
                     <h4 class="card-title ms-4">Successfull Bookings</h4>
                     <p class="card-text ms-4">View detals of successfull bookings.</p>
                     <div class="d-grid gap-2 ms-4 mb-4 me-4">
                        <a class="btn btn-primary" href="successfullBookings.php">View Successfull Bookings</a>
                     </div>
                  </div>
               </div>
            </div>
         <?php
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


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>