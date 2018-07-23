<?php

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

Route::get('/', function () {
    return view('welcome');
});

/*=
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your admin. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace' => 'Admin', 'middleware' => [], 'prefix' => 'admin/'], function () {

    //Juste pour la fusion des attributs
    Route::get('fusion','ProductController@fusion');
    /*redactor route*/
    Route::post('/redactor-files/upload', 'FileController@upload');
    Route::post('/redactor-files/images', 'FileController@getImages');

    Route::post('/ckeditor/upload', 'FileController@uploadCKeditor');
    Route::post('/ckeditor/browse', 'FileController@browse');

    Route::get('/', 'LoginController@index');
    Route::get('login', 'LoginController@index')->name('login');
    Route::post('login', 'LoginController@store');
    Route::get('logout', 'LoginController@destroy')->name('logout');
    Route::get('get-state/{country_id}', 'RegionController@getState')->name('get-state');
    Route::post('get-coordinates','StoreController@getCoordinates');

    //Route::post('search_store','searchController@search');
    Route::get('get-brand-by-tag','BrandController@byTag');
    Route::group(['middleware' => ['auth.admin','permission']], function () {
        Route::get('profile', 'UserController@show')->name('profile');
        Route::patch('update/{id}', ['as' => 'profile.update', 'uses' => 'UserController@update']);

        Route::resource('radio','RadioController');

        Route::resource('page', 'PageController');
        Route::resource('email-template', 'EmailTemplateController');

        Route::get('account', 'AccountController@index')->name('account');
        Route::get('account', 'AccountController@index')->name('account');
        Route::get('account/add', 'AccountController@create')->name('create_account');

        Route::resource('customer', 'UserController');
        Route::resource('merchant', 'UserController');
        Route::get('account/delete/{merchant_id}', 'UserController@destroy');

        Route::resource('role', 'AdminRoleController');
        Route::get('role/destroy/{role_id}', 'AdminRoleController@destroy')->name('delete_role');

        Route::resource('banner', 'BannerController');
        Route::get('slider', 'BannerController@sliderindex')->name('slider');
        Route::resource('product-rating', 'ProductRatingController');

        /*Route::get('product/get-data', 'ProductController@getData')->name('product-data');
        Route::get('product', 'ProductController@index')->name('product');
        Route::post('product/attributes', 'ProductController@attributes')->name('get_attribute');
        Route::post('product', 'ProductController@store')->name('save_product');
        
        Route::post('product/upload', 'ProductController@uploadImage')->name('upload_product_media');
        Route::get('product/edit/{product_id}', 'ProductController@edit')->name('edit_product');
        Route::delete('product/{product_id}', 'ProductController@destroy')->name('remove_product');
        Route::post('product/{product_id}', 'ProductController@update')->name('update_product');
        Route::get('product/add', 'ProductController@create')->name('create_product');*/



        Route::post('get-tag', 'TagController@getAll')->name('tags');
        Route::post('save-tag', 'TagController@store')->name('save_tag');

        Route::post('get-brand-tag', 'BrandTagController@getAll')->name('brand_tags');
        Route::post('save-brand-tag', 'BrandTagController@store')->name('brand_save_tag');
        Route::post('remove-brand-tag', 'BrandTagController@destroy')->name('brand_remove_tag');
        Route::get('remove-request-brand/{brand_id}','BrandController@removeRequestBrand');

        Route::get('attribute', 'AttributeController@index')->name('attribute');
        Route::post('attribute', 'AttributeController@store')->name('save_attribute');
        Route::post('attribute/{attribute_id}', 'AttributeController@update')->name('update_attribute');
        Route::get('attribute/add', 'AttributeController@create')->name('create_attribute');
        Route::get('attribute/edit/{attribute_id}', 'AttributeController@edit')->name('edit_attribute');
        Route::delete('attribute/{attribute_id}', 'AttributeController@destroy')->name('delete_attribute');


        Route::get('attribute-set', 'AttributeSetController@index')->name('attribute_set');
        Route::post('attribute-set', 'AttributeSetController@store')->name('save_attribute_set');
        Route::post('attribute-set/{attribute_set_id}', 'AttributeSetController@update')->name('update_attribute_set');
        Route::get('attribute-set/add', 'AttributeSetController@create')->name('create_attribute_set');
        Route::get('attribute-set/edit/{attribute_set_id}', 'AttributeSetController@edit')->name('edit_attribute_set');
        Route::delete('attribute-set/{attribute_set_id}', 'AttributeSetController@destroy')->name('delete_attribute_set');

        Route::get('brand/get-data', 'BrandController@getData')->name('brand-data');
        Route::resource('brand', 'BrandController');
        Route::resource('special-product', 'SpecialProductController');
        Route::post('get-product','SpecialProductController@getProduct')->name('get_product');

        Route::get('category', 'CategoryController@index')->name('category');
        Route::post('category/update-order','CategoryController@updateOrder')->name('category_update_order');
        Route::post('category', 'CategoryController@store')->name('save_category');
        Route::post('category/{category_id}', 'CategoryController@update')->name('update_category');
        Route::get('category/edit/{category_id}', 'CategoryController@edit')->name('edit_category');
        Route::get('category/destroy/{category_id}', 'CategoryController@destroy')->name('delete_category');

        Route::get('sales/get-data/{status}', 'SalesController@getData')->name('orders-data');
        Route::get('sales/{status}', 'SalesController@index')->name('orders');
        Route::get('sales/view/{order_id}', 'SalesController@view')->name('orders_detail');
        Route::delete('sales/{order_id}', 'SalesController@destroy')->name('delete_order');
        Route::post('sales/update-status/{order_id}', 'SalesController@updateStatus')->name('delete_order');

        Route::get('coupon', 'CouponController@index')->name('coupon');
        Route::get('claim/price-adjustment', 'ClaimController@index')->name('price_adjustment');

        /*Route::get('affiliate', 'AffiliateController@index')->name('affiliate');
        Route::get('affiliate/generate', 'AffiliateController@create')->name('create_affiliate');*/
        Route::resource('affiliate', 'AffiliateController');

        Route::get('product-billed', 'SalesController@productBilled')->name('product_billed');
        Route::get('product-billed-detail/{id}', 'SalesController@byItemId')->name('item_detail');
        Route::post('search-product','ProductController@searchProduct');

        Route::get('company-account', 'AccountController@index')->name('company_account');
        Route::get('company-account/{id}', 'AccountController@show')->name('company_account_detail');

        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('administrator', 'AdminUserController@index')->name('administrator');
        Route::post('administrator', 'AdminUserController@store')->name('save_administrator');
        Route::post('administrator/{admin_id}', 'AdminUserController@update')->name('update_administrator');
        Route::get('administrator/create', 'AdminUserController@create')->name('add_administrator');
        Route::get('administrator/edit/{admin_id}', 'AdminUserController@edit')->name('edit_administrator');
        Route::delete('administrator/{admin_id}', 'AdminUserController@destroy')->name('delete_administrator');
        Route::resource('order-status','OrderStatusController');
        Route::resource('store','StoreController');
        Route::get('store/get-html/{index}','StoreController@getHtml');
        Route::get('brand-json','BrandController@getAllBrands');
        Route::resource('blog-category','BlogCategoryController');
        Route::resource('blog','BlogPostController');
        Route::post('get-blog-tag','BlogTagController@get');
        Route::post('save-blog-tag','BlogTagController@store');
        Route::post('get-post','BlogPostController@getPost');
        Route::resource('faq','FaqController');
        Route::resource('epartner','EpartnerController');
        Route::resource('invoice','InvoiceController');
        Route::post('remove-product-tag', 'ProductController@removeTag')->name('product_remove_tag');
        Route::get('accounting','AccountingController@index')->name('accounting_table');
        Route::get('accounting/{index}','AccountingController@reset')->name('accounting_table_reset');
        Route::get('system','SystemController@index')->name('setting_list');
        Route::post('system','SystemController@store')->name('update_setting');
        Route::get('404',function(){
            return view('admin.404');
        })->name('404');
    });

});
Route::group(['namespace' => 'Front', 'middleware' => ['language'], 'prefix' => ''], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('connexion', ['uses' => 'Auth\AuthController@getLogin', "middleware" => 'guest', 'as' => 'login']);
    Route::post('authentification', 'Auth\AuthController@postLogin')->name('login-post');
    Route::get('login-merchant', 'Auth\AuthController@loginInMerchant')->name('login-merchant');
    
    /*Route::get('sign-up', ['uses' => 'Auth\AuthController@getRegister', "middleware" => 'guest', 'as' => 'customer-sign-up'])->name('sign-up');*/
 
    Route::get('marchand/login', ['uses' => 'Auth\AuthController@getMerchantLogin', "middleware" => 'guest', 'as' => 'merchant-login']);
    Route::post('marchand/login', ['uses' => 'Auth\AuthController@postMerchantLogin', "middleware" => 'guest'])->name('merchant-login-post');

    /*Route::get('merchant/sign-up', ['uses' => 'StoreController@create', "middleware" => 'guest', 'as' => 'merchant-sign-up'])->name('merchant-sign-up-get');*/
    Route::post('merchant/sign-up', ['uses' => 'StoreController@postRegister', "middleware" => 'guest'])->name('merchant-sign-up-post');

    Route::get('get-radio/{zip}','RadioController@getRadioByZip')->name('get-radio');

    Route::post('register', 'Auth\AuthController@saveUser')->name('sign-up');
    Route::get('logout', 'Auth\AuthController@destroy')->name('logout');
    Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider')->name('auth');
    Route::get('forgot-password', ['as' => 'auth.reset.request', 'uses' => 'Auth\PasswordController@getEmail'])->name('forgot-password-get');
    Route::post('forgot-password', ['as' => 'auth.reset.submit', 'uses' => 'Auth\PasswordController@postEmail'])->name('forgot-password-post');
    Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\PasswordController@getReset'])->name('password-reset');
    Route::post('forgot', ['as' => 'auth.reset', 'uses' => 'Auth\PasswordController@postReset'])->name('forgot');
    Route::get('contacter-nous', 'ContactUsController@index')->name('contact-us-get');
    Route::post('contact-us', 'ContactUsController@send')->name('contact-us-post');
    Route::get('panier', 'CartController@index')->name('cart');
    Route::post('cart/add','CartController@add')->name('cart-add');
    Route::post('cart/update','CartController@update')->name('cart-update');
    Route::get('panier/suppression/{item_id}','CartController@remove')->name('cart-remove');
    Route::post('remove-product','ProductController@removeProduct')->name('remove-product');
    Route::post('product-sorting','ProductController@getSortByPrice')->name('product-sorting');
    Route::get('ask-product/search','ProductController@searchProduct')->name('ask-product-search');
    Route::get('ask-product','ProductController@askProduct')->name('ask-product');
    Route::post('product-available','ProductController@productExistsInLocal')->name('product-available');
    Route::post('produit/options', 'ProductController@getOptions')->name('get_options');
    Route::get('share-product-detail-on-facebook', 'ShareController@shareProductDetailOnFacebook')->name('share-product-detail-on-facebook');
    Route::get('get-all-product-in-area', 'AutocompleteController@getAllProductInArea')->name('get-all-product-in-area');
    
    Route::get('mentions-légales-clickee','PagesController@legalMention')->name('mentions-légales-clickee');
    Route::get('conditions-générales-de-vente','PagesController@PageCGV')->name('conditions-générales-de-vente');
    Route::get('conditions-générales-d-utilisation','PagesController@PageCGU')->name('conditions-générales-d-utilisation');
    Route::get('vendre-avec-nous','PagesController@SaleWithUs')->name('vendre-avec-nous');
    Route::get('presse','PagesController@PagePresse')->name('presse');
    Route::get('qui-sommes-nous', 'PagesController@PageWhoAreWe')->name('qui-sommes-nous');
    Route::get('acheter-avec-clickee', 'PagesController@PageBuyWithClickee')->name('acheter-avec-clickee');
    Route::get('nos-conseils-photo','PagesController@PageOurPhotosTips')->name('nos-conseils-photo');
    Route::get('fonctionnement','PagesController@PageOperation')->name('fonctionnement');
    Route::get('test','PagesController@PageTest')->name('test');
    Route::get('sendMailTest','TestController@SendMailTest')->name('sendMailTest');
    
    Route::get('liste-des-souhaits','WishlistController@index')->name('wishlist');
    Route::get('souhait/{id}','WishlistController@store')->name('wishlist-store');
    Route::get('souhait/supprimer/{id}','WishlistController@remove')->name('wishlist-remove');
    Route::get('souhait/suppression-dans-un-list/{id}','WishlistController@remove_in_list')->name('wishlist-remove-in-list');
    Route::get('souhait/findid/{idpu}','WishlistController@findIdWishlist')->name('wishlist-findid');

    Route::get('zoom-image-test', 'TestController@imageZoom')->name('zoom-image-test');
    Route::get('page-test', 'TestController@styleElement')->name('page-test');

    Route::group(['middleware' => ['auth']], function () {        
        Route::post('caisse', 'CheckoutController@storeOrderInfo')->name('checkout');
        Route::get('checkout/order-confirmed', 'CheckoutController@confirmOrder')->name('checkout-order-confirmed');
        Route::post('caisse/confirmation', 'CheckoutController@confirmCart')->name('checkout-confirm-cart');
        Route::get('checkout_store_quantity_session', 'CheckoutController@storeQuantitySession')->name('checkout_store_quantity_session');
        Route::group(['middleware' => ['customer']], function () {
            /*Customer specific routes*/
            Route::get('customer', 'CustomerController@index');
            Route::group(['prefix' => 'client/'], function () {
                Route::get('order/completed', 'CustomerController@completedOrders')->name('customer-order-completed');
                Route::get('order/pending', 'CustomerController@onGoingOrders')->name('customer-order-pending');
                Route::get('request', 'OrderController@getCustomerOrders')->name('customer-request');
                Route::get('commande-en-cours', 'CustomerController@getCurrentOrder')->name('customer-commande-en-cours');
                Route::get('coupon-de-reception/{id}', 'CustomerController@getCurrentCoupon')->name('customer-coupon-de-reception');
                Route::get('historique-commande', 'CustomerController@getOrderStory')->name('customer-historique-commande');
                Route::get('customer-bills', 'CustomerController@getCustomerBills')->name('customer-customer-bills');
                Route::get('informations-client', 'CustomerController@getCustomerInformations')->name('customer-informations-client');
                Route::get('newsletters', 'CustomerController@getNewsLetter')->name('customer-newsletters');
                Route::get('modification-mot-de-passe', 'CustomerController@getChangePassword')->name('customer-modification-mot-de-passe');
                Route::post('changer-mot-de-passe','CustomerController@updatePassword')->name('customer-update-password');
                Route::get('get-distance-store', 'CustomerController@getDistanceStore')->name('customer-get-distance-store');
                Route::get('aide-et-faq', 'CustomerController@getFaq')->name('customer-aide-et-faq');
                Route::post('changer-information-client', 'CustomerController@updateCustomerInformations')->name('customer-update-info');
                Route::get('telecharger-pdf/{id}','CustomerController@downloadPdf')->name('customer-download-pdf');
                Route::get('imprimer-pdf/{id}','CustomerController@printPdf')->name('customer-print-pdf');
                Route::get('waiting-order/{id}','CustomerController@waitingOrder')->name('customer-waiting-order');
                Route::get('canceled-order/{id}','CustomerController@canceledOrder')->name('customer-canceled-order');
            });
            /*Route::post('manage-account', 'CustomerController@postManageAccount')->name('manage-account');
            Route::post('change-password', 'CustomerController@postResetPassword')->name('change-password');

            Route::post('choose-seller/{seller_id}', 'OrderController@chooseSeller')->name('choose-seller');
            Route::post('booking-request', 'OrderController@bookingRequest')->name('booking-request');
            Route::post('cancel-request', 'OrderController@cancelRequest')->name('cancel-request');*/
        });

        Route::group(['middleware' => ['merchant']], function () {
            /*merchnat specific routes*/
            Route::get('merchant', 'MerchantController@index')->name('merchant');
            Route::group(['prefix' => 'marchand/'], function () {
                
                Route::get('orders', 'MerchantController@getOrders')->name('orders');
                Route::get('stores', 'MerchantController@getStores')->name('stores');
                Route::get('request', 'OrderController@getMerchantOrders')->name('request');
                Route::get('invoices', 'MerchantController@invoices')->name('invoices');
                Route::post('add-card', 'MerchantController@addCard')->name('add-card');
                Route::post('pay-invoice/{id}', 'MerchantController@payInvoice')->name('pay-invoice');

                Route::group(['namespace' => 'Merchant'], function(){
                    Route::get('tableau-de-bord','DashboardController@index')->name('merchant-dashboard');
                    Route::get('statistical','DashboardController@statistical')->name('merchant-statistical');
                    Route::get('inlineLocal','DashboardController@salesInlineLocal')->name('merchant-inlineLocal');
                    Route::resource('code-promo','CodePromoController');
                    Route::resource('promotion','PromotionController');
                    Route::resource('commande','OrderController');
                    Route::get('terminer-commande/{id}','OrderController@bookingRequest')->name('merchant-booked-request');
                    Route::get('produit/get-data', 'ProductController@getData')->name('merchant-product-data');
                    Route::get('produit', 'ProductController@index')->name('merchant-product');
                    Route::resource('article', 'ArticleController');
                    Route::get('child-category','ArticleController@getChild')->name('get-child-category');
                    Route::get('produit/attributes', 'ArticleController@attributes')->name('get_attribute');
                    Route::post('produit', 'ProductController@store')->name('save_product_merchant');
                    Route::post('produit/upload', 'ProductController@uploadImage')->name('upload_product_image');
                    Route::get('produit/edit/{product_id}', 'ProductController@edit')->name('edit_product');
                    Route::delete('produit/{product_id}', 'ProductController@destroy')->name('remove_product');
                    Route::post('produit/{product_id}', 'ProductController@update')->name('update_product');
                    Route::get('produit/get-product-for-encasement', 'ProductController@getProductForEncasement');
                    Route::get('produit/get-code-promo-by-category', 'ProductController@getCodePromoByCategory');
                    Route::get('produit/remove_product_image', 'ProductController@removeImage')->name('remove_product_image');
                    Route::get('produit/add', 'ProductController@create')->name('create_product');
                    Route::post('produit/search-product','ProductController@searchProduct')->name('merchant_search_product');
                    Route::post('produit/remove-product-tag', 'ProductController@removeTag')->name('merchant_product_remove_tag');
                    Route::get('produit/delete-products', 'ProductController@deletes')->name('delete_products');
                    Route::resource('client', 'CustomerController');
                    Route::get('facture','CustomerController@facture')->name('merchant-facture');
                    Route::get('facturePdf','CustomerController@facturePdf')->name('merchant-facturePdf');
                    Route::get('contact','CustomerController@addContact')->name('merchant-contact');
                    Route::post('save_contact','CustomerController@saveContactCustomer')->name('save_contact');
                    Route::get('encaissement', 'CustomerController@encasement')->name('encasement');
                    Route::post('get-product','CodePromoController@getProduct')->name('get_product');
                    Route::get('get-customers', 'CustomerController@getAllCustomer')->name('get-customers');
                }); 
            });

            Route::get('invoice/{id}','MerchantController@viewInvoice')->name('invoice');
            Route::resource('magasin', 'StoreController');
            Route::post('response-to-customer', 'OrderController@responseToCustomer')->name('response-to-customer');
        });
    });

    Route::get('buy', function () {
        return view('front.buy');
    });

    Route::get('about-us', function () {
        return view('front.aboutus');
    });
    Route::post('search_store', function () {
        return view('front.store.search_store');
    });
    Route::get('blog/{blog_id}','BlogController@show')->name('blog');
    Route::get('faq', 'FaqController@index')->name('faq');
    Route::get('faq-boutiques', 'FaqController@businessFaq')->name('business-faq');
    Route::get('blog-list', 'BlogController@allPost')->name('blog-list');
    Route::post('submit-review','ProductController@submitReview')->name('submit-review');
    Route::post('get-distance','ProductController@getDistance')->name('get-distance');
    Route::get('get-distance-store', 'CatalogController@getDistanceStore')->name('get-distance-store');
    Route::get('add-info-cookie', 'CatalogController@addInfoCookie')->name('add-info-cookie');
    Route::get('save-latest-category', 'CatalogController@saveLatestCategory')->name('save-latest-category');
    Route::get('catalogue', 'CatalogController@search')->name('search');
    Route::post('set-location', 'CatalogController@setLocation')->name('set-location');
    Route::post('subscribe','NewsletterController@subscribe')->name('subscribe');
    Route::get('crowdfunding', 'CrowdfundingController@index')->name('crowdfunding');
    Route::get('getLists','NewsletterController@getListMembers')->name('getLists');
    Route::get('image-color-code/{color_code}', function ($hex_code) {
        $handle = ImageCreate(24, 24);
        $rgb1 = hexdec($hex_code[0] . $hex_code[1]);
        $rgb2 = hexdec($hex_code[2] . $hex_code[3]);
        $rgb3 = hexdec($hex_code[4] . $hex_code[5]);
        ob_start();
        imagecolorallocate($handle, $rgb1, $rgb2, $rgb3);
        imagepng($handle);
        $image_data = ob_get_contents();
        ob_end_clean();
        return Response::make($image_data, 200, ['content-type' => 'image/png']);
    });

    Route::get('/{slug}/{item_id?}', function (Request $request, $slug, $item_id = null) {
        try {
            $value = \App\Url::where('target_url', $slug)->first();
            if ($value == null) {
               // return view('front.404');
               return redirect()->route('crowdfunding');
            }
            $app = app();
            //dd($value);
            switch ($value->type) {
                case 2:
                    // redirect to BYO page if product's parent category is BYO
                    $controller = $app->make('App\Http\Controllers\Front\ProductController');
                    return $controller->CallAction('index', [$value->target_id]);
                case 1:
                    $controller = $app->make('App\Http\Controllers\Front\CatalogController');
                    return $controller->callAction('index', [$value->target_id]);
                case 3:
                    $controller = $app->make('App\Http\Controllers\Front\PageController');
                    return $controller->callAction('index', [$value->target_id]);
                case 4:
                    $controller = $app->make('App\Http\Controllers\Front\BlogController');
                    return $controller->callAction('show', [$value->target_id]);
            }
        } catch (Exception $e) {
            return view('front.404');
            //return redirect()->route('crowdfunding');
        }
    });
});
Route::get('auth/{provider}/callback', 'Front\Auth\AuthController@handleProviderCallback');
//Route::get('/home', 'HomeController@index')->name('home');