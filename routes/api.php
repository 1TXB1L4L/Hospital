<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DashboardController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


/*Route::middleware('auth:sanctum')->group(function () {*/
/*    Route::get('/dashboard/most-used-medicines', [DashboardController::class, 'mostUsedMedicines']);*/
/*    Route::get('/dashboard/last-month-used-medicines', [DashboardController::class, 'lastMonthUsedMedicines']);*/
/*    Route::get('/dashboard/predict-next-month', [DashboardController::class, 'predictNextMonthUsage']);*/
/*    Route::get('/dashboard/medicines-near-to-end', [DashboardController::class, 'medicinesNearToEnd']);*/
/*    Route::get('/dashboard/medicines-about-to-expire', [DashboardController::class, 'medicinesAboutToExpire']);*/
/*    Route::post('/dashboard/get-medicine-usage', [DashboardController::class, 'getMedicineUsage']);*/
/*});*/
/**/


    Route::get('/dashboard/most-used-medicines', [DashboardController::class, 'mostUsedMedicines']);
    Route::get('/dashboard/last-month-used-medicines', [DashboardController::class, 'lastMonthUsedMedicines']);
    Route::get('/dashboard/predict-next-month', [DashboardController::class, 'predictNextMonthUsage']);
    Route::get('/dashboard/medicines-near-to-end', [DashboardController::class, 'medicinesNearToEnd']);
    Route::get('/dashboard/medicines-about-to-expire', [DashboardController::class, 'medicinesAboutToExpire']);
    Route::post('/dashboard/get-medicine-usage', [DashboardController::class, 'getMedicineUsage']);
