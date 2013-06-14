<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>BoltBus</h1> 
        <div class="avg_rate" data-company="<?php echo $company->id ?>"></div>
    </div>

    <hr />
    <div class="well well-large justified">
        Bolt understands that customers expect simplicity when it comes to traveling on a bus. And when it comes to a frequent rider program, we’re keeping it simple as well. 

Introducing the Bolt Rewards program. No miles, no restrictions. Simply take eight trips on BoltBus and you’re eligible for a free one-way ticket trip. 

That’s it. No strings attached. Valid at any time, regardless of time of day, day of week, or even holiday travel. You’ve earned it, so why not use it whenever you want? 

    </div>
    <?php echo View::factory('company/social_buttons')->bind("company", $company)->render(); ?>
</div>