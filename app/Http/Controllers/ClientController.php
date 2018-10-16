<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:clients',
                'birth_date' => 'required',
                'blood_type' => 'required|in:O-,O+,A-,A+,B-,B+,AB-,AB+',
                'city_id' => 'required',
                'mobile' => 'required|unique:clients',
                'password' => 'required|min:8|confirmed',
                'last_don_date' => 'required'
            ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $request->merge(['password' => bcrypt($request->password)]);
        $client = Client::create($request->all());
        $client->api_token = str_random(60);
        $client->save();
        return responseJson(1, 'Registered successfuly', [
            'api_token' => $client->api_token,
            'client' => $client
        ]);
    }

    public function login(Request $request)
    {
        $validator = validator()->make($request->all(),
            [
                'mobile' => 'required',
                'password' => 'required',
            ]);
        if ($validator->fails()) {
            return responseJson(0, $validator->errors()->first(), $validator->errors());
        }

        $client = Client::where('mobile', $request->mobile)->first();
        if ($client) {
            if (Hash::check($request->password, $client->password)) {
                return responseJson(1, 'You has been logged in', [
                    'api_token' => $client->api_token,
                    'client' => $client
                ]);
            } else {
                return responseJson(0, 'Wrong Credintals');
            }
        } else {
            return responseJson(0, 'Wrong Credintals');
        }
        return responseJson(1, '', $auth);
    }

    public function index()
    {
        $clients = Client::all();

        return responseJson(1, 'Success',$clients );
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $client = Client::findOrFail($id);

        $this->validate($request, [
            'mobile' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);

        $request->merge(['password' => bcrypt($request->password)]);

        $input = $request->all();

        $client->fill($input)->save();

        return responseJson('1', 'Updated successfuly', $client);
    }

    public function destroy($id)
    {
        //
    }
}
