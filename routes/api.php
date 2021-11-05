<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Auth\EmailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Image\ImageController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\User\UserRoleController;
use App\Http\Controllers\User\Role\RoleController;
use App\Http\Controllers\User\UserImageController;
use App\Http\Controllers\Activity\ActivityController;
use App\Http\Controllers\User\UserActivityController;
use App\Http\Controllers\Activity\Type\TypeController;
use App\Http\Controllers\User\UserPermissionController;
use App\Http\Controllers\Activity\ActivityTypeController;
use App\Http\Controllers\Activity\ActivityImageController;
use App\Http\Controllers\Activity\Source\SourceController;
use App\Http\Controllers\Activity\ActivityProcessController;
use App\Http\Controllers\Activity\Process\ProcessController;
use App\Http\Controllers\User\Role\RolePermissionController;
use App\Http\Controllers\Activity\ActivityAttentionController;
use App\Http\Controllers\User\Permission\PermissionController;
use App\Http\Controllers\Activity\ActivityIdentifierController;
use App\Http\Controllers\Activity\Attention\AttentionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')->group(function(){

  Route::post('register', [ UserController::class, 'store' ]);
  Route::post('login', [ LoginController::class, 'login' ]);
  Route::post('forgot-password', [ PasswordController::class, 'forgotPassword' ])->name('password.email');
  Route::post('reset-password', [ PasswordController::class, 'resetPassword' ])->name('password.reset');
});

Route::middleware('auth:sanctum')->group(function(){

  Route::get('email/verify/{id}/{hash}', [ EmailController::class, 'verifyEmail' ])->name('verification.verify');
  Route::post('email/verify-notification', [ EmailController::class, 'resendEmailVerification' ]);
  Route::middleware('verified')->group(function(){

    /** User Profile */
    Route::group(['prefix' => 'profile'], function(){

      Route::get('/', [ ProfileController::class, 'index' ]);
      Route::get('roles', [ ProfileController::class, 'roles' ]);
      Route::get('permissions', [ ProfileController::class, 'permissions' ]);
      Route::get('activities', [ ProfileController::class, 'activities' ]);
      Route::get('images', [ ProfileController::class, 'images' ]);
    });
    /** Resources endpoints */
    Route::apiResources([
      'users' => UserController::class,
      'users.images' => UserImageController::class,
      'users.activities' => UserActivityController::class,
      'roles' => RoleController::class,
      'permissions' => PermissionController::class,
      'images' => ImageController::class,
      'activities/types' => TypeController::class,
      'activities/sources' => SourceController::class,
      'activities/attentions' => AttentionController::class,
      'activities/processes' => ProcessController::class,
      'activities' => ActivityController::class,
      'activities.images' => ActivityImageController::class,
      'activities.identifiers' => ActivityIdentifierController::class
    ]);
    Route::apiResources([
      'users.roles' => UserRoleController::class,
      'users.permissions' => UserPermissionController::class,
      'roles.permissions' => RolePermissionController::class
    ], [ 'except' => 'update' ]);
    Route::match(['put', 'patch'], 'users/{user}/roles', [ UserRoleController::class, 'update' ])->name('users.roles.update');
    Route::match(['put', 'patch'], 'users/{user}/permissions', [ UserPermissionController::class, 'update' ])->name('users.permissions.update');
    Route::match(['put', 'patch'], 'roles/{role}/permissions', [ RolePermissionController::class, 'update' ])->name('roles.permissions.update');

    Route::prefix('activities/{activity}/type')->group(function(){
      Route::get('/', [ ActivityTypeController::class, 'index' ])->name('items.type.index');
      Route::match(['post', 'put', 'patch'], '/', [ ActivityTypeController::class, 'update' ])->name('items.type.update');
      Route::delete('/', [ ActivityTypeController::class, 'destroy' ])->name('items.type.delete');
    });
    Route::prefix('activities/{activity}/attention')->group(function(){
      Route::get('/', [ ActivityAttentionController::class, 'index' ])->name('items.brand.index');
      Route::match(['post', 'put', 'patch'], '/', [ ActivityAttentionController::class, 'update' ])->name('items.brand.update');
      Route::delete('/', [ ActivityAttentionController::class, 'destroy' ])->name('items.brand.delete');
    });
    Route::prefix('activities/{activity}/process')->group(function(){
      Route::get('/', [ ActivityProcessController::class, 'index' ])->name('items.type.index');
      Route::match(['post', 'put', 'patch'], '/', [ ActivityProcessController::class, 'update' ])->name('items.type.update');
      Route::delete('/', [ ActivityProcessController::class, 'destroy' ])->name('items.type.delete');
    });
  });
  Route::match(['post', 'get'], 'logout', [ LoginController::class, 'logout' ]);
});

Route::fallback(fn() => response()->json(['success' => false, 'message' => 'Resource not found.'], 404));
