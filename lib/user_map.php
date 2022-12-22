<div class="row">
    <div class="col-sm-8">

        <div class="content-map">
            <div class="mappings">
                <div id="map"> </div>
            </div>
        </div>

    </div>
    <div class="col-sm-4">
        <div class="card mb-3">
            <div class="card-body">

                <form method="POST" action="">
                    <div class="pt-2 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Book A Ride</h5>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="fullname" class="form-label">Name</label>
                        <input type="text" name="fullname" class="form-control" id="fullname" value="<?php echo $_SESSION['fullname'] ?>" readonly>
                        <div class="invalid-feedback">Please, enter your Firstname!</div>
                    </div>

                    <div class="col-12 mb-2">
                        <label for="distance" class="form-label">Distance</label>
                        <input type="text" name="distance" class="form-control" id="distance" readonly>
                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    <div class="col-12 mb-2">
                        <label for="fare" class="form-label">Fare</label>
                        <div class="input-group flex-nowrap">
                            <span class="input-group-text" id="pesoSign">₱</span>
                            <input type="text" class="form-control" aria-label="fare" aria-describedby="pesoSign" name="fare" id="fare" readonly>
                        </div>
                    </div>

                    <div class="col-12 mb-3">
                        <label for="place" class="form-label">Destination</label>
                        <input type="text" name="place" class="form-control" id="place" readonly>
                        <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>

                    <input type="text" name="endcoordinates" class="form-control" id="endcoordinates" hidden>
                    <input type="text" name="startcoordinates" class="form-control" id="startcoordinates" hidden>

                    <div class="d-grid gap-2 mt-2">
                        <button type="submit" class="btn btn-success" name="book_now">Book</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


<script>
  function initMap() {

    const origin = {
      lat: 15.743808170730249,
      lng: 121.57761176454434
    };
    const map = new google.maps.Map(document.getElementById("map"), {
      zoom: 20,
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
          destination: {
            placeId: placeId
          },
          travelMode: google.maps.TravelMode.DRIVING,
        })
        .then((response) => {
          me.directionsRenderer.setDirections(response);

          document.getElementById("distance").value = response.routes[0].legs[0].distance.text;
          var cptDistance = response.routes[0].legs[0].distance.text;
          var faretemp = cptDistance.split(' ');
          document.getElementById("fare").value = Math.ceil(faretemp[0] * 9.2);
          document.getElementById("startcoordinates").value = response.routes[0].legs[0].start_location;
          document.getElementById("endcoordinates").value = response.routes[0].legs[0].end_location;
        })
        .catch((e) => window.alert("Directions request failed due to " + status));
    }
    getPlaceInformation(placeId) {
      const me = this;

      this.placesService.getDetails({
        placeId: placeId
      }, (place, status) => {
        if (
          status === "OK" &&
          place &&
          place.geometry &&
          place.geometry.location
        ) {
          document.getElementById("place").value = place.name;
          me.infowindow.close();
          me.infowindow.setPosition(place.geometry.location);
          me.infowindowContent.children["place-icon"].src = place.icon;
          me.infowindowContent.children["place-name"].textContent = place.name;
          me.infowindowContent.children["place-id"].textContent = place.place_id;
          me.infowindowContent.children["place-address"].textContent = place.formatted_address;
          me.infowindow.open(me.map);
        }
      });
    }
  }

  window.initMap = initMap;
</script>