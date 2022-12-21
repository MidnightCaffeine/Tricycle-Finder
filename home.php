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
            <div class="content-map">
               <div class="mappings">
                  <div id="map"> </div>
               </div>
            </div>

            <input id="distance" readonly>
            <input id="timeElapsed" readonly>

         <?php
         }elseif ($_SESSION['position'] == 'Administrator') {
            include 'lib/admin_dash.php';
         }elseif ($_SESSION['position'] == 'TODA-Admin') {
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