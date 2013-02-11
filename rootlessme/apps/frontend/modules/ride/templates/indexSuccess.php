<?php use_javascript(sfConfig::get('app_google_map_script')) ?>
<?php use_stylesheet(sfConfig::get('app_css_ride')) ?>

<?php slot(
  'title',
  sprintf('Rootless - Rideboard'))
?>

<?php slot('gmapheader'); ?>
    <script type="text/javascript" src="/js/map/<?php echo sfConfig::get('app_js_map_search'); ?>"></script>
    <script type="text/javascript" src="<?php echo sfConfig::get('app_jquery_form_script') ?>"></script>
    <script type="text/javascript" src="/js/underscore.js"></script>
    <script type="text/javascript" src="/js/ext/moment.js"></script>

    <script type="text/javascript">   
      $(document).ready(function(){
          
        $( ".datePicker" ).datepicker();  
        
        //rootless namespace that should be added to our global template
        var rootless = Rootless.getInstance({sessionId : 'indexSuccess'});
       
       //the map object
        var map = Rootless.Map.Search.getInstance({mapId : 'map', el: {
            $originLatitude       : $("#rides_origin_latitude"),
            $originLongitude      : $("#rides_origin_longitude"),
            $destinationLatitude  : $("#rides_destination_latitude"),
            $destinationLongitude : $("#rides_destination_longitude")
        }
        });
        map.mapInit();
      });
    </script>
    

<?php end_slot();?>

<div id="map"></div>
<h1 class="findRide green">Find rides</h1>
<div id="searchForm" class="middleRidesFormArea">
    <?php include_partial('rideSearchForm', array('rideSearchForm' => $searchForm)) ?>
</div>
<img id="loader" alt="Loading spinner" src="/images/ajax-loader.gif" style="left: 50%; margin-left: -15px; top: 0; position: relative; top: 75px;" />
<div id="results"></div>
<script id="rideTableTemplate" type="template/javascript">
    <table class="rideTable">
        <thead>
            <tr>
                <th><h2 class="dateHeader orange"><%= moment(date).format('MMMM D, YYYY') %></h2></th>
            </tr>
    	</thead>
        <tbody>
            <% _.each(obj.rides, function(ride) { %>
                <tr>
                	<td class="person-td">
	                	<a class="tableLink hide" href="/rides/<%= (ride.is_driver) ? 'offer': 'request' %>/<%= ride.id %>"></a>
	                	<img class="rideListDriverCreatorProfileImage" src="<%= ride.person.picture_small_url %>" />
		                <span class="ride-table-name">
		                    <%= ride.person.first_name %><br />
		                    <%= ride.person.last_name %><br />
		                </span>
	               	    <div class="icon <%= (ride.is_driver) ? 'driver': 'passenger' %>"></div>
	
	                    <span id="ride-<% if(ride.is_driver) { print('carpool-'); } else { print('passenger-'); } print(ride.id); %>" class="hidden routePolyline"><%= ride.route.encoded_polyline %></span>
                    </td>
                    <td class="origin-td"><%= ride.route.origin_string %></td>
            		<td><span class="icon destination-arrow"></span></td>
            		<td class="destination-td"><%= ride.route.destination_string %></td>
            		<td>
            	        <div class="seatContainer"><h2 class="seatCount"><%= ride.seat_count %></h2><span class="seatText">seat<%= (ride.seat_count == 1) ? '' : 's' %> <%= (ride.is_driver) ? 'available': 'requested' %></span></div>
            	        <div class="cost green"><%= (ride.asking_price != null) ? '$' + ride.asking_price + ' per seat' : 'price negotiable' %></div>
                    </td>
                </tr>
            <% }); %>
        </tbody> 
    </table>
</script>
<script id="noRide" type="template/javascript">
	<div class="noRide">
	    <% if(obj.results.length) { %>
	    	<div class="options">
		        <a class="cta" href="/rides/new/offer">Offer a ride</a> 
		        <span class='or'>or</span>
		        <a class="cta" href="/rides/new/request">Request a ride</a>
	        </div>
	        <p>Haven’t found what you are looking for? Post your ride!</p>
        <% } else { %>
        	<div class="options">
	            <p>No rides matched your search, but all is not lost! Search again or post your ride!</p>
		        <a class="cta" href="/rides/new/offer">Offer a ride</a> 
		        <span class='or'>or</span>
		        <a class="cta" href="/rides/new/request">Request a ride</a>
	        </div>
        <% } %>
    </div>
</script>
