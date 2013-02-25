<div class="transparent-bg" style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;z-index: -1;zoom: 1;"></div>

<div class="divPanel notop nobottom">
    <div class="row-fluid">
        <div class="span5">

            <div id="divLogo">
                <a href="<?php echo URL::base() ?>" id="divSiteTitle">Bus Catchers</a><br />
                <a href="<?php echo URL::base() ?>" id="divTagLine">Catch your bus</a>
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
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row-fluid">
        <div class="span12">

            <div id="headerSeparator"></div>

<!--            <div class="row-fluid">-->
<!--                <div class="span6">-->
<!---->
<!--                    <div id="divHeaderText" class="page-content">-->
<!--                        <div id="divHeaderLine1">Start Booking Now!</div><br />-->
<!--                        <div id="divHeaderLine2">Are you a frequent traveller or commuter? Search all available bus tickets at once for better pricing and less hassle.</div><br />-->
<!--                        <div id="divHeaderLine3"><a class="btn btn-secondary" href="#">Secondary Button</a>    <a class="btn btn-primary" href="#">Primary Button</a></div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--                <div class="span6">-->
<!---->
<!--                    <div id="imgHeader">-->
<!--                        <img src="styles/BoltBus.png" title="" />-->
<!--                    </div>-->
<!---->
<!--                </div>-->
<!--            </div>-->

            <div id="headerSeparator2"></div>

        </div>
    </div>
</div>