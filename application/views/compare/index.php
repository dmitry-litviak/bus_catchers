<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>Find Tickets</h1>
        <h4>Are you a frequent traveller or commuter? Search all available bus tickets at once for better pricing and less hassle.</h4>
        <h4>
            <strong>Notice:</strong> Fung Wah is currently out of service
        </h4>    
    </div>

    <hr />
    <?php foreach ($companies as $key => $company): ?>
        <div class="well well-large justified">
            <h4><a href="<?php echo URL::site('company/info/'. $company->name) ?>" target="_blank"><?php echo $company->name ?></a></h4>
            <?php echo $company->description ?>
        </div>
    <?php endforeach; ?>
</div>