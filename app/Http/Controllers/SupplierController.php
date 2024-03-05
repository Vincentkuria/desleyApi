<?php

namespace App\Http\Controllers;

use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SupplierController extends Controller
{
    use HttpResponses;

    protected $guard='supplier';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SupplierResource::collection(Supplier::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'company_name'=>'required|string',
            'email'=>'required|string|unique:suppliers',
            'password'=>'required|string|min:6',
        ]);

        $supplier=Supplier::create([
            'company_name'=>$request->company_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return new SupplierResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        return $supplier;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        return $this->success('','supplier deleted successfully');
    }
}
