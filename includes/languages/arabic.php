<?php 

    function lang($phrase) {

        static $lang = array (
            'DIRECTION' 	=> 'rtl',
            
            'Profile'      => 'حسابي',
            'New_Item'   => 'عنصر جديد',
            'My_Items'   => 'عناصري',
            'LOGOUT'        => 'تسجيل خروج',
            // Navbar links
            'HomePage'    => 'الرئيسية' ,
            'Handmade'    => 'مصنوعات يدوية' ,
            'Computers'         => 'أجهزة الكمبيوتر' ,
            'Cell phones'       => 'هواتف خليوية' ,
            'Clothing'       => 'ملابس' ,
            'Tools'    => 'أدوات' ,
            'Samsung'          => 'سامسونج',
            'Hammers' => 'المطارق',
            'iPhone mobiles'  => 'هواتف iPhone',
        );
        return $lang[$phrase];
    }