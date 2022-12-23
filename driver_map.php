<?php
include 'lib/connection.php';
session_start();

if (!isset($_SESSION['username'])) {
    session_unset();
    session_write_close();
    session_destroy();
    header("Location: index.php");
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $select = $pdo->prepare("SELECT * FROM `bookings` WHERE `booking_id` = '$id' ORDER BY booking_id ASC");
    $select->execute();

    while ($row = $select->fetch(PDO::FETCH_ASSOC)) {
        $originLat = $_GET['originLat'];
        $originLng = $_GET['originLng'];

        $destinationLat = $_GET['destLat'];
        $destinationLng = $_GET['destLng'];
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
        <h1>Driver Map</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                <li class="breadcrumb-item active">Driver Map</li>
            </ol>
        </nav>
    </div>
    <section class="section dashboard">
        <div class="row">
            <input id='originLatLng' value="<?php echo $originLat . ', ' . $originLng; ?>" hidden>
            <input id='destinationLatLng' value="<?php echo $destinationLat . ', ' . $destinationLng;; ?>" hidden>
            <div class="content-map">
                <div class="mappings">
                    <div id="map"> </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php
include 'includes/footer.php';
include 'includes/script_list.php';
?>

<script>
    function initMap() {
        const directionsService = new google.maps.DirectionsService();
        const directionsRenderer = new google.maps.DirectionsRenderer();
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: {
                lat: 15.743808170730249,
                lng: 121.57761176454434
            },
        });

        directionsRenderer.setMap(map);

        calculateAndDisplayRoute(directionsService, directionsRenderer);


        document.getElementById("originLatLng");
        document.getElementById("destinationLatLng");
    }

    function calculateAndDisplayRoute(directionsService, directionsRenderer) {
        directionsService
            .route({
                origin: {
                    query: document.getElementById("originLatLng").value,
                },
                destination: {
                    query: document.getElementById("destinationLatLng").value,
                },
                travelMode: google.maps.TravelMode.DRIVING,
            })
            .then((response) => {
                directionsRenderer.setDirections(response);
            })
            .catch((e) => window.alert("Directions request failed due to " + status));
    }

    window.initMap = initMap;
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhJTfM7zUxZ6B8DY0i2YMAksOs6huSJDs&libraries=places&callback=initMap" async defer></script>

</body>

</html>