<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Component Locations
    |--------------------------------------------------------------------------
    */

    'component_locations' => [
        resource_path('views/components'),
        resource_path('views/livewire'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Component Namespaces
    |--------------------------------------------------------------------------
    */

    'component_namespaces' => [
        'layouts' => resource_path('views/layouts'),
        'pages' => resource_path('views/pages'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Page Layout
    |--------------------------------------------------------------------------
    */

    'component_layout' => 'layouts::app',

    /*
    |--------------------------------------------------------------------------
    | Lazy Loading Placeholder
    |--------------------------------------------------------------------------
    */

    'component_placeholder' => null,

    /*
    |--------------------------------------------------------------------------
    | Make Command
    |--------------------------------------------------------------------------
    */

    'make_command' => [
        'type' => 'sfc',
        'emoji' => true,

        'with' => [
            'js' => false,
            'css' => false,
            'test' => false,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Class Namespace
    |--------------------------------------------------------------------------
    */

    'class_namespace' => 'App\\Livewire',

    /*
    |--------------------------------------------------------------------------
    | Class Path
    |--------------------------------------------------------------------------
    */

    'class_path' => app_path('Livewire'),

    /*
    |--------------------------------------------------------------------------
    | View Path
    |--------------------------------------------------------------------------
    */

    'view_path' => resource_path(
        'views/livewire'
    ),

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Livewire stores uploaded files temporarily before Filament moves them
    | to their final storage location.
    |
    | The local disk points to:
    | storage/app/private
    |
    | Temporary files will be stored inside:
    | storage/app/private/livewire-tmp
    |
    */

    'temporary_file_upload' => [
        /*
         * Explicitly use Laravel's local disk.
         */
        'disk' => 'local',

        /*
         * Maximum temporary upload size is 12MB.
         */
        'rules' => [
            'required',
            'file',
            'max:12288',
        ],

        /*
         * Temporary upload directory.
         */
        'directory' => 'livewire-tmp',

        /*
         * Upload request rate limiting.
         */
        'middleware' => 'throttle:60,1',

        /*
         * File types allowed for temporary previews.
         */
        'preview_mimes' => [
            'png',
            'gif',
            'bmp',
            'svg',
            'wav',
            'mp4',
            'mov',
            'avi',
            'wmv',
            'mp3',
            'm4a',
            'jpg',
            'jpeg',
            'mpga',
            'webp',
            'wma',
        ],

        /*
         * Temporary uploads remain valid for 10 minutes.
         */
        'max_upload_time' => 10,

        /*
         * Delete temporary uploads older than 24 hours.
         */
        'cleanup' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Render On Redirect
    |--------------------------------------------------------------------------
    */

    'render_on_redirect' => false,

    /*
    |--------------------------------------------------------------------------
    | Eloquent Model Binding
    |--------------------------------------------------------------------------
    */

    'legacy_model_binding' => false,

    /*
    |--------------------------------------------------------------------------
    | Auto-inject Frontend Assets
    |--------------------------------------------------------------------------
    */

    'inject_assets' => true,

    /*
    |--------------------------------------------------------------------------
    | Navigate — SPA Mode
    |--------------------------------------------------------------------------
    */

    'navigate' => [
        'show_progress_bar' => true,
        'progress_bar_color' => '#C7F36B',
    ],

    /*
    |--------------------------------------------------------------------------
    | HTML Morph Markers
    |--------------------------------------------------------------------------
    */

    'inject_morph_markers' => true,

    /*
    |--------------------------------------------------------------------------
    | Smart Wire Keys
    |--------------------------------------------------------------------------
    */

    'smart_wire_keys' => true,

    /*
    |--------------------------------------------------------------------------
    | Pagination Theme
    |--------------------------------------------------------------------------
    */

    'pagination_theme' => 'tailwind',

    /*
    |--------------------------------------------------------------------------
    | Release Token
    |--------------------------------------------------------------------------
    */

    'release_token' => 'a',

    /*
    |--------------------------------------------------------------------------
    | CSP Safe
    |--------------------------------------------------------------------------
    */

    'csp_safe' => false,

    /*
    |--------------------------------------------------------------------------
    | Payload Guards
    |--------------------------------------------------------------------------
    */

    'payload' => [
        /*
         * Maximum Livewire request payload size.
         * Temporary uploaded file data uses its own upload endpoint.
         */
        'max_size' => 1024 * 1024,

        /*
         * Maximum property nesting depth.
         */
        'max_nesting_depth' => 10,

        /*
         * Maximum method calls in one request.
         */
        'max_calls' => 50,

        /*
         * Maximum Livewire components per request.
         */
        'max_components' => 200,
    ],

];