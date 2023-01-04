<script src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>

<!DOCTYPE html>
<html lang="en">
<?php
include_once 'lib/connection.php';
$page = 'Register';

session_start();


if (isset($_SESSION['username'])) {

   header("Location: home.php");
}

date_default_timezone_set('Asia/Manila');
$d = date("Y-m-d");
$t = date("h:i:s A");
$action = 'Register';

if (isset($_POST['btn_signup'])) {

   $firstname = ucwords(strtolower($_POST['firstname']));
   $lastname = ucwords(strtolower($_POST['lastname']));
   $middlename = ucwords(strtolower($_POST['middlename']));
   $username = $_POST['username'];
   $email = $_POST['email'];
   $password = $_POST['password'];
   $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
   $suffix = $_POST['suffix'];
   $gender = $_POST['sex'];
   $phone = $_POST['phone'];
   $position = 'User';


   //echo $username ."-".$useremail."-".$password."-".$userrole;

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

include 'includes/head.php';

?>

</head>

<body>
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
                              <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                              <p class="text-center small">Enter your personal details to create account</p>
                           </div>
                           <form id="signupForm" class="row g-3" method="post" action="">
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
                                 <input maxlength = "11" type="text" name="phone" class="form-control" id="phone" onkeypress="return checkNumber(event)" required>
                                 <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                              </div>
                              <div class="col-12">
                                 <label for="password" class="form-label">Password</label>
                                 <div class="input-group has-validation">
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <span class="input-group-text" id="inputGroupPrepend">
                                       <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </span>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                 </div>
                              </div>

                              <!-- Driver Registration

                              <div class="input-group mb-3 mt-3">
                                 <label class="input-group-text" for="position">Position</label>
                                 <select class="form-select" id="position" name="position">
                                    <option value="User" selected>User</option>
                                    <option value="Driver">Driver</option>
                                 </select>
                              </div>


                              <div id="box" onchange="showDiv(this)">
                                 <div class="col-12">
                                    <label for="plateNumber" class="form-label">Plate Number</label>
                                    <input type="text" name="plateNumber" class="form-control" id="plateNumber" required>
                                    <div class="invalid-feedback">Please enter your Plate Number!</div>
                                 </div>
                                 <div class="col-12">
                                    <label for="license" class="form-label">License</label>
                                    <input type="text" name="license" class="form-control" id="license" required>
                                    <div class="invalid-feedback">Please enter your License number!</div>
                                 </div>
                                 <div class="col-12">
                                    <label for="toda" class="form-label">TODA</label>
                                    <input type="text" name="toda" class="form-control" id="toda" required>
                                    <div class="invalid-feedback">Please enter your TODA!</div>
                                 </div>
                                 <div class="col-12">
                                    <label for="mtop" class="form-label">MTOP</label>
                                    <input type="text" name="mtop" class="form-control" id="mtop" required>
                                    <div class="invalid-feedback">Please enter your MTOP!</div>
                                 </div>
                              </div>
-->

                              <div class="col-12">
                                 <div class="form-check">
                                    <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required> <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                                    <div class="invalid-feedback">You must agree before submitting.</div>
                                 </div>
                              </div>
                              <div class="col-12">
                                 <input name="btn_signup" id="signup" class="btn btn-primary w-100" type="submit" value="Signup" />
                              </div>
                              <div class="col-12">
                                 <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
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
  
   <!--
   <script>
      const el = document.getElementById('position');

      const box = document.getElementById('box');
      box.style.display = 'none';

      el.addEventListener('change', function handleChange(event) {
         if (event.target.value === 'Driver') {
            box.style.display = 'block';
         } else {
            box.style.display = 'none';
         }
      });
   </script>
   -->

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