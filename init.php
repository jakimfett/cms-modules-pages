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

    Route::set('page-tickets', 'tickets')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'tickets'
    ));

    Route::set('page-four-oh-four', '404')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'four_oh_four'
    ));

    Route::set('page-home', '')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'index'
    ));

    Route::set('page-render-test', 'rendertest(/<alias>)(/<section>(/<view>))')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'rendertest'
    ));
}