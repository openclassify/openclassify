// Initialize and add the map
function loadScript(src,callback){
    var script = document.createElement("script");
    script.type = "text/javascript";
    if(callback)script.onload=callback;
    document.getElementsByTagName("head")[0].appendChild(script);
    script.src = src;
}

loadScript('https://maps.googleapis.com/maps/api/js?key=AIzaSyCAGc0z8kg9rKGVy2FizFKoz0FoWWWzoGQ&callback=initMap');

function initMap() {
    // The location of Uluru

    var lat = $('#lat').data();
    var long = $('#long').data();

    console.log(lat);

    var uluru = {lat: Number(lat['content']), lng: Number(long['content'])};
    // The map, centered at Uluru
    var map = new google.maps.Map(
        document.getElementById('page-map'), {zoom: 10, center: uluru});
    // The marker, positioned at Uluru
    var marker = new google.maps.Marker({position: uluru, map: map});
}
