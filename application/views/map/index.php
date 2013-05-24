<div class="span12" id="divMain">
    <input type="hidden" id="d_lat" value="<?php echo $d_city->lat ?>">
    <input type="hidden" id="d_long" value="<?php echo $d_city->long ?>">
    <input type="hidden" id="a_lat" value="<?php echo $a_city->lat ?>">
    <input type="hidden" id="a_long" value="<?php echo $a_city->long ?>">
    <div class="centered">
        <h1>Explore the map</h1>
        <h4>Search for stations near you</h4>  
        <hr>
    </div>
    <?php if (!empty($get)): ?>
        <h3 class="centered">From "<?php echo $get['depart'] ?>" to "<?php echo $get['arrive'] ?>"</h3>
    <?php else: ?>
        <h3 class="centered">For all cities</h3>
    <?php endif ?>
    <div class="centered">
        <?php if (!empty($get)): ?>
            <label class="checkbox inline">
                <span>
                    <input type="checkbox" value="all" name="all" >
                    <span>All companies</span>
                </span>
            </label>
            <?php foreach ($companies as $company): ?>
                <label class="checkbox inline">
                    <span>
                        <input type="checkbox" value="<?php echo $company->name ?>" name="companies" <?php echo in_array($company->name, $get['company']) ? "checked" : "" ?> >
                        <span><?php echo $company->name ?></span>
                    </span>
                </label>
            <?php endforeach; ?>
        <?php else: ?>
            <label class="checkbox inline">
                <span>
                    <input type="checkbox" value="all" name="all" checked>
                    <span>All</span>
                </span>
            </label>
            <?php foreach ($companies as $company): ?>
                <label class="checkbox inline">
                    <span>
                        <input type="checkbox" value="<?php echo $company->name ?>" name="companies" checked >
                        <span><?php echo $company->name ?></span>
                    </span>
                </label>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
    <hr>
    <div class="row-fluid">
        <div class="span6">
            <h3 class="centered">Origin City</h3>
            <div id='gmaps-canvas-depart' class="map_canvas"></div>
        </div>
        <div class="span6 pull-right">
            <h3 class="centered">Arrival City</h3>
            <div id='gmaps-canvas-arrive' class="map_canvas"></div>
        </div>
    </div>

</div>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerclusterer/src/markerclusterer_compiled.js" ></script>