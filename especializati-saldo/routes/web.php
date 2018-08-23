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

    $this->get('withdraw', 'BalanceController@withdraw')->name('admin.withdraw');
    $this->post('withdraw', 'BalanceController@withdrawStore')->name('admin.withdraw.store');

    $this->post('transfer', 'BalanceController@transferStore')->name('admin.transfer.store');
    $this->get('transfer', 'BalanceController@transfer')->name('admin.transfer');
    $this->post('confirm-transfer', 'BalanceController@confirmTransfer')->name('admin.confirm.transfer');

    $this->get('historic', 'BalanceController@historic')->name('admin.historic');
    $this->get('historic-search', 'BalanceController@historicSearch')->name('admin.historic.search');
});

$this->group(['middleware' => 'auth'], function () {
    $this->get('meu-perfil', 'Admin\UserController@profile')->name('profile');
    $this->post('meu-perfil', 'Admin\UserController@profileUpdate')->name('admin.profile.update');
});

$this->get('/', 'Site\SiteController@index')->name('home');


Auth::routes();
