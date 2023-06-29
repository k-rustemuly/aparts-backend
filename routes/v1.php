<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CommercialPremiseController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FlatCommentController;
use App\Http\Controllers\FlatController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SignController;
use App\Http\Controllers\StoreroomController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TransactionController;
use Buildit\Facades\Buildit;
use Illuminate\Support\Facades\Route;

Route::prefix('{locale}')
    ->as('app.')
    ->where(['locale' => '[a-zA-Z]{2}'])
    ->middleware('setlocale')
    ->group(static function () {

        Route::controller(SignController::class)->group(function(){
            Route::post('login', 'login')->name('login');
        });

        Route::middleware('auth:sanctum')->group(function () {

            Buildit::apiResource('employees', EmployeeController::class);

            Buildit::apiResource('objects', ObjectController::class);

            Buildit::apiResource('clients', ClientController::class);

            Buildit::apiResource('banks', BankController::class);

            Buildit::apiResource('transactions', TransactionController::class);

            Route::prefix('transactions')
                ->as('transactions.')
                ->controller(TransactionController::class)
                ->group(function () {
                    Route::get('action-approve', 'approveAction')->name('action.approve');
                    Route::post('approve', 'approve')->name('approve');
            });

            Route::prefix('flats')
                ->as('flats.')
                ->controller(FlatController::class)
                ->group(function () {
                    Route::get('', 'page')->name('page');
                    Route::get('{flat_id}', 'about')->name('show')->whereNumber('flat_id');
                    Route::get('list', 'all')->name('list');
            });

            Route::prefix('commercial-premises')
                ->as('commercial_premises.')
                ->controller(CommercialPremiseController::class)
                ->group(function () {
                    Route::get('', 'page')->name('page');
                    Route::get('list', 'all')->name('list');
            });

            Route::prefix('storerooms')
                ->as('storerooms.')
                ->controller(StoreroomController::class)
                ->group(function () {
                    Route::get('', 'page')->name('page');
                    Route::get('list', 'all')->name('list');
            });

            Route::prefix('parkings')
                ->as('parkings.')
                ->controller(ParkingController::class)
                ->group(function () {
                    Route::get('', 'page')->name('page');
                    Route::get('list', 'all')->name('list');
            });

            Route::prefix('objects/{id}')
                ->as('objects.')
                ->group(function () {

                Route::prefix('blocks')
                    ->as('blocks.')
                    ->controller(BlockController::class)
                    ->group(function () {
                        Route::get('action-create', 'createAction')->name('action.create');
                        Route::get('list', 'list')->name('list');
                        Route::post('store', 'store')->name('store');

                        Route::prefix('{block_id}')
                            ->group(function () {
                                Route::get('', 'show')->name('show');

                                Route::prefix('storerooms')
                                    ->as('storerooms.')
                                    ->controller(StoreroomController::class)
                                    ->group(function () {
                                        Route::get('action-create', 'createAction')->name('action.create');
                                        Route::get('', 'list')->name('list');
                                        Route::post('', 'store')->name('store');
                                    });

                                Route::prefix('commercial-premises')
                                    ->as('commercial_premises.')
                                    ->group(function () {
                                        Route::controller(CommercialPremiseController::class)->group(function(){
                                            Route::get('action-create', 'createAction')->name('action.create');
                                            Route::get('', 'list')->name('list');
                                            Route::post('', 'store')->name('store');
                                        });
                                    });

                                Route::prefix('flats')
                                    ->as('flats.')
                                    ->controller(FlatController::class)
                                    ->group(function () {
                                        Route::get('action-create', 'createAction')->name('action.create');
                                        Route::get('', 'list')->name('list');
                                        Route::post('', 'store')->name('store');

                                        Route::prefix('{flat_id}')
                                            ->group(function () {
                                                Route::get('', 'show')->name('show');

                                                Route::prefix('bookings')
                                                    ->as('bookings.')
                                                    ->controller(BookingController::class)
                                                    ->group(function () {
                                                        Route::get('action-create', 'createAction')->name('action.create');
                                                        Route::get('action-calc', 'calcAction')->name('action.calc');
                                                        Route::post('', 'store')->name('store');
                                                    });

                                                Route::prefix('comments')
                                                    ->as('comments.')
                                                    ->controller(FlatCommentController::class)
                                                    ->group(function () {
                                                        Route::get('action-create', 'createAction')->name('action.create');
                                                        Route::get('', 'list')->name('list');
                                                        Route::post('', 'store')->name('store');
                                                    });
                                            });
                                    });
                            });
                    });

                Route::prefix('parkings')
                    ->as('parkings.')
                    ->controller(ParkingController::class)
                    ->group(function () {
                        Route::get('action-create', 'createAction')->name('action.create');
                        Route::get('', 'list')->name('list');
                        Route::post('', 'store')->name('store');
                    });
            });

            Route::prefix('reference')
                ->as('reference.')
                ->controller(ReferenceController::class)
                ->group(function () {
                    Route::get('role', 'role')->name('role');
                    Route::get('city', 'city')->name('city');
                    Route::get('class', 'class')->name('class');
                    Route::get('technology', 'technology')->name('technology');
                    Route::get('heating-type', 'heating_type')->name('heating_type');
                    Route::get('finishing-status', 'finishing_status')->name('finishing_status');
                    Route::get('flat-statuses', 'flat_statuses')->name('flat_statuses');
                    Route::get('commercial-premise-statuses', 'commercial_premise_statuses')->name('commercial_premise_statuses');
                    Route::get('storeroom-statuses', 'storeroom_statuses')->name('storeroom_statuses');
                    Route::get('banks', 'banks')->name('banks');
                    Route::get('objects', 'objects')->name('objects');
                    Route::get('clients', 'clients')->name('clients');
                    Route::get('operation-types', 'operation_types')->name('operation_types');
                    Route::get('transactions', 'transactions')->name('transactions');
                });

            Route::prefix('tests')
                ->as('tests.')
                ->group(function () {
                    Route::controller(TestController::class)->group(function(){
                        Route::get('', 'index')->name('index');
                        Route::get('list', 'list')->name('list');
                        Route::post('', 'store')->name('store');
                        Route::get('test', 'test')->name('test');

                        Route::prefix('actions')
                            ->as('actions.')
                            ->group(function () {
                                Route::get('create', 'createAction')->name('create');
                            });
                    });
                });

            });

    });
