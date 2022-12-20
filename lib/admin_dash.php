<div class="col-lg-8">
               <div class="row">
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">SATODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='SATODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">BACTTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='BACTTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">BARTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='BARTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">BATODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='BATODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">CASTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='CASTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">CENTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='CENTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">KIPTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='KIPTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">METODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='METODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">NTSTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='NTSTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">RETODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='RETODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">SUKTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='SUKTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">ZACECTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='ZACECTODA'");
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
                  <div class="col-xxl-4 col-md-6">
                     <div class="card info-card sales-card">
                        <div class="card-body">
                           <h5 class="card-title">ZACEMTODA Total Booking<span>| Todays</span></h5>
                           <?php
                           $countStudent = $pdo->prepare("SELECT * FROM `bookings` WHERE toda='ZACEMTODA'");
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
                        $userlog = $pdo->prepare("SELECT * FROM `user_log` ORDER BY log_id ASC limit 20");
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