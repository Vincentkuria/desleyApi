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
        $cartitem=CartItem::create($request->all());
        return new CartitemResource($cartitem);
    }

    /**
     * Display the specified resource.
     */
    public function show(CartItem $cartitem)
    {
        return new CartitemResource($cartitem);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CartItem $cartitem)
    {
        $cartitem->update($request->all());
        return new CartitemResource($cartitem);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CartItem $cartitem)
    {
        return $this->success('','cartitem deleted successfully');
    }
}
