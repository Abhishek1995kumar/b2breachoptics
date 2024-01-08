<?php

use App\UsersModel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;


Route::get('/user/login', 'Auth\ProfileLoginController@showLoginFrom')->name('user.login');
Route::post('/user/login', 'Auth\ProfileLoginController@login')->name('user.login.submit');

Route::get('/verifyOTP', function(){
	return view('submitotp');
})->name('verifyOTP');

Route::get('/verifyOTPWithCheckout', function(){
    return view('submitotpforcheckout');
})->name('verifyOTPWithCheckout');

Route::post('/verifyOTP', 'LangController@checkOTP')->name('checkOTP');
Route::post('/verifyOTPWithCheckout', 'LangController@checkOTPWithCheckout')->name('checkOTPWithCheckout');


Route::get('/cart', 'FrontEndController@cart')->name('user.cart');
Route::post('/showprescription/{id}', 'FrontEndController@showprescription');

// URL for forward API ----------------------------------------------
Route::any('/shipping','TestController@generateShipRocketToken');

Route::any('/create_order/{id}', 'TestController@create_order');
Route::post('/courier_order/{id}', 'TestController@courier_order');
Route::any('/pickups/{id}', 'TestController@pickup_date');
Route::any('/manifest/{id}', 'TestController@generate_manifest');
Route::any('/downloadlabel/{id}','TestController@create_label');
Route::any('/downloadinvoice/{id}','TestController@create_invoice');

Route::get('/detail/{id}','TestController@order_detail');

Route::any('/track/{id}','TestController@track_product');

// URL for Return API -----------------------------------------------
Route::any('/return_order/{id}','TestController@return_order');

Route::get('/check_return_courier/{id}','TestController@return_check_serviceability');

Route::post('/return_courier/{id}','TestController@return_courier_order');

Route::any('/Get_all_shippment/{id}', 'TestController@Get_all_shippment');
Route::any('/cancel_order/{id}', 'TestController@cancel_order');
Route::any('/cancel_shipment/{id}', 'TestController@cancel_shipment');
Route::any('/update_order/{id}', 'TestController@update_order');


Route::get('delete/{id}','VendorsController@destroy');




// Route::get('/admin', function () {
//     return view('admin.index');
// })->name('admin.login')->middleware('underconstruction');

Route::get('/vendor', function () {
    return view('vendor.index');
})->name('vendor.login');

Route::get('/login', function () {
    return view('admin.login');
});

Route::get('admin/themecolor', function () {
    return view('admin.themecolor');
});

Route::delete('/deletemyaccount', 'VendorProfileController@deletemyvendor')->name('deletevendorsaccount.delete');

Auth::routes();


Route::get('/vendor', 'Auth\VendorLoginController@showLoginFrom')->name('vendor.login');
Route::post('/vendor/login', 'Auth\VendorLoginController@login')->name('vendor.login.submit');
Route::post('/vendor/generateOTP', 'Auth\VendorLoginController@generateOTP')->name('vendor.login.submitotp');

Route::get('/vendor/registration', 'Auth\VendorRegistrationController@showRegistrationForm')->name('vendor.reg');
Route::post('/vendor/registration', 'Auth\VendorRegistrationController@register')->name('vendor.reg.submit');



Route::get('/vendor/withdraws', 'VendorController@withdraws');
Route::get('/vendor/withdrawmoney', 'VendorController@withdraw');
Route::post('/vendor/withdrawsubmit', 'VendorController@withdrawsubmit')->name('account.withdraw.submit');;
Route::get('/vendor/dashboard', 'VendorController@index')->name('vendor.dashboard');
Route::post('vendor/products/status/{id}/{status}', 'VendorProductsController@status');

Route::post('/vendor/products/add', 'VendorProductsController@store'); //Nik Add
Route::post('/vendor/products/update', 'VendorProductsController@update');

Route::resource('/vendor/products', 'VendorProductsController');


Route::get('logout', 'Auth\LoginController@logout')->name('logout');

// Admin Routes -----------------------------------------F
// Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('admin.login')->middleware('underconstruction');
Route::get('/admin', 'Auth\LoginController@showLoginForm')->name('admin.login')->middleware('disable_back');
Route::post('/login', 'Auth\LoginController@login')->name('login');


