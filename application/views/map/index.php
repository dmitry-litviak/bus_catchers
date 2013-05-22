<div class="span12" id="divMain">
    <input type="hidden" id="d_lat" value="<?php echo $d_city->lat ?>">
    <input type="hidden" id="d_long" value="<?php echo $d_city->long ?>">
    <div style="text-align:center">
        <h1>Explore the map</h1>
        <h4>Search for stations near you</h4>  
    </div>

    <div class="tabbable"> <!-- Only required for left/right tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1" data-toggle="tab">Origin City</a></li>
            <li><a href="#tab2" data-toggle="tab">Arrival City</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab1">
                <div id='gmaps-canvas' class="map_canvas"></div>
            </div>
            <div class="tab-pane" id="tab2">
                <div id='gmaps-canvas' class="map_canvas"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js" ></script>