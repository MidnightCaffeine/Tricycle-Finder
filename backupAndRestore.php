<!DOCTYPE html>
<html lang="en">
<?php
date_default_timezone_set('Asia/Manila');
$page = 'Home';
session_start();

if (!isset($_SESSION['username'])) {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}

include 'lib/connection.php';
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/side_nav.php';
?>
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Backup And Restore</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Home</a></li>
                <li class="breadcrumb-item active">Backup And Restore</a></li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">

        <div class="container">
            <div class="row">
                <div class="col-6 mb-4">
                    <div class="card">
                        <h4 class="card-title ms-4">Backup</h4>
                        <p class="card-text ms-4">Save backup of the database.</p>
                        <div class="d-grid gap-2 ms-4 mb-4 me-4">
                            <a class="btn btn-primary" href="backup_function.php">Backup</a>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-block">
                            <h4 class="card-title ms-4">Restore</h4>
                            <p class="card-text ms-4">Restore data of the database.</p>
                            <div class="d-grid gap-2 ms-4 mb-4 me-4">
                                <a class="btn btn-primary" href="restore_function.php">Restore</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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