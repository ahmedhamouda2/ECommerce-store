<?php 

    function lang($phrase) {
        
        static $lang = array (
            'message' => 'مرحبا' ,
            'name' => 'أحمد'
        );
        return $lang[$phrase];
    }