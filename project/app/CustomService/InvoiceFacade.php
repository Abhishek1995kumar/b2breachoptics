<?php

namespace App\CustomService;
use Illuminate\Support\Facades\Facade;

class InvoiceFacade extends Facade {
    protected static function getFacadeAccessor() {
        return 'InvoiceFacade';
    }
}