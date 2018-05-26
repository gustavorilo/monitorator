<aside id="sidebar_main">
    <div class="sidebar_main_header"></div>
    <div class="menu_section">
        <ul>
            <li class="<?=($act_section == 'dashboard') ? 'current_section' : ''?>" title="Dashboard">
							<a href="default.php">
    						<span class="menu_icon"><i class="material-icons">&#xE871;</i></span>
    						<span class="menu_title">Dashboard</span>
							</a>
            </li>
            
            <li title="Administration">
            <a href="#">
                <span class="menu_icon"><i class="material-icons">&#xE8D2;</i></span>
                <span class="menu_title <?=(($act_section) == 'administration') ? 'current_section' : ''?>">Administración</span>
            </a>
            <ul>
								<li class="<?=(($act_item) == 'entities') ? 'act_item' : ''?>"><a href="list_entities.php">Entidades</a></li>
								<li class="<?=(($act_item) == 'commands_types') ? 'act_item' : ''?>"><a href="list_commands-types.php">Tipos de comandos</a></li>
								<li class="<?=(($act_item) == 'report') ? 'act_item' : ''?>"><a href="report.php">Reportes</a></li>
								<li style="border-bottom: 1px dotted #000000; margin: 10px auto; width: 80%;"></li> 
           	</ul>
            </li>
          </ul>
    </div>
</aside>