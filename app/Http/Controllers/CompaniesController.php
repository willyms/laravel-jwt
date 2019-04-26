<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Company;

use JWTAuth;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return response()->json($companies);
    }

    public function show($id)
    {
        $company = Company::find($id);

        if(!$company) {
            return response()->json(['message'   => 'Record not found',], 404);
        }

        return response()->json($company);
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:companies',
            'password' => 'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json(['success'=> false, 'error'=> $validator->errors()], 400);
        }
        
        $company = new Company();
        $company->fill($request->all());
        $company->save();

        $token = JWTAuth::fromUser($company);

        return response()->json(compact('company','token'), 201);
    }

    public function update(Request $request, $id)
    {
        $company = Company::find($id);

        if(!$company) {
            return response()->json([
                'message'   => 'Record not found',
            ], 404);
        }

        $company->fill($request->all());
        $company->save();

        return response()->json($company);
    }

    public function destroy($id)
    {
        $company = Company::find($id);

        if(!$company) {
            return response()->json(['message'   => 'Record not found'], 404);
        }

        $company->delete();
    }
}
