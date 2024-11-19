<?php

namespace App\Http\Controllers;

use App\Http\Resources\EmployeeResource;
use App\Http\Resources\ServiceGroupResource;
use App\Http\Resources\ServiceResource;
use App\Models\Employee;
use App\Models\Service;
use App\Models\ServiceGroup;
use App\Models\Shipping;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServiceGroupController extends Controller
{
    use HttpResponses;

    function idleServiceGroups() {
        return ServiceGroupResource::collection(ServiceGroup::whereNull('job')->get());
    }

    function assignJobtoGroup(Request $request){
        $request->validate([
            'job'=>'required',
            'id'=>'required'
        ]);

        ServiceGroup::where('id',request('id'))->update([
            'job'=>request('job')
        ]);

        Shipping::where('id',request('job'))->update([
            'assigned'=>true
        ]);

        return $this->success('','job assigned successfully');
    }

    function serviceWorkerData(Request $request) {
        if($request->user()->service_group!=null){
            $servicegroup=ServiceGroup::where('id',$request->user()->service_group)->first();
            Log::debug('vinnnnnnnnnnn');
            if($servicegroup->job!=null){
                $shipping=Shipping::where('id',$servicegroup->job)->first();
                
                return [
                    'address'=>$shipping->shipping_address,
                    'job'=>Service::find($shipping->service_id)->name,
                    'supervisor'=>$servicegroup->supervisor==$request->user()->id? true:false,
                    'count'=>$shipping->count,
                    'shipping'=>$shipping->id,
                    'serviceGroup'=>$servicegroup->id
                ];
            }
            
        }
        
                return $this->error('','not a service worker',401); 
    }

    function jobDone(Request $request) {
        ServiceGroup::where('id',request('serviceGroup'))->update([
            'job'=>null
        ]);
        // Shipping::where('id',request('shipping'))->delete();
        return $this->success('','job done successfully');
           
    }

    function ungroupedServiceTechnicians() {
        return EmployeeResource::collection(Employee::where('role','service')->whereNull('service_group')->get());
    }

    function assignGroup() {
        $membersListId=request('membersList');
        $servicegroup=ServiceGroup::create([
            'name'=>request('name'),
            'supervisor'=>$membersListId[0],
        ]);

        foreach ($membersListId as $id) {
            Employee::find($id)->update([
                'service_group'=>$servicegroup->id
            ]);
        }

        return $this->success('','group assigned successfully');
    }
}
