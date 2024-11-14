<?php

namespace App\Http\Controllers;

use App\Http\Resources\FeedbackResource;
use App\Models\Employee;
use App\Models\Feedback;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    use HttpResponses;
   function receiveFeedback(Request $request){ 
        Feedback::create(
            [
                'message'=>$request->message,
                'sender'=>$request->user()->id,
                'receiver'=>Employee::where('role',$request->receiver)->first()->id,
                'reply'=>$request->reply

            ]
        );
        return $this->success('','feedback sent successfully');
    }

    function myFeedback(Request $request) {
        return FeedbackResource::collection(Feedback::where('sender',$request->user()->id)->get());
    }

    function myeFeedback(Request $request) {
        return FeedbackResource::collection(Feedback::where('receiver',$request->user()->id)->get());
    }

    function replyFeedback(Request $request) {
        $newFeedback=Feedback::create(
            [
                'message'=>$request->message,
                'sender'=>null,
                'receiver'=>null,
                'reply'=>null,

            ]
        );

        Feedback::where('id',$request->replyingto)->update([
            'reply'=>$newFeedback->id,
        ]);
        return $this->success('','feedback sent successfully');


    }
}
