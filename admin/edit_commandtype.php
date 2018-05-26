<?php
  @session_start();
  $arrClasses     = array('CommandsTypes', 'Session');
	include('core.inc.php');
	
	if(empty($_SESSION['user']))	echo "<script type='text/javascript'>window.location='index.php';</script>";

	$idCommandType	= (!empty($_REQUEST['commandtype_id']))  	? $_REQUEST['commandtype_id']          	:    0;
	$command		= (!empty($_REQUEST['command']))  			? $_REQUEST['command']              	:    0;
	
	//Variables
	$act_section  = 'administration';
	$act_item  		= 'commands_types';
	
	if( isset($_POST['edit']) ) {
		$CommandsTypes->update($idCommandType, $command);
	}
	$qCommandsTypes = $CommandsTypes->get($idCommandType, 'query');
?>
<!DOCTYPE html>
<!--[if lte IE 9]> <html class="lte-ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html lang="en"> <!--<![endif]-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Remove Tap Highlight on Windows Phone IE -->
    <meta name="msapplication-tap-highlight" content="no"/>

    <link rel="icon" type="image/png" href="assets/img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="assets/img/favicon-32x32.png" sizes="32x32">

    <title>Monitorator</title>

    <!-- additional styles for plugins -->
    <!-- weather icons -->
    <link rel="stylesheet" href="bower_components/weather-icons/css/weather-icons.min.css" media="all">
    <!-- metrics graphics (charts) -->
    <link rel="stylesheet" href="bower_components/metrics-graphics/dist/metricsgraphics.css">
    <!-- chartist -->
    <link rel="stylesheet" href="bower_components/chartist/dist/chartist.min.css">
    
    <!-- uikit -->
    <link rel="stylesheet" href="bower_components/uikit/css/uikit.almost-flat.min.css" media="all">

    <!-- flag icons -->
    <link rel="stylesheet" href="assets/icons/flags/flags.min.css" media="all">

    <!-- style switcher -->
    <link rel="stylesheet" href="assets/css/style_switcher.min.css" media="all">
    
    <!-- altair admin -->
    <link rel="stylesheet" href="assets/css/main.min.css" media="all">

    <!-- themes -->
    <link rel="stylesheet" href="assets/css/themes/themes_combined.min.css" media="all">
    
    <!-- fontawesome -->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">

    <!-- matchMedia polyfill for testing media queries in JS -->
    <!--[if lte IE 9]>
        <script type="text/javascript" src="bower_components/matchMedia/matchMedia.js"></script>
        <script type="text/javascript" src="bower_components/matchMedia/matchMedia.addListener.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
		<script type="text/javascript" src="assets/js/pages/form_validate.js"></script>
</head>
<body class=" sidebar_main_open sidebar_main_swipe">
    <!-- main header -->
    <?php $searh_not_include = 1; ?>
    <?php include('header.php')?>
    <!-- main header end -->
    
    <!-- main sidebar -->
    <?php include('aside.php')?>
    <!-- main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">
        	<div class="uk-notify uk-notify-bottom-center" style="<?=(!empty($_POST['edit'])) ? 'display: block' : 'display: none'?>">
						<div class="uk-notify-message uk-notify-message-success" style="opacity: 1; margin-top: 0px; margin-bottom: 10px;">
							<a class="uk-close"></a>
							<div>
								<a href="#" onclick="closeNotification()" class="notify-action">Cerrar</a> Acci&oacute;n completada!.
							</div>
						</div>
					</div>
					<div class="md-card uk-margin-medium-bottom">
						<div class="md-card-content">
							<div class="class="uk-width-medium-1-3" align="right">
							  <div class="md-card">
					      	<div class="md-card-content">
					        	<h3 class="heading_a">Editar comando</h3>
					          <div class="data-uk-grid-margin data-form-model">
					          	<form name="frmEditCommandType" id="frmEditCommandType" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
					          	<input type="hidden" name="edit" value="true" />
					          	<input type="hidden" name="commandtype_id" value="<?=$_REQUEST['commandtype_id']?>" />
					          	<div style="text-align: left;">
<?php
	while($row = $sqlCommon->myfetchassoc($qCommandsTypes)) {
?>
					            	<div class="uk-form-row">
					              	<label>Comando</label>
					                <input type="text" id="command" name="command" value="<?=$row['command']?>" class="md-input" />
					              </div>
<?php
	}
