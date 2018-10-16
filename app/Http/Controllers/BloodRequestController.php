<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BloodRequest;

class BloodRequestController extends Controller
{
    public function index(Request $request)
    {
        $blood_requests = BloodRequest::where(function ($query) use($request){
            if($request->has('city_id'))
            {
                $query->where('city_id',$request->city_id);
            }else
                {
                $blood_requests = BloodRequest::latest();

                return responseJson(1, 'Blood Requests', $blood_requests);
            }
        })->paginate(8);

        return responseJson(1,'Success', $blood_requests);
    }

    public function store(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'patient_name' => 'required',
                'patient_age' => 'required',
                'blood_type' => 'required',
                'bag_num' => 'required',
                'hospital_name' => 'required',
                'hospital_address' => 'required',
                'city_id' => 'required',
                'mobile' => 'required|unique:blood_requests'
            ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $blood_requests = BloodRequest::create($request->all());
        $blood_requests->save();
        return responseJson(1, 'Request added Successfully', $blood_requests);
    }

    // Show one blood request by id
    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $blood_request = BloodRequest::findOrFail($id);

        $this->validate($request, [
            'patient_age' => 'required'
        ]);

        $input = $request->all();

        $blood_request->fill($input)->save();

        return responseJson('1', 'Updated successfuly', $blood_request);
    }

    public function destroy(BloodRequest $blood_request, $id)
    {
        $blood_request = BloodRequest::findOrFail($id);
        $blood_request->delete();

        return responseJson(1, 'Deleted successfuly');
    }
}
