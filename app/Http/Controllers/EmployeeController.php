<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    use HttpResponses;

    protected $guard='employee';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return EmployeeResource::collection(Employee::all());
    }

   
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $request->validated($request->all());
        $employee=Employee::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role,
            'phone_no'=>$request->phone_no,
        ]);

        return $this->success([
            'employee'=>$employee,
        ],'Employee account created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return new EmployeeResource($employee);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $employee->update($request->all());
        return new EmployeeResource($employee);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return $this->success('','Employee deleted successfully');
    }
}
