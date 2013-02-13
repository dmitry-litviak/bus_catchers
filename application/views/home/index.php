<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>Buy Tickets</h1>
    </div>
    <hr />
    <div class="row-fluid">
        <div class="span4">
            <form id="schedule" action="<?php echo URL::site('home/get_schedule') ?>" method="POST">
                <h2 style="text-align:center" >Options:</h2>
                <div>
                    <label>Departure City:</label>
                    <select name="depart_city" class="span12">
                        <?php foreach($cities as $city): ?>
                            <option value="<?php echo $city->name . ', ' . $city->region ?>"><?php echo $city->name . ', ' . $city->region ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <label>Arrival City:</label>
                    <select name="arrive_city" class="span12">
                        <?php foreach($cities as $city): ?>
                        <option value="<?php echo $city->name . ', ' . $city->region ?>"><?php echo $city->name . ', ' . $city->region ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <label>Departure Date:</label>
                    <select name="depart_time" class="span12">
                        <?php foreach($dates as $date): ?>
                        <option value="<?php echo $date[1] ?>"><?php echo $date[0] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <?php foreach($companies as $company): ?>
                    <label class="checkbox">
                        <input type="checkbox" value="<?php echo $company->name ?>" name="companies[]" checked>
                        <?php echo $company->name ?>
                    </label>
                <?php endforeach; ?>
                <div style="text-align:center">
                    <input class="btn btn-primary" value="Search Schedules" type="submit">
                </div>
            </form>
        </div>
        <div class="span8">
            <h2 style="text-align:center" >Search results:</h2>
            <div id="search_res_div"><h4 id="search_res_text" style="text-align:center">Choose options and press "Search Schedule" to show results</h4></div>
        </div>
    </div>
    <br />

</div>