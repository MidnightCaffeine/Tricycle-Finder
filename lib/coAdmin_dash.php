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