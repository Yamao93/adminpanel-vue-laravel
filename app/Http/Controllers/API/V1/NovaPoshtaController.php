<?php

namespace App\Http\Controllers\API\V1;

use App\Models\Api;
use Illuminate\Http\Request;

class NovaPoshtaController extends BaseController
{

    private $apiKey;
    public function __construct() {
        $w = Api::first();
        $this->apiKey = $w->name;

    }
    public function index()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.novaposhta.ua/v2.0/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
"modelName": "Address",
"calledMethod": "getCities",
"apiKey": "'.$this->apiKey.'"
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: PHPSESSID=t987ob735bpe8fga5dmu3s6nij; YIICSRFTOKEN=df510edcb0522e56630b64406c5387886a580f47s%3A88%3A%22SjVyeEZjVVpvbVQ3OXVwaXV4Uk1UVWZiTTRHcXNqZlnQABNyjIgw3SEFu75rJuxzg3DAeFQYeJpXCtopqmqsgA%3D%3D%22%3B'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);


        $my_new_array = json_decode($response, true);

        if ($my_new_array['success'] == true) {
//            dd($my_new_array);
            return $this->sendResponse($my_new_array['data'], 'Regions');
        }
        return $this->sendError('Failed NovaPoshta response');
    }


    public function address($ref)
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.novaposhta.ua/v2.0/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "modelName": "Address",
  "calledMethod": "getWarehouses",
  "methodProperties": {
    "CityRef": "' . $ref . '"
  },
  "apiKey": "'.$this->apiKey.'"
}',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $new_array = json_decode($response, true);

        if ($new_array['success'] == true) {
            return $this->sendResponse($new_array['data'], 'Addresses');
        }
        return $this->sendError('Failed NovaPoshta response');

    }

}
