<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Governorate;
use Illuminate\Support\Facades\Auth;

class GovernoratesController extends Controller
{
    public function index()
    {
        $governorates = Governorate::all();

        return responseJson(1, 'Success',$governorates );
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
