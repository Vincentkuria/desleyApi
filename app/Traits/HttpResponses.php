<?php
namespace App\Traits;


trait HttpResponses
{
    protected function success($data=null,$message=null,$code=200) {
        return response()->json([
            'message'=>$message,
            'data'=>$data,
        ],200);
    }

    protected function error($data=null,$message=null,$code) {
        return response()->json([
            'message'=>$message,
            'data'=>$data,
        ], $code);
    }
}
