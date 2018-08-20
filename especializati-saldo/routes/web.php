<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

$this->group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    $this->get('/', 'AdminController@index')->name('admin.home');

    $this->get('balance', 'BalanceController@index')->name('admin.balance');
    $this->get('deposit', 'BalanceController@deposit')->name('admin.deposit');
    $this->post('deposit', 'BalanceController@depositStore')->name('admin.depositStore');
});

$this->get('/', 'Site\SiteController@index')->name('home');


Auth::routes();
