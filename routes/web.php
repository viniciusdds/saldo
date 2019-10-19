<?php

//ultima aula 34

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
    
    $this->any('historico-search', 'BalanceController@searchHistorico')->name('historico.search');
    $this->get('historico', 'BalanceController@historico')->name('admin.historico');
    
    $this->post('transfer', 'BalanceController@transferStore')->name('transfer.store');
    $this->post('confirm-transfer', 'BalanceController@confirmTransfer')->name('confirm.transfer');
    $this->get('transfer', 'BalanceController@transfer')->name('balance.transfer');
    
    $this->post('withdraw', 'BalanceController@withdrawStore')->name('balance.withdraw');
    $this->get('withdraw', 'BalanceController@withdraw')->name('withdraw.store');
    
    $this->post('deposito', 'BalanceController@depositoStore')->name('deposito.store');
    $this->get('deposito', 'BalanceController@deposito')->name('balance.deposito');
    $this->get('balance', 'BalanceController@index')->name('admin.balance');
    
    $this->get('/', 'AdminController@index')->name('admin.home');
});

$this->post('atualizar-perfil', 'Admin\UserController@profileUpdate')->name('profile.update')->middleware('auth');
$this->get('meu-perfil', 'Admin\UserController@profile')->name('profile')->middleware('auth');
        
$this->get('login2', 'Site\SiteController@login')->name('login2');
$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();


