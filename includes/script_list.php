<script type="text/javascript" charset="utf8" src="assets/js/jquery-3.4.1.min.js"></script>
<script src="assets/js/jquery.validate.js"></script>
<script type="text/javascript" charset="utf8" src="assets/js/datatable.js"></script>
<script type="text/javascript" charset="utf8" src="assets/js/dataTables.bootstrap5.min.js"></script>
<script src="assets/js/apexcharts.min.js"></script>
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/chart.min.js"></script>
<script src="assets/js/echarts.min.js"></script>
<script src="assets/js/quill.min.js"></script>
<script src="assets/js/tinymce.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/toastr.min.js"></script>

<script>function initMap() {
   
  const origin = { lat: 15.744431800053126,
            lng: 121.57686467671813 };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 18,
    center: origin,
  });

  new ClickEventHandler(map, origin);
}

function isIconMouseEvent(e) {
  return "placeId" in e;
}

class ClickEventHandler {
  origin;
  map;
  directionsService;
  directionsRenderer;
  placesService;
  infowindow;
  infowindowContent;
  constructor(map, origin) {
    this.origin = origin;
    this.map = map;
    this.directionsService = new google.maps.DirectionsService();
    this.directionsRenderer = new google.maps.DirectionsRenderer();
    this.directionsRenderer.setMap(map);
    this.placesService = new google.maps.places.PlacesService(map);
    this.infowindow = new google.maps.InfoWindow();
    this.infowindowContent = document.getElementById("infowindow-content");
    this.infowindow.setContent(this.infowindowContent);
    // Listen for clicks on the map.
    this.map.addListener("click", this.handleClick.bind(this));
  }
  handleClick(event) {
    console.log("You clicked on: " + event.latLng);
    // If the event has a placeId, use it.
    if (isIconMouseEvent(event)) {
      console.log("You clicked on place:" + event.placeId);
      // Calling e.stop() on the event prevents the default info window from
      // showing.
      // If you call stop here when there is no placeId you will prevent some
      // other map click event handlers from receiving the event.
      event.stop();
      if (event.placeId) {
        this.calculateAndDisplayRoute(event.placeId);
        this.getPlaceInformation(event.placeId);
      }
    }
  }
  calculateAndDisplayRoute(placeId) {
    const me = this;

    this.directionsService
      .route({
        origin: this.origin,
        destination: { placeId: placeId },
        travelMode: google.maps.TravelMode.WALKING,
      })
      .then((response) => {
        me.directionsRenderer.setDirections(response);
      })
      .catch((e) => window.alert("Directions request failed due to " + status));
  }
  getPlaceInformation(placeId) {
    const me = this;

    this.placesService.getDetails({ placeId: placeId }, (place, status) => {
      if (
        status === "OK" &&
        place &&
        place.geometry &&
        place.geometry.location
      ) {
        me.infowindow.close();
        me.infowindow.setPosition(place.geometry.location);
        me.infowindowContent.children["place-icon"].src = place.icon;
        me.infowindowContent.children["place-name"].textContent = place.name;
        me.infowindowContent.children["place-id"].textContent = place.place_id;
        me.infowindowContent.children["place-address"].textContent =
          place.formatted_address;
        me.infowindow.open(me.map);
      }
    });
  }
}

window.initMap = initMap;


function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else {
    alert("Geolocation is not supported by this browser.");
  }
}


</script>