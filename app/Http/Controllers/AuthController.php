<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\LoginEmployeeRequest;
use App\Http\Requests\LoginSupplierRequest;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    //Customers Auth >>>>
    
    public function login(LoginCustomerRequest $request) {
        $request->validated($request->all());

        if (!Auth::guard('customer')->attempt($request->only('email','password'))) {
            return $this->error('','wrong login credentials',401);
        }

        $customer=Customer::where('email',$request->email)->first();
        return $this->success([
            'customer'=>$customer,
            'token'=>$customer->createToken('Api token for'.$customer->first_name)->plainTextToken
        ],'customer logedin successfully');
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->success('','you have been logedout successfully');
    }


    //Employees Auth >>>>

    public function elogin(LoginEmployeeRequest $request) {
        $request->validated($request->all());

        if (!Auth::guard('employee')->attempt($request->only('email','password'))) {
            return $this->error('','wrong login credentials',401);
        }

        $employee=Employee::where('email',$request->email)->first();
        return $this->success([
            'employee'=>$employee,
            'token'=>$employee->createToken('Api token for'.$employee->first_name)->plainTextToken
        ],'employee logedin successfully');
    }

    public function elogout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->success('','you have been logedout successfully');
    }


    //Supplier Auth >>>>

    public function slogin(LoginSupplierRequest $request) {
        $request->validated($request->all());

        if (!Auth::guard('supplier')->attempt($request->only('email','password'))) {
            return $this->error('','wrong login credentials',401);
        }

        $supplier=Supplier::where('email',$request->email)->first();
        return $this->success([
            'supplier'=>$supplier,
            'token'=>$supplier->createToken('Api token for'.$supplier->company_name)->plainTextToken,
        ],'supplier logedin successfully');
    }

    public function slogout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->success('','you have been successfully logedout');
    }

}
