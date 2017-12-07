<?php
namespace App\CustomClass;

use Illuminate\Http\Response;

class Rest
{


    public static function error($message = 'Error', $code = 403){
        $response = [ 
            'code'=> $code, 
            'status'=>'Error', 
            'message'=>$message
        ];

        return response()->json($response, $code);
    }
        
    public static function success($message,$data = null, $code=200){
        $response = [ 
            'code'=> $code, 
            'status'=>'Success', 
            'message'=>$message,
            'data' => $data
        ];

        return response()->json($response, $code);

    }

}
