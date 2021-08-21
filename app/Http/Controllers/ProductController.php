<?php

namespace App\Http\Controllers;

use DB;
use File;
use Auth;
use Image;
use Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{

  public function product($id)
  {

    $product = DB::table('products')
      ->select('products.id AS id', 'admin_id', 'title', 'LOT_number', 'UPC', 'pack_size', 'DIN', 'auto_bid', 'med_quantity', 'brand_generic', 'generic', 'description', 'shop_price', 'opening_price', 'lowest_price', 'currency.code AS currency_code', 'currency.currency AS currency_currency', 'image1', 'image2', 'image3', 'image4', 'image5', 'image6', 'image7', 'image8', 'image9', 'image10', 'users.name AS user_name', 'timelimit', 'opened')
      ->where('products.id', $id)
      ->join('users', 'users.id', '=', 'products.admin_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->first();

    if (!empty($product)) {
      $minprice = \App\Models\Bid::where('product_id', '=', $id)->max('price');

      if (empty($minprice)) {
        $minprice = $product->opening_price;
      }
      return view('product/product', compact('product', 'minprice'));
    }
  }

  public function getProductsList()
  {
    $get_current_date = Carbon::now()->toDateString();
    $products_list = DB::table('products')
      ->where('admin_id', '!=', Auth::user()->id)
      ->select('products.id as id', 'title', 'LOT_number', 'UPC', 'pack_size', 'DIN', 'med_quantity', 'brand_generic', 'auto_bid', 'sold', 'generic', 'timelimit', DB::raw("DATEDIFF(timelimit, NOW()) AS daydiff2"), 'description', 'shop_price', 'opening_price', 'image1', 'code', 'currency')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->where('opened', 1)
      ->where('sold', 0)
      ->groupBy('products.id', 'title', 'timelimit', 'currency', 'opened')
      ->whereDate('timelimit', '>', $get_current_date)
      ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function ($join) {
        $join->on('products.id', '=', 'ResultBid.product_id');
      })
      ->orderBy('products.id', 'asc')
      ->paginate(12);

    return \View::make('list')->with('products_list', $products_list);
  }

  public function getSellList()
  {
    $products_list = DB::table('products')
      ->where('admin_id', '=', Auth::user()->id)
      ->select('products.id as id', 'title', 'LOT_number', 'UPC', 'pack_size', 'DIN', 'med_quantity', 'sold', 'generic', 'timelimit', 'shop_price', 'opening_price', 'image1', 'code', 'currency')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->where('opened', 0)
      ->where('sold', 1)
      ->groupBy('products.id', 'title')
      ->orderBy('products.id', 'asc')
      ->paginate(12);
    return \View::make('/mysales')->with('products_list', $products_list);
  }

  public function adminproductList()
  {
    $get_current_date = Carbon::now()->toDateString();
    $products = DB::table('products')
      ->where('admin_id', '=', Auth::user()->id)
      ->select('products.id as id', 'title', 'LOT_number', 'auto_bid', 'UPC', 'pack_size', 'DIN', 'med_quantity', 'brand_generic', 'sold', 'auto_bid', 'generic', 'timelimit', 'description', 'shop_price', 'opening_price', 'image1', 'code', 'currency')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->where('opened', 1)
      ->where('sold', 0)
      ->groupBy('products.id', 'title', 'timelimit', 'currency', 'opened')
      ->whereDate('timelimit', '>', $get_current_date)
      ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function ($join) {
        $join->on('products.id', '=', 'ResultBid.product_id');
      })
      ->orderBy('products.id', 'asc')
      ->paginate(12);

    return \View::make('/dashboard')->with(array('products' => $products, 'userid' => Auth::user()->id));
  }


  public function productAdd(Request $request)
  {
    if ($request->isMethod('post')) {

      $rules = array(
        'title' => 'required',
        'description' => 'required',
        'LOT_number' => 'required',
        'UPC' => 'required|numeric|unique:products',
        'auto_bid' => 'required|bool',
        'pack_size' => 'required|numeric',
        'DIN' => 'required|numeric|unique:products',
        'med_quantity' => 'required|numeric',
        'brand_generic' => 'required',
        'generic' => 'required',
        'dosage' => 'required|numeric',
        'form' => 'required',
        'route' => 'required',
        'medicine_manufacturer' => 'required',
        'opening_price' => 'required|numeric',
        'currency_id' => 'required',
        'timelimit' => 'required',
      );

      $inputs = Input::all();

      $validation = Validator::make($inputs, $rules);


      if (!$validation->passes()) {

        $message[] = $validation->messages()->all();

        echo json_encode(join('<br>', $message[0]));
      } else {
        $images_str = Input::get('images_str');
        $imagesArr = explode(",", $images_str);
        $imagePathArr = array();
        $destinationPath = public_path() . '/uploads/products/originals';

        $messageArr = array();
        for ($n = 1; $n <= 10; ++$n) {
          $i = $n - 1;

          if (array_key_exists($i, $imagesArr) && !empty($imagesArr[$i])) {
            $fileArr = explode("|", $imagesArr[$i]);
            $filename = $fileArr[0];

            $imageInfo = getimagesize($destinationPath . '/' . $filename);

            $img = Image::make($destinationPath . '/' . $filename);

            $imgArr = getimagesize($destinationPath . '/' . $filename);

            if ($imgArr[0] < 500) {
              $img->resize($imgArr[0], null, function ($constraint) {
                $constraint->aspectRatio();
              });
            } else {
              $img->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
              });
            }

            $newfilename = "auction" . substr($filename, 5);
            $img->save(public_path() . '/uploads/products/thumbs/medium/' . $newfilename);

            $img->resize(200, null, function ($constraint) {
              $constraint->aspectRatio();
            });
            $img->save(public_path() . '/uploads/products/thumbs/small/' . $newfilename);
            File::delete(public_path() . '/uploads/products/originals/' . $filename);

            $imagePathArr[$n] = $newfilename;
          } else {
            $imagePathArr[$n] = 'default.jpg';
          }
        }

        \App\Models\Product::create(array(
          'application_type' => 1,
          'title' => Input::get('title'),
          'description' => Input::get('description'),
          'image1' => $imagePathArr[1],
          'image2' => $imagePathArr[2],
          'image3' => $imagePathArr[3],
          'image4' => $imagePathArr[4],
          'image5' => $imagePathArr[5],
          'image6' => $imagePathArr[6],
          'image7' => $imagePathArr[7],
          'image8' => $imagePathArr[8],
          'image9' => $imagePathArr[9],
          'image10' => $imagePathArr[10],
          'LOT_number' => Input::get('LOT_number'),
          'UPC' => Input::get('UPC'),
          'sold' => 0,
          'dosage' => Input::get('dosage'),
          'form' => Input::get('form'),
          'auto_bid' => Input::get('auto_bid'),
          'route' => Input::get('route'),
          'medicine_manufacturer' => Input::get('medicine_manufacturer'),
          'pack_size' => Input::get('pack_size'),
          'DIN' => Input::get('DIN'),
          'med_quantity' => Input::get('med_quantity'),
          'brand_generic' => Input::get('brand_generic'),
          'generic' => Input::get('generic'),
          'shop_price' => Input::get('shop_price'),
          'opening_price' => Input::get('opening_price'),
          'currency_id' => Input::get('currency_id'),
          'timelimit' => Input::get('timelimit'),
          'admin_id' => Auth::user()->id
        ));

        return Redirect::intended('/dashboard');
      }
    } else {
      $mycurrency_id = \App\Models\User::find(Auth::user()->id)->currency_id;
      $currency_list = \App\Models\Currency::orderBy('code')->get();
      return \View::make('product/add', array('currency_list_json' => json_encode($currency_list), "mycurrency_id" => $mycurrency_id));
    }
  }

  public function imagestore(Request $request)
  {

    $id = Auth::user()->id;


    $rules = [];


    $image_size = env('IMAGE_SIZE');
    $rules['file'] = 'required|image|mimes:png,jpg,jpeg';

    $messages = array(
      'required' => 'The :attribute field is required.',

    );

    $validator = Validator::make($request->all(), $rules, $messages);

    if ($validator->fails()) {


      $message_string = "";
      foreach ($validator->messages()->getMessages() as $field_name => $messages) {

        foreach ($messages as $message) {
          $message_string .= $message;
        }
      }

      return response()->json(['error' => $message_string], 200);
    }

    if ($request->file('file')) {

      $fileName = $request->file('file')->getClientOriginalName();

      $extension = $request->file('file')->getClientOriginalExtension();
      $fileNameFull = $fileName . '.' . $extension;


      $name = "image_" . uniqid() . '_' . time() . '.' . $request->file('file')->getClientOriginalExtension();

      $image = \Image::make($request->file('file'));

      $image->save(public_path('uploads/products/originals/') . $name);

      return response()->json(['image' => $name], 200);
    } else {
      return response()->json(['error' => "Upload error"], 200);
    }
  }

  public function deleteImage(Request $request)
  {

    $image = $request->get('image');

    File::delete(public_path() . '/uploads/products/originals/' . $image);

    return response()->json([
      'image' => $image,
      'message' => 'image has been deleted!',
      'status' => 'ok',
    ], 200);
  }

  public function deleteImageOlder(Request $request)
  {

    $image = $request->get('image');

    File::delete(public_path() . '/uploads/products/thumbs/medium/' . $image);
    File::delete(public_path() . '/uploads/products/thumbs/small/' . $image);

    return response()->json([
      'image' => $image,
      'message' => 'older image has been deleted!',
      'status' => 'ok',
    ], 200);
  }

  public function productEdit(Request $request, $id)
  {

    if ($request->isMethod('post')) {

      $rules = array(
        'title' => 'required',
        'description' => 'required',
        'LOT_number' => 'required',
        'pack_size' => 'required|numeric',
        'med_quantity' => 'required|numeric',
        'brand_generic' => 'required',
        'dosage' => 'required|numeric',
        'auto_bid' => 'required|bool',
        'form' => 'required',
        'route' => 'required',
        'medicine_manufacturer' => 'required',
        'generic' => 'required',
        'opening_price' => 'required|numeric',
        'currency_id' => 'required',
        'timelimit' => 'required',
      );

      $inputs = Input::all();

      $validation = Validator::make($inputs, $rules);
      if (!$validation->passes()) {
        $message[] = $validation->messages()->all();
        echo join('<br>', $message[0]);
      } else {
        $imagePathArr = array();
        $imagePathArr[0] = 'empty';
        $images_str = Input::get('images_str');
        $imagesArr = explode(",", $images_str);
        $older_images_str = Input::get('older_images_str');
        $older_imagesArr = explode(",", $older_images_str);
        $older_imagesArr_count = count($older_imagesArr);
        $imagePathArr = array_merge($imagePathArr, $older_imagesArr);
        $destinationPath = public_path() . '/uploads/products/originals';
        $messageArr = array();
        $i = 0;
        for ($n = 1 + $older_imagesArr_count; $n <= 10; ++$n) {
          if (array_key_exists($i, $imagesArr) && !empty($imagesArr[$i])) {
            $fileArr = explode("|", $imagesArr[$i]);
            $filename = $fileArr[0];
            $imageInfo = getimagesize($destinationPath . '/' . $filename);
            $img = Image::make($destinationPath . '/' . $filename);
            $imgArr = getimagesize($destinationPath . '/' . $filename);
            if ($imgArr[0] < 500) {
              $img->resize($imgArr[0], null, function ($constraint) {
                $constraint->aspectRatio();
              });
            } else {
              $img->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
              });
            }
            $newfilename = "auction" . substr($filename, 5);
            $img->save(public_path() . '/uploads/products/thumbs/medium/' . $newfilename);
            $img->resize(200, null, function ($constraint) {
              $constraint->aspectRatio();
            });
            $img->save(public_path() . '/uploads/products/thumbs/small/' . $newfilename);
            File::delete(public_path() . '/uploads/products/originals/' . $filename);
            $imagePathArr[$n] = $newfilename;
          } else {
            $imagePathArr[$n] = 'default.jpg';
          }
          ++$i;
        }
        $id = Input::get('id');
        $product = \App\Models\Product::find($id);
        $product->title = Input::get('title');
        $product->description = Input::get('description');
        $product->image1 = $imagePathArr[1];
        $product->image2 = $imagePathArr[2];
        $product->image3 = $imagePathArr[3];
        $product->image4 = $imagePathArr[4];
        $product->image5 = $imagePathArr[5];
        $product->image5 = $imagePathArr[5];
        $product->image6 = $imagePathArr[6];
        $product->image7 = $imagePathArr[7];
        $product->image8 = $imagePathArr[8];
        $product->image9 = $imagePathArr[9];
        $product->image10 = $imagePathArr[10];
        $product->LOT_number = Input::get('LOT_number');
        $product->sold = 0;
        $product->auto_bid = Input::get('auto_bid');
        $product->pack_size = Input::get('pack_size');
        $product->dosage = Input::get('dosage');
        $product->form = Input::get('form');
        $product->route = Input::get('route');
        $product->medicine_manufacturer = Input::get('medicine_manufacturer');
        $product->med_quantity = Input::get('med_quantity');
        $product->brand_generic = Input::get('brand_generic');
        $product->generic = Input::get('generic');
        $product->shop_price = Input::get('shop_price');
        $product->opening_price = Input::get('opening_price');
        $product->lowest_price = Input::get('lowest_price');
        $product->currency_id = Input::get('currency_id');
        $product->timelimit = Input::get('timelimit');
        $product->save();
        $messagePart = join(", ", $messageArr);
        echo json_encode('OK' . 'You have modified the product successfully.' . $messagePart);
      }
    } else {

      $images_str = "";
      $product = \App\Models\Product::find($id);
      if (
        $product->admin_id ==
        Auth::user()->id ||
        Auth::user()->admin == 2
      ) {
        for ($n = 1; $n <= 10; ++$n) {
          if ($product['image' . $n] != "default.jpg") {
            $images_str .= $product['image' . $n] . ",";
          }
        }
        $currency_list_vue = \App\Models\Currency::orderBy('code')->get();
        $currency_list = \App\Models\Currency::orderBy('code')->get()->pluck('CurrencyFullName', 'id');

        return \View::make('product/edit', array('product_id' => $id, "currency_list" => $currency_list, 'product_json' => json_encode($product), 'currency_list_json' => json_encode($currency_list_vue)));
      } else {
        return Redirect::route('/dashboard')->with('error', 'This page is not allowed for you. You are redirected to here.');
      }
    }
  }

  public function getimages($id)
  {
    $product = \App\Models\Product::find($id);
    $imagesArr = array();
    for ($n = 1; $n <= 10; ++$n) {
      if ($product['image' . $n] != "default.jpg") {
        $imagesArr[] = $product['image' . $n];
      }
    }

    return response()->json([
      'images' => $imagesArr,
    ], 200);
  }

  public function productOpen()
  {
    $product = \App\Models\Product::find(Input::get('product_id'));
    $product->opened = 1;
    $product->save();
    return Redirect::route('mainbids');
  }

  public function productClose()
  {
    $product = \App\Models\Product::find(Input::get('product_id'));
    $product->opened = 0;
    $product->save();
    return Redirect::route('mainbids');
  }


  public function superadminProductList()
  {
    $products = DB::table('products')
      ->select('products.id as id', 'title', 'opening_price', 'shop_price', 'image1', 'maxbidprice', 'code', 'currency', 'users.name AS user_name', 'users.email AS user_email')
      ->join('users', 'users.id', '=', 'products.admin_id')
      ->join('currency', 'currency.id', '=', 'products.currency_id')
      ->leftJoin(DB::raw('(SELECT  max(price) as maxbidprice , product_id FROM bids GROUP BY product_id) ResultBid'), function ($join) {
        $join->on('products.id', '=', 'ResultBid.product_id');
      })
      ->orderBy('products.created_at', 'desc')
      ->paginate(12);

    return \View::make('product/superadmin_product_list')->with(array('products' => $products));
  }


  public function productSuperadminDelete($id)
  {
    $product = \App\Models\Product::find($id);
    for ($n = 1; $n < 6; ++$n) {
      if ($product['image' . $n] != "default.jpg") {
        File::delete(public_path() . '/uploads/products/thumbs/small/' . $product['image' . $n]);
        File::delete(public_path() . '/uploads/products/thumbs/medium/' . $product['image' . $n]);
      }
    }
    \App\Models\Product::find($id)->delete();
    return Redirect::route('product/superadminproductlist')->with('error', 'The auction is deleted.');
  }

  public function productDelete($id)
  {
    $admin_id = Auth::user()->id;
    $productObj = \App\Models\Product::where('id', '=', $id)->where('admin_id', '=', $admin_id)->get();
    $product = $productObj[0];
    for ($n = 1; $n < 6; ++$n) {
      if ($product['image' . $n] != "default.jpg") {
        File::delete(public_path() . '/uploads/products/thumbs/small/' . $product['image' . $n]);
        File::delete(public_path() . '/uploads/products/thumbs/medium/' . $product['image' . $n]);
      }
    }

    \App\Models\Product::find($id)->delete();
    return Redirect::route('product/adminproductlist')->with('error', 'The auction is deleted.');
  }
}
