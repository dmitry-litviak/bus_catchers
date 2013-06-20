<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1 class="my-font">Find Tickets</h1>
        <h4>Are you a frequent traveller or commuter? Search all available bus tickets at once for better pricing and less hassle.</h4>  
    </div>

    <hr />
    <div class="row-fluid">
        <div class="span4">
            <form id="schedule" action="<?php echo URL::site('home/get_schedule') ?>" method="POST">
                <h2 class="my-font" style="text-align:center" >Options:</h2>
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
                <div>
                    <label>Time Range:</label>
                    <div class="row-fluid">
                        <select name="time_beg" class="span6">
                            <?php for ($i = 5; $i <= 1435; $i += 5): ?>
                                <?php $date = Helper_Output::create_date($i); ?>
                                <option value="<?php echo $date ?>"><?php echo $date ?></option>
                            <?php endfor ?>
                        </select>
                        <select name="time_end" class="span6">
                            <?php for ($i = 5; $i <= 1435; $i += 5): ?>
                                <?php $date = Helper_Output::create_date($i); ?>
                                <option <?php echo $i == 1435 ? 'selected' : '' ?> value="<?php echo $date ?>"><?php echo $date ?></option>
                            <?php endfor ?>
                        </select>
                    </div>
                </div>
                <br>
                <div style="text-align:center">
                    <input class="btn btn-primary" value="Search Schedules" type="submit">
                </div>

                <hr>
                <label>Companies:</label>
                <label class="checkbox" style="width: 35%">
                    <span>
                        <input type="checkbox" value="all" name="all" checked>
                        <span>All companies</span>
                    </span>
                </label>
                <div class="row-fluid">
                    <div class="span6 right-smth">
                        <?php foreach ($companies as $company): ?>
                            <label class="checkbox">
                                <span>
                                    <input type="checkbox" value="<?php echo $company->name ?>" name="companies[]" class="c_name" checked>
                                    <span class=""  ><?php echo $company->name ?></span>
                                </span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <div class="left-smth" >

                        <?php foreach ($companies as $company): ?>
                            <div class="label label-important read-more" data-trigger="click" data-content="<?php echo Helper_Output::cut_string($company->description, 150) ?>" data-title="<?php echo $company->name ?>"><i class="icon-arrow-right icon-white info-link"></i></div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <br>
            </form>
        </div>
        <div class="span8">
            <h2 class="my-font" style="text-align:center" >Search results:</h2>
            <div style="text-align:center" id="search_res_div">
                <h4 id="search_res_text" style="text-align:center">Choose options and press "Search Schedule" to show results</h4>
                <!-- <img src="styles/BoltBus.png" title="" /> -->
            </div>
        </div>
    </div>
    <br />

</div>