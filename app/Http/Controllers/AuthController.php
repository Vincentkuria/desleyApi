<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginCustomerRequest;
use App\Http\Requests\LoginEmployeeRequest;
use App\Http\Requests\LoginSupplierRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\SupplierResource;
use App\Mail\verify;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Supplier;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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

    public function user(Request $request) {
        return new CustomerResource($request->user());
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
            'token'=>$employee->createToken('Api token for'.$employee->first_name)->plainTextToken,
            'role'=>$employee->role
        ],'employee logedin successfully');
    }

    public function elogout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return $this->success('','you have been logedout successfully');
    }

    public function euser(Request $request) {
        return new EmployeeResource($request->user());
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

    public function suser(Request $request) {
        return new SupplierResource($request->user());
    }


    //send verification emailcode

    // public function sendCode(Request $request){

    //     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //     $charactersLength = strlen($characters);
    //     $randomString = '';

    //     // Generate the random string
    //     for ($i = 0; $i < 5; $i++) {
    //         $randomString .= $characters[random_int(0, $charactersLength - 1)];
    //     }

    //    Customer::find($request->user()->id)->update(['verify_code'=>$randomString]);
        
    //     Mail::to($request->user()->email)->send(new verify($randomString,$request->user()->first_name));
    //     return $this->success('','email sent successfully');
    // }

    // public function checkVerifyStatus(Request $request){
    //     if ($request->user()->verify_code=='true') {
    //         return $this->success(['status'=>true],'user is verified');
    //     }else {
    //         return $this->success(['status'=>false],'user is not verified');
    //     }
    // }

    // public function verify(Request $request){
    //     $request->validate([
    //         'code'=>'required'
    //     ]);

    //     $code = $request->user()->verify_code;
    //     if ($code===$request->code) {
    //         Customer::find($request->user()->id)->update(['verify_code'=>'true']);
    //     }else {
    //         return $this->error(['code'=>'$request->code'],'wrong code',417);
    //     }

    //     return $this->success('','email verified successfully');
    // }
}
