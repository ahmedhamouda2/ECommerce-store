<?php 

    function lang($phrase) {

        static $lang = array (
            'message' => 'welcome' ,
            'name' => 'ahmed'
        );
        return $lang[$phrase];
    }