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


use app\controller\Api\Admin\Auth\AuthController;
use app\controller\Api\Admin\Permission\AdminController;
use app\controller\Api\Admin\Permission\RoleController;
use Webman\Route;

Route::group('/api/admin', function () {
    Route::post('/login', [AuthController::class,'index'])->name('login');
    Route::get('/captcha', [AuthController::class,'captcha'])->name('cptcha');
    Route::post('/logout', [AuthController::class,'logout'])->name('logout');
    Route::post('/me', [AuthController::class,'me'])->name('me');
});
Route::group('/api/admin',function (){
    Route::resource('/admins', AdminController::class);
    Route::resource('/roles', RoleController::class);
});




Route::fallback(function(){
    return json(['code' => 404, 'msg' => '404 not found']);
});
