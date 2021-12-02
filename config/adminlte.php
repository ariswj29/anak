<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Aplikasi Ternak',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => true,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Aplikasi Ternak</b>',
    'logo_img' => 'vendor/adminlte/dist/img/mardawavector.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Anak',

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => true,
    'usermenu_desc' => true,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => false,
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-light-white',
    'classes_sidebar_nav' => '',    
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => true,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => 'profile',

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [

        // // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Cari',
            // 'color' => 'grey',
        ],
        [
            'text' => 'blog',
            'url'  => 'admin/blog',
            'can'  => 'manage-blog',
        ],

            // NAVBAR ADMIN 
        [
            'text'        => 'Dashboard',
            'url'         => 'home',
            'icon'        => 'fas fa-fw fa-home',
        ],
        [
            'text' => 'DATA MASTER',
            'icon' => 'fa fa-fw fa-users-cog',
            'submenu' => [
                [
                    'text' => 'Manajemen User',
                    'url'  => 'admin/user',
                    'icon' => 'fa fa-fw fa-users',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'PJUB',
                    'url'  => 'admin/pjub',
                    'icon' => 'fa fa-fw fa-user',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Mitra',
                    'url'  => 'admin/mitra',
                    'icon' => 'fa fa-fw fa-handshake',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Farm',
                    'url'  => 'admin/farm',
                    'icon' => 'fas fa-fw fa-warehouse',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Siklus',
                    'url'  => 'admin/siklus',
                    'icon' => 'fa fa-fw fa-th',
                    'shift'   => 'ml-2',
                ],
            ]
        ],
        [
            'text' => 'DATA KEUANGAN MITRA',
            'icon' => 'fa fa-fw fa-coins',
            'submenu' => [
                [
                    'text' => 'Data Modal',
                    'label'       => 'new',
                    'label_color' => 'success',
                    'shift'   => 'ml-2',
                    'url'  => 'admin/capex',
                    'icon' => 'fas fa-fw fa-donate',
                ],
                [
                    'text' => 'Data Operasional',
                    'url'  => 'admin/opex',
                    'shift'   => 'ml-2',
                    'icon' => 'fas fa-fw fa-dolly',
                    'label'       => 'new',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Data Kas',
                    'url'  => 'admin/kas',
                    'shift'   => 'ml-2',
                    'icon' => 'fas fa-fw fa-clipboard-check',
                    'label'       => 'Pengembangan',
                    'label_color' => 'warning',
                ],
            ]
        ],
        [
            'text' => 'DATA OPERASIONAL',
            'icon'    => 'fas fa-fw fa-table',
            'submenu' => [
                [
                    'text' => 'Konsumsi Pakan',
                    'url'  => 'admin/pakan',
                    'icon' => 'fas fa-fw fa-box',
                    'shift'   => 'ml-2',
                ],
                [
                    'text'  => 'Konsumsi Minum',
                    'url'   => 'admin/minum',
                    'icon'  => 'fas fa-fw fa-prescription-bottle',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Rata-rata Bobot',
                    'url'  => 'admin/berat',
                    'icon' => 'fa fa-fw fa-weight',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Vitamin',
                    'url'  => 'admin/vitamin',
                    'icon' => 'fa fa-fw fa-prescription-bottle-alt',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Kematian',
                    'url'  => 'admin/kematian',
                    'icon' => 'fa fa-fw fa-book-dead',
                    'shift'   => 'ml-2',
                ],
                // [
                //     'text' => 'Dokumen',
                //     'url'  => 'admin/dokumen',
                //     'icon' => 'fas fa-fw fa-file',
                //     'shift'   => 'ml-2',
                // ],
                [
                    'text' => 'Penjualan',
                    'url'  => 'admin/penjualan',
                    'icon' => 'fas fa-fw fa-store',
                    'shift'   => 'ml-2',
                    'label'       => 'new',
                    'label_color' => 'success',
                ],
            ],
        ],

            // NAVBAR MITRA
        [
            'text' => 'Beranda',
            'url'  => 'mitra/index',
            'icon' => 'fas fa-fw fa-home',
        ],
        [
            'text' => 'DATA UTAMA',
            'icon'    => 'fas fa-fw fa-calendar-day',
            'submenu' => [
                [
                    'text' => 'Update Harian',
                    'url'  => 'mitra/perbarui',
                    'icon' => 'fas fa-fw fa-calendar-week',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Farm',
                    'url'  => 'mitra/farm',
                    'icon' => 'fas fa-fw fa-warehouse',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Siklus',
                    'url'  => 'mitra/siklus',
                    'icon' => 'fa fa-fw fa-th',
                    'shift'   => 'ml-2',
                ],
            ],    
        ],    
        [
            'text' => 'DATA KEUANGAN',
            'icon'    => 'fas fa-fw fa-coins',
            'submenu' => [
                [
                    'text' => 'Data Modal',
                    'label'       => 'new',
                    'label_color' => 'success',
                    'shift'   => 'ml-2',
                    'url'  => 'mitra/capex',
                    'icon' => 'fas fa-fw fa-donate',
                ],
                [
                    'text' => 'Data Operasional',
                    'url'  => 'mitra/opex',
                    'shift'   => 'ml-2',
                    'icon' => 'fas fa-fw fa-dolly',
                    'label'       => 'new',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Data Kas',
                    'url'  => 'mitra/kas',
                    'shift'   => 'ml-2',
                    'icon' => 'fas fa-fw fa-clipboard-check',
                    'label'       => 'new',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Penjualan',
                    'url'  => 'mitra/penjualan',
                    'icon' => 'fas fa-fw fa-store',
                    'shift'   => 'ml-2',
                    'label'       => 'new',
                    'label_color' => 'success',
                ],
            ],
        ],
        [
            'text' => 'DATA HARIAN',
            'icon'    => 'fas fa-fw fa-calendar-day',
            'submenu' => [
                [
                    'text' => 'Konsumsi Pakan',
                    'url'  => 'mitra/pakan',
                    'icon' => 'fas fa-fw fa-box',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Konsumsi Minum',
                    'url'  => 'mitra/minum',
                    'icon' => 'fas fa-fw fa-prescription-bottle',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Bobot Ternak',
                    'url'  => 'mitra/berat',
                    'icon' => 'fa fa-fw fa-weight',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Vitamin',
                    'url'  => 'mitra/vitamin',
                    'icon' => 'fa fa-fw fa-prescription-bottle-alt',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Kematian',
                    'url'  => 'mitra/kematian',
                    'icon' => 'fa fa-fw fa-book-dead',
                    'shift'   => 'ml-2',
                ],
            ],
        ],
            // NAVBAR PJUB 
            [    
                'text'        => 'Home',
                'url'         => 'pjub/index',
                'icon'        => 'fas fa-fw fa-home',
            ],
            [
                'text' => 'DATA UTAMA FARM',
                'icon'    => 'fas fa-fw fa-table',
                'submenu' => [
            
                [
                    'text' => 'Data Mitra',
                    'url'  => 'pjub/mitra',
                    'icon' => 'fa fa-fw fa-handshake',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Farm',
                    'url'  => 'pjub/farm',
                    'icon' => 'fas fa-fw fa-warehouse',
                    'shift'   => 'ml-2',
                ],
                [
                    'text' => 'Data Siklus',
                    'url'  => 'pjub/siklus',
                    'icon' => 'fa fa-fw fa-recycle',
                    'shift'   => 'ml-2',
                ],
            ],
        ],
        [
            'text' => 'DATA KEUANGAN FARM',
            'icon'    => 'fas fa-fw fa-coins',
            'submenu' => [
                [
                    'text' => 'Data Modal',
                    'label'       => 'new',
                    'label_color' => 'success',
                    'shift'   => 'ml-2',
                    'url'  => 'pjub/capex',
                    'icon' => 'fas fa-fw fa-donate',
                ],
                [
                    'text' => 'Data Operasional',
                    'url'  => 'pjub/opex',
                    'shift'   => 'ml-2',
                    'icon' => 'fas fa-fw fa-dolly',
                    'label'       => 'new',
                    'label_color' => 'success',
                ],
                [
                    'text' => 'Data Kas',
                    'url'  => 'pjub/kas',
                    'shift'   => 'ml-2',
                    'icon' => 'fas fa-fw fa-clipboard-check',
                    'label'       => 'pengembangan',
                    'label_color' => 'warning',
                ],
                [
                    'text' => 'Penjualan',
                    'url'  => 'pjub/penjualan',
                    'icon' => 'fas fa-fw fa-store',
                    'shift'   => 'ml-2',
                    'label'       => 'new',
                    'label_color' => 'success',
                ],
            ],
        ],
        [
            'text' => 'DATA HARIAN FARM',
            'icon'    => 'fas fa-fw fa-calendar-day',
            'submenu' => [
        [
                'text' => 'Data Konsumsi Pakan',
                'url'  => 'pjub/pakan',
                'icon' => 'fas fa-fw fa-box',
                'shift'   => 'ml-2',
            ],
            [
                'text'  => 'Data Konsumsi Minum',
                'url'   => 'pjub/minum',
                'icon'  => 'fas fa-fw fa-prescription-bottle',
                'shift'   => 'ml-2',
            ],
            [
                'text' => 'Data Bobot Ternak',
                'url'  => 'pjub/berat',
                'icon' => 'fa fa-fw fa-weight',
                'shift'   => 'ml-2',
            ],
            [
                'text' => 'Data Vitamin',
                'url'  => 'pjub/vitamin',
                'icon' => 'fa fa-fw fa-prescription-bottle-alt',
                'shift'   => 'ml-2',
            ],
            [
                'text' => 'Data Kematian',
                'url'  => 'pjub/kematian',
                'icon' => 'fa fa-fw fa-book-dead',
                'shift'   => 'ml-2',
            ],
        ],
    ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
        App\Filters\MenuFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'name' => 'DateRangePicker',
        'active' => false,
        'files' => [
            [
                'type' => 'css',
                'asset' => false,
                'location' => '/vendor/daterangepicker/daterangepicker.css',
            ],
            [
                'type' => 'js',
                'asset' => false,
                'location' => '/vendor/daterangepicker/moment.min.js',
            ],
            [
                'type' => 'js',
                'asset' => false,
                'location' => '/vendor/daterangepicker/daterangepicker.js',
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,

        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