Route::middleware(['disable_back'])->group(function() {
    Route::prefix('admin')->middleware(['auth:web'])->group(function() {
        Route::get('/dashboard', 'HomeController@index')->name('admin.dashboard');
        Route::post('/updatecolor', 'SettingsController@themecolor');
        Route::post('/settings/title', 'SettingsController@title');
        Route::post('/settings/payment', 'SettingsController@payment');
        Route::post('/settings/about', 'SettingsController@about');
        Route::post('/settings/address', 'SettingsController@address');
        Route::post('/settings/footer', 'SettingsController@footer');
        Route::post('/settings/logo', 'SettingsController@logo');
        Route::post('/settings/favicon', 'SettingsController@favicon');
        Route::post('/settings/pickup', 'SettingsController@pickup');
        Route::get('/settings/pickup-del/{id}', 'SettingsController@pickdel');
        Route::post('/settings/background', 'SettingsController@background');
        Route::get('/language-settings', 'SettingsController@setlanguage');
        Route::post('/settings/language', 'SettingsController@language');
        Route::resource('/settings', 'SettingsController');
    
        Route::resource('/sliders', 'SliderController');
        
        Route::get('/customers/email/{id}', 'CustomerController@email');
        Route::post('/customers/emailsend', 'CustomerController@sendemail');
        
        Route::get('/customers/pending', 'CustomerController@pending');
        Route::post('/customer/accept/{id}', 'CustomerController@accept');
        Route::get('/customer/reject/{id}', 'CustomerController@reject');
        Route::get('/customer/view/{id}', 'CustomerController@show');
        Route::post('/customer/destroy', 'CustomerController@destroy');
            
        Route::post('/customers/get_active_customer_details', 'CustomerController@get_active_customer_details');
        
        Route::post('/customerexportsalesreport','CustomerController@customerexportExcel');
        Route::post('/vendorexportexcel','VendorsController@vendorexportExcel');
        
        Route::resource('/customers', 'CustomerController');
        
        Route::get('/vendors/accept/{id}', 'VendorsController@accept');
        Route::get('/vendors/reject/{id}', 'VendorsController@reject');
        
        Route::post('/vendors/accept/doc/{id}', 'VendorsController@acceptdoc');
        Route::post('/vendors/reject/doc/{id}', 'VendorsController@rejectdoc');
        Route::get('/vendors/waitingdoc/{id}', 'VendorsController@waitingdoc');
        Route::get('/vendors/Correction/documents', 'VendorsController@Correctiondoc');
        
        Route::get('/vendors/pending', 'VendorsController@pending');
        Route::get('/vendors/pending/documents', 'VendorsController@pendingdoc');
        Route::get('/vendors/pending/uploadeddocument', 'VendorsController@uploadeddoc');
        Route::get('/vendors/email/{id}', 'VendorsController@email');
        Route::post('/vendors/emailsend', 'VendorsController@sendemail');
        Route::resource('/vendors', 'VendorsController');
        
        Route::post('/blog/titles', 'BlogController@titles');
        Route::resource('/blog', 'BlogController');
        
        Route::post('/service/titles', 'ServiceSectionController@titles');
        Route::resource('/service', 'ServiceSectionController');
        
        Route::post('/testimonial/titles', 'TestimonialController@titles');
        Route::resource('/testimonial', 'TestimonialController');
        
        
        //Route::resource('/admin/services', 'ServiceController');
        Route::get('/categories/delete/{id}', 'CategoryController@delete');
        
        Route::resource('/categories', 'CategoryController');
        
        // Route::get('/subcats/{id}', 'SubCategoryController@subcats');
        // Route::get('/childcats/{id}', 'ChildCategoryController@childcats');
        
        
        Route::resource('/subcategory', 'SubCategoryController');
        Route::resource('/childcategory', 'ChildCategoryController');
        
        Route::get('/banner/add', 'PageSettingsController@addbanner');
        Route::get('/banner/{id}/delete', 'PageSettingsController@bannerdelete');
        Route::get('/banner/{id}/edit', 'PageSettingsController@banneredit');
        Route::post('/banner/{id}/update', 'PageSettingsController@bannerupdate');
        Route::post('/banner/save', 'PageSettingsController@bannersave');
        // for newslider added , edit,delete
        Route::get('/slider/add', 'PageSettingsController@addnewsliders');
        Route::get('/newslider/{id}/delete', 'PageSettingsController@newsliderdelete');
        Route::get('/newslider/{id}/edit', 'PageSettingsController@newslideredit');
        Route::post('/slider/save', 'PageSettingsController@newslidersave');
        Route::post('/slider/{id}/newsliderupdate', 'PageSettingsController@newsliderupdate');
        // for main slider add,edit,delete
        Route::get('/mainslider/add', 'PageSettingsController@addnewmainsliders');
        Route::post('/mainslider/save', 'PageSettingsController@mainslidersave');
        Route::get('/mainslider/{id}/delete', 'PageSettingsController@mainsliderdelete');
        Route::get('/mainslider/{id}/edit', 'PageSettingsController@mainslideredit');
        Route::post('/mainslider/{id}/mainsliderupdate', 'PageSettingsController@mainsliderupdate');
        // for small box image add,edit,delete
        Route::get('/smallbox/add', 'PageSettingsController@addsmallbox');
        Route::post('/smallbox/save', 'PageSettingsController@smallboxsave');
        Route::get('/smallbox/{id}/delete', 'PageSettingsController@smallboxdelete');
        Route::get('/smallbox/{id}/edit', 'PageSettingsController@smallboxedit');
        Route::post('/smallbox/{id}/smallboxupdate', 'PageSettingsController@smallboxupdate');
        
        
        
        Route::get('/faq/add', 'PageSettingsController@addfaq');
        Route::get('/faq/{id}/delete', 'PageSettingsController@faqdelete');
        Route::get('/faq/{id}/edit', 'PageSettingsController@faqedit');
        Route::post('/faq/{id}/update', 'PageSettingsController@faqupdate');
        Route::post('/pagesettings/faqsave', 'PageSettingsController@faqsave');
        Route::post('/banner/large', 'PageSettingsController@largebanner');
        
        Route::post('/pagesettings/about', 'PageSettingsController@about');
        Route::post('/pagesettings/faq', 'PageSettingsController@faq');
        Route::post('/pagesettings/contact', 'PageSettingsController@contact');
        Route::resource('/pagesettings', 'PageSettingsController');
        
        // Abhishek code for vendor product
        Route::get('/products/getVendorProduct', 'AdminVendorProductController@getVendorProduct'); 
        Route::post('/products/addVendorProduct', 'AdminVendorProductController@store');
        Route::get('/products/editVendorProduct/{id}', 'AdminVendorProductController@editVendorProduct');
        Route::post('/products/updateVendorProduct', 'AdminVendorProductController@updateVendorProduct');
        Route::post('/product_color_attr','AdminVendorProductController@product_color_attr');
        Route::post('/attr_color_fetch','AdminVendorProductController@attr_color_fetch');
        Route::post('/attr_color_dropdown','AdminVendorProductController@attr_color_dropdown');
        Route::post('/products/get_vendor_list_details', 'AdminVendorProductController@get_vendor_list_details');
        Route::post('/products/vendor_product_details', 'AdminVendorProductController@vendor_product_details');
        Route::post('/products/add_avail_product_color', 'AdminVendorProductController@add_avail_product');
        Route::post('/products/getattrcolordata', 'AdminVendorProductController@getattrcolordata');
        Route::get('/products/vendor_product_view/{id}', 'AdminVendorProductController@vendor_product_view');
        Route::post('/attr_color_list','AdminVendorProductController@attr_color_list');
        Route::post('/updateColorValue','AdminVendorProductController@updateColorValue');
        Route::post('/getDownloadExcel','AdminVendorProductController@getDownloadExcel');
        
        Route::get('/products/pending', 'ProductController@pending');
        Route::get('/products/accept/{id}', 'ProductController@accept');
        Route::get('/products/reject/{id}', 'ProductController@reject');
        Route::get('/products/rejectnote/{id}', 'ProductController@storenote');
        
        Route::get('/products/pending/{id}', 'ProductController@pendingdetails');
        Route::post('/products/status/{id}/{status}', 'ProductController@status');
        Route::post('/products/add', 'ProductController@store'); //Nik Add
        
        Route::post('/products/update', 'ProductController@update'); //Nik Add
        Route::resource('/products', 'ProductController');
        Route::post('/products/brands', 'ProductController@');
        Route::get('/products/brand-del/{id}', 'ProductController@');
        Route::post('/deleteproduct/{id}', 'ProductController@destroy');
        Route::post('/products/get_list_details', 'ProductController@get_list_details');
        
        // vendor product list url ---------------
        Route::post('/products/get_vendor_list_details', 'ProductController@get_vendor_list_details');
        Route::post('/products/get_vendor_pending_list_details', 'ProductController@get_vendor_pending_list_details');
        Route::post('/products/vendor/productupdate', 'ProductController@vendorProductUpdate');
        Route::get('/products/{id}/view', 'ProductController@vendorProductView');
        Route::post('/products/vendor_product_update', 'ProductController@vendor_product_update');
        Route::post('/vendorproductexcel', 'ProductController@vendorProductExcel');

        Route::get('/ads/status/{id}/{status}', 'AdvertiseController@status');
        Route::post('/customers/create', 'CustomerController@create');
          Route::post('/customers/savecostprice', 'CustomerController@savecostprice');
        // routes for  paymentoverview
        Route::get('/Paymentoverview', 'AdminProfileController@Paymentoverview');
        Route::get('/Paymentview', 'AdminProfileController@Paymentview');
        Route::get('/orderpayment/view/{id}', 'AdminProfileController@pendingpaymentoverview');
        Route::get('/cancelpayment/view/{id}', 'AdminProfileController@cancelpaymentoverview');
        Route::get('/returnpayment/view/{id}', 'AdminProfileController@returnpaymentoverview');
        Route::get('/todaypayment/view/{id}', 'AdminProfileController@todayssettlement');
        // Route::get/venodor/view/{id}','AdminProfileController@getview')->name('tests.create');
        Route::get('/vendors/view/{id}', 'AdminProfileController@vendorsview');
        
        Route::resource('/ads', 'AdvertiseController');
        Route::resource('/social', 'SocialLinkController');
        Route::resource('/tools', 'SeoToolsController');
        Route::get('/subscribers/download', 'SubscriberController@download');
        
        Route::resource('/subscribers', 'SubscriberController');
        Route::post('/adminpassword/change/{id}', 'AdminProfileController@changepass');
        Route::get('/adminpassword', 'AdminProfileController@password');
        Route::resource('/adminprofile', 'AdminProfileController');
        
        Route::get('/withdraws/pending', 'WithdrawController@pendings');
        Route::get('/withdraws/accept/{id}', 'WithdrawController@accept');
        Route::get('/withdraws/reject/{id}', 'WithdrawController@reject');
        Route::resource('/withdraws', 'WithdrawController');
        
        Route::get('/orders/status/{id}/{status}', 'OrderController@status');
        Route::get('/orders/email/{id}', 'OrderController@email');
        Route::post('/orders/emailsend', 'OrderController@sendemail');
        Route::resource('/orders', 'OrderController');
        // Nik 
        Route::post('/manualorders/combine_details_fetch', 'ManualOrderController@combine_details_fetch')->name('combine_details_fetch');
        Route::get('/manualorders/status/{id}/{status}', 'ManualOrderController@status');
        Route::post('/manualorders/status', 'ManualOrderController@status')->name('status');
        Route::post('/courierboy/{id}','ManualOrderController@courier_boy');
        Route::get('/returnorder/{id}/{status}','ManualOrderController@returnOrder');
        Route::resource('/manualorders', 'ManualOrderController');
        
        // for server side -------------------------
        Route::post('/manualorders/get_order_details', 'ManualOrderController@get_order_details');
        Route::post('/manualorders/get_order_process_details', 'ManualOrderController@get_order_process_details');
    
        Route::post('/manualorders/get_reach_cancel_details', 'ManualOrderController@get_reach_cancel_details');
        Route::post('/manualorders/get_vendor_cancel_details', 'ManualOrderController@get_vendor_cancel_details');
        
        Route::post('/manualorders/order_details_fetch', 'ManualOrderController@order_details_fetch')->name('order_details_fetch');
        
        // new route for export data
        Route::post('/orders', 'OrderController@serach')->name('search');
        Route::post('/orders/vendor','OrderController@searchvendor')->name('searchvendor');
        Route::get('/allstatus', 'OrderController@exportCsv')->name('exportcsv');
        Route::get('/picked', 'OrderController@exportpickedCsv')->name('exportpickedcsv');
        Route::get('/pending', 'OrderController@exportpendingCsv')->name('exportpendingcsv');
        Route::get('/confirmed', 'OrderController@exportconfirmedCsv')->name('exportconfirmedcsv');
        Route::get('/shipped', 'OrderController@exportshippedCsv')->name('exportshippedcsv');
        Route::get('/delivered', 'OrderController@exportdeliverdCsv')->name('exportdeliveredcsv');
        
        // for cancel & return order model
            
        Route::get('/returnorders', 'OrderController@returnorderview');
        
        // create route for return order and cancelled order
        Route::get('/return/order/view/{id}', 'OrderController@returnorderdetails');
        Route::get('/cancel/order/view/{id}', 'OrderController@cancelorderdetails');
        
        Route::get('/return/order/vendorlist','OrderController@loadvendorlist');
        Route::get('/return/order/adminlist','OrderController@loadadminlist');
        
        // end create route for return order and cancelled order
        
        // pranali's code for bottom slider
        
        Route::get('/bottomslider/add','PageSettingsController@addbottomslider');
        Route::post('/bottomslider/save', 'PageSettingsController@bottomslidersave');
        Route::get('/bottomslider/{id}/edit', 'PageSettingsController@bottomslideredit');
        Route::post('/bottomslider/{id}/bottomsliderupdate', 'PageSettingsController@bottomsliderupdate');
        Route::get('/bottomslider/{id}/delete', 'PageSettingsController@bottomsliderdelete');
        // end of pranali's code for bottom slider
        
        // pranali's code for blog policy section
        
        Route::get('/policy/add','BlogController@createpolicy');
        Route::post('/policy/store','BlogController@storepolicy');
        Route::get('/policy/{id}/edit', 'BlogController@policyedit');
        Route::delete('/policy/del/{id}', 'BlogController@policydestroy');
        Route::post('/policy/update/{id}','BlogController@policyupdate');
        // end of pranali's code for blog policy section
    
        // blog ourofferings section start//
        Route::get('/OurOfferings/add','BlogController@createourofferings');
        Route::post('/OurOfferings/store','BlogController@storeourofferings');
        Route::delete('/OurOfferings/del/{id}', 'BlogController@OurOfferingsdestroy');
        // Route::get('/OurOfferings/{id}','FrontEndController@OurOfferings');
        //blog ourofferings section end//
        
        // Role and Permission Model Routes ------------------------
        Route::get('/manageroles', 'RolleManagerController@rolleformlist')->name('manageroles');
        Route::get('/rolecreate', 'RolleManagerController@rolleCreateform')->name('role.create');
        Route::post('/rolestore', 'RolleManagerController@storerole')->name('role.store');
        Route::get('/roledit/{id}', 'RolleManagerController@roleEdit')->name('role.edit');
        Route::post('/updaterole', 'RolleManagerController@updateRole')->name('role.updaterole');
        Route::get('/adminrole', 'RolleManagerController@adminrole')->name('adminrole.create');
        Route::post('/adminrolestore', 'RolleManagerController@adminrolestore')->name('adminrole.store');
        Route::get('/adminroledit/{id}', 'RolleManagerController@rolleEditform')->name('adminrole.edit');
        Route::post('/adminroleupdate', 'RolleManagerController@rolleUpdate')->name('adminrole.update');
    
        Route::get('/permission/{id}', 'PermissionManagerController@permissionCreateform')->name('permission.create');
        Route::post('/permissionstore', 'PermissionManagerController@permissionStore')->name('permission.store');
        Route::post('/category_permission', 'PermissionManagerController@Product_list_category_permission')->name('permission.category');
    
        Route::get('/managerole/status/{id}/{status}', 'RolleManagerController@adminRoleStatus')->name('adminrole.status');
        Route::resource('/admin/managerole', 'RolleManagerController');
        
        // for server side -------------------------
        Route::post('/manualorders/get_order_details', 'ManualOrderController@get_order_details');
        Route::post('/manualorders/get_order_process_details', 'ManualOrderController@get_order_process_details');
        Route::post('/manualorders/get_total_order_details', 'ManualOrderController@get_total_order_details');
        Route::post('/manualorders/get_ready_for_pickup_details', 'ManualOrderController@get_ready_for_pickup_details');
        Route::post('/manualorders/get_in_transit_details', 'ManualOrderController@get_in_transit_details');
        Route::post('/manualorders/get_delivered_details', 'ManualOrderController@get_delivered_details');
        Route::post('/select-orders','ManualOrderController@changeallselectedsts')->name('manualorder.accept');
        Route::get('/cancelorders', 'ManualOrderController@cancelorderview');
        
        Route::get('/brand/add', 'PageSettingsController@addbrand');
        Route::get('/brand/{id}/delete', 'PageSettingsController@branddelete');
        Route::get('/brand/{id}/edit', 'PageSettingsController@brandedit');
        Route::post('/brand/{id}/update', 'PageSettingsController@brandupdate');
        Route::post('/brand/brandsave', 'PageSettingsController@brandsave');
        
         //Nik Product Baner Here
        Route::get('/product_baner/add', 'PageSettingsController@productbaners');
        Route::post('/product_baner/save', 'PageSettingsController@product_Baner_form');
        Route::get('/product_baner/{id}/delete', 'PageSettingsController@Product_baner_delete');
        // Product Setting -----------
        
        Route::get('/productsetting', 'BrandsController@index');
        
        Route::get('/brands/addbrand', 'BrandsController@getBrand');
        Route::post('/brands/insert', 'BrandsController@addBrand')->name('brands.save');
        Route::get('/brands/delete/{id}', 'BrandsController@deleteBrand');
        
        //kishu start code//
        Route::get('/brand/editbrand/{id}', 'BrandsController@editbrand');
        Route::post('/brand/edit/{id}', 'BrandsController@brandUpdate')->name('admin.brand.edit');
        
        Route::get('/material/create', 'MaterialController@getMaterial');
        Route::post('/material/insert', 'MaterialController@addMaterial')->name('material.save');
        Route::get('/material/delete/{id}', 'MaterialController@deleteMaterial');
        
        //kishori start code//
        Route::get('/material/editmaterial/{id}', 'MaterialController@editMaterial');
        Route::post('/admin/updatematerial/{id}', 'MaterialController@updatematerial')->name('admin.material.edit');
        
        Route::get('/lenscolor/create', 'ColorController@getColor');
        Route::post('/color/insert', 'ColorController@addColor')->name('color.save');
        Route::get('/color/delete/{id}', 'ColorController@deleteColor');
        
        //kishori start code//
        Route::get('/editlenscolor/{id}', 'ColorController@editlenscolor');
        Route::post('/admin/updatecolorlens/{id}', 'ColorController@updatecolorlens')->name('admin.colorlens.edit');
        
        Route::get('/lens_coating/create', 'ProductsettingController@getLensCoating');
        Route::post('/lens_coating/insert', 'ProductsettingController@addLensCoating')->name('coating.save');
        Route::get('/lens_coating/delete/{id}', 'ProductsettingController@deleteLensCoating');
        
        Route::get('/lens_index/create', 'ProductsettingController@getLensIndex');
        Route::post('/lens_index/insert', 'ProductsettingController@addLensIndex')->name('lens_index.save');
        Route::get('/lens_index/delete/{id}', 'ProductsettingController@deleteLensIndex');
        
        Route::get('/lens_technology/create', 'ProductsettingController@getLensTechnology');
        Route::post('/lens_technology/insert', 'ProductsettingController@addLensTechnology')->name('lens_technology.save');
        Route::get('/lens_technology/delete/{id}', 'ProductsettingController@deleteLensTechnology');
        
        Route::get('/contactlens/create', 'ColorController@getContactColor');
        Route::post('/contactlens/insert', 'ColorController@contactColorAdd')->name('contactcolor.save');
        Route::get('/contactlens/delete/{id}', 'ColorController@deleteContactColor');
        
        //kish start code//
        Route::get('/contactlens/editcontactlenscolor/{id}', 'ColorController@editcontactlenscolor');
        Route::post('/admin/updatecontactcolorlens/{id}', 'ColorController@updatecontactlenscolor')->name('admin.contactlenscolor.edit');
        
        // Nik 
        Route::get('/shape/create', 'ProductsettingController@createshape');
        Route::post('/shape/insert', 'ProductsettingController@shapeAdd')->name('shape.save');
        Route::get('/shape/delete/{id}', 'ProductsettingController@shape_delete');
        
        //kish start code//
        Route::get('/shape/editshape/{id}', 'ProductsettingController@editshape');
        Route::post('shape/edit/{id}', 'ProductsettingController@shapeUdate')->name('admin.shape.edit');
        
        Route::get('/frame_color/create', 'ProductsettingController@createframecolor');
        Route::post('/frame_color/insert', 'ProductsettingController@framecolorAdd')->name('framecolor.save');
        Route::get('/frame_color/delete/{id}', 'ProductsettingController@frame_delete');
        
        //kish start code//
        Route::get('/frame_color/editframe/{id}', 'ProductsettingController@editframcolor');
        Route::post('frame_color/edit/{id}', 'ProductsettingController@framecolorUdate')->name('admin.colorframe.edit');
        
        Route::get('/frame_material/create', 'ProductsettingController@createframematerial');
        Route::post('/frame_material/insert', 'ProductsettingController@framematerialAdd')->name('framematerial.save');
        Route::get('/frame_material/delete/{id}', 'ProductsettingController@frame_material_delete');
        
        //kishori start code//
        Route::get('/frame_material/editframematerial/{id}', 'ProductsettingController@editframematerial');
        Route::post('frame_material/edit/{id}','ProductsettingController@framematerialUdate')->name('admin.framematerial.edit');
        
        //kishori start code//
        Route::get('/contactproductpackaging/create', 'ProductsettingController@createpackaging');
        Route::post('/contactproductpackaging/insert', 'ProductsettingController@packagingAdd')->name('contactlenspackaging.save');
        Route::get('/contactlenspackaging/delete/{id}', 'ProductsettingController@contactlenspackaging_delete');
        Route::get('/contactproductpackaging/editcontactlenspackaging/{id}', 'ProductsettingController@editcontactlenspackaging');
        Route::post('contactproductpackaging/edit/{id}','ProductsettingController@contactpackagingUdate')->name('admin.contactlenspackage.edit');

        Route::get('/report_attr', 'ReportController@index');
        Route::get('/report_list', 'ReportController@report_list');
        Route::post('/listPurchase', 'ReportController@listPurchase');
        Route::get('/export','ReportController@Export')->name('admin/export');
        
        Route::get('/sales_report_list', 'ReportController@sales_report_list');
        Route::post('/getSalesOrder', 'ReportController@getSalesOrder');
        Route::post('/exportsalesreport', 'ReportController@exportExcel');
        Route::post('/exportcancelreport', 'ReportController@exportCancelExcel');
        Route::post('/get_country', 'ReportController@getState');
        
        Route::get('/cancil_report_list', 'ReportController@cancilReportList');
        Route::post('/getCancilOrder', 'ReportController@getCancilOrder');
        
        // Return Report Abhishek
        Route::get('/returnOrderList', 'ReportController@returnOrderList');
        Route::post('/getReturnOrderDetails', 'ReportController@getReturnOrderDetails');
        Route::post('/getExportExcel', 'ReportController@getExportExcel');
        
        Route::get('/coupan', 'CoupanController@index');
        Route::get('/coupan/addCoupan', 'CoupanController@getCoupan');
        Route::get('/coupan/editCoupan/{id}', 'CoupanController@getCoupan');
        Route::post('/coupan/insert', 'CoupanController@addCoupan')->name('coupan.save');
        Route::get('/coupan/status/{status}/{id}', 'CoupanController@status');
        Route::post('/coupan/delete/{id}', 'CoupanController@deleteCoupan');
        Route::post('/coupan/import_excel', 'CoupanController@importCoupan')->name('import_excel');
        Route::get('/coupan/export', 'CoupanController@excelData');
        Route::post('/coupan/export_coupon_excel', 'CoupanController@export_coupon_excel');
        Route::post('/coupan/export_sample_coupon_excel', 'CoupanController@export_sample_coupon_excel');
        
        Route::post('/fetch_attr_color_list_view','ProductController@fetch_attr_color_list_view');
        Route::post('/export_cancel_excel', 'ProductController@exportCancelExcel')->name('export.excel');
        Route::post('/export_excel', 'ProductController@exportExcel')->name('export.excel');
    });


// User Panel -----------------------

Route::get('/','FrontEndController@videoplay');
Route::get('/homepage', 'FrontEndController@homepage');

Route::get('/home', 'FrontEndController@index');
Route::get('/language', 'FrontEndController@language');
Route::get('/track', 'FrontEndController@track');
Route::get('/about', 'FrontEndController@about');
Route::get('/faq', 'FrontEndController@faq');
Route::get('/contact', 'FrontEndController@contact');
Route::get('/listall', 'FrontEndController@all');
Route::get('/listfeatured', 'FrontEndController@featured');
Route::get('/services/{category}', 'FrontEndController@category');
Route::get('/services/order/{id}', 'FrontEndController@order');
Route::post('/subscribe', 'FrontEndController@subscribe');
Route::post('/profile/email', 'FrontEndController@usermail');
Route::post('/contact/email', 'FrontEndController@contactmail');
Route::get('/profile/{id}/{name}', 'FrontEndController@viewprofile');
Route::get('product/{id}/{title}', 'FrontEndController@productdetails');
Route::get('/do_login_into_ci', 'FrontEndController@do_login_into_ci')->name('do_login_into_ci');
Route::post('product/changeImage/', 'FrontEndController@getImageData');

Route::get('productshoww/{id}/{color}', 'FrontEndController@productshoww');
Route::post('productshoww/{id}/{color}', 'FrontEndController@productshoww');
Route::post('check-product-qty', 'FrontEndController@checkProductQty');

Route::get('loadcategory/{slug}/{page}', 'FrontEndController@loadcatproduct');
Route::get('category/{slug}', 'FrontEndController@catproduct');

Route::get('category/new/{id}', 'FrontEndController@catproductnew');
Route::get('tags/{tag}', 'FrontEndController@tagproduct');
Route::get('/blogs', 'FrontEndController@allblog');
Route::get('/blog/{id}', 'FrontEndController@blogdetails');
Route::get('shop/{id}', 'FrontEndController@vendorproduct');
Route::get('shop/{id}/{name}', 'FrontEndController@vendorproduct');
Route::get('loadvendor/{id}/{page}', 'FrontEndController@loadvendproduct');
Route::get('search/{search}', 'FrontEndController@searchproduct');

Route::get('quick-view/{id}', 'FrontEndController@getProduct');

Route::post('user/review', 'FrontEndController@reviewsubmit')->name('review.submit');

Route::get('/checkout', 'UserProfileController@checkout')->name('user.checkout');

Route::get('user/dashboard', 'UserProfileController@index')->name('user.account');
Route::get('user/account-information', 'UserProfileController@accinfo')->name('user.accinfo');
Route::get('user/account-password', 'UserProfileController@userchangepass')->name('user.accpass');
Route::get('user/orders', 'UserProfileController@userorders')->name('user.orders');
Route::get('user/subuserorders', 'UserProfileController@subuserorders')->name('user.subuserorders');
Route::get('user/order/{id}', 'UserProfileController@userorderdetails');
Route::get('/user/get_prescription_details/{id}', 'UserProfileController@prescriptionDetailsOrder');
Route::post('user/cancelorder/{id}', 'UserProfileController@ordercancel');
Route::post('user/returnorder/{id}', 'UserProfileController@returnorder');

Route::post('user/orders/get_active_userorder_details', 'UserProfileController@get_active_userorder_details');
Route::post('user/orders/get_active_subuserorder_details', 'UserProfileController@get_active_subuserorder_details');
Route::post('user/orders/get_active_childuserorder_details', 'UserProfileController@get_active_childuserorder_details');


Route::post('/user/buyer_invoice', 'UserProfileController@buyer_invoice')->name('buyer_invoice');

Route::post('/fetchConversionRight', 'FrontEndController@fetchConversionRight');

Route::get('user/cancelreturnorder/{id}', 'UserProfileController@cancelreturnorder');
Route::get('user/downloadinvoice/{id}','UserProfileController@download_invoice');


// Route::get('user/deleteaccount/{id}', 'UserProfileController@deleteuser');
Route::delete('/deleteaccount', 'UserProfileController@deleteuser')->name('deleteaccount.destroy');
///Route::get('/deleteaccount','UserProfileController@deleteuserpage');
Route::post('user/update/{id}', 'UserProfileController@update')->name('user.update');
Route::post('user/passchange/{id}', 'UserProfileController@passchange')->name('user.passchange');


Route::get('/cartdelete/{id}/{color?}', 'FrontEndController@cartdelete');
Route::get('/cartupdate', 'FrontEndController@cartupdate');
Route::post('/cartupdate', 'FrontEndController@cartupdate');

// Get state city -------------------------------------------
Route::post('get_country_state', 'UserProfileController@getState');
Route::post('get_state_city', 'UserProfileController@getCity');
// Extra admin url -----------------------------------------------------------------

// get coupon code ---------------------------
Route::post('/get_coupon', 'UserProfileController@getCoupon');
// end ---------------------------------------

Route::get('manualgeneratePDF/{id}','ManualOrderController@generatePDF');
Route::get('vendormanualgeneratePDF/{id}','VendorManualOrderController@generateVendorPDF');
Route::get('/policydetails/{id}', 'FrontEndController@policydetails');

Route::get('img/destroy/{id}', 'ProductController@deleteimg');
Route::post('/add_product_color','ProductController@add_product_color');
Route::post('/fetch_attr_color_list','ProductController@fetch_attr_color_list');
Route::post('/update_attr_color_list','ProductController@update_attr_color_list');
Route::post('/delete_attr_color','ProductController@delete_attr_color');
Route::post('/fetch_attr_color_dropdown','ProductController@fetch_attr_color_dropdown');
Route::post('/add_product_color','ProductController@add_product_color');


Route::get('/subcats/{id}', 'SubCategoryController@subcats');
Route::post('/childcats', 'ChildCategoryController@childcats');

// End extra admin url -------------------------------------------------------------

Route::get('/vendor/vendor_report', 'VendorReportController@index');

Route::get('/vendor/report_list', 'VendorReportController@report_list');
Route::post('/vendor/listPurchase', 'VendorReportController@listPurchase');
Route::get('/vendor/export','VendorReportController@Export')->name('admin/export');

Route::get('/vendor/sales_report_list', 'VendorReportController@sales_report_list');
Route::post('/vendor/getSalesOrder', 'VendorReportController@getSalesOrder');
Route::post('/vendor/exportsalesreport', 'VendorReportController@exportExcel');
Route::post('/vendor/get_country', 'VendorReportController@getState');


Route::get('/vendor/cancil_report_list', 'VendorReportController@vendorcancilReportList');
Route::post('/vendor/getCancilOrder', 'VendorReportController@getCancilOrder');
Route::post('/vendor/getExportCancilOrder', 'VendorReportController@getExportCancilOrder');

Route::get('/vendor/return_order_details', 'VendorReportController@return_order_details');
Route::post('/vendor/return_order_data_from_database', 'VendorReportController@return_order_data_from_database');
Route::post('/vendor/export_return_order_data', 'VendorReportController@export_return_order_data');

        
Route::post('updatewithbc', 'FrontEndController@updatewithbc');
// nik changes regards vendor
Route::post('/vendor/fetch_attr_color_list','VendorProductsController@fetch_attr_color_list');
Route::post('/vendor/add_product_color','VendorProductsController@add_product_color');
Route::post('/vendor/fetch_attr_color_dropdown','VendorProductsController@fetch_attr_color_dropdown');
Route::post('/vendor/delete_attr_color','VendorProductsController@delete_attr_color');
Route::post('/vendor/products/add', 'VendorProductsController@store');

// Abhishek
Route::post('/vendor/getUpdateAttributColor', 'VendorProductsController@getUpdateAttributColor');
Route::post('/vendor/getVendorExcelData', 'VendorProductsController@vendorExcelData');


// Add by Prashant-----
Route::post('/vendor/product/get_vendor_product_details', 'VendorProductsController@get_vendor_product_details');
Route::post('/vendor/product/get_vendor_change_list_details', 'VendorProductsController@get_vendor_change_list_details');
Route::post('/vendor/product/chek_changes_product', 'VendorProductsController@chek_changes_product');
Route::post('/vendor/get_brand_name', 'VendorProductsController@get_brand_name');
// end changes vendor

// end changes vendor


// Add By Nik..
Route::get('/user/password_reset', 'Auth\ProfileResetPassController@password_reset')->name('user.password_reset');
Route::post('/user/test','Auth\ProfileResetPassController@test')->name('user.test');
Route::post('fetch-states', 'UserProfileController@fetchState');
// Add By Vendor Nik..
Route::get('/vendor/password_reset', 'Auth\VendorResetPassController@password_reset')->name('vendor.password_reset');
Route::post('/vendor/password_set','Auth\VendorResetPassController@Password_set')->name('vendor.password_set');

// Route::post('/fetch-states', 'UserProfileController@fetchState')->middleware('auth');
Route::post('fetch-city', 'UserProfileController@fetchCity');


Route::post('states', 'Auth\ProfileRegistrationController@fetchState');
Route::post('city', 'Auth\ProfileRegistrationController@fetchCity');   
 
Route::get('/vendor/vendorpassword', 'VendorProfileController@password');
Route::post('/vendor/vendorpassword/change/{id}', 'VendorProfileController@changepass');
Route::resource('/vendor/vendorprofile', 'VendorProfileController');
Route::post('/vendor/businessdetails','VendorProfileController@AddBusinessDetails')->name('businessdetails.submit');
Route::post('/vendor/bankdetails','VendorProfileController@AddBankDetails')->name('bankdetails.submit');


// end for cancel & order model

// for server side -------------------------
Route::post('/vendor/manualorders/status/{id}/{status}', 'VendorManualOrderController@status');
Route::post('vendor/manualorders/get_order_details', 'VendorManualOrderController@get_order_details');
Route::post('vendor/manualorders/get_order_process_details', 'VendorManualOrderController@get_order_process_details');
Route::post('vendor/manualorders/get_total_order_details', 'VendorManualOrderController@get_total_order_details');
Route::post('vendor/manualorders/get_ready_for_pickup_details', 'VendorManualOrderController@get_ready_for_pickup_details');
Route::post('vendor/manualorders/get_in_transit_details', 'VendorManualOrderController@get_in_transit_details');
Route::post('vendor/manualorders/get_delivered_details', 'VendorManualOrderController@get_delivered_details');
Route::post('vendor/select-orders','VendorManualOrderController@changeallselectedsts')->name('vendormanualorder.accept');
Route::post('vendor/courierboy/{id}','VendorManualOrderController@courier_boy');

Route::post('vendor/manualorders/order_details_fetch', 'VendorManualOrderController@order_details_fetch')->name('vendor_order_details_fetch');
Route::post('vendor/manualorders/combine_details_fetch', 'VendorManualOrderController@combine_details_fetch')->name('vendor_combine_details_fetch');
Route::resource('vendor/manualorders', 'VendorManualOrderController');

Route::get('vendor/returnorders', 'VendorManualOrderController@returnorder');
Route::get('vendor/cancelorders', 'VendorManualOrderController@cancelorder');
Route::get('vendor/return/order/view/{id}', 'VendorManualOrderController@returnorderdetails');
Route::get('vendor/cancel/order/view/{id}', 'VendorManualOrderController@cancelorderdetails');

// Route::get('/vendor/orders/status/{id}/{status}', 'VendorOrdersController@status');
// Route::resource('/vendor/orders', 'VendorOrdersController');
// // new route for vendor orders
// Route::post('vendor/select-orders','VendorOrdersController@changeallselectedsts')->name('vendor.accept');
// Route::post('vendor/confirmed-order','VendorOrdersController@confirmallselectedorders')->name('vendor.confirm');
// Route::post('vendor/bookslot/{id}','VendorOrdersController@vendorbookslot');
// Route::get('vendor/generatePDF/{id}','VendorOrdersController@generatePDF');
// Route::get('vendor/genrateacknowladgeslip/{id}','OrderController@acknowladgeslip');
// Route::get('vendor/downloadpickupslip/{id}','OrderController@downloadpickupslip');
// Route::get('/vendor/returnorders', 'VendorOrdersController@returnorder');
// Route::get('/vendor/cancelorders', 'VendorOrdersController@cancelorder');
// Route::get('vendor/return/order/view/{id}', 'VendorOrdersController@returnorderdetails');
// Route::get('vendor/cancel/order/view/{id}', 'VendorOrdersController@cancelorderdetails');

// url for payment overview

Route::get('vendor/orderpayment/view/{id}', 'VendorController@pendingpaymentoverview');
Route::get('vendor/cancelpayment/view/{id}', 'VendorController@cancelpaymentoverview');
Route::get('vendor/returnpayment/view/{id}', 'VendorController@returnpaymentoverview');
Route::get('vendor/todaypayment/view/{id}', 'VendorController@todayssettlement');

// paymentoverview
Route::get('/vendor/paymentoverview', 'VendorController@paymentoverview');

// bank and business details link
Route::get('/vendor/bankdetails', 'VendorController@bankdetails');
Route::get('/vendor/businessdetails', 'VendorController@businessdetails');
Route::post('/vendor/updatebankdetails','VendorController@UpdateBankDetails')->name('bankdetails.update');
Route::post('/vendor/updatebusinessdetails','VendorController@UpdatebusinessDetails')->name('businessname.update');




// end url for payment overview


// end new route for vendor orders

// pdf genrator
Route::get('temp/{id}','FrontEndController@generateInvoice');
Route::get('generatePDF/{id}','OrderController@generatePDF');
Route::get('genrateacknowladgeslip/{id}','OrderController@acknowladgeslip');
Route::get('downloadpickupslip/{id}','OrderController@downloadpickupslip');
// Route::post('/selected-order','OrderController@changeallselectedsts')->name('order.acceptselected'); 

Route::post('/select-orders','OrderController@changeallselectedsts')->name('order.accept');
Route::post('/confirmed-order','OrderController@confirmallselectedorders')->name('order.confirm');

// for booking slot
Route::post('bookslot/{id}','OrderController@bookslot');


Route::post('/payment', 'PaymentController@store')->name('payment.submit');
Route::get('/payment/cancle', 'PaymentController@paycancle')->name('payment.cancle');
Route::get('/payment/return', 'PaymentController@payreturn')->name('payment.return');
Route::post('/payment/notify', 'PaymentController@notify')->name('payment.notify');
Route::post('/razorpayment-complete','PaymentController@razorpaySuccess')->name('razorpayment.success');

Route::post('/stripe-submit', 'StripeController@store')->name('stripe.submit');

Route::post('/cashondelivery', 'FrontEndController@cashondelivery')->name('cash.submit');
Route::post('/mobile_money', 'FrontEndController@mobilemoney')->name('mobile.submit');
Route::post('/bank_wire', 'FrontEndController@bankwire')->name('bank.submit');

Route::post('/user/generateOTP', 'Auth\ProfileLoginController@generateOTP')->name('user.login.submitotp');
Route::get('/user/registration', 'Auth\ProfileRegistrationController@showRegistrationForm')->name('user.reg');
Route::post('/user/registration', 'Auth\ProfileRegistrationController@register')->name('user.reg.submit');

Route::get('/subuser/detail', 'UserProfileController@childuser')->name('subuser.details');
Route::get('subuser/delete/{id}', 'UserProfileController@childdelete');
Route::post('subuser/savecostprice', 'UserProfileController@childCostPrice');

Route::get('/subuser/registration', 'Auth\SubUsersRegisterController@showRegistration')->name('subuser.reg');
Route::post('/subuser/registration', 'Auth\SubUsersRegisterController@childregister')->name('subuser.reg.submit');

Route::post('states', 'Auth\SubUsersRegisterController@fetchState');
Route::post('city', 'Auth\SubUsersRegisterController@fetchCity');

Route::get('/user/forgot', 'Auth\ProfileResetPassController@showForgotForm')->name('user.forgotpass');
Route::post('/user/forgot', 'Auth\ProfileResetPassController@resetPass')->name('user.forgotpass.submit');

Route::get('/vendor/forgot', 'Auth\VendorResetPassController@showForgotForm')->name('vendor.forgotpass');
Route::post('/vendor/forgot', 'Auth\VendorResetPassController@resetPass')->name('vendor.forgotpass.submit');

// Route::get('/submitotp', 'Auth\ProfileLoginController@genrateotp')->name('user.login.otp');
//http://nimbusit.biz/api/SmsApi/SendSingleUnicodeApi?UserID=elricaglobal&Password=fkei2983FK&SenderID=ELRICA&Phno=9819790406&Msg=Your+order+with+ID+123+is+out+for+delivery+today.+ELRICA&EntityID=1701161735338698800&TemplateID=1707162192370987903
// Route::get('testing', function(){
// 	$Phno='919819790406';
//         $Msg="Your OTP is 123. ELRICA";
//         $Password='fkei2983FK';
//         $SenderID='ELRICA';
//         $UserID='elricaglobal';
//         $TemplateID='1707162192370987888';
//         $EntityID='1701161735338698800';
//         function send_message($Phno,$Msg,$Password,$SenderID,$UserID,$EntityID,$TemplateID)
//         {         
//             $ch='';
//             $url='http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID;
//             $ch = curl_init($url);
//             curl_setopt($ch,CURLOPT_URL,$url);
//             curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

//             $output=curl_exec($ch);
//             curl_close($ch);
//             return $output;
//         }

//         echo send_message($Phno,$Msg,$Password,$SenderID,$UserID,$EntityID,$TemplateID);

// });

Route::get('/testing', 'Auth\ProfileLoginController@generateOTP');
// Route::get('/singlevisionview','ProductController@singlevision');
// Route::get('/singleviewpage','ProductController@singlevisionnew');


});