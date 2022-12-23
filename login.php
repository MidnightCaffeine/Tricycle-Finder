<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>


<?php
include_once 'lib/connection.php';
session_start();
if(isset($_SESSION['username'])){
   header("LOCATION: home.php");
 }

$page = 'Login';

date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
$t = date("h:i:s A");
$action = 'Login';

if (isset($_POST['btn_login'])) {

   $useremail = $_POST['username'];
   $password = $_POST['password'];


   $select = $pdo->prepare("SELECT * FROM user_list WHERE email = '$useremail' OR username = '$useremail' OR phone_number= '$useremail' ");

   $select->execute();

   $row = $select->fetch(PDO::FETCH_ASSOC);

   if (password_verify($password, $row['password'])) {
      if ($row['email'] == $useremail or $row['username'] == $useremail) {
         $_SESSION['myid'] = $row['user_id'];
         $id = $row['user_id'];
         $_SESSION['myID'] = $row['user_id']; 
         $_SESSION['username'] = $row['username'];
         $_SESSION['email'] = $row['email'];
         $_SESSION['position'] = $row['position'];
         $_SESSION['status'] = '';

         $insertLog = $pdo->prepare("INSERT INTO user_log(user_id, username, action, logDate, logTime) values(:id, :user, :action, :logDate, :logTime)");

         $insertLog->bindParam(':id', $id);
         $insertLog->bindParam(':user', $useremail);
         $insertLog->bindParam(':action', $action);
         $insertLog->bindParam(':logDate', $d);
         $insertLog->bindParam(':logTime', $t);
         $insertLog->execute();

         if ($row["position"] == "User") {
            $selectYou = $pdo->prepare("SELECT * from `client_list` where user_id = '$id'");
            $selectYou->execute();
            while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
               $firstname = $row["client_firstname"];
               $mname = $row["client_middlename"];
               $lname = $row["client_lastname"];
               $id = $row['user_id'];
            }

            $_SESSION['fullname'] = $firstname . " " . $mname . " " . $lname;
         } elseif ($row["position"] == "Driver") {
            $selectYou = $pdo->prepare("SELECT * from `driver_list` where user_id = '$id'");
            $selectYou->execute();
            while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
               $firstname = $row["driver_firstname"];
               $mname = $row["driver_middlename"];
               $lname = $row["driver_lastname"];
               $toda = $row['toda'];
               $id = $row['user_id'];
            }
            $_SESSION['fullname'] = $firstname . " " . $mname . " " . $lname;
         } elseif ($row["position"] == "TODA-Admin") {
            $selectYou = $pdo->prepare("SELECT * from `driver_list` where user_id = '$id'");
            $selectYou->execute();
            while ($row = $selectYou->fetch(PDO::FETCH_ASSOC)) {
               $firstname = $row["driver_firstname"];
               $mname = $row["driver_middlename"];
               $lname = $row["driver_lastname"];
               $toda = $row['toda'];
               $id = $row['user_id'];
            }
            $_SESSION['fullname'] = $firstname . " " . $mname . " " . $lname;
            $_SESSION['toda'] = $toda;
         } else {
            $_SESSION['fullname'] = "Super Admin";
         }
         echo '<script type="text/javascript">
                jQuery(function validation(){
                
                swal({
                      title: "Good job! ' . $_SESSION['username'] . '",
                      text: "Details Matched!!",
                      icon: "success",
                      button: "Loading...",
                    });
                
                
                });
              </script>';


            header('refresh:1;home.php');
         
      }
   } else {

      echo '<script type="text/javascript">
            jQuery(function validation(){
            
            swal({
                  title: "Access Denied!",
                  text: "Details Did Not Matched!!",
                  icon: "error",
                  button: "Try Again",
                });
            
            
            });
          </script>';
   }
}

?>


<!DOCTYPE html>
<html lang="en">

<?php
include 'includes/head.php';
?>

<main>
   <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                  <div class="d-flex justify-content-center py-4"> <a href="index.php" class="logo d-flex align-items-center w-auto"> <img src="assets/img/logo.png" alt=""> <span class="d-none d-lg-block">TRider</span> </a></div>
                  <div class="card mb-3">
                     <div class="card-body">
                        <div class="pt-4 pb-2">
                           <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                           <p class="text-center small">Enter your username & password to login</p>
                        </div>
                        <form class="row g-3 needs-validation" method="POST" novalidate>
                           <div class="col-12">
                              <label for="yourUsername" class="form-label">Username</label>
                              <div class="input-group has-validation">
                                 <span class="input-group-text" id="inputGroupPrepend">@</span>
                                 <input type="text" name="username" class="form-control" id="yourUsername" required>
                                 <div class="invalid-feedback">Please enter your username.</div>
                              </div>
                           </div>
                           <div class="col-12">
                              <label for="yourPassword" class="form-label">Password</label>
                              <input type="password" name="password" class="form-control" id="yourPassword" required>
                              <div class="invalid-feedback">Please enter your password!</div>
                           </div>
                           <div class="col-12"> <button class="btn btn-primary w-100" type="submit" name="btn_login">Login</button></div>
                           <div class="col-12">
                              <p class="small mb-0">Don't have account? <a href="register.php">Create an account</a></p>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</main>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="assets/js/apexcharts.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/echarts.min.js"></script>
<script src="assets/js/quill.min.js"></script>
<script src="assets/js/simple-datatables.js"></script>
<script src="assets/js/tinymce.min.js"></script>
<script src="assets/js/validate.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/icheck.min.js"></script>
<script src="assets/js/sweetalert.js"></script>

</body>

</html>