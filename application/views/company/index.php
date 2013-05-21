<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1><?php echo $company->name ?></h1>  
    </div>

    <hr />
    <div class="well well-large justified">
        <?php echo $company->description ?>
    </div>
    <div class="centered">
        <a href="<?php echo URL::site('compare') ?>">Follow this link to view all companies at one page</a>
    </div>
</div>