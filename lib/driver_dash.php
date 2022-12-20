<div class="content-map">
   <div class="mappings">
      <div id="map"> </div>
   </div>

   <!-- nilipat ko dito sa baba nung div map itong script para maload niya ng una itong map muna -->
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