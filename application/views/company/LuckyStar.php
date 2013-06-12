<div class="span12" id="divMain">

    <div style="text-align:center">
        <h1>LuckyStar</h1>  
    </div>

    <hr />
    <div class="well well-large justified">
        Established in 2003, Lucky River Transportation Inc offers competitive fare to customers traveling between Boston and New York City. Since then, Lucky Star evolved from a family style operation business into a corporation which maintains its fleet of more than 20 luxury motor coaches from the state of the art maintenance facility. "We are serious about our service because we strive to provide a professional, dependable and safe environment to our passengers."    
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
            <h3>You logged in as <?php echo $_SESSION['user']['displayName'] ?></h3>
            <a class="btn gl" href="<?php echo URL::site("company/logout") ?>">Logout</a>
        <?php endif; ?>
    </div>
</div>