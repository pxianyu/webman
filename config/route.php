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
    Route::post('/login', [app\controller\Admin\Auth\AuthController::class,'index']);
    Route::get('/captcha', [app\controller\Admin\Auth\AuthController::class,'captcha']);
    Route::post('/admins', [app\controller\Admin\Auth\AdminController::class,'create']);
    Route::get('/admins', [app\controller\Admin\Auth\AdminController::class,'index']);
    Route::get('/admins/{id:\d+}', [app\controller\Admin\Auth\AdminController::class,'show']);
});





