<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Webman\Route;
Route::group('/auth', function () {
    Route::post('/login', [app\controller\Admin\Auth\AuthController::class,'index'])->name('login');
    Route::get('/captcha', [app\controller\Admin\Auth\AuthController::class,'captcha'])->name('cptcha');
    Route::post('/logout', [app\controller\Admin\Auth\AuthController::class,'logout'])->name('logout');
    Route::post('/me', [app\controller\Admin\Auth\AuthController::class,'me'])->name('me');
});
Route::group('admin',function (){
    Route::resource('/admins', app\controller\Admin\Auth\AdminController::class);
});




Route::fallback(function(){
    return json(['code' => 404, 'msg' => '404 not found']);
});
