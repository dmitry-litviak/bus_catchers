<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>BoltBus</h1>  
    </div>

    <hr />
    <div class="well well-large justified">
        Bolt understands that customers expect simplicity when it comes to traveling on a bus. And when it comes to a frequent rider program, we’re keeping it simple as well. 

Introducing the Bolt Rewards program. No miles, no restrictions. Simply take eight trips on BoltBus and you’re eligible for a free one-way ticket trip. 

That’s it. No strings attached. Valid at any time, regardless of time of day, day of week, or even holiday travel. You’ve earned it, so why not use it whenever you want? 

    </div>
    <div class="centered">
        <a href="<?php echo URL::site('compare') ?>">Follow this link to view all companies at one page</a>
    </div>
    <hr>
    <div class="social-buttons">
        <?php if (empty($_SESSION['user'])): ?>
            <h3>For leaving a comment you should sign in</h3>
            <a class="btn fb" href="<?php echo URL::site("company/login?type=Facebook") ?>">Sign in with Facebook</a>
            <a class="btn tw" href="<?php echo URL::site("company/login?type=Twitter") ?>">Sign in with Twitter</a>
            <a class="btn gl" href="<?php echo URL::site("company/login?type=Google") ?>">Sign in with Google</a>
        <?php else: ?>
            <h3>You logged in as <?php // echo $_SESSION['user']['displayName'] ?></h3>
        <?php endif; ?>
    </div>
</div>