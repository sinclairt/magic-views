<?php

return [

    /*
     * Nav links
     *
     * The key will be used for the display of the nav bar link, it will be passed through the trans() method first.
     * The value should be the name of the route. Route naming is encouraged to ensure flexible routes.
     */
    'nav-links'         => [
        'home' => 'home',
    ],
    /*
     * Project Details
     *
     * The name will be used through the app in the appropriate places.
     * The image will be used on the auth screens and the nav-bar.
     */
    'project'           => [
        'name'  => 'Project 101',
        'image' => '#'
    ],
    /*
     * Breadcrumbs
     *
     * Set the display name as the route name of the first breadcrumb to appear on pages, this is usually the home page.
     * The key is the term used for display through the trans() method, the value is the route name.
     */
    'breadcrumb-prefix' => [
        'home' => 'home'
    ],
    /*
     * Form Actions
     *
     * These are the routes used for the resourceful create and edit form views, they default to store and update respectively
     */
    'form-actions'      => [
        'create' => 'store',
        'edit'   => 'update'
    ]
];