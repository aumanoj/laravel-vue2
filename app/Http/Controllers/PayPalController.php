<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use App\Order;
use Illuminate\Support\Facades\Mail;
use App\Events\SendConfirmOrder;
use Srmklive\PayPal\Traits\IPNResponse As PayPalIPN;
use App\Models\TblOrder;
use App\Models\TblOrderDetail;
use App\Models\Brand;
use App\Models\Tool;
use URL;
use DB;
//use PayPalIPN;

class PayPalController extends Controller
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new ExpressCheckout();
    }

    public function postnotify(Request $request)
    {   exit;
        /*$requestJson = '{"mc_gross":"5.00","invoice":"15","protection_eligibility":"Eligible","item_number1":null,"payer_id":"ADTAM89Y9HWQ6","tax":"0.00","payment_date":"22:56:29 Sep 22, 2020 PDT","payment_status":"Completed","charset":"windows-1252","mc_shipping":"0.00","mc_handling":"0.00","first_name":"John","mc_fee":"0.20","notify_version":"3.9","custom":null,"payer_status":"verified","business":"sb-dcjzj2327922@business.example.com","num_cart_items":"1","verify_sign":"AMLWbSF-8vban1Axis.pde4SyL7eAAW3CYWwaEm1Xm.6g3HLP5Y0NUM9","payer_email":"sb-9omsx2369920@personal.example.com","tax1":"0.00","txn_id":"62J30766CP327872R","payment_type":"instant","last_name":"Doe","item_name1":"1539# iC\/Network Lock Bypass GSM Devices - iP 6s\/6s+\/7\/7+ By SN {WITH SIGNAL} {NO MEID}{Mbypass Tools}{Windows & Mac}","receiver_email":"sb-dcjzj2327922@business.example.com","payment_fee":null,"shipping_discount":"0.00","quantity1":"1","insurance_amount":"0.00","receiver_id":"2LTDW7VUFC5VQ","txn_type":"cart","discount":"0.00","mc_gross_1":"5.00","mc_currency":"INR","residence_country":"IN","test_ipn":"1","shipping_method":"Default","transaction_subject":"Order #15 Invoice","payment_gross":null,"ipn_track_id":"895a5862d78a3"}'; */

        //$request = json_decode($requestJson);
        $msg    = json_encode($request->all());
        $chk = Mail::send([], ['msg' => $msg], 
            function($message) use($msg){
                $message->subject("testing Notify");
                $message->to("surender@aphroecs.com");
                $message->setBody($msg,"text/html");});
        $order = Order::find($request->custom);
        $order->pay_status = 1;
        $order->paymethod = "Paypal";
        $order->payment_status = $pay_status;
        $order->payment_type = "PayPal_SUCCESS";
        $order->paid_amount = $order->total_amount;
        $order->txn_id = $request->txn_id;
        $order->payment_date = $request->payment_date;
        $order->fname = $request->first_name;
        $order->lname = $request->last_name;
        $order->save();
        event(new SendConfirmOrder($order));
        /*echo '<pre>'; print_r($request); exit; 
         $post = []; $request_params = $request->all();

        foreach ($request_params as $key=>$value) $post[$key] = $value;

        $post['cmd'] = '_notify-validate';

        $response = $this->verifyIPN($post);
        $msg = "Notify Page \nSecond line of text"; */
        // use wordwrap() if lines are longer than 70 characters
        //$msg = wordwrap($msg,70);
         
        // send email

        //echo mail("surender@aphroecs.com","My subject",$msg);
     exit;
       $msg    = json_encode($request->all());
        $chk = Mail::send([], ['msg' => $msg], 
            function($message) use($msg){
                $message->subject("testing Notify");
                $message->to("surender@aphroecs.com");
                $message->setBody($msg,"text/html");});
        exit;
        Log::info($request->all());
        echo '<pre>';
        print_r($request->all());
        exit;
    }

    public function cancel()
    {
        //dd('Your payment is cancelled. Cancel Page Here');
        return redirect('payment_fail');
    }

    public function success(Request $request)
    {   
        
        $token = $request->get('token');
        $payerID = $request->get('PayerID');
        $dataItems = [];
        $orderID = [];
        $price = 0;
        $data = [];
        
        $provider = new ExpressCheckout;

        $response = $provider->getExpressCheckoutDetails($token);

        //echo '<pre>'; print_r($response); exit;
                
        if (isset($response['INVNUM']) && !empty($response['INVNUM']))
        {   
            $ordID = $response['INVNUM'];
            $order = TblOrder::where('order_id',$ordID)
                        ->first();

            $orderDetail = TblOrderDetail::with('Tool')->where('order_id',$ordID)->first();
            //echo $orderDetail->tool->tool_name; exit;
            //echo '<pre>xdgdf'; print_r($orderDetail->toArray()); exit;
            $orderID = $ordID;
            $data['items'] = [
                [
                    'name' => $orderDetail->tool->tool_name,
                    'price' => $orderDetail->tool->selling_price,
                    'desc'  => $orderDetail->tool->tool_desc,
                    'qty' => 1
                ]
            ];

            //$data['invoice_id'] = $this->generateRandomString();
            $data['invoice_id'] = $orderID;
            $data['invoice_description'] = "Order #{$orderID} Invoice";
            $data['custom'] = $orderID;
            $data['notify_url'] = route('payment.notify');
            $data['return_url'] = route('payment.success');
            $data['cancel_url'] = route('payment.cancel');
            $data['total'] = $orderDetail->tool->selling_price;

            $payment_status = $provider->doExpressCheckoutPayment($data, $token, $payerID);

            $ordID = $response['INVNUM'];
            //echo $ordID; exit;
            $order = TblOrder::where('order_id',$ordID)
                        ->first();

            
            $order->fname = $response['FIRSTNAME'];
            $order->lname = $response['LASTNAME'];
            $order->email = $response['EMAIL'];
            $order->pay_status = 1;
            $order->payment_status = $payment_status['PAYMENTINFO_0_PAYMENTSTATUS'];
            $order->payment_type = $payment_status['PAYMENTINFO_0_PAYMENTTYPE'];
            $order->paid_amount = $payment_status['PAYMENTINFO_0_AMT'];
            $order->txn_id = $payment_status['PAYMENTINFO_0_TRANSACTIONID'];
            $order->payer_email = $response['EMAIL'];
            $order->payment_date = $payment_status['PAYMENTINFO_0_ORDERTIME'];
            $order->save();
            event(new SendConfirmOrder($order));


            // return view ('pages.thankyou',[
            //     'order' => $order,
            // ]);   
            //event(new SendConfirmOrder($order));    
            return redirect('thankyou') ;       
        }
        //dd('Something is wrong.');
        return redirect('payment_fail');
    }

    public function refund($id,Request $request)
    {   
        $order = TblOrder::find($id);
        $transactionId = $order->txn_id; 
        $amount = $order->paid_amount;
        $paymethod = $order->paymethod;
        if ($paymethod == 'Moneris') {
            $service_url = URL::to('/').'/refunds.php';
            //$service_url = $this->apiurl . '/customapi/v1/refunds.php';
            $curl = curl_init($service_url);
            $header = array();
            $header[] = 'Authorization: f1d4';
            curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
            $curl_post_data = array(
                "orderid" => $id,
                "txnnumber" => $transactionId,
                "amount" => $amount
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
            $curl_response = curl_exec($curl);
            $curl_error = curl_error($curl);
            curl_close($curl); 
            
           //echo $curl_response; exit();
            
            $curl_response = explode('#',$curl_response);
            
            $curl_responseapp = $curl_response[0];
            
            if($curl_responseapp == 'APPROVED'){
                
                $refundtransationid = $curl_response[1];

            $order->paid_amount = 0.00;
            $order->payment_status = 'Refunded';
            $order->save();
            DB::table('order_comments')->insert(['order_id'=>$id,'refund_type'=>'Full','amount'=>$amount,'transactionID'=>$transactionId,'refundtransationid'=>$refundtransationid,'refund_date'=>NOW()]);
                echo 'Success';
            }else{
                echo 'Faild :- ';
                print_r($curl_response);
            }
            
        }else{
            $provider = new ExpressCheckout;
            $response = $provider->refundTransaction($transactionId, $amount);
            if (isset($response['REFUNDTRANSACTIONID'])) {
               // $order->refund_id = $response['REFUNDTRANSACTIONID'];
                $order->paid_amount = 0.00;
                $order->payment_status = 'Refunded';
                $order->save();
                DB::table('order_comments')->insert(['order_id'=>$id,'refund_type'=>'Full','amount'=>$amount,'transactionID'=>$transactionId,'refundtransationid'=>$response['REFUNDTRANSACTIONID'],'refund_date'=>NOW()]);
                echo 'Success';
                //return redirect('admin/orders')->with('update', 'Order refund data updated successfully !!!');
            }else{
                echo 'Faild';
                //return redirect('admin/orders')->with('fail', $response['L_LONGMESSAGE0']);
            }
        }    
        //echo '<pre>'; print_r($response); exit;
        //echo $id; exit;
        //
    }   

    
}
