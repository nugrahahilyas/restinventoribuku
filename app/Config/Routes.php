<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Login::index');
$routes->get('api/penerbit/(:num)', 'api\Penerbit::index/$1');
$routes->get('api/penerbit', 'api\Penerbit::index');
$routes->get('api/penerbit/show', 'api\Penerbit::show');
$routes->put('api/penerbit/(:num)', 'api\Penerbit::update/$1');
$routes->post('api/penerbit', 'api\Penerbit::create');

$routes->get('api/buku', 'api\Buku::index');
$routes->get('api/buku/(:num)', 'api\Buku::index/$1');
$routes->get('api/buku/show', 'api\Buku::show');
$routes->put('api/buku/(:num)', 'api\Buku::update/$1');
$routes->post('api/buku', 'api\Buku::create');

$routes->get('api/penjualan', 'api\Penjualan::index');
$routes->get('api/detailpenjualan', 'api\Penjualan::lihatDetailPenjualan');
$routes->get('api/simpanpenjualan', 'api\Penjualan::simpanPenjualan');

$routes->get('api/temp', 'api\Penjualan::lihatTemp');
$routes->put('api/temp/(:num)', 'api\Penjualan::update/$1');
$routes->post('api/temp', 'api\Penjualan::create');