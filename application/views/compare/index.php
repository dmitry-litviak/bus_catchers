<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>Find Tickets</h1>
        <h4>Are you a frequent traveller or commuter? Search all available bus tickets at once for better pricing and less hassle.</h4>  
    </div>

    <hr />
    <?php foreach ($companies as $key => $company): ?>
        <div class="row-fluid">
            <div class="span4 company_container">
                <img class="company_logo" src="<?php echo URL::site("img/logos") . '/' . $company->image ?>" />
            </div>
            <div class="span4 company-name">
                <a class="comp_name" href="<?php echo URL::site('company/info/'. $company->name) ?>" target="_blank"><?php echo $company->name ?></a>
            </div>
            <div class="span4 company_container">
                <div class="stars" data-company="<?php echo $company->id ?>"></div>
            </div>
        </div>
        <hr>
    <?php endforeach; ?>
</div>