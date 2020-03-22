<?php


Route::get('/', function () {
    return view('pages.index');
});


//-------auth & user----------
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/password-change', 'HomeController@changePassword')->name('password.change');
Route::post('/password-update', 'HomeController@updatePassword')->name('password.update');
Route::get('/user/logout', 'HomeController@Logout')->name('user.logout');


//-------admin---------------
Route::get('admin/home', 'AdminController@index');
Route::get('admin', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('admin', 'Admin\LoginController@login');


//-------Password Reset Routes------------
Route::get('admin/password/reset', 'Admin\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('admin-password/email', 'Admin\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('admin/reset/password/{token}', 'Admin\ResetPasswordController@showResetForm')->name('admin.password.reset');
Route::post('admin/update/reset', 'Admin\ResetPasswordController@reset')->name('admin.reset.update');
Route::get('/admin/Change/Password', 'AdminController@ChangePassword')->name('admin.password.change');
Route::post('/admin/password/update', 'AdminController@Update_pass')->name('admin.password.update');
Route::get('admin/logout', 'AdminController@logout')->name('admin.logout');


// Admin section --------------------------


// Categories
Route::get('admin/categories', 'Admin\Category\CategoryController@category')->name('categories');
Route::post('admin/store/category', 'Admin\Category\CategoryController@storeCategory')->name('store.category');
Route::get('edit/category/{id}', 'Admin\Category\CategoryController@editCategory');
Route::post('update/category/{id}', 'Admin\Category\CategoryController@updateCategory');
Route::get('delete/category/{id}', 'Admin\Category\CategoryController@deleteCategory');


// Brands=========
Route::get('admin/brands', 'Admin\Category\CategoryController@brand')->name('brands');
Route::post('admin/store/brand', 'Admin\Category\CategoryController@storeBrand')->name('store.brand');
Route::get('edit/brand/{id}', 'Admin\Category\CategoryController@editBrand');
Route::post('update/brand/{id}', 'Admin\Category\CategoryController@updateBrand');
Route::get('delete/brand/{id}', 'Admin\Category\CategoryController@deleteBrand');


// Sub-categories=========
Route::get('admin/sub/category', 'Admin\Category\CategoryController@subcategories')->name('sub.categories');
Route::post('admin/store/subcat', 'Admin\Category\CategoryController@storeSubcat')->name('store.subcategory');
Route::get('edit/subcategory/{id}', 'Admin\Category\CategoryController@editSubcat');
Route::post('update/subcategory/{id}', 'Admin\Category\CategoryController@updateSubcat');
Route::get('delete/subcategory/{id}', 'Admin\Category\CategoryController@deleteSubcat');


// Coupon---------
Route::get('admin/sub/coupon', 'Admin\CouponController@coupon')->name('admin.coupon');
Route::post('admin/store/coupon', 'Admin\CouponController@storeCoupon')->name('store.coupon');
Route::get('edit/coupon/{id}', 'Admin\CouponController@editCoupon');
Route::post('update/coupon/{id}', 'Admin\CouponController@updateCoupon');
Route::get('delete/coupon/{id}', 'Admin\CouponController@deleteCoupon');

// Newsletters
Route::get('admin/newsletter', 'Admin\CouponController@newsletter')->name('admin.newsletter');
Route::get('delete/sub/{id}', 'Admin\CouponController@deleteSub');


// Products 
Route::get('admin/product/all', 'Admin\ProductController@index')->name('all.product');
Route::get('admin/product/add', 'Admin\ProductController@create')->name('add.product');

// Get Sub-category by AJAX
Route::get('get/subcategory/{category_id}', 'Admin\ProductController@getSubcat');




// Frontend Routes=============
Route::post('store/newsletter', 'FrontController@storeNewsletter')->name('store.newsletter');
