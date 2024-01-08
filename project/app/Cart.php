<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "cart";
    protected $fillable = [
        'uniqueid',
        'title',
        'productImage',
        'category',
        'product',
        'productAttrId',
        'quantity',
        'cartcolor',
        'maincolor',
        'colorcode',
        'size',
        'cost',
        'rangenameone',
        'rangenametwo',
        'rangenamethree',
        'discount_one',
        'discount_two',
        'discount_three',
        'price',
        'main_price',
        'base_curve',
        'presc_image',
        'lefteyequantity',
        'righeyequantity',
        'botheyequantity',
        'base_curv',
        'dia',
        'Lsphere',
        'Lpower',
        'LDia',
        'LBc',
        'Laxis',    
        'Lcyle',
        'same_rx_both',
        'parameter',
        'rsphere',
        'rpower',
        'rbc',
        'rdia',
        'Raxis',
        'rcyl',
        'bsphere',
        'bpower',
        'Bbc',
        'Bdia',
        'Bcyle',
        'Baxis',
        'minus_right_eye',
        'minus_left_eye',
        'precat',
        'totalPd',
        'Lepd',
        'Repd',
        'frame_fit',
        'a_size',
        'b_size',
        'dbl',
        'r_dia',
        'l_dia',
        'r_pd',
        'l_pd',
        'bvd',
        'r_ed',
        'l_ed',
        'r_fitting',
        'l_fitting',
        'pantascopic',
        'temple_size',
        'network_distance',
        'bow_angle',
        'frame_type',
        'materials',
        'shape_code'
        
    ];
    public $timestamps = false;
}