<div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

<div class="divPanel notop nobottom">
    <div class="row-fluid">
        <div class="span5">

            <div id="divLogo">
                <a href="<?php echo URL::base() ?>" id="divSiteTitle">Bus Catchers</a><br />
                <a href="<?php echo URL::base() ?>" id="divTagLine">Catch your bus (beta)</a>
            </div>

        </div>
        <div class="span7">

            <div id="divMenuRight" class="pull-right">
                <div class="navbar">
                    <button type="button" class="btn btn-navbar-highlight btn-large btn-primary" data-toggle="collapse" data-target=".nav-collapse">
                        NAVIGATION <span class="icon-chevron-down icon-white"></span>
                    </button>
                    <div class="nav-collapse collapse">
                        <ul class="nav nav-pills ddmenu">
<!--                            <li class="dropdown active"><a href="index.html">Home</a></li>-->
<!--                            <li class="dropdown"><a href="grid.html">Grid</a></li>-->
<!--                            <li class="dropdown"><a href="simple.html">Simple</a></li>-->
                            <?php Helper_Mainmenu::render() ?>
                            <?php if (!empty($_SESSION['user'])): ?>
                                <li class="dropdown"><a href="<?php echo URL::site("company/logout") ?>">Logout</a></li>
                            <?php else: ?>
                                <li class="dropdown">
                                    <a href="javascript: void(0)" class="dropdown-toggle">Sign In <b class="caret"></b></a>
                                    <ul class="dropdown-menu" style="display: none;">
                                        <li><a href="<?php echo URL::site("company/login?type=Facebook") ?>"><i class="icon-facebook"></i>&nbsp&nbsp Sign in with Facebook</a></li>
                                        <li><a href="<?php echo URL::site("company/login?type=Twitter") ?>"><i class="icon-twitter"></i> Sign in with Twitter</a></li>
                                        <li><a href="<?php echo URL::site("company/login?type=Google") ?>"><i class="icon-google-plus"></i> Sign in with Google</a></li>
                                    </ul>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>