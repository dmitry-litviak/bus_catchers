<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container-fluid">
        <a class="brand" href="<?php echo URL::site() ?>">MasterLogoDesign Admin Side</a>
        <div class="nav-collapse collapse">
          <p class="navbar-text pull-right">
            Logged in as <a href="#" class="navbar-link"><?php echo Auth::instance()->get_user()->email?></a> |
              <a href="<?php echo URL::site('session/logout') ?>" class="navbar-link">Logout</a>
          </p>
        </div><!--/.nav-collapse -->
      </div>
    </div>
</div>