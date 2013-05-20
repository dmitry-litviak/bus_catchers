<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>Find Tickets</h1>
        <h4>Are you a frequent traveller or commuter? Search all available bus tickets at once for better pricing and less hassle.</h4>
        <h4>
            <strong>Notice:</strong> Fung Wah is currently out of service
        </h4>    
    </div>

    <hr />
    <div class="row-fluid">
        <div class="span4">
            <form id="schedule" action="<?php echo URL::site('home/get_schedule') ?>" method="POST">
                <h2 style="text-align:center" >Options:</h2>
                <div>
                    <label>Origin city:</label>
                    <select name="depart_city" class="span12">
                        <option value="NULL" selected>-- select city --</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?php echo $city->name . ', ' . $city->region ?>"><?php echo $city->name . ', ' . $city->region ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <label>Arrival city:</label>
                    <select name="arrive_city" class="span12">
                        <option value="NULL" selected>-- select city --</option>
                        <?php foreach ($cities as $city): ?>
                            <option value="<?php echo $city->name . ', ' . $city->region ?>"><?php echo $city->name . ', ' . $city->region ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div>
                    <label>Departure Date:</label>
                    <select name="depart_time" class="span12">
                        <?php foreach ($dates as $date): ?>
                            <option value="<?php echo $date[1] ?>"><?php echo $date[0] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="row-fluid">
                    <div class="span4">
                        <label>Companies:</label>
                        <?php foreach ($companies as $company): ?>
                            <label class="checkbox">
                                <input type="checkbox" value="<?php echo $company->name ?>" name="companies[]" checked>
                                <span class="company-name" data-content="<?php echo Helper_Output::cut_string($company->description, 200) ?>" ><?php echo $company->name ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <div class="span8 info-block justified" style="height: 200px">
                    </div>
                </div>
                <div style="text-align:center">
                    <input class="btn btn-primary" value="Search Schedules" type="submit">
                </div>
            </form>
        </div>
        <div class="span8">
            <h2 style="text-align:center" >Search results:</h2>
            <div style="text-align:center" id="search_res_div">
                <h4 id="search_res_text" style="text-align:center">Choose options and press "Search Schedule" to show results</h4>
                <!-- <img src="styles/BoltBus.png" title="" /> -->
            </div>
        </div>
    </div>
    <br />

</div>