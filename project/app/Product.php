<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    
    protected $fillable = ['title', 'titledescription', 'vendor_name','vendorid', 'owner','category','packweight','packlength','packheight','packwidth' ,'entry_by', 'intransit_date', 'framecolor', 'pickup_date', 'tags', 'description', 'price', 'previous_price', 'stock','cateone','catetwo','make','shape','color','gender','brandname','manufracturer','warrentytype','productdimension','weight','countryoforigin','hsncode','feature_image','video','policy', 'featured', 'views', 'created_at', 'updated_at', 'status','note','productsku','sellername', 'discount_one', 'discount_two', 'discount_three', 'framestyle','framematerial','templematerial','templecolor','lensmaterialtype','leanscoating','lenscolor','lensindex','usages','disposability','packaging','powermin','powermax','focallength','diameter','shelflife','lenstechnology','watercontent','packtype','basecurve','form','productcolor','productdim','material','contactlensmaterialtype','weight','frametype','framewidth','prescriptiontype','modelno','height','conditionsnew','usagesduration','latest','tranding','selected','gravity','coatingcolor','abbevalue','netquntity','video1','video2','centerthiknessnew','cylindernew','axisnew','ranegnameone','rangenametwo','rangenamethree','vendor_name','costprice','addpower','lenstype','coating','visioneffect','powerrange','childid','subid', 'premiumtype',
                            'addpowerlens',
                            'diameterlens',
                            'sphere',
                            'single_pd',
                            'double_pd',
                            'axisnlens',
                            'cylinderlens',
                            'producttat',
                            'colorcode',
                            'approved',
                            'status'
                        ];

    public static $withoutAppends = false;
    
    public function gallery_images()
    {
        return $this->hasMany('App\Gallery', 'productid');
    }
    
    public function getProductAttribute()
    {
        return $this->hasMany('App\ProductAttr', 'product_id');
    }
    
    public function getProductAttributeColor()
    {
        return $this->hasMany('App\ProductGallery', 'pid', 'productsku');
    }

    // public function vendor() {
    //     return $this->belongsTo('App\Vendors','id');
    // }

    // public function postedBy()
    //   {
    //      return $this->belongsTo('App\Order','id');
    //   }
    

    public function getCategoryAttribute($category)
    {
        if(self::$withoutAppends){
            return $category;
        }
        return explode(',',$category);
    }

    public static function Cost($id)
    {
        $product = Product::findOrFail($id);
        // $cart = Cart::select('quantity')->where('product',$id)->first();
        // echo "<pre>";
        // print_r($cart);
        // die();
        $fees = Settings::findOrFail(1);

        // if ($cart->quantity >= 2 && $cart->quantity <=49) {
        //     $finalcost = $product->p40pieces + (($fees->dynamic_commission / 100) * $product->p40pieces) + (($fees->tax / 100) * $product->p40pieces) + $fees->fixed_commission;
        // return round($finalcost,2);
        // }
        // elseif ($cart->quantity >= 50 && $cart->quantity <=4999) {
        //    $finalcost = $product->p51pieces + (($fees->dynamic_commission / 100) * $product->p51pieces) + (($fees->tax / 100) * $product->p51pieces) + $fees->fixed_commission;
        // return round($finalcost,2);
        // }
        // elseif ($cart->quantity >= 5000) {
        //    $finalcost = $product->p5000pieces + (($fees->dynamic_commission / 100) * $product->p5000pieces) + (($fees->tax / 100) * $product->p5000pieces) + $fees->fixed_commission;
        // return round($finalcost,2);
        // }
        // else{

        //      $finalcost = $product->price + (($fees->dynamic_commission / 100) * $product->price) + (($fees->tax / 100) * $product->price) + $fees->fixed_commission;
        // return round($finalcost,2);
        // }

        $finalcost = $product->price + (($fees->dynamic_commission / 100) * $product->price) + (($fees->tax / 100) * $product->price) + $fees->fixed_commission;
        return round($finalcost,2);
       
    }

    public static function Costtwopis($id)
    {
        $product = Product::findOrFail($id);
        $fees = Settings::findOrFail(1);
        $finalcost = $product->p40pieces + (($fees->dynamic_commission / 100) * $product->p40pieces) + (($fees->tax / 100) * $product->p40pieces) + $fees->fixed_commission;
        return round($finalcost,2);
    }

     public static function Costfiftypis($id)
    {
        $product = Product::findOrFail($id);
        $fees = Settings::findOrFail(1);
        $finalcost = $product->p51pieces + (($fees->dynamic_commission / 100) * $product->p51pieces) + (($fees->tax / 100) * $product->p51pieces) + $fees->fixed_commission;
        return round($finalcost,2);
    }

     public static function Costfivethousandpis($id)
    {
        $product = Product::findOrFail($id);
        $fees = Settings::findOrFail(1);
        $finalcost = $product->p5000pieces + (($fees->dynamic_commission / 100) * $product->p5000pieces) + (($fees->tax / 100) * $product->p5000pieces) + $fees->fixed_commission;
        return round($finalcost,2);
    }

    //  public static function Subtotalone($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $cart = \DB::table('cart')->Where('product', $product);
    //     $fees = Settings::findOrFail(1);
    //     $finalcost = $product->p40pieces * $cart->quantity;
    //     return round($finalcost,2);
    // }


    public static function Filter($price)
    {
        $fees = Settings::findOrFail(1);
        $finalcost = $price - (($fees->dynamic_commission / 100) * $price) - (($fees->tax / 100) * $price) - $fees->fixed_commission;
        return ceil($finalcost);
    }

}
