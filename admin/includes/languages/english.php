<?php 

    function lang($phrase) {

        static $lang = array (
            // Navbar links
            'HOME_ADMIN'    => 'Home' ,
            'CATEGORIES'    => 'Categories' ,
            'ITEMS'         => 'Items' ,
            'MEMBERS'       => 'Members' ,
            'STATISTICS'    => 'Statistics' ,
            'LOGS'          => 'Logs',
            'DROPDOWN_Name' => 'Ahmed',
            'EDIT_PROFILE'  => 'Edit Profile',
            'SETTINGS'      => 'Settings',
            'LOGOUT'        => 'Logout',

            'Admin_Login'   => 'Admin Login' 
        );
        return $lang[$phrase];
    }