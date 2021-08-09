<?php 

    function lang($phrase) {

        static $lang = array (
            // Navbar links
            'HOME_ADMIN'    => 'الرئيسية' ,
            'CATEGORIES'    => 'الأقسام' ,
            'ITEMS'         => 'العناصر' ,
            'MEMBERS'       => 'أعضاء' ,
            'COMMENTS'       => 'التعليقات' ,
            'STATISTICS'    => 'إحصائيات' ,
            'LOGS'          => 'السجلات',
            'DROPDOWN_Name' => 'أحمد',
            'EDIT_PROFILE'  => 'تعديل الملف الشخصي',
            'SETTINGS'      => 'إعدادات',
            'LOGOUT'        => 'تسجيل خروج',

            'Admin_Login'   => 'تسجيل دخول المشرف',
        );
        return $lang[$phrase];
    }