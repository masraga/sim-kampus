<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Layout');
$routes->setDefaultMethod('init');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Layout::init');
$routes->get('/logout', 'Authentication::logout');
$routes->post('/auth', 'Authentication::authenticate');

$routes->get('/admin', 'Layout::admin_home');

$routes->get('/bendahara', 'Layout::bendahara_home');
$routes->get('/bendahara/tagihan/mahasiswa', 'Layout::bendahara_tagihan_mahasiswa');
$routes->get('/bendahara/tagihan/new', 'Layout::bendahara_tagihan_new');

$routes->get('/api/mahasiswa', 'Mahasiswa::list');
$routes->post( "/api/mahasiswa/tagihan/new", "Tagihan::add" );


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
