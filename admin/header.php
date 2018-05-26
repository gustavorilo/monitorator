<?php
	$user_avatar = '';
  if( !empty($_SESSION['user']) ) {
		$user_avatar = 'assets/img/avatars/avatar_'.strtolower($_SESSION['user']['fname']).'_'.strtolower($_SESSION['user']['lname']).'@4x.png';
	  $user_avatar = (file_exists($user_avatar)) ? $user_avatar : 'assets/img/avatars/user@2x.png';
	}
  //echo date('d/MM/YYYY H:i:S');
?>
<header id="header_main">
    <div class="header_main_content">
        <nav class="uk-navbar">
                            
            <!-- main sidebar switch -->
            <a href="#" id="sidebar_main_toggle" class="sSwitch sSwitch_left">
                <span class="sSwitchIcon"></span>
            </a>
            
            <!-- secondary sidebar switch -->
            <a href="#" id="sidebar_secondary_toggle" class="sSwitch sSwitch_right sidebar_secondary_check">
                <span class="sSwitchIcon"></span>
            </a>
            
            <div class="uk-navbar-flip">
                <ul class="uk-navbar-nav user_actions">
                    <li><a href="#" id="full_screen_toggle" class="user_action_icon uk-visible-large"><i class="material-icons md-24 md-light">&#xE5D0;</i></a></li>
                    <?php if( empty($searh_not_include) ) { ?>
                    <li><a href="#" id="main_search_btn" class="user_action_icon"><i class="material-icons md-24 md-light">&#xE8B6;</i></a></li>
                    <?php } ?>
                    <li data-uk-dropdown="{mode:'click',pos:'bottom-right'}">
                        <a href="#" class="user_action_image"><img class="md-user-image" src="<?=$user_avatar?>" alt=""/></a>
                        <div class="uk-dropdown uk-dropdown-small">
                            <ul class="uk-nav js-uk-prevent">
                                <li><a href="page_user_profile.php">Mis datos</a></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="header_main_search_form">
        <form name="frmList" id="frmList" action="<?=$_SERVER['PHP_SELF']?>" method="get">
     	  <input type="hidden" id="search" name="search" value="" />
     	  <input type="hidden" id="page" name="page"  value="0" />
        <i class="md-icon header_main_search_close material-icons">&#xE5CD;</i>
        <input type="text" class="header_main_search_input" />
        <button class="header_main_search_btn uk-button-link"><i class="md-icon material-icons">&#xE8B6;</i></button>
      	</form>
    </div>
</header>