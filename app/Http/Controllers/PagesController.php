<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manufacturer;
use App\Models\BrandContent;
use App\Models\Models;
use App\Models\ModelContent;
use App\Models\Network;
use App\Models\CustomPriceTool;
use App\Models\TblOrder;
use App\Models\TblOrderDetail;
use App\Models\Brand;
use App\Models\Tool;
use App\Models\Banner;
use App\Models\OrderUser;
use Srmklive\PayPal\Services\ExpressCheckout;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use URL;
use Mail;
use App\Events\SendConfirmOrder;
use Session;
use Cache;
use Illuminate\Support\Facades\Redirect;
use DB;

class PagesController extends Controller
{
    public function homePage(Request $request)
    {   
        //Cache::forget('home_index');    
        /*if ( Cache::has('home_index') ) {
            return Cache::get('home_index');
        } else { */
            $brand = brands_query();
            $slug_header='home-header';
            $asset_header = manage_assets($slug_header);
            $slug_footer='home-footer';
            $asset_footer = manage_assets($slug_footer);
            /*$cachedData = view('pages.index', [
            'cache' => 'true',   
            'brands' => $brand,
            'asset_header' => $asset_header,
            'asset_footer' => $asset_footer,
            ])->render();
            //Cache::put('home_index', $cachedData);
            cache(['home_index' => $cachedData], now()->addMinutes(1440));      */                                   
            return view('pages.index', [
            'cache' => 'false',    
            'brands' => $brand,
            'asset_header' => $asset_header,
            'asset_footer' => $asset_footer,
            ]);           
        //}     
        /*$brand = brands_query();
        $slug_header='home-header';
        $asset_header = manage_assets($slug_header);
        $slug_footer='home-footer';
        $asset_footer = manage_assets($slug_footer);

        return view('pages.index', [
    		'brands' => $brand,
            'asset_header' => $asset_header,
            'asset_footer' => $asset_footer,
            ]); */
    }

    public function contact(Request $request)
    {
        
    	return view('pages.contact');
    }

    public function contactPost(Request $request){
        $this->validate($request, [
                        'name' => 'required',
                        'email' => 'required|email',
                        'comment' => 'required'
                ]);

                // print_r($request->name);

        Mail::send('pages.email', [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'comment' => $request->get('comment') ],

                function ($message)use ($request) {
                    
                        $message->from($request->email);
                        $message->to('info@unlockninja.com', 'unlockninja')
                        ->subject('Unlockninja Contact Us');
        });

        
        return redirect('/contacts')->with('success', 'Thanks for contacting me, I will get back to you soon!');

        // return '<script type="text/javascript">alert("Thanks for contacting me, I will get back to you soon!");</script>';

    

    }


    public function CountryNetworkPage($brand_name, $model_name, Request $request)
    {   
        $url = URL::current(); 
        $match = preg_match('~^\p{Lu}~u', $brand_name) ? 'upper' : 'lower';
        if ($match == 'upper') {
            $url = strtolower($url);
           return Redirect::to($url, 301); 
        }
        /*if ( Cache::has('network_cache') ) {
            return Cache::get('network_cache');
        } else { */


            // print_r($brand->toArray()); exit;

            $brand = str_replace("-"," ", $brand_name);
        	$model = str_replace("-"," ",$model_name);
            $brand = str_replace('~',"-",$brand);
            $model = str_replace("~","-",$model);

            if ($model_name == 'phone')
            {

                $brand = brands_query($brand);
                $modelGT = models_query($brand[0]->manu_id,1);
                $modelEQ = models_query($brand[0]->manu_id,0);
                return view('pages.model', [
                    'brands' => $brand,
                    'brands_href' => $brand_name,
                    'modelsGT' => $modelGT,
                    'modelsEQ' => $modelEQ
                ]);
            }
            else
            {
                /*$countryGT = countries_query(1);
                $countryEQ = countries_query(0);
                $networkGT = networks_query(146,"YES");
                $networkEQ = networks_query(146,"NO"); */
                $country_id = 146; 


                $models=Models::where('model_num',$model)->first();
                $brands=Manufacturer::where('manu_name',$brand)->first();
                //print_r($models->toArray());
                $model_condition1=ModelContent::where('manu_id',0)->where('model_id',0)->first();
                $model_condition2=ModelContent::where('manu_id',$models->manu_id)->where('model_id',0)->first();
                $model_condition3=ModelContent::where('model_id',$models->model_id)->where('manu_id',$models->manu_id)->first();

                //print_r($model_condition3->toArray());

                //for brand images 
                $bannerimage = Banner::where('brand_id',$models->manu_id)->first();
                if (!empty($bannerimage->toArray())) {
                    $imagename = $bannerimage['image'];
                }else{
                     $imagename = '';
                }
                
    		    if (empty($imagename)) {
    			$imagename = 'no-image.png';
    		    }

                else{

                $imagename;
                }

                
                
            
            

            //description
            if (!empty($model_condition2) && empty($model_condition2->description))
    		{
                
    			
                $content_desc['description'] = str_replace('[Model]',$models->model_num,$model_condition2->description);
                $content_desc['description'] = str_replace('[Manufacturer]',$brands->manu_name,$content_desc['description']);

                $content_desc['description'] = str_replace('}-{','<img style="width: 18px; height: 18px;" src="/images/bluetick.png" >',$content_desc['description']);
                $content_desc['description'] = str_replace('}--{','<img style="width: 10px; height: 10px;" src="/images/blackdot.png" >',$content_desc['description']);
    		}
    		else if (!empty($model_condition3) && !empty($model_condition3->description))
    		{
                
    			
                $content_desc['description'] = str_replace('[Model]',$models->model_num,$model_condition3->description);
                $content_desc['description'] = str_replace('[Manufacturer]',$brands->manu_name,$content_desc['description']);

                $content_desc['description'] = str_replace('}-{','<img style="width: 18px; height: 18px;" src="/images/bluetick.png" >',$content_desc['description']);
                    $content_desc['description'] = str_replace('}--{','<img style="width: 10px; height: 10px;" src="/images/blackdot.png" >',$content_desc['description']);
            }
            else{

                
                $content_desc['description'] = str_replace('[Model]',$models->model_num,$model_condition1->description);
                $content_desc['description'] = str_replace('[Manufacturer]',$brands->manu_name,$content_desc['description']);

                $content_desc['description'] = str_replace('}-{','<img style="width: 18px; height: 18px;" src="/images/bluetick.png" >',$content_desc['description']);
                $content_desc['description'] = str_replace('}--{','<img style="width: 10px; height: 10px;" src="/images/blackdot.png" >',$content_desc['description']);

            }
            //meta title

            if (!empty($model_condition2) && empty($model_condition2->heading_title))
    		{
                
    			
                $content_mt['meta_title'] = str_replace('[Model]',$models->model_num,$model_condition2->meta_title);
                $content_mt['meta_title'] = str_replace('[Manufacturer]',$brands->manu_name,$content_mt['meta_title']);

    		}
    		else if (!empty($model_condition3) && !empty($model_condition3->meta_title))
    		{
                
    			
                $content_mt['meta_title'] = str_replace('[Model]',$models->model_num,$model_condition3->meta_title);
                $content_mt['meta_title'] = str_replace('[Manufacturer]',$brands->manu_name,$content_mt['meta_title']);
            }
            else{

                
                $content_mt['meta_title'] = str_replace('[Model]',$models->model_num,$model_condition1->meta_title);
                $content_mt['meta_title'] = str_replace('[Manufacturer]',$brands->manu_name,$content_mt['meta_title']);

            }

            //meta keyword(focused keyword)
            if (!empty($model_condition2) && empty($model_condition2->meta_keyword))
    		{
                
    			
                $content_mk['meta_keyword'] = str_replace('[Model]',$models->model_num,$model_condition2->meta_keyword);
                $content_mk['meta_keyword'] = str_replace('[Manufacturer]',$brands->manu_name,$content_mk['meta_keyword']);
    		}
    		else if (!empty($model_condition3) && !empty($model_condition3->meta_keyword))
    		{
                
    			
                $content_mk['meta_keyword'] = str_replace('[Model]',$models->model_num,$model_condition3->meta_keyword);
                $content_mk['meta_keyword'] = str_replace('[Manufacturer]',$brands->manu_name,$content_mk['meta_keyword']);
            }
            else{

                
                $content_mk['meta_keyword'] = str_replace('[Model]',$models->model_num,$model_condition1->meta_keyword);
                $content_mk['meta_keyword'] = str_replace('[Manufacturer]',$brands->manu_name,$content_mk['meta_keyword']);

            }
            //meta desc
           
            if (!empty($model_condition2) && empty($model_condition2->meta_desc))
    		{
                
    			
                $content_dsc['meta_desc'] = str_replace('[Model]',$models->model_num,$model_condition2->meta_desc);
                $content_dsc['meta_desc'] = str_replace('[Manufacturer]',$brands->manu_name,$content_dsc['meta_desc']);
    		}
    		else if (!empty($model_condition3) && !empty($model_condition3->meta_desc))
    		{
                
    			
                $content_dsc['meta_desc'] = str_replace('[Model]',$models->model_num,$model_condition3->meta_desc);
                $content_dsc['meta_desc'] = str_replace('[Manufacturer]',$brands->manu_name,$content_dsc['meta_desc']);
            }
            else{

                
                $content_dsc['meta_desc'] = str_replace('[Model]',$models->model_num,$model_condition1->meta_desc);
                $content_dsc['meta_desc'] = str_replace('[Manufacturer]',$brands->manu_name,$content_dsc['meta_desc']);

            }

            //heading title
            if (!empty($model_condition2) && empty($model_condition2->heading_title))
    		{
                
    			
                $content['heading_title'] = str_replace('[Model]',$models->model_num,$model_condition2->heading_title);
                $content['heading_title'] = str_replace('[Manufacturer]',$brands->manu_name,$content['heading_title']);

    		}
    		else if (!empty($model_condition3) && !empty($model_condition3->heading_title))
    		{
                
    			
                $content['heading_title'] = $model_condition3->heading_title;//str_replace('[Model]',$models->model_num,$model_condition3->heading_title);
                 $content['heading_title'] = str_replace('[Manufacturer]',$brands->manu_name,$content['heading_title']);
            }
            else{

                
                $content['heading_title'] = str_replace('[Model]',$models->model_num,$model_condition1->heading_title);
                 $content['heading_title'] = str_replace('[Manufacturer]',$brands->manu_name,$content['heading_title']);

            }
            
            
            //print_r($content);
    		
            $slug_header='model-header';
            $asset_header = manage_assets($slug_header);

            $slug_footer='model-footer';
            $asset_footer = manage_assets($slug_footer);

            /*$cachedData = view('pages.country_network', [
                'cache' => 'true',
                'brands' => $brand,
                'brands_href' => $brand_name,
                'models' => $model,
                'countriesGT' => $countryGT,
                'countriesEQ' => $countryEQ,
                'networksGT' => $networkGT,
                'networksEQ' => $networkEQ,
                'countryID' => $country_id,
                'content'=>$content,
                'content_mt'=>$content_mt,
                'content_mk'=>$content_mk,
                'content_dsc'=>$content_dsc,
                'content_desc'=>$content_desc,
                'bnr_image' => $imagename,
                'asset_header' => $asset_header,
                'asset_footer' => $asset_footer,
            ])->render();

           // Cache::put('network_cache', $cachedData);
            cache(['network_cache' => $cachedData], now()->addMinutes(1440));       */                                  
            return view('pages.country_network', [
                'cache' => 'false',
                'brands' => $brands->manu_name,
                'brands_href' => $brand_name,
                'models' => $models->model_num,
                //'countriesGT' => $countryGT,
                //'countriesEQ' => $countryEQ,
                //'networksGT' => $networkGT,
                //'networksEQ' => $networkEQ,
                'countryID' => $country_id,
                'content'=>$content,
                'content_mt'=>$content_mt,
                'content_mk'=>$content_mk,
                'content_dsc'=>$content_dsc,
                'content_desc'=>$content_desc,
                'bnr_image' => $imagename,
                'asset_header' => $asset_header,
                'asset_footer' => $asset_footer,
            ]); 

        //}

            /*return view('pages.country_network', [
                'brands' => $brand,
                'brands_href' => $brand_name,
                'models' => $model,
                'countriesGT' => $countryGT,
                'countriesEQ' => $countryEQ,
                'networksGT' => $networkGT,
                'networksEQ' => $networkEQ,
                'countryID' => $country_id,
                'content'=>$content,
                'content_mt'=>$content_mt,
                'content_mk'=>$content_mk,
                'content_dsc'=>$content_dsc,
                'content_desc'=>$content_desc,
                'bnr_image' => $imagename,
                'asset_header' => $asset_header,
                'asset_footer' => $asset_footer,

                
            ]); */
        }
    }

    public function brandPage($brandName)
    {       
        $url = URL::current(); 
        $match = preg_match('~^\p{Lu}~u', $brandName) ? 'upper' : 'lower';
        if ($match == 'upper') {
            $url = strtolower($url);
           return Redirect::to($url, 301); 
        }
        /*Cache::forget('brand_cache'); 
        if ( Cache::has('brand_cache') ) {
            return Cache::get('brand_cache');
        } else { */
            $brandName = ucwords($brandName); 
            
            $brand = Manufacturer::where('manu_name', $brandName)->where('status',1)->first();
            
            //$models = Models::where('manu_id', $brand->manu_id)->where('status',1)->get();
            
            $brand_condition1=BrandContent::where('manu_id',$brand->manu_id)->where('manu_name',$brand->manu_name)->first();
            $brand_condition2=BrandContent::where('manu_id',0)->where('manu_name','All')->first();


            //for brand images 
            $bannerimage = Banner::where('brand_id',$brand->manu_id)->first();
            $imagename = $bannerimage['image'];
    		if (empty($imagename)) {
    			$imagename = 'no-image.png';
    		}
            else{
                $imagename;
            }
            
            

            //brand description
            if (!empty($brand_condition1) && !empty($brand_condition1->description))
    		{
                
    			
                $content_desc['description'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition1->description);

                $content_desc['description'] = str_replace('}-{','<img style="width: 18px; height: 18px;" src="/images/bluetick.png" >',$content_desc['description']);
                $content_desc['description'] = str_replace('}--{','<img style="width: 10px; height: 10px;" src="/images/blackdot.png" >',$content_desc['description']);
    		}
    		
            else{

                
                $content_desc['description'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition2->description);
                
                $content_desc['description'] = str_replace('}-{','<img style="width: 18px; height: 18px;" src="/images/bluetick.png" >',$content_desc['description']);
                $content_desc['description'] = str_replace('}--{','<img style="width: 10px; height: 10px;" src="/images/blackdot.png" >',$content_desc['description']);

            }

            //brand heading title
            if (!empty($brand_condition1) && !empty($brand_condition1->heading_title))
    		{
                
    			
                $content_ht['heading_title'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition1->heading_title);
                
                
    		}
    		
            else{

                
                $content_ht['heading_title'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition2->heading_title);
                //$content_desc['heading_title'] = str_replace('[Manufacturer]',ucwords($brand),$content_desc['heading_title']);

            }

            //brand meta title
            if (!empty($brand_condition1) && !empty($brand_condition1->meta_title))
    		{
                
    			
                $content_mt['meta_title'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition1->meta_title);
                //$content_desc['meta_title'] = str_replace('[Manufacturer]',ucwords($brand),$content_desc['meta_title']);
    		}
    		
            else{

                
                $content_mt['meta_title'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition2->meta_title);
                //$content_desc['meta_title'] = str_replace('[Manufacturer]',ucwords($brand),$content_desc['meta_title']);

            }

            //brand meta keyword
            if (!empty($brand_condition1) && !empty($brand_condition1->meta_keyword))
    		{
                
    			
                $content_mk['meta_keyword'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition1->meta_keyword);
                
    		}
    		
            else{

                
                $content_mk['meta_keyword'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition2->meta_keyword);
                

            }

            //brand meta title
            if (!empty($brand_condition1) && !empty($brand_condition1->meta_desc))
    		{
                
    			
                $content_dsc['meta_desc'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition1->meta_desc);
                
    		}
    		
            else{

                
                $content_dsc['meta_desc'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition2->meta_desc);
                

            }

            //brand meta backlink
            if (!empty($brand_condition1) && !empty($brand_condition1->backtracklinks))
    		{
                
    			
                $backtracklinks['backtracklinks'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition1->backtracklinks);
                //$content_desc['backtracklinks'] = str_replace('[Manufacturer]',ucwords($brand),$content_desc['backtracklinks']);
    		}
    		
            else{

                
                $backtracklinks['backtracklinks'] = str_replace('[Manufacturer]',$brand->manu_name,$brand_condition2->backtracklinks);
                //$content_desc['backtracklinks'] = str_replace('[Manufacturer]',ucwords($brand),$content_desc['backtracklinks']);

            }

            $slug_header='brand-header';
            $asset_header = manage_assets($slug_header);

            $slug_footer='brand-footer';
            $asset_footer = manage_assets($slug_footer);
            // echo '<pre>'; print_r($models->toArray()); exit;
            /*$cachedData = view('pages.brand', [
                'cache' => 'true',
                'brandName' => $brandName,
                'brandID' => $brand->manu_id,
                //'models' => $models,
                'content_desc' => $content_desc,
                'content_ht' => $content_ht,
                'content_mt' => $content_mt,
                'content_mk'=>$content_mk,
                'content_dsc'=>$content_dsc,
                'backtracklinks'=>$backtracklinks,
                'bnr_image' => $imagename,
                'asset_header' => $asset_header,
                'asset_footer' => $asset_footer,
            ])->render();
            //Cache::put('brand_cache', $cachedData);
            cache(['brand_cache' => $cachedData], now()->addMinutes(1440));          */                                
            return view('pages.brand', [
                'cache' => 'false',
                'brandName' => $brand->manu_name,
                'brandID' => $brand->manu_id,
                //'models' => $models,
                'content_desc' => $content_desc,
                'content_ht' => $content_ht,
                'content_mt' => $content_mt,
                'content_mk'=>$content_mk,
                'content_dsc'=>$content_dsc,
                'backtracklinks'=>$backtracklinks,
                'bnr_image' => $imagename,
                'asset_header' => $asset_header,
                'asset_footer' => $asset_footer,
            ]);           
        //}  

         //echo '<pre>'; print_r($asset); exit;

        /*return view('pages.brand', [
            'brandName' => $brandName,
            'models' => $models,
            'content_desc' => $content_desc,
            'content_ht' => $content_ht,
            'content_mt' => $content_mt,
            'content_mk'=>$content_mk,
            'content_dsc'=>$content_dsc,
            'backtracklinks'=>$backtracklinks,
            'bnr_image' => $imagename,
            'asset_header' => $asset_header,
            'asset_footer' => $asset_footer,
        ]);    */
     

        
       
        
    }


    public function top_apps(Request $request)
    {
         //$brand = brands_query();
        return view('pages.topApp');
    }

    public function Order(Request $request)
    {
        $brandName = ucwords($request->brand); 
        $brand = Manufacturer::where('manu_name', $brandName)
        ->where('status',1)
        ->first();
      // echo '<pre>'; print_r($request->toArray()); exit;
        $model = Models::where('model_num', $request->model)
            ->where('manu_id',$brand['manu_id'])
            ->where('status',1)
            ->first();
        $network = Network::where('country_id',$request->country_id)
            ->where('network_id',$request->network_id)
            ->orderBy('id','desc')
            ->first();
            //echo '<pre>'; print_r($network->toArray()); exit;
    $brandID = $brand['manu_id'];
    $modelID = $model['model_id'];
    $countryID = $request->country_id;
    $networkID = $request->network_id;
    $email = $request->email;
    
    //print_r($request->email); exit;
    $enableTool = enabletools_query($brandID, $modelID, $countryID, $networkID);
    if (!isset($enableTool[0]->selling_price)) {
        //echo 'hello i am in code'; exit;
        return redirect('top_apps?code=not-available');
    }
    //echo $enableTool[0]->tool_id; exit;
   // echo '<pre>'; print_r($enableTool->toArray()); exit;
        //if(!empty($enableTool) && isset($enableTool[0]->tool_id)){
        
        $order = new TblOrder;
        $order->order_type = 0;
        $order->fname = '';
        $order->lname = '';
        $order->phone = '';
        $order->email = $request->email;
        $order->total = $enableTool[0]->selling_price;
        $order->tax = 0;
        $order->order_total = $enableTool[0]->selling_price;
        $order->api_total = 0;
        $order->pay_status = 0;
        $order->payment_status = '';
        $order->payment_type = '';
        $order->paid_amount = 0;
        $order->txn_id = 0;
        $order->payer_email = $request->email;
        $order->payment_date = '';
        $order->coupon_code = '';
        $order->coupon_discount = 0;
        $order->active_code = '';
        $order->cart_id = '';
        $order->refund_id = 0;
        $order->user_cookie = '';
        $order->user_ip_address ='';
        $order->insert_time = now();
        $order->payment_time = NOW();
        $order->min_price = 0;
        $order->trpay_affiliate_id = 0;
        $order->trpay_campaign = '';
        $order->trpay_site = '';
        $order->ssaid = '';
        $order->ssaid_data = '';
        $order->review_email = 0;
        $order->email_type = 0;
        $order->paymethod = '';
        $order->stripe_details = '';
        $order->address_zip = '';
        $order->address_country = '';
        $order->address = '';
        $order->country_code = '';
        $order->aweber_status = 0;
        $order->tool_unavailable = 0;
        $order->source = '';
        $order->medium = '';
        $order->campaign = '';
        $order->reference_id = '';
        $order->uuid = '';
        $order->device_id = '';
        $order->device_token = '';
        $order->organization = 'UNLOCKNINJA';  //enum('UNLOCKNINJA', 'SAMSUNGUNLOCKS') =
        $order->feedback_email =  'INPROCESS'; //enum('INPROCESS', 'SENT', 'STOP') =
        $order->verify_email = 'NONE'; //enum('NONE', 'YES', 'NO')  =
        $order->verify_email_reason  = '';
        $order->verify_email_date = null;
        $order->save(); 
        Session::forget('custom_ship');
        //session()->put('order_id',$order->order_id);
        Session::put('order_id',$order->order_id);
        Session::save();
        //echo $order->order_id; exit;
        $orderDetail = new TblOrderDetail;
        $orderDetail->order_dt_tm = $order->insert_time;
        $orderDetail->order_id = $order->order_id;
        $orderDetail->manu_id = $brand->manu_id; 
        $orderDetail->model_id = $model->model_id;
        $orderDetail->network_id = $request->network_id;
        $orderDetail->country_id = $request->country_id;
        $orderDetail->tool_id = $enableTool[0]->tool_id;
        $orderDetail->quantity = 1;
        $orderDetail->api_price = 0;
        $orderDetail->unit_price = $enableTool[0]->selling_price;
        $orderDetail->delivery_time = $enableTool[0]->estimated_time;
        $orderDetail->unlock_status = 0;
        $orderDetail->unlock_msg = '';
        $orderDetail->unlock_id = '';
        $orderDetail->unlock_code = '';
        $orderDetail->imei_code = '';
        $orderDetail->prd = 0;
        $orderDetail->getDrip = 0;
        $orderDetail->status = 1;
        $orderDetail->place_order_ip = ''; 
        $orderDetail->refunded_provider = 'NO';  //  enum('YES', 'NO')
        $orderDetail->save();

       // echo 'Order Data Save';
       // exit;

    /* order end code end here */
    
    //for brand images 
        $bannerimage = Banner::where('brand_id',$brand->manu_id)->first();
        $imagename = $bannerimage['image'];
		if (empty($imagename)) {
			$imagename = 'no-image.png';
		}
        else{
            $imagename;
        }

        $slug_header='checkout-header';
        $asset_header = manage_assets($slug_header);
        $slug_footer='checkout-footer';
        $asset_footer = manage_assets($slug_footer);

    return view ('pages.order',[
        'brands' => $brand,
        'models' => $model,
        'networks' => $network,
        'enabletools' => $enableTool,
        'emails' => $email,
        'OrderID' => $order->order_id,
        'totalPrice' => $order->order_total,
        'bnr_image' => $imagename,
        'asset_header' => $asset_header,
        'asset_footer' => $asset_footer
    ]);

    }

    // return redirect('/top_apps');
       
    // }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function payment(Request $request)
    {  // echo $request->toolID; exit;
        //echo '<pre>'; print_r($request->order_id); exit;
        $customPrc = Tool::where('tool_id',$request->toolID)->first();
        //echo '<pre>'; print_r($customPrc); exit;
        $orderID = $request->order_id;
        $data['items'] = [
            [
                'name' => $customPrc->tool_name,
                'price' => $customPrc->selling_price,
                'desc'  => $customPrc->tool_desc,
                'qty' => 1
            ]
        ];

        //$data['invoice_id'] = $this->generateRandomString();
        $data['invoice_id'] = $orderID;
        $data['invoice_description'] = "Order #{$data['invoice_id']} Invoice";
        $data['custom'] = $orderID;
        $data['notify_url'] = route('payment.notify');
        $data['return_url'] = route('payment.success');
        $data['cancel_url'] = route('payment.cancel');
        $data['total'] = $customPrc->selling_price;
        $provider = new ExpressCheckout;
        $response = $provider->setExpressCheckout($data);
        $response = $provider->setExpressCheckout($data, true);
        //echo '<pre>'; print_r($response); exit;
        if (!$response['paypal_link'])
        {
            return redirect('payment_fail');
        }

        return redirect($response['paypal_link']);
        exit;
        /*$order = new TblOrder;
        $order->order_type = 0;
        $order->fname = '';
        $order->lname = '';
        $order->phone = '';
        $order->email = $request->email;
        $order->total = $customPrc->selling_price;
        $order->tax = 0;
        $order->order_total = $customPrc->selling_price;
        $order->api_total = 0;
        $order->pay_status = 0;
        $order->payment_status = '';
        $order->payment_type = '';
        $order->paid_amount = 0;
        $order->txn_id = 0;
        $order->payer_email = $request->email;
        $order->payment_date = '';
        $order->coupon_code = '';
        $order->coupon_discount = 0;
        $order->active_code = '';
        $order->cart_id = '';
        $order->refund_id = 0;
        $order->user_cookie = '';
        $order->user_ip_address ='';
        $order->insert_time = now();
        $order->payment_time = NOW();
        $order->min_price = 0;
        $order->trpay_affiliate_id = 0;
        $order->trpay_campaign = '';
        $order->trpay_site = '';
        $order->ssaid = '';
        $order->ssaid_data = '';
        $order->review_email = 0;
        $order->email_type = 0;
        $order->paymethod = '';
        $order->stripe_details = '';
        $order->address_zip = '';
        $order->address_country = '';
        $order->address = '';
        $order->country_code = '';
        $order->aweber_status = 0;
        $order->tool_unavailable = 0;
        $order->source = '';
        $order->medium = '';
        $order->campaign = '';
        $order->reference_id = '';
        $order->uuid = '';
        $order->device_id = '';
        $order->device_token = '';
        $order->organization = 'UNLOCKNINJA';  //enum('UNLOCKNINJA', 'SAMSUNGUNLOCKS') =
        $order->feedback_email =  'INPROCESS'; //enum('INPROCESS', 'SENT', 'STOP') =
        $order->verify_email = 'NONE'; //enum('NONE', 'YES', 'NO')  =
        $order->verify_email_reason  = '';
        $order->verify_email_date = null;
        $order->save();

        $orderDetail = new TblOrderDetail;
        $orderDetail->order_dt_tm = $order->insert_time;
        $orderDetail->order_id = $order->id;
        $orderDetail->manu_id = $request->brand_id; 
        $orderDetail->model_id = $request->model_id;
        $orderDetail->network_id = $request->network_id;
        $orderDetail->country_id = $request->country_id;
        $orderDetail->tool_id = $request->toolID;
        $orderDetail->quantity = 1;
        $orderDetail->api_price = 0;
        $orderDetail->unit_price = $customPrc->selling_price;
        $orderDetail->delivery_time = $customPrc->delivery_time;
        $orderDetail->unlock_status = 0;
        $orderDetail->unlock_msg = '';
        $orderDetail->unlock_id = '';
        $orderDetail->unlock_code = '';
        $orderDetail->imei_code = '';
        $orderDetail->prd = 0;
        $orderDetail->getDrip = 0;
        $orderDetail->status = 1;
        $orderDetail->place_order_ip = ''; 
        $orderDetail->refunded_provider = 'NO';  //  enum('YES', 'NO')
        $orderDetail->save();

        echo 'Order Data Save';
        exit; */
    }

    public function orderThankyou()
    {
        return view('pages.thankyou');
    }

    public function orderPayCancel()
    {   
        print_r($_REQUEST); exit;
        return view('pages.payment_fail');
    }

    public function customerordermoneris(Request $request)
    {       //echo $request->fname; exit;
            //echo URL::to('/'); exit;
            $validation = array();
    
            if(empty($request->fname)){
                $validation['fname'] = 1;
            }
            if(empty($request->lname)){
                $validation['lname'] = 1;
            }
            if(empty($request->card_number)){
                $validation['card_number'] = 1;
            }
            
            if(empty($request->expdate)){
                $validation['expdate'] = 1;
            }
            
            if(empty($request->cvd)){
                $validation['cvd'] = 1;
            }
            
            if(!empty($validation)){
                
                echo json_encode($validation); exit();
                
            }
            $order_id = $request->order_id;
            $tools = Tool::where('tool_id',$request->tool)->first();
            //echo $tools->selling_price; exit;
            //echo '<pre>'; print_r($tools->toArray()); exit;
            $service_url = URL::to('/').'/TestPurchase.php';
            $fname = $request->fname;
            $lname = $request->lname;
            $card_number = $request->card_number;
            $expdate = $request->expdate;
            $cvd = $request->cvd;
            //$this->Session->write('order_id', $order_id);
            $curl = curl_init($service_url);
            $header = array();
            $header[] = 'Authorization: f1d4';
            curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
            $curl_post_data = array(
                "order_id" => $order_id,
                "price" => $tools->selling_price,
                "fname" => $fname,
                "lname" => $lname,
                "card_number" => $card_number,
                "expdate" => $expdate,
                "cvd" => $cvd,
                "tool" => $request->tool
            ); 
           
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
            $curl_response = curl_exec($curl);
            header("Access-Control-Allow-Origin: *");
            $curl_error = curl_error($curl);
            curl_close($curl);
            //echo $curl_response; exit;
            $jsonDecodeResponse = json_decode($curl_response);
            $ordID = $order_id; 
            //echo $ordID; exit;
            $order = TblOrder::find($ordID);
            $jsonDecodeResponseMessage = $jsonDecodeResponse->Message;
            $jsonDecodeResponseMessage = str_replace(' ', '', $jsonDecodeResponseMessage);
            $jsonDecodeResponseMessage = str_replace('*', '', $jsonDecodeResponseMessage);
            $jsonDecodeResponseMessage = str_replace('=', '', $jsonDecodeResponseMessage);
            
            //echo $order->fname; exit;
            //echo '<pre>'; print_r($jsonDecodeResponse); exit; 
            if ( $jsonDecodeResponseMessage == 'APPROVED') {
                
                $order->fname = $request->fname;
                $order->lname = $request->lname;
                //$order->email = $request->email;
                $order->pay_status = 1;
                $order->paymethod = 'Moneris';
                $order->payment_status = 'Completed';
                $order->payment_type = 'instant';
                $order->paid_amount = $jsonDecodeResponse->TransAmount;
                $order->txn_id = $jsonDecodeResponse->TransID;
                $order->payer_email = $order->email;
                $order->payment_date = now();
                $order->save();
                event(new SendConfirmOrder($order));
                //echo '<pre>'; print_r($jsonDecodeResponse);
                echo 'APPROVED'; exit;
            }else{
                echo $jsonDecodeResponse->Message; exit;
            }
            exit;
            //echo $jsonDecodeResponse->Complete; exit;
            //echo '<pre>'; print_r($jsonDecodeResponse); exit;
            /*if($curl_response=='APPROVED'){
                $this->redirect(array('controller'=>'clients' , 'action'=>'thankyou')); 
                exit();

            } else { */
            //echo $curl_response; exit();
    

        //print_r($_REQUEST); exit;
       // return view('pages.payment_fail');
    }

    public function thankyou(){
        if(Session::has('your_key')){
            return redirect('/');
        }
        $orderID = Session::get('order_id'); 
        $order = TblOrder::find($orderID);
        if (empty($order)) {
            return redirect('/');
        }
        $OrderUser = OrderUser::where('email',$order->email)->first();
        if (empty($OrderUser) ) {
            return redirect('/');
        }
        //echo '<pre>'; print_r($OrderUser->toArray()); exit;
       // event(new SendConfirmOrder($order));

       $slug_header='thankyou-header';
       $asset_header = manage_assets($slug_header);
       $slug_footer='thankyou-footer';
       $asset_footer = manage_assets($slug_footer);

        return view ('pages.thankyou',[
            'order' => $order,
            'OrderUser' => $OrderUser,
            'asset_header' => $asset_header,
            'asset_footer' => $asset_footer
        ]);
    }
}
