<?php
  @session_start();
  $arrClasses     = array('Clients', 'Users', 'Session');
  include('core.inc.php');
  
  if(!empty($_POST['login_username']) & !empty($_POST['login_password']) & !empty($_POST['login_client'])) {
  	
		$arrUser = $Users->validate_login($_POST['login_username'], $_POST['login_password'], $_POST['login_client'], 'fetch_array');
		
		if(!empty($arrUser['idUser']) & !empty($arrUser['client'])) {
			  $Session->user_session($arrUser['idUser'], $arrUser['user'], $arrUser['pass'], $arrUser['fname'], $arrUser['lname'], $arrUser['email'], $arrUser['state'], $arrUser['permissions'], $arrUser['client'],  $arrUser['idClient']);
				echo '<script type="text/javascript">window.location.href = "default.php";</script>';
				//header("Location: default.php");
		} else {
				$messageLogin = '<div class="uk-alert">Usuario y/o contraseña no válidos!</div>';
		}
	}
	$qClients = $Clients->selectClientsActive('query');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Monitorator</title>
    <link rel="stylesheet" href="assets/css/login_page.min.css" />

</head>
<body class="login_page">
		<div class="login_page_wrapper">
				<div class="login_heading"><img src="assets/img/logo-monitorator.png" alt=""/></div>
    		<div class="md-card" id="login_card">
            <div class="md-card-content large-padding" id="login_form">
                <div class="login_heading">
                    <div class="user_avatar"></div>
                </div>
                <form name="frmLogin" method="post">
                		<?=$messageLogin?>
                    <div class="uk-form-row">
                        <label for="login_username">Usuario</label>
                        <input class="md-input" type="text" id="login_username" name="login_username" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_password">Contraseña</label>
                        <input class="md-input" type="password" id="login_password" name="login_password" />
                    </div>
                    <div class="uk-form-row">
                        <label for="login_username">Cliente</label>
                        <select class="md-input" id="login_client" name="login_client">
                        	<option value="">Seleccione una opci&oacute;n</option>
<?php
		while($row = $sqlCommon->myfetchassoc($qClients)) {
?>
													<option value="<?=$row['idClient']?>"><?=$row['client']?></option>
<?php
		}
?>
                        </select>	
                    </div>
                    <div class="uk-margin-medium-top">
                        <a href="javascript:void(0)" onclick="frmLogin.submit();" class="md-btn md-btn-primary md-btn-block md-btn-large">Ingresar</a>
                    </div>
                    <div class="uk-margin-top">
                        <a href="#" id="login_help_show" class="uk-float-right">Necesita ayuda?</a>
                        <span class="icheck-inline">
                            <input type="checkbox" name="login_page_stay_signed" id="login_page_stay_signed" data-md-icheck />
                            <label for="login_page_stay_signed" class="inline-label">Permanacer conectado</label>
                        </span>
                    </div>
                </form>
            </div>
            <div class="md-card-content large-padding uk-position-relative" id="login_help" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_b uk-text-success">No puedes iniciar sesión?</h2>
                <p>Aquí está la información para ayudarle a volver a su cuenta tan pronto como sea posible.</p>
                <p>En primer lugar , trata de la cosa más fácil : si recuerda su contraseña , pero no está funcionando , asegúrese de que el bloqueo de mayúsculas está apagado , y que su nombre de usuario está escrito correctamente y vuelve a intentarlo.</p>
                <p>Si la contraseña sigue sin funcionar , es hora de <a href="#" id="password_reset_show">restablecer su contraseña</a>.</p>
            </div>
            <div class="md-card-content large-padding" id="login_password_reset" style="display: none">
                <button type="button" class="uk-position-top-right uk-close uk-margin-right uk-margin-top back_to_login"></button>
                <h2 class="heading_a uk-margin-large-bottom">Restablecer contraseña</h2>
                <form>
                    <div class="uk-form-row">
                        <label for="login_email_reset">Tu correo electrónico</label>
                        <input class="md-input" type="text" id="login_email_reset" name="login_email_reset" />
                    </div>
                    <div class="uk-margin-medium-top">
                        <a onclick="restorePass();" class="md-btn md-btn-primary md-btn-block">Restablecer la contraseña</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- common functions -->
    <script src="assets/js/common.min.js"></script>
    <!-- uikit functions -->
    <script src="assets/js/uikit_custom.min.js"></script>
    <!-- altair core functions -->
    <script src="assets/js/altair_admin_common.min.js"></script>

    <!-- altair login page functions -->
    <script src="assets/js/pages/login.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_validate.js"></script> 

</body>
</html>