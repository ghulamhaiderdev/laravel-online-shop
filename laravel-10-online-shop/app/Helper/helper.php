<?php

use App\Mail\OrderEmail;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;

function getCategories ()
{
    return Category::orderBy('name', 'ASC')
                ->with('sub_category')
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->where('show_home', 'Yes')->get();
}

function getProductsImages($product_id)
{
 return \App\Models\ProductImage::where('product_id', $product_id)->first();
}

function orderEmail ($orderId, $userType = 'customer')
{
    $order = Order::where('id', $orderId)->with('items')->first();

    $subject = '';
    if ($userType == 'customer')
    {
        $subject =  'Thanks for your order';
        $email = $order->email;
    }else{
        $subject =  'You have received an order';
        $email = env('ADMIN_EMAIL');

    }
    $mailData = [
        'subject' => $subject,
        'order' => $order,
        'userType' => $userType
    ];

    Mail::to($email)->send(new  OrderEmail($mailData));
}

function getCountryInfo($country_id)
{
    return \App\Models\Country::where('id', $country_id)->first();
}

function getPages()
{
    return \App\Models\Page::orderBy('name', 'ASC')->get();
}

