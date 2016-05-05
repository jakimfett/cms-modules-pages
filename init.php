<?php
if (!Route::cache()) {

    Route::set('page-games', 'games(/<game_id>)')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'games'
    ));

    Route::set('page-contact', 'contact')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'contact'
    ));

    Route::set('page-faq', 'faq')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'faq'
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

    Route::set('promo-redeem-redirect', 'redeem')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'redeem'
    ));

    Route::set('page-render-test', 'rendertest(/<alias>)(/<section>(/<view>))')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'rendertest'
    ));

    Route::set('page-subscribe', 'subscribe')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'subscribe'
    ));

    Route::set('page-tickets', 'tickets')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'tickets'
    ));

    Route::set('page-unsubscribe', 'unsubscribe/<email>/<domain>')
            ->defaults(array(
                'controller' => 'pages',
                'action' => 'unsubscribe'
    ));
}