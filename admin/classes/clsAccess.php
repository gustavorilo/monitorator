<?php
    Class Access
    {
        function isLogedBackend()
        {
            return (!empty($_SESSION['user']))  ? true : false;
        }
        
        function withAccessCheckTagClientByRequest()
        {
            return (!empty($_SESSION['permissions']['check_tag_client_by_request']))    ? true : false;
        }
        
        function withAccessCheckTagProspectByRequest()
        {
            return (!empty($_SESSION['permissions']['check_tag_prospect_by_request']))    ? true : false;
        }
        
        function withAccessClients()
        {
            return (!empty($_SESSION['permissions']['clients_administration']))    ? true : false;
        }
        
        function withAccessProspects()
        {
            return (!empty($_SESSION['permissions']['prospects_administration']))    ? true : false;
        }
        
        function withAccessChangePass()
        {
            return (!empty($_SESSION['permissions']['change_password']))    ? true : false;
        }
    }
?>
