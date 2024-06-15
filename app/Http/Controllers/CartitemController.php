<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartitemResource;
use App\Models\CartItem;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CartitemController extends Controller
{

    use HttpResponses;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CartitemResource::collection(CartItem::all());
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
    public function show(String $id)
    {
      $cartItem=CartItem::find($id) ;
      return new CartitemResource($cartItem);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $cartItem=CartItem::find($id);
        $cartItem->update($request->all());
        return new CartitemResource($cartItem);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
       
        CartItem::destroy($id);
        return $this->success('','cartitem deleted successfully');
        
        
    }
}
