<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function currentUser()
    {

        $access = '';
        $client = new \GuzzleHttp\Client();
        $token = $_COOKIE['access_tokenku'];
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ];

        try {
            $response = $client->request('GET', env('APP_SERVER') . '/api/user', ['headers' => $headers]); //request data dari url tersebut ke api/meta@index
        } catch (\GuzzleHttp\Exception\ClientException $e) {

            abort(404, $e->getResponse()->getStatusCode());
        }

        $response = $response->getBody()->getContents(); //mengambil value dari $response yang berupa JSON
        $response = json_decode($response); //merubah $response menjadi array

        if ($response) {
            $data['user'] = $response;

            return $data;
        } else { //jika user pada response->data = null maka akan tampil pesan error 404
            setcookie("access_tokenku", null);
            return abort(404, 'user not found.');
        }
    }
}
