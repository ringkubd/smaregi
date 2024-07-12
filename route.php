<?php

use Anwar\Smaregi\Controller\SmaregiController;

Route::prefix('smaregi')->group(function () {
    Route::get('/', [SmaregiController::class, 'checkConnection']);
});
