<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\SendMissingToolIdEmail;
use App\Models\Tool;
use illuminate\Support\Facades\Mail;

class FiredSendMissingToolIDEmail
{
    public function __construct()
    {
        //
    }

    public function handle($event)
    {
        $tool = Tool::select('tools.tool_id as tool_id','tools.tool_name as tool_name')
            ->leftJoin('fun_credits','fun_credits.fun_tool_id','tools.tool_id')
            ->whereNull('fun_credits.fun_tool_id')
            ->groupBy('tools.tool_id','tools.tool_name')
            ->get();

        $dataView = '<html>
            <body>
                <p><b>Dear Sir/Madam</b></p>
                <p>Find below the list of Missing Tools ID</p>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ToolID</th>
                                <th>Tool Name</th>
                            </tr>
                        </thead>
                        <tbody>';
        
        if (count($tool) > 0)
        {
            foreach ($tool as $too)
            {
                $dataView .= "<tr>
                    <td>".$too->tool_id."</td>
                    <td>".$too->tool_name."</td>
                </tr>";
            }
        }
        $dataView .= "</tbody>
            </table>
            </div>
            <p><b>Thanks & Regard </b></p>
            </body>
            </html>";
        

        $chk = \Mail::send([],[],function($message) use($dataView) {
            $message->to('info@demoninja.com','demoninja@aphroecs.com','demoninja@aphroecs.com');
            $message->subject("Missing Tools ID in Fun Credit");
            $message->setBody($dataView,"text/html");
            $message->from('info@aphroecs.com');
            });

        return $chk;
    }
}
