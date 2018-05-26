<?php
  @session_start();
  $arrClasses 	= array('Entities', 'Session');
	include('core.inc.php');
	
	if(empty($_SESSION['user']))	echo "<script type='text/javascript'>window.location='index.php';</script>";
	
	//Paginado
	$byReg			= 10;
	$byPage			= 25;
	$page 			= (isset($_GET['page'])) 	? $_GET['page']											: 0;
	$search			= (isset($_GET['search'])) 	? $_GET['search']									: '';
	$offset 		= $page * ($byPage + 1);
	
	//Variables
	$act_section  	= 'administration';
	$act_item  		= 'entities';
	
	$cantEntities	= $Entities->select($search, 0, '', 'mynumrows');
	$qEntities  	= $Entities->select($search, $offset, $byPage, 'query');
?>
<!doctype html>
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
    <?php include('header.php')?>
    <!-- main header end -->
    
    <!-- main sidebar -->
    <?php include('aside.php')?>
    <!-- main sidebar end -->

    <div id="page_content">
        <div id="page_content_inner">
					<div class="md-card uk-margin-medium-bottom">
						<div class="md-card-content">
							<div class="class="uk-width-medium-1-3" align="right">
								<button class="md-btn" data-uk-modal="{target:'#modal_lightbox'}">Nuevo</button>
								<div class="uk-modal" id="modal_lightbox">
                    <div class="uk-modal-dialog uk-modal-dialog-lightbox">
                        <button type="button" class="uk-modal-close uk-close uk-close-alt"></button>
                        <div class="md-card">
							            <div class="md-card-content">
							                <h3 class="heading_a">Agregar entidad</h3>
							                <div class="uk-grid data-uk-grid-margin">
							                    <div class="uk-width-medium-1-2">
							                        <div class="uk-form-row">
							                            <label>Entidad</label>
							                            <input type="text" id="entity" name="entity" class="md-input" />
							                        </div>
							                    </div>
							                </div>
							                <div class="uk-grid" data-uk-grid-margin>
							                    <div class="uk-width-large-1-4 uk-width-medium-1-2">
							                        <div class="uk-input-group">
							                            <span class="uk-input-group-addon"><a class="md-btn" href="#" onclick="addEntity()">Grabar</a></span>
							                        </div>
							                    </div>
							                </div>
							            </div>
							        </div>
                    </div>
                </div>
							</div>
<?php
	if($cantEntities > 0) {
?>
							<div class="uk-overflow-container">
										<table class="uk-table uk-table-nowrap">
                        <thead>
                        <tr>
                            <th class="uk-width-2-10">Entidad</th>
                             <th class="uk-width-2-10">Estado</th>
                            <th class="uk-width-2-10 uk-text-center">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
<?php
		while($row = $sqlCommon->myfetchassoc($qEntities)) {
?>
                            <tr>
                                <td><?=$row['entity']?></td>
                                <td><?=($row['state'] == 1) ? 'ACTIVO' : 'INACTIVO'?></td>
                                <td class="uk-text-center">
                                    <a href="edit_entity.php?entity_id=<?=$row['idEntity']?>"><i class="md-icon material-icons fa fa-pencil"></i></a>
                                    <!--a href="#" class="remove" id="entities_<?=$row['idEntity']?>"><i class="md-icon material-icons fa fa-remove"></i></a-->
                                </td>
                            </tr>
<?php
		}
?>                    
                        </tbody>
                    </table>
                </div>
								<div class="uk-margin-medium-top uk-text-center">
               	<?=($search != '') ? 'Término buscado: "<b>' . $search  . '</b>" &nbsp;&nbsp;|&nbsp;&nbsp; ' : ''?>
               	<?=$cantEntities?> entidades encontradas.
<?php
		
		$url       = $_SERVER['PHP_SELF'] . '?action=l';
	  $url      .= ($search != '') ? '&search=' . $search : '';
	  $cantPages = ceil($cantEntities / $byPage);
		
		if($cantEntities > $byPage) {
			
			$from = ((($page+1)-$byReg) > 0) 	? '' 	: 'display: none;';
			$to 	= (($page+1+$byReg) <= $cantPages) 								? '' 	: 'display: none;';
?>
                <ul class="uk-pagination uk-margin-medium-top">
                		<li style="<?=$from?>"><a href="<?=$url . '&page=' . ($page-$byReg)?>"><i class="uk-icon-angle-double-left"></i></a></li>
                		<li style="<?=($page > 0) ? '' : 'display: none;'?>"><a href="<?=$url . '&page=' . ($page-1)?>"><i class="uk-icon-angle-left"></i></a></li>
<?php
			$stop = (($page+$byReg) < $cantPages) ?  $page+$byReg : $cantPages;
			for($i=$page; $i < $stop; $i++) {
				$class = ($i == $page) ? "uk-active" : "";
?>
                    <li class="<?=$class?>"><span><a href="<?=$url . '&page=' . $i?>"><?=$i+1?></a></span></li>
<?php
			}	
?>
                    <li style="<?=(($page+1) < $cantPages) ? '' : 'display: none;'?>"><a href="<?=$url . '&page=' . ($page+1)?>"><i class="uk-icon-angle-right"></i></a></li>
                    <li style="<?=$to?>"><a href="<?=$url . '?page=' . ($page+$byReg)?>"><i class="uk-icon-angle-double-right"></i></a></li>
                </ul>
<?php
		}
	}	else {
?>
            		<div class="uk-overflow-container">
            			<?=($search != '') ? 'Término buscado: "<b>' . $search  . '</b>" &nbsp;&nbsp;|&nbsp;&nbsp; ' : ''?>
               		<?=$cantCircuits?> entidades encontradas.
            		</div>
<?php
	}
?>
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