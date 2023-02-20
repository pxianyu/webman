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
use app\controller\Api\Admin\Permission\MenuController;
use app\controller\Api\Admin\Permission\RoleController;
use app\controller\Api\Admin\Permission\PermissionController;
use app\controller\Api\Admin\System\BannerController;
use app\controller\Api\Admin\System\BannerGroupController;
use app\controller\Api\Admin\System\ConfigController;
use app\controller\Api\Admin\System\ConfigGroupController;
use support\Response;
use Webman\Route;
use app\middleware\AuthCheckTest;
Route::post('/api/admin/login', [AuthController::class,'login'])->name('admin.login');
Route::get('/api/admin/captcha', [AuthController::class,'captcha'])->name('admin.captcha');
Route::group('/api/admin', function () {
    Route::post('/logout', [AuthController::class,'logout'])->name('admin.logout');
    Route::post('/me', [AuthController::class,'me'])->name('admin.me');
})->middleware([AuthCheckTest::class]);
Route::group('/api/admin',function (){
    Route::resource('/admins', AdminController::class,['index','show','store','update','destroy']);
    Route::resource('/roles', RoleController::class,['index','show','store','update','destroy']);
    Route::post('/roles/empower',[AdminController::class,'empower'])->name('roles.empower');
    Route::resource('/permissions', PermissionController::class,['index','show','store','update','destroy']);
    Route::resource('/menus', MenuController::class,['index','show','store','update','destroy']);
    Route::resource('/configs', ConfigController::class,['index','show','store','update','destroy']);
    Route::resource('/configGroups', ConfigGroupController::class,['index','show','store','update','destroy']);
    Route::resource('/bannerGroups', BannerGroupController::class,['index','show','store','update','destroy']);
    Route::resource('/banners', BannerController::class,['index','show','store','update','destroy']);

})->middleware([AuthCheckTest::class]);




Route::fallback(function(){
    return  new Response(200, ['Content-Type' => 'application/json','Access-Control-Allow-Origin'=>'*'], \json_encode(['code' => 404, 'msg' => '404 not found'], JSON_UNESCAPED_UNICODE));
});
