<?php

use Anwar\Smaregi\Controller\SmaregiController;

Route::prefix('smaregi')->group(function () {
    Route::get('categories', [SmaregiController::class, 'getCategories']);
    Route::post('categories', [SmaregiController::class, 'storeCategories']);
    Route::delete('categories/{id}', [SmaregiController::class, 'deleteCategory']);
    Route::patch('categories/{id}', [SmaregiController::class, 'updateCategory']);
});
