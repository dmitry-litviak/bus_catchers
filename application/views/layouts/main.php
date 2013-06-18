<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo Kohana::$config->load('config')->get('Site Title') ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <script type="text/javascript">
            var SYS = {baseUrl: '<?php echo URL::base() ?>'}
        </script>

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <?php echo Helper_Output::renderCss(); ?>

        <link href="http://fonts.googleapis.com/css?family=Chewy" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Abel" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Terminal+Dosis+Light" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Maven+Pro" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Cuprum" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Dosis:500' rel='stylesheet' type='text/css'>
    </head>
    <body id="pageBody">
        <div id="fb-root"></div>
        <div id="divBoxed" class="container">
            <?php echo View::factory('layouts/partials/header')->render(); ?>
            <div class="contentArea">
                <div class="divPanel notop page-content">
                    <?php if (!empty($_SESSION['user'])): ?>
                        <h5 class="status-line">You are logged in as <span class="label label-important"><?php echo $_SESSION['user']['displayName'] ?></span></h5>
                    <?php endif; ?>
                    <div class="row-fluid">
                        <?php echo $content; ?>
                    </div>
                    <div id="footerInnerSeparator"></div>
                </div>
            </div>
            <?php echo View::factory('layouts/partials/footer')->render(); ?>
        </div>
        <div id="toTop">^ Back to Top</div>
        <br /><br /><br />
        <?php echo Helper_Output::renderJs(); ?>
    </body>
</html>