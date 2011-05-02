<?php use_javascript("jquery.js") ?>

<?php slot(
  'title',
  sprintf('Rootless Me - New ride offer'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript"
        src="http://maps.google.com/maps/api/js?sensor=false">
    </script>
    <script type="text/javascript">
        var map = null;
        var directionDisplay;
        var directionsService = new google.maps.DirectionsService();
        var geocoder;

        // Function when the page is ready
        $(document).ready(function(){

            // Google map loading
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var myOptions = {
                zoom: 8,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("map"),
                myOptions);
            geocoder = new google.maps.Geocoder();
            directionsDisplay = new google.maps.DirectionsRenderer();
            directionsDisplay.setMap(map);



            // Preview Route button
            $('#previewRouteButton').click(previewRoute);

            // Route preview changes whenever the user finished editing the
            // origin or destination textboxes
            $('#carpools_origin').change(previewRoute);
            $('#carpools_destination').change(previewRoute);
           
        });

        function previewRoute() {
            if ($("#carpools_origin").val())
            {
                // Get the location of the origin, and place a marker on the map
                var originValue = $("#carpools_origin").val();
                var originGeocodeRequest = {
                    address: originValue
                };
                geocoder.geocode(originGeocodeRequest, showResults);
            }

            if ($("#carpools_destination").val())
            {
                // Get the location of the destination, and place a marker on the map
                var destinationValue = $("#carpools_destination").val();
                var destinationGeocodeRequest = {
                    address: destinationValue
                };
                geocoder.geocode(destinationGeocodeRequest, showResults);
            }

            // Get the directions
            calcRoute();
        }

        function showResults(results, status) {
          //var reverse = (clickMarker != null);

          if (! results) {
            alert("Geocoder did not return a valid response");
          } else {
//            document.getElementById("statusValue").innerHTML = status;
//            document.getElementById("statusDescription").innerHTML = GeocoderStatusDescription[status];
//
//            document.getElementById("responseInfo").style.display = "block";
//            document.getElementById("responseStatus").style.display = "block";

            if (status == google.maps.GeocoderStatus.OK) {
//              document.getElementById("matchCount").innerHTML = results.length;
//              document.getElementById("responseCount").style.display = "block";
//              plotMatchesOnMap(results, reverse);


                var myLatlng = results[0].geometry.location;
                var marker = new google.maps.Marker({
                   position: myLatlng,
                   map: map,
                     title:"Hello World!"
                });
                map.panTo(myLatlng);
            } else {
//              if (! reverse) {
//                map.setCenter(new google.maps.LatLng(0.0, 0.0));
//                map.setZoom(1);
//              }
            }
          }
        }

        function calcRoute() {
          var start = $("#carpools_origin").val();
          var end = $("#carpools_destination").val();
          var request = {
            origin:start,
            destination:end,
            travelMode: google.maps.TravelMode.DRIVING
          };
          directionsService.route(request, function(result, status) {
            if (status == google.maps.DirectionsStatus.OK) {
              directionsDisplay.setDirections(result);
            }
          });
        }

//        function plotMatchesOnMap(results, reverse) {
//
//          markers = new Array(results.length);
//          var resultsListHtml = "";
//
//          var openInfoWindow = function(resultNum, result, marker) {
//            return function() {
//              if (selected != null) {
//                document.getElementById('p' + selected).style.backgroundColor = "white";
//                clearBoundsOverlays();
//              }
//
//              map.fitBounds(result.geometry.viewport);
//              infowindow.setContent(getAddressComponentsHtml(result.address_components));
//              infowindow.open(map, marker);
//
//              if (result.geometry.bounds) {
//                boundsOverlay = new google.maps.Rectangle({
//                  'bounds': result.geometry.bounds,
//                  'strokeColor': '#ff0000',
//                  'strokeOpacity': 1.0,
//                  'strokeWeight': 2.0,
//                  'fillOpacity': 0.0
//                });
//                boundsOverlay.setMap(map);
//                google.maps.event.addListener(boundsOverlay, 'click', onClickCallback);
//                document.getElementById('boundsLegend').style.display = 'block';
//              } else {
//                boundsOverlay = null;
//              }
//
//              viewportOverlay = new google.maps.Rectangle({
//                  'bounds': result.geometry.viewport,
//                  'strokeColor': '#0000ff',
//                  'strokeOpacity': 1.0,
//                  'strokeWeight': 2.0,
//                  'fillOpacity': 0.0
//                });
//              viewportOverlay.setMap(map);
//              google.maps.event.addListener(viewportOverlay, 'click', onClickCallback);
//              document.getElementById('viewportLegend').style.display = 'block';
//
//              document.getElementById('p' + resultNum).style.backgroundColor = "#eeeeff";
//              document.getElementById('matches').scrollTop =
//                document.getElementById('p' + resultNum).offsetTop -
//                document.getElementById('matches').offsetTop;
//              selected = resultNum;
//            }
//          }
//
//          for (var i = 0; i < results.length; i++) {
//            var icon = new google.maps.MarkerImage(
//              getMarkerImageUrl(i),
//              new google.maps.Size(20, 34),
//              new google.maps.Point(0, 0),
//              new google.maps.Point(10, 34)
//            );
//
//            markers[i] = new google.maps.Marker({
//              'position': results[i].geometry.location,
//              'map': map,
//              'icon': icon,
//              'shadow': shadow
//            });
//
//            google.maps.event.addListener(markers[i], 'click', openInfoWindow(i, results[i], markers[i]));
//
//            resultsListHtml += getResultsListItem(i, getResultDescription(results[i]));
//          }



    </script>

<?php end_slot();?>

<h1>New Offer</h1>
<?php include_partial('form', array('form' => $form)) ?>
<input id="previewRouteButton" type="button" value="Preview route" />
<div id="map" style="width: 400px; height: 400px;"></div>
