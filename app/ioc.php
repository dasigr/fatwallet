<?php

/*
|--------------------------------------------------------------------------
| Application Inversion of Control
|--------------------------------------------------------------------------
|
| Class Bindings
|
*/

App::bind('UserRepositoryInterface', 'UserRepository');
App::bind('CategoryRepositoryInterface', 'CategoryRepository');
App::bind('MerchantRepositoryInterface', 'MerchantRepository');