?>
	                  	</div>
	                  	<div class="uk-width-large-1-4 uk-width-medium-1-2">
	                    	<div class="uk-input-group">
	                      	<span class="uk-input-group-addon"><input type="button" class="md-btn" value="Volver" onclick="window.location.href = './list_commands-types.php?rnd=' + getNowDateTimeStr()" /><a class="md-btn" href="#" onclick="editCommandType()">Grabar</a></span>
	                      </div>
	                    </div>
	                  	</form>
		                </div>
		              </div>
								</div>
        </div>
			</div>
    </div>

    <!-- google web fonts -->
    <script>
        WebFontConfig = {
            google: {
                families: [
                    'Source+Code+Pro:400,700:latin',
                    'Roboto:400,300,500,700,400italic:latin'
                ]
            }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
            '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>

    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair common functions/helpers -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <script>
        $(function() {
            if(isHighDensity) {
                // enable hires images
                altair_helpers.retina_images();
            }
            if(Modernizr.touch) {
                // fastClick (touch devices)
                FastClick.attach(document.body);
            }
        });
    </script>

		<!-- right bar (manage) -->
    <?php include('manage.php')?>
    <!-- right bar (manage) -->

    <script>
        $(function() {
            var $switcher = $('#style_switcher'),
                $switcher_toggle = $('#style_switcher_toggle'),
                $theme_switcher = $('#theme_switcher'),
                $mini_sidebar_toggle = $('#style_sidebar_mini'),
                $boxed_layout_toggle = $('#style_layout_boxed'),
                $accordion_mode_toggle = $('#accordion_mode_main_menu'),
                $body = $('body');


            $switcher_toggle.click(function(e) {
                e.preventDefault();
                $switcher.toggleClass('switcher_active');
            });

            $theme_switcher.children('li').click(function(e) {
                e.preventDefault();
                var $this = $(this),
                    this_theme = $this.attr('data-app-theme');

                $theme_switcher.children('li').removeClass('active_theme');
                $(this).addClass('active_theme');
                $body
                    .removeClass('app_theme_a app_theme_b app_theme_c app_theme_d app_theme_e app_theme_f app_theme_g app_theme_h app_theme_i')
                    .addClass(this_theme);

                if(this_theme == '') {
                    localStorage.removeItem('altair_theme');
                } else {
                    localStorage.setItem("altair_theme", this_theme);
                }

            });

            // hide style switcher
            $document.on('click keyup', function(e) {
                if( $switcher.hasClass('switcher_active') ) {
                    if (
                        ( !$(e.target).closest($switcher).length )
                        || ( e.keyCode == 27 )
                    ) {
                        $switcher.removeClass('switcher_active');
                    }
                }
            });

            // get theme from local storage
            if(localStorage.getItem("altair_theme") !== null) {
                $theme_switcher.children('li[data-app-theme='+localStorage.getItem("altair_theme")+']').click();
            }


        // toggle mini sidebar

            // change input's state to checked if mini sidebar is active
            if((localStorage.getItem("altair_sidebar_mini") !== null && localStorage.getItem("altair_sidebar_mini") == '1') || $body.hasClass('sidebar_mini')) {
                $mini_sidebar_toggle.iCheck('check');
            }

            $mini_sidebar_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_sidebar_mini", '1');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_sidebar_mini');
                    location.reload(true);
                });


        // toggle boxed layout

            if((localStorage.getItem("altair_layout") !== null && localStorage.getItem("altair_layout") == 'boxed') || $body.hasClass('boxed_layout')) {
                $boxed_layout_toggle.iCheck('check');
                $body.addClass('boxed_layout');
                $(window).resize();
            }

            $boxed_layout_toggle
                .on('ifChecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.setItem("altair_layout", 'boxed');
                    location.reload(true);
                })
                .on('ifUnchecked', function(event){
                    $switcher.removeClass('switcher_active');
                    localStorage.removeItem('altair_layout');
                    location.reload(true);
                });

        // main menu accordion mode
            if($sidebar_main.hasClass('accordion_mode')) {
                $accordion_mode_toggle.iCheck('check');
            }

            $accordion_mode_toggle
                .on('ifChecked', function(){
                    $sidebar_main.addClass('accordion_mode');
                })
                .on('ifUnchecked', function(){
                    $sidebar_main.removeClass('accordion_mode');
                });


        });
    </script>
</body>
</html>