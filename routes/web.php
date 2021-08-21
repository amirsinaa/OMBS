<?php

Auth::routes();

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::get('/', function () {
  return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::any("user/notifications", [
  "as" => "user/showNotifs",
  "uses" => "UserController@showNotifs",
]);

Route::post('user/mark-as-read', 'UserController@markNotification')->name('markNotification');

Route::get('/langtest', 'HomeController@langtest')->name('langtest');

Route::get('pub_bid_list', array(
  'uses' => 'BidController@publicBidList',
));

Route::any('/dashboard', [
  'middleware' => 'auth.basic',
  'as' => '/dashboard',
  "uses" => "ProductController@adminproductList",
]);

Route::any('/mysales', [
  'middleware' => 'auth.basic',
  'as' => '/mysales',
  "uses" => "ProductController@getSellList",
]);

Route::any('activities', [
  'middleware' => 'auth.basic',
  'as' => 'activities',
  "uses" => "OrderController@getBuyOrdersList",
]);

Route::any('/list', [
  'middleware' => 'auth.basic',
  'as' => '/list',
  "uses" => "ProductController@getProductsList",
]);

Route::pattern('id', '[0-9]+');
Route::get('product/{id}', "ProductController@product");

Route::any('product/add', [
  'middleware' => 'auth.basic',
  "uses" => "ProductController@productAdd",
]);

Route::any('product/edit/{id}', [
  'middleware' => 'auth.basic',
  'as' => 'product.postedit',
  "uses" => "ProductController@productEdit",
]);

Route::group(['middleware' => 'auth'], function () {
  Route::post('/product/imagestore', 'ProductController@imagestore');
  Route::post('/uploaded_image/delete_image', 'ProductController@deleteImage');
  Route::post('/uploaded_image/delete_image_older', 'ProductController@deleteImageOlder');

  Route::get('product/getimages/{id}', "ProductController@getimages");

  Route::any("user/edit", [
    "as" => "user/edit",
    "uses" => "UserController@edit",
  ]);

  Route::get('product/delete/{id}', [
    'before' => 'auth.basic',
    "uses" => "ProductController@productDelete"
  ]);

  Route::get('mainbids', array(
    'middleware' => 'auth.basic',
    'as' => 'mainbids',
    'uses' => 'BidController@mainIndex',
  ));

  Route::post('product_open', array(
    'middleware' => 'auth.basic',
    'uses' => 'ProductController@productOpen'
  ));

  Route::post('product_close', array(
    'middleware' => 'auth.basic',
    'uses' => 'ProductController@productClose'
  ));

  Route::get('sentbids', array(
    'middleware' => 'auth.basic',
    'as' => 'sentbids',
    'uses' => 'BidController@mainSent',
  ));

  Route::get('sentbids/{product_id}', array(
    'before' => 'auth.basic',
    'as' => 'sentbids/{product_id}',
    'uses' => 'BidController@sentBids',
  ));

  Route::get('bids/{product_id}', array(
    'before' => 'auth.basic',
    'as' => 'bids/{product_id}',
    'uses' => 'BidController@arrivedBids',
  ));

  Route::get(
    '/message/get/{bid_id}',
    [
      'middleware' => 'auth.basic',
      'uses' => 'MessageController@get',
    ]
  );

  Route::any(
    'message/add/{bid_id}/{recipient_id}/{product_id}',
    [
      'before' => 'auth.basic',
      'uses' => 'MessageController@add',
    ]
  );

  Route::post(
    'message/add',
    [
      'middleware' => 'auth.basic',
      'uses' => 'MessageController@add',
    ]
  );

  Route::post(
    'bid/add',
    [
      "as" => "bid/add",
      'before' => 'auth.basic',
      'uses' => 'BidController@add',
    ]
  );

  Route::get(
    '/bid/delete/{id}/{bid_type}',
    array(
      'before' => 'auth.basic',
      'as' => 'delete_bid',
      'uses' => 'BidController@getDelete'
    )
  );

  Route::get("basket/basketfull", [
    "as" => "basket/basketfull",
    "uses" => "BasketController@basketfull",
  ]);

  Route::post('basket_post', array(
    'middleware' => 'auth.basic',
    'uses' => 'BasketController@basketPost',
  ));

  Route::get('basket_get', array(
    'middleware' => 'auth.basic',
    'as' => 'basket_get',
    'uses' => 'BasketController@basketGet',
  ));

  Route::post(
    'basket/add',
    [
      'middleware' => 'auth.basic',
      'uses' => 'BasketController@add',
    ]
  );

  Route::post('order', array(
    'middleware' => 'auth.basic',
    'uses' => 'OrderController@postOrder'
  ));

  Route::post('orderinformation_edit', array(
    'middleware' => 'auth.basic',
    'uses' => 'OrderinformationController@edit',
  ));

  Route::get('orderinformation_get', array(
    'middleware' => 'auth.basic',
    'uses' => 'OrderinformationController@get',
  ));

  Route::get('arrived_orders', array(
    'middleware' => 'auth.basic',
    "as" => "arrived_orders",
    'uses' => 'OrderController@arrivedOrders',
  ));

  Route::get('sent_orders', array(
    'middleware' => 'auth.basic',
    'uses' => 'OrderController@sentOrders',
  ));

  Route::get('order/{order_uniqid}/{status}', [
    'middleware' => 'auth.basic',
    "uses" => "OrderController@orderDetail",
  ]);

  Route::get(
    'order_delete/{key}',
    array(
      'middleware' => 'auth.basic',
      'uses' => 'OrderController@getDelete',
    )
  );
});

Route::any('product/adminproductlist', [
  'middleware' => 'auth.basic',
  'as' => 'product/adminproductlist',
  "uses" => "ProductController@adminproductList",
]);

Route::get(
  'superadminarea',
  array(
    'middleware' => 'is_superadmin',
    'as' => 'superadminarea',
    'uses' => 'SuperadminController@index'
  )
);

Route::any('product/superadminproductlist', [
  'middleware' => 'is_superadmin',
  'as' => 'product/superadminproductlist',
  "uses" => "ProductController@superadminProductList"
]);

Route::get('product/superadmindelete/{id}', [
  'middleware' => 'is_superadmin',
  "uses" => "ProductController@productSuperadminDelete"
]);

Route::get(
  '/superadmin/userlist',
  array(
    'middleware' => 'is_superadmin',
    'uses' => 'SuperadminController@userList'
  )
);

Route::get('superadminbids', array(
  'middleware' => 'is_superadmin',
  'uses' => 'BidController@superadminGetIndex'
));

Route::get('superadminorders', array(
  'middleware' => 'is_superadmin',
  "as" => "superadminorders",
  'uses' => 'OrderController@arrivedOrdersSuper'
));

Route::get('super_order/{order_uniqid}/{status}', [
  'middleware' => 'is_superadmin',
  "uses" => "OrderController@orderDetailSuper"
]);

Route::get('super_bid/{product_id}', array(
  'middleware' => 'is_superadmin',
  'as' => 'super_bid/{product_id}',
  'uses' => 'BidController@superBid'
));
