<?php use_stylesheet(sfConfig::get('app_css_place')) ?>
<?php use_javascript(sfConfig::get('app_js_mustache')) ?>
<?php slot(
  'title',
  sprintf('Rootless - Rideboard'))
?>
<!--
<script src="http://github.com/janl/mustache.js/raw/master/mustache.js"></script>-->
<script type="text/javascript" >

$(document).ready(function()
{
    var place = {
        id: 1,
        name: "Eagle Point Resort",
        address: "123 Mountain Road, Mountainside, UT, 12345",
        location: {
            lat: 13.1234,
            lon: -40.232343
        },
        website_url: "http://eaglepoint.com",
        slug: "eagle_point_resort",
        is_partner: true,
        contact_url: "contact@eaglepoint.com",
        phone: "1-800-123-0987",
        logo: "eaglepoint.png",
        type: "establishment",
        category: "recreation",
        subcategory: "ski",
        place_url: "http://rootless.me/places/1",
        description: "",
        extra: ""
    };
    var template = document.getElementById('placeTemplate').innerHTML 
//    var template = $('#placeTemplate').html();
    var html = Mustache.to_html(template, place);
    document.getElementById('sampleArea').innerHTML = html;
//    $('#sampleArea').html(html);
});
</script>

<!-- Mustache templates -->
<script id="placeTemplate" type="text/template">

    <h1>Share a Ride to {{name}}</h1>

    <div id="placeRideDetails">
        <div id="placeRideFormContainer">
            <form>
            </form>
        <div/>
        <div id="placeRideResponseContainer">
        <div/>
    </div>
    <div id="placeDetails" >
        <div id="placeLocationDetails" >
            <div id="map"></div>
            <div id="placeAddressDetails">
                {{name}} | <a href="{{website_url}}" >{{website_url}}</a><br />
                {{address}}
            </div>
        </div>
    </div>

</script>


<div id="sampleArea"></div>