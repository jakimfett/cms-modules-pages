<?php

if (!Route::cache()) {

    Route::set('page-faq', 'faq')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'faq'
    ));

    Route::set('page-contact', 'contact')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'contact'
    ));

    Route::set('page-home', '')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'index'
    ));
}