<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartitemResource;
use App\Models\CartItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return CartitemResource::collection(CartItem::where('customer_id',$request->user()->id)->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        if ($request->equipment_id!=null) {
            $cartitem=CartItem::where('customer_id',$request->user()->id)
                                ->where('equipment_id',$request->equipment_id)->first();
            if ($cartitem==null) {
                $cartitem=CartItem::create([
                    'customer_id'=>$request->user()->id,
                    'equipment_id'=>$request->equipment_id,
                    'service_id'=>$request->service_id,
                    'spare_id'=>$request->spare_id,
                    'count'=>$request->count,
                ]);
                return new CartitemResource($cartitem);
            }
            
        }else if ($request->service_id!=null) {
            $cartitem=CartItem::where('customer_id',$request->user()->id)
                                ->where('service_id',$request->service_id)->first();
                                Log::error($cartitem);
            if ($cartitem==null) {
                Log::error($cartitem==null);
                $cartitem=CartItem::create([
                    'customer_id'=>$request->user()->id,
                    'equipment_id'=>$request->equipment_id,
                    'service_id'=>$request->service_id,
                    'spare_id'=>$request->spare_id,
                    'count'=>$request->count,
                ]);
                return new CartitemResource($cartitem);
            }
            
        }else if($request->spare_id!=null){
            $cartitem=CartItem::where('customer_id',$request->user()->id)
                                ->where('spare_id',$request->spare_id)->first();
            if ($cartitem==null) {
                $cartitem=CartItem::create([
                    'customer_id'=>$request->user()->id,
                    'equipment_id'=>$request->equipment_id,
                    'service_id'=>$request->service_id,
                    'spare_id'=>$request->spare_id,
                    'count'=>$request->count,
                ]);
                return new CartitemResource($cartitem);
            }
            
        }
        
        return $this->error('','item already exists in your cart',403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $cartitem=CartItem::find($request->id);
        if ($cartitem!=null) {
            return new CartitemResource($cartitem);
        }else {
            return null;
        }
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $cartitem=CartItem::find($request->id);
        if ($cartitem==null) {
            return null;
        }
        $alldata=$request->all();
        unset($alldata['id']);
        $cartitem->update($alldata);
        return new CartitemResource($cartitem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $cartitem=CartItem::find($request->id);
        if($cartitem!=null){
            $cartitem->delete();
            return $this->success('','cartitem deleted successfully');
        }
        return null;
        
    }
}
