<?php

// (1)use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// Route::get('/', function () {
//     return view('/admin/dashboard');
// })->name('admin_dashboard');

Route::get('/', 'Admin\Dashboard@index')->name('admin_dashboard');

Route::get('/events', function () {
    return 'Admin Events';
})->name('admin_events');

Route::post('/events/create', function (){
    return 'Events created!!';
});

Route::catch(function(){
    return response()->view('errors/404', [], 404);
    // (1)throw new NotFoundHttpException('Pagina no encontrada');
});

// Route::any('{any}', function(){
//     return response()->view('errors/404', [], 404);
//     // (1)throw new NotFoundHttpException('Pagina no encontrada');
// })->where('any', '.*');
