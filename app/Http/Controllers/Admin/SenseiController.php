<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class SenseiController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    public function index()
    {

        // $mentors  = $this->getListMentors();
        // print_r(json_encode($data['mentors'], JSON_PRETTY_PRINT));
        // exit;
        // return view("admin/senseis", ['mentors' => $mentors]);
        return view("admin/sensei/list");
    }


    public function getListMentors(){
		$authToken = \Config('constant.jwt_token'); 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/users/?page_number=1&page_size=100&status=active",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$authToken,
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        return json_decode($response)->users;
        // if ($err) {
        //     echo "cURL Error #:" . $err;
        // } else {
        //     return json_decode($response)->users;
        // }
    }


    public function syncSenseisToDB()
    {
        try {
        $authToken = \Config('constant.jwt_token'); 
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/users/?page_number=1&page_size=100&status=active",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer ".$authToken,
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $senseis = json_decode($response)->users;

        // foreach ($senseis as $key => $sensei) {
        //     $data = Sensei::create([
        //         'first_name' => 
        //     ]);
        // }
        // return json_decode($response)->users;


        } catch (Exception $e) {
            
        }
    }

    public function getSenseiById($id)
    {
        try {
            
        } catch (Exception $e) {
            
        }
    }

}
