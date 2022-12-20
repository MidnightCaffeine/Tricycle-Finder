<div class="content-map">
    <div class="mappings">
        <div id="map"> </div>
    </div>

    <!-- nilipat ko dito sa baba nung div map itong script para maload niya ng una itong map muna -->
    <script>
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">


        function initMap() {
            var map = new google.maps.Map(document.getElementById('map'), {
                mapTypeControl: false,
                center: {
                    lat: 15.67,
                    lng: 121.55
                },
                zoom: 2
            });

            new AutocompleteDirectionsHandler(map);

        }

        /**
         * @constructor
         */
        function AutocompleteDirectionsHandler(map) {
            this.map = map;
            this.originPlaceId = null;
            this.destinationPlaceId = null;
            this.travelMode = 'DRIVING';
            var originInput = document.getElementById('origin-input');
            var destinationInput = document.getElementById('destination-input');
            /*  var modeSelector = document.getElementById('mode-selector');
            No reason pa para ilagay to kung driving lang din ang option, might aswell disregard
            tutal wala din naman akong nakitang nagcocompute siya kung ilang Kilometers ang meron sa
            destination kaya wala lang din tong silbi
            */
            this.directionsService = new google.maps.DirectionsService;
            this.directionsDisplay = new google.maps.DirectionsRenderer;
            this.directionsDisplay.setMap(map);

            var originAutocomplete = new google.maps.places.Autocomplete(
                originInput, {
                    placeIdOnly: true
                });
            var destinationAutocomplete = new google.maps.places.Autocomplete(
                destinationInput, {
                    placeIdOnly: true
                });

            this.setupClickListener('changemode-driving', 'DRIVING');

            this.setupPlaceChangedListener(originAutocomplete, 'ORIG');
            this.setupPlaceChangedListener(destinationAutocomplete, 'DEST');
            /*
            itong part na to nag edit nalang ako sa CSS ng itsura nung mga buttons mo

                      //  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(originInput);
                      //  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(destinationInput);
                      //  this.map.controls[google.maps.ControlPosition.TOP_LEFT].push(modeSelector);
            */
        }

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        AutocompleteDirectionsHandler.prototype.setupClickListener = function(id, mode) {
            var radioButton = document.getElementById(id);
            var me = this;
            radioButton.addEventListener('click', function() {
                me.travelMode = mode;
                me.route();
            });
        };

        AutocompleteDirectionsHandler.prototype.setupPlaceChangedListener = function(autocomplete, mode) {
            var me = this;
            autocomplete.bindTo('bounds', this.map);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.place_id) {
                    window.alert("Please select an option from the dropdown list.");
                    return;
                }
                if (mode === 'ORIG') {
                    me.originPlaceId = place.place_id;
                } else {
                    me.destinationPlaceId = place.place_id;
                }
                me.route();
            });

        };

        AutocompleteDirectionsHandler.prototype.route = function() {
            if (!this.originPlaceId || !this.destinationPlaceId) {
                return;
            }
            var me = this;

            this.directionsService.route({
                origin: {
                    'placeId': this.originPlaceId
                },
                destination: {
                    'placeId': this.destinationPlaceId
                },
                travelMode: this.travelMode

            }, function(response, status) {
                if (status === 'OK') {
                    me.directionsDisplay.setDirections(response);

                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
            /*
Ito yung sinend ko sayo na gagawin na solusyon para lumabas yung choice na pinili dun sa origin and destination
  */
            document.getElementById("originDest").value = document.getElementById("origin-input").value;
            document.getElementById("destDest").value = document.getElementById("destination-input").value;

        };
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDhJTfM7zUxZ6B8DY0i2YMAksOs6huSJDs&libraries=places&callback=initMap" async defer></script>

</div>
<!-- itong google search na dive ipinasok ko lang ung form sa div na to para maiayos yung CSS niya. -->
<div class="google-search">
    <form role="form" action="bookform.php" method="post">
        <div class="input">

            <input id="origin-input" class="controls" type="text" name="originDest" placeholder="Enter an origin location" required>

            <input id="destination-input" class="controls" type="text" name="destDest" placeholder="Enter a destination location" required>
            <input type="hidden" name="exactloc" value="" ;>
            <input type="hidden" name="drivermsg" value="" ;>
            <div id="mode-selector" class="controls">

                <button type="submit" class="continue" name="btn_book" id="changemode-driving"> Continue </button>
                <!--  <a href="bookform.php">
              <button type="submit" class="continue" name="btn_book" id="changemode-driving">Continue</button>
            </a> -->
            </div>
        </div>

        <!--
Nagdagdag ako ng dalawang hidden inputs para pag lalagyan nung mga origin and destination dun sa bookform.php
 -->
        <input type="hidden" name="originDest" id="originDest" value="">
        <input type="hidden" name="destDest" id="destDest" value="">
    </form>


</div>
</div>