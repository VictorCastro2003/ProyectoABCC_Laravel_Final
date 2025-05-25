<?php

return [
    'title' => 'Tutorias',
    'use_ico_only' => false,
    'use_full_favicon' => false,

    'google_fonts' => [
        'allowed' => true,
    ],

    'logo' => 'Tutorias',
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
    'logo_img_class' => 'brand-image img-circle elevation-3',
    'logo_img_alt' => 'FastPDV Logo',

    'auth_logo' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    'preloader' => [
        'enabled' => true,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Preloader',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    'layout_fixed_sidebar' => true,
    'layout_fixed_navbar' => true,
    'layout_fixed_footer' => false,

    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    'use_route_url' => true,
    'dashboard_url' => 'dashboard',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password.request',
    'password_email_url' => 'password.email',

    'menu' => [
        ['header' => 'Gestión'],
        [
            'text' => 'Alumnos',
            'url'  => 'alumnos',
            'icon' => 'fas fa-users',
        ],
        [
            'text' => 'Asignaturas',
            'url'  => 'asignaturas',
            'icon' => 'fas fa-book',
        ],
        [
            'text' => 'Docentes',
            'url'  => 'docentes',
            'icon' => 'fas fa-chalkboard-teacher',
        ],
        ['header' => 'Cuenta'],
        [
            'text' => 'Perfil',
            'url'  => 'perfil',
            'icon' => 'fas fa-user',
        ],
        [
            'text' => 'Cambiar Contraseña',
            'route' => 'password.change',
            'icon' => 'fas fa-lock',
        ],
    ],

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                ['type' => 'js', 'asset' => false, 'location' => '//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js'],
                ['type' => 'js', 'asset' => false, 'location' => '//cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js'],
                ['type' => 'css', 'asset' => false, 'location' => '//cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css'],
            ],
        ],
        'AlpineJS' => [
            'active' => true,
            'files' => [
                ['type' => 'js', 'asset' => false, 'location' => 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js'],
            ],
        ],
        'Sweetalert2' => [
            'active' => true,
            'files' => [
                ['type' => 'js', 'asset' => false, 'location' => '//cdn.jsdelivr.net/npm/sweetalert2@11'],
            ],
        ],
    ],

    'iframe' => [
        'default_tab' => ['url' => null, 'title' => null],
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

    'livewire' => false,
];
