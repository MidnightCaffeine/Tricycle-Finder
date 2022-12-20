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

            <div id="map"> </div>
            <script>
                function initMap() {
                    // The location of Uluru
                    const uluru = {
                        lat: -25.344,
                        lng: 131.031
                    };
                    // The map, centered at Uluru
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 4,
                        center: uluru,
                    });
                    // The marker, positioned at Uluru
                    const marker = new google.maps.Marker({
                        position: uluru,
                        map: map,
                    });
                }

                window.initMap = initMap;
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhJTfM7zUxZ6B8DY0i2YMAksOs6huSJDs&libraries=places&callback=initMap" async defer></script>

        </div>
    </section>
</main>

<?php
include 'includes/footer.php';
include 'includes/script_list.php';
?>
</body>

</html>