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


    // -------------------barang Seiks90j --------------------------------
    $routes->post('barang-delete/(:any)', 'AdminBarang_crudv::deleteBarang/$1', ['as' => 'admin_toko.barang_delete']); // Delete Barang 
    $routes->get('barang', 'AdminBarang_crudv::index', ['as' => 'admin_toko.barang_view']); // Page View
    $routes->get('barang/create', 'AdminBarang_crudv::createView', ['as' => 'admin_toko.barang_create_view']); // Add Barang page view
    $routes->post('barang-create', 'AdminBarang_crudv::createBarang', ['as' => 'admin_toko.barang_create']); // Add Barang method
    $routes->get('barang/update/(:any)', 'AdminBarang_crudv::updateBarangView/$1', ['as' => 'admin_toko.barang_update_view']); // Update Barang page view
    $routes->post('barang-update/(:any)', 'AdminBarang_crudv::updateBarang/$1', ['as' => 'admin_toko.barang_update']); // Update Barang method

    // -------------------Kategori Seiks90j --------------------------------
    $routes->post('kategori/(:num)', 'AdminKategori_crudv::deleteBarang/$1', ['as' => 'admin_toko.kategori_delete']); // delete
    $routes->get('kategori', 'AdminKategori_crudv::index', ['as' => 'admin_toko.kategori_view']); //kategori page
    $routes->get('kategori/add' , 'AdminKategori_crudv::addView', ['as' => 'admin_toko.kategori_view_add']); //add kategori page
    $routes->post('add-kategori' , 'AdminKategori_crudv::save', ['as' => 'admin_toko.kategori_add']); //Add Kategori method
    $routes->get('kategori/update/(:num)', 'AdminKategori_crudv::updateView/$1', ['as' => 'admin_toko.kategori_update_view']);  // kategori update page
    $routes->post('kategori-update/(:num)', 'AdminKategori_crudv::update/$1', ['as' => 'admin_toko.kategori_update']); // kategori update method
});

// owner
$routes->group('owner', ['filter' => 'owner'], function($routes){
    $routes->get('/', 'OwnerDisplayPage::index', ['as' => 'owner.product_view']);
});

// Pelanggan
$routes->group('pelanggan', ['filter' => 'pelanggan'], function($routes){
    // -----Main View-----
    $routes->get('/', 'PelangganKeranjang_crudv::index', ['as' => 'pelanggan.main_view']); //Main page view
    // Add Keranjang
    $routes->post('keranjang-add', 'PelangganKeranjang_crudv::addKeranjang', ['as' => 'pelanggan.add_keranjang']); // Add keranjang method 

    $routes->get('keranjang', 'PelangganTransaksi::index', ['as' => 'pelanggan.transaksi_view']);

    // Add Requets
    $routes->post('add-request', 'PelangganTransaksi::addRequest', ['as' => 'pelanggan.add_request']);

});