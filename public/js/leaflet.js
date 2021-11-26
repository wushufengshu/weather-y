const locationiq = "{{config('myconfig.leaflet')  }}";

var map = L.map("map", {
    center: [40.7259, -73.9805],
    zoom: 12,
    scrollWheelZoom: true,
    zoomControl: false,
    attributionControl: false,
});

var geocoderControlOptions = {
    bounds: false,
    markers: false,
    attribution: null,
    expanded: true,
    panToPoint: false,
    params: {
        dedupe: 1,
        tag: "place:city",
    },
};

var geocoderControl = new L.control.geocoder(locationiq, geocoderControlOptions)
    .addTo(map)
    .on("select", function (e) {
        displayLatLon(e.feature.feature.display_place);
    });

var searchBoxControl = document.getElementById("search-box");

var geocoderContainer = geocoderControl.getContainer();

searchBoxControl.appendChild(geocoderContainer);

function displayLatLon(display_place) {
    var city = display_place;

    document.getElementById("cityname").innerHTML = city;
    fetchdata(city);
}

$(document).ready(function () {
    // var input = $('#search-box').find(':input');
    // input.attr('name', 'city_name');
    // input.val("{{ !empty(app('request')->input('city_name')) ? app('request')->input('city_name') : '' }}")
});
function fetchdata(city_name) {
    $.ajax({
        type: "GET",
        success: function (msg) {
            console.log(msg);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(thrownError);
        },
    });
}
