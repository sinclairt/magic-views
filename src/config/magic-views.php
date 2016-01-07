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
    ],
    /*
     * Partials
     *
     * Here you can change the default views that are pulled into the master layout, even changing the master layout itself
     */
    'master'            => 'magic-views::layouts.master',
    'head'              => 'magic-views::includes.head',
    'foot'              => 'magic-views::includes.foot',
    'nav'               => 'magic-views::includes.nav',
    'breadcrumbs'       => 'magic-views::includes.breadcrumbs',
    'page-title'        => 'magic-views::includes.page-title',


    /*
     * Trans Fallback
     *
     * The trans method returns the full string passed to it, if the value cannot be found.
     * However with the fallback, this will return the last element of the dot notation
     * i.e. general.responses.success will return success instead of the full string.
     */
    'use-trans-fallback' => true

];