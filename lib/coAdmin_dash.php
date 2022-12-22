<?php
if (isset($_POST['addQue'])) {
   $status = 'Available';
   $dId = $_POST['id'];
   $fullname = $_POST['fullname'];

   $insert = $pdo->prepare("INSERT into queuing(driver_name, driver_id, que_status) values(:name, :id ,:status)");

   $insert->bindParam(':name', $fullname);
   $insert->bindParam(':id', $dId);
   $insert->bindParam(':status', $status);
   $insert->execute();
}

?>

<div class="col-lg-8">
   <div class="row">
      <div class="col-xxl-4 col-md-6">
         <div class="card info-card sales-card">
            <div class="card-body">
               <h5 class="card-title"><?php echo $_SESSION['toda']; ?> Total Booking<span>| Todays</span></h5>
               <?php
               $toda = '' . $_SESSION['toda'];
               $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='$toda'");
               $countStudent->execute();

               $count = 0;

               while ($row = $countStudent->fetch(PDO::FETCH_ASSOC)) {
                  $count++;
               }
               ?>
               <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center"><i class='bx bxs-face'></i></div>
                  <div class="ps-3">
                     <h6><?php echo $count; ?></h6>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="row">
      <div class="col-sm-4">

         <div class="pt-2 pb-2">
            <h5 class="card-title text-center pb-0 fs-4">Que List</h5>
         </div>

         <table id="quelist" class="display table table-bordered">
            <thead>
               <tr>
                  <th>ID</th>
                  <th>Name</th>
               </tr>
            </thead>
            <tbody>

               <?php
               $userlog = $pdo->prepare("SELECT * FROM `queuing` WHERE que_status='Available' ORDER BY que_id ASC");
               $userlog->execute();
               while ($row = $userlog->fetch(PDO::FETCH_ASSOC)) { ?>
                  <tr>
                     <td><?php echo $row['driver_id']; ?></td>
                     <td><?php echo $row['driver_name']; ?></td>
                  </tr>
               <?php
               }
               ?>

            </tbody>
         </table>

      </div>
      <div class="col-sm-8">
         <div class="card mb-3">
            <div class="card-body">

               <div class="pt-2 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Add to Que</h5>
               </div>

               <table id="que" class="display table table-bordered">
                  <thead>
                     <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">add</th>
                     </tr>
                  </thead>
                  <tbody>

                     <?php
                     $userlog = $pdo->prepare("SELECT * FROM `driver_list` WHERE driver_firstname!='admin' ORDER BY user_id ASC");
                     $userlog->execute();
                     while ($row = $userlog->fetch(PDO::FETCH_ASSOC)) {
                        $name = $row['driver_firstname'] . ' ' . $row['driver_middlename'] . ' ' . $row['driver_lastname'];

                     ?>
                        <tr>
                           <form method="POST">
                              <td><?php echo $row['user_id']; ?> <input name="id" value="<?php echo $row['user_id']; ?>" hidden></td>
                              <td><?php echo $name; ?> <input name="fullname" value="<?php echo $name; ?>" hidden></td>
                              <td><button type="submit" name="addQue" class="btn btn-success" data-toggle="tooltip" title="Add To Que"><i class="bi bi-bookmark-plus"></i></button></td>
                           </form>
                        </tr>

                     <?php
                     }
                     ?>

                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>

</div>
<!--History Logs-->
<div class="col-lg-4">
   <div class="card">
      <div class="card-body">
         <h5 class="card-title">History Logs<span>| Today</span></h5>
         <div class="activity">
            <?php
            $userlog = $pdo->prepare("SELECT * FROM `user_log` ORDER BY log_id ASC limit 10");
            $userlog->execute();
            while ($row = $userlog->fetch(PDO::FETCH_ASSOC)) {
               $datetime1 = new DateTime($row['logTime']); // Date post was created
               $datetime2 = new DateTime(); // Default DateTime is now
               $interval = $datetime1->diff($datetime2);
            ?>
               <div class="activity-item d-flex">
                  <div class="activite-label"><?php echo $interval->format('%h hours ago'); ?></div>
                  <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                  <div class="activity-content"> <?php echo $row['username'];  ?> <a href="#" class="fw-bold text-dark"><?php echo $row['action']; ?></a></div>
               </div>

            <?php
            }
            ?>
         </div>
      </div>
   </div>
</div>



<script>
   $('#que').DataTable({
      pagingType: 'full_numbers',
      responsive: true,
      columnDefs: [{
         'targets': [0, 2, 3, 4, 5],
         /* column index */

         'orderable': false,
         /* true or false */
      }, ],
   });
   $('#quelist').DataTable({
      pagingType: 'full_numbers',
      responsive: true,
      columnDefs: [{
         'targets': [0, 2, 3, 4, 5],
         /* column index */

         'orderable': false,
         /* true or false */
      }, ],
   });
</script>

<div id="myModal" class="modal fade">
   <div class="modal-dialog modal-confirm  modal-dialog-centered">
      <div class="modal-content">
         <div class="modal-header flex-column">
            <div class="icon-box">
               <i class="material-icons">&#xE5CD;</i>
            </div>
            <h4 class="modal-title w-100">Are you sure?</h4>
         </div>
         <div class="modal-body">
            <p>Do you really want to delete these records? This process cannot be undone.</p>
         </div>
         <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form action="lib/student/deleteStudent.php" method="post">
               <input type="hidden" name="id" value="<?php echo $stdId; ?>">
               <button type="submit" name="delete" class="btn btn-danger">Delete</button>
            </form>
         </div>
      </div>
   </div>
</div>