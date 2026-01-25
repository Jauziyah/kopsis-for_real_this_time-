<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

service('auth')->routes($routes, ['except' => ['register', 'login']]);

// Custom login
$routes->get('login', 'LoginAdd::loginView');
$routes->post('login', 'LoginAdd::loginAction', ['as' => 'login.action']);

// Custom Register
$routes->get('register', 'RegisterAdd::index', ['as' => 'register']);
$routes->post('register', 'RegisterAdd::registerAction' ,['as' => 'register.action']);


// Admin Toko
$routes->group('admin_toko', ['filter' => 'admin_toko'], function($routes){
    $routes->get('/', 'AdminTokoDisplayPage::index', ['as' => 'admin_toko.product_view']); 

    $routes->post('kategori/(:num)', 'AdminKategori_crudv::delete/$1', ['as' => 'admin_toko.kategori_delete']);

    $routes->get('kategori', 'AdminKategori_crudv::index', ['as' => 'admin_toko.kategori_view']); 
    $routes->get('kategori/add' , 'AdminKategori_crudv::addView', ['as' => 'admin_toko.kategori_view_add']);

    $routes->get('kategori/update/(:num)', 'AdminKategori_crudv::updateView/$1', ['as' => 'admin_toko.kategori_update_view']);
    $routes->post('kategori-update/(:num)', 'AdminKategori_crudv::update/$1', ['as' => 'admin_toko.kategori_update']);

    $routes->post('add-kategori' , 'AdminKategori_crudv::save', ['as' => 'admin_toko.kategori_add']);

});

// owner
$routes->group('owner', ['filter' => 'owner'], function($routes){
    $routes->get('/', 'OwnerDisplayPage::index', ['as' => 'owner.product_view']);
});

// Pelanggan
$routes->group('pelanggan', ['filter' => 'pelanggan'], function($routes){
    $routes->get('/', 'PelangganDisplayPage::index', ['as' => 'pelanggan.main_view']);
});