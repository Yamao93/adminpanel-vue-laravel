<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Requests\ApiRequest;
use App\Models\Api;

class ApiController extends BaseController
{
    public function store(ApiRequest $request) {
        $apis = Api::create([
            'name' => $request['name'],
        ]);
        $data['id'] = $apis->id;
        $data['name'] = $apis->name;

        return $this->sendResponse($data, 'API Created Successfully');
    }

    public function index()
    {
        $api = Api::first();
       $data['id'] = $api->id;
       $data['name'] = $api->name;
        return $this->sendResponse($data, 'Api list');
    }


//    public function update(ApiRequest $request ,$id) {
//        $api = Api::findOrFail($id);
//
//        $api->update($request->all());
//
//        return $this->sendResponse($api, 'Api Information has been updated');
//    }
}
