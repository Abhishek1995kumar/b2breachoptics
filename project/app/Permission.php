<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = "role_permissions";
    protected $fillable = ['role_id', 'is_admin', 'manual_orders', 'return_orders', 'cancelled_orders', 'products', 'vendors',
                            'customers', 'manage_category', 'blog', 'slider_settings', 'page_settings', 'general_settings', 'subscribers',
                            'payment_overview', 'created_at', 'updated_at'];
}