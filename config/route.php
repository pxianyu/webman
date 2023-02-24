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


use app\bootstrap\ApiRoute;
use app\controller\Api\Admin\Auth\AuthController;
use app\controller\Api\Admin\Permission\AdminController;
use app\controller\Api\Admin\Permission\DepartmentController;
use app\controller\Api\Admin\Permission\JobController;
use app\controller\Api\Admin\Permission\MenuController;
use app\controller\Api\Admin\Permission\PermissionController;
use app\controller\Api\Admin\Permission\RoleController;
use app\controller\Api\Admin\System\BannerController;
use app\controller\Api\Admin\System\BannerGroupController;
use app\controller\Api\Admin\System\ConfigController;
use app\controller\Api\Admin\System\ConfigGroupController;
use app\middleware\AuthCheckTest;
use support\Response;
use Webman\Route;

Route::post('/api/admin/login', [AuthController::class,'login'])->name('admin.login');
Route::get('/api/admin/captcha', [AuthController::class,'captcha'])->name('admin.captcha');
Route::group('/api/admin', function () {
    Route::post('/logout', [AuthController::class,'logout'])->name('admin.logout');
    Route::post('/me', [AuthController::class,'me'])->name('admin.me');
})->middleware([AuthCheckTest::class]);
Route::group('/api/admin',function (){
    Route::put('/admins/enable/{id}', [AdminController::class,'enable'])->name('admins.enable');
    Route::get('/admins/dataRange', [AdminController::class,'dataRange'])->name('admins.dataRange');
    ApiRoute::resource('/admins', AdminController::class);
    ApiRoute::resource('/roles', RoleController::class);
    Route::post('/roles/empower',[AdminController::class,'empower'])->name('roles.empower');
    ApiRoute::resource('/permissions', PermissionController::class);
    ApiRoute::resource('/menus', MenuController::class);
    ApiRoute::resource('/configs', ConfigController::class);
    ApiRoute::resource('/configGroups', ConfigGroupController::class);
    ApiRoute::resource('/bannerGroups', BannerGroupController::class);
    ApiRoute::resource('/banners', BannerController::class);
    ApiRoute::resource('/jobs', JobController::class);
    ApiRoute::resource('departments', DepartmentController::class);

})->middleware([AuthCheckTest::class]);




Route::fallback(function(){
    return  new Response(200, ['Content-Type' => 'application/json','Access-Control-Allow-Origin'=>'*'], \json_encode(['code' => 404, 'msg' => '404 not found'], JSON_UNESCAPED_UNICODE));
});
