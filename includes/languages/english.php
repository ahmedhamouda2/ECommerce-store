<?php 

    function lang($phrase) {

        static $lang = array (
            'DIRECTION'     => 'ltr',

            'Profile'      => 'My Profile',
            'New_Item'   => 'New Item' ,
            'My_Items'   => 'My Items' ,
            'LOGOUT'        => 'Logout',
            // Navbar links
            'HomePage'    => 'HomePage' ,
            'Handmade'    => 'Handmade' ,
            'Computers'         => 'Items' ,
            'Cell phones'       => 'Cell phones' ,
            'Clothing'      => 'Clothing' ,
            'Tools'    => 'Tools' ,
            'Samsung'          => 'Samsung',
            'Hammers' => 'Hammers',
            'iPhone mobiles'  => 'iPhone mobiles',
        );
        return $lang[$phrase];
    }