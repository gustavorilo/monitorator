<?php
    Class Paginator extends SQLCommon
    {
        function __construct(){
        }
        
        function paginate($page=0, $bypage=_bypage_) {
            return ($page * $bypage) / $bypage;
        }
    }
?>