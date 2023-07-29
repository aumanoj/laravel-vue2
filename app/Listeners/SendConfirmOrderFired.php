<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendConfirmOrder;
use App\Jobs\ConfirmOrderJob;
use App\Models\OrderUser;
use App\Models\TblOrder;
use App\Models\TblOrderDetail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;


class SendConfirmOrderFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(SendConfirmOrder $event)
    {   
         
       // $job = (new ConfirmOrderJob($event->order))->delay(10);
       // dispatch($job);$event->order
        //echo '<pre>'; print_r($event->order->toArray()); exit;
        $order = $event->order;
        $orderDetail = TblOrderDetail::with('Manufacturer','Model')->where('order_id',$order->order_id)->first();
        //echo $order->email; exit;
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $user = OrderUser::where('email',$order->email)->first();
        //echo '<pre>'; print_r($orderDetail->manufacturer->manu_name); exit;
        if (!empty($user)) {
           $password = $user->password; 
        }else{
            function random_num($size) {
                $alpha_key = '';
                $keys = range('A', 'Z');

                for ($i = 0; $i < 4; $i++) {
                    $alpha_key .= $keys[array_rand($keys)];
                }

                $length = $size - 5;

                $key = '';
                $keys = range(0, 9);

                for ($i = 0; $i < $length; $i++) {
                    $key .= $keys[array_rand($keys)];
                }

                return $alpha_key . $key;
            }

            $password = random_num(9); 
            //$password = substr($random, 0, 8); 
            $user = new OrderUser;
            $user->email = $order->email;
            $user->password = $password;
            $user->status = 1;
            //$user->created_at = now();
            $user->save();
        }   
        //echo '<pre>'; print_r($user->toArray()); exit;
        $orderID = $order->order_id;
        /*$chk = Mail::send([], ['order' => $order, 'orderID' => $order->id, 'user' => $user], function($message) use($order, $orderID,$user){
                $message->subject("Thanks for order ".$user->name);
                $message->to($order->email);
                $message->setBody("Hi <strong>".$user->name."</strong> <br> Its to inform you that order has been confirm.  The detail of the order is shown below : <br> <strong> OrderID confirm: </strong>".$orderID."<br> <strong>Email: </strong>".$user->email."<br> <strong>Password: </strong>".$user->pwd."<br><p>You are receiving this email because we got your order thru online.  If you feel that its not you then no further action required.</p><p><strong> Thanks & Regard <br> </strong></p>","text/html");
        });*/

        //$brandID = Manufacturer::where('manu_id', $order->brand_id)->first();
        //$modelID = Models::where('id', $order->modal_id)->first();
        $email = $order->email;
        $baseURL = url('');
        $email = $order->email;

        $emailTemplate = EmailTemplate::where('alias','paymentdone')->first();
        $msg = $emailTemplate->content;
        $msg = str_replace('&lt;&lt;Brand&gt;&gt;',$orderDetail->manufacturer->manu_name,$msg);
        $msg = str_replace('&lt;&lt;Model&gt;&gt;',$orderDetail->model->model_num,$msg);
        $msg = str_replace('#baseurl#',$baseURL,$msg);
        $msg = str_replace('&lt;&lt;email&gt;&gt;',$email,$msg);
        $msg = str_replace('&lt;&lt;password&gt;&gt;',$password,$msg);
        $msg = str_replace('&lt;&lt;order_id&gt;&gt;',$orderID,$msg);
        //echo '<pre>'; print_r($emailTemplate->toArray()); exit;        
        if ($emailTemplate)
        {
            $chk = Mail::send([], ['order' => $order, 'emailTemplate' => $emailTemplate,'msg' => $msg], function($message) use($order, $emailTemplate, $msg){
                $message->subject($emailTemplate->subject);
                $message->to($order->email);
                //$message->bcc($emailTemplate->bcc);
                //$message->cc($emailTemplate->cc);
                //$message->replyTo($emailTemplate->reply_to);
                $message->returnPath($emailTemplate->from);
                $message->from($emailTemplate->from);
                $message->setBody($msg,"text/html");
            });
           // echo $chk; exit;
            /*$chk = Mail::send([], ['order' => $order, 'orderID' => $order->id, 'user' => $user], function($message) use($order, $orderID,$user){
                $message->subject("Thanks for order ".$user->name);
                $message->to($order->email);
                $message->setBody("Hi <strong>".$user->name."</strong> <br> Its to inform you that order has been confirm.  The detail of the order is shown below : <br> <strong> OrderID confirm: </strong>".$orderID."<br> <strong>Email: </strong>".$user->email."<br> <strong>Password: </strong>".$user->pwd."<br><p>You are receiving this email because we got your order thru online.  If you feel that its not you then no further action required.</p><p><strong> Thanks & Regard <br> </strong></p>","text/html");
        });*/

        }
    }
}
