<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // $endpoint = "http://localhost:8080/api/buku/";

        // // Data to send as JSON
        // $data = array(
        //     "limit" => 3,
        //     "page" => 1
        // );

        // // Convert data to JSON format
        // $json_data = json_encode($data);

        // // Initialize cURL session
        // $ch = curl_init();

        // // Set cURL options
        // curl_setopt($ch, CURLOPT_URL, $endpoint);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //     'Content-Type: application/json',
        // ));
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Use POST method

        // // Set the JSON data as the request body
        // curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

        // // Execute cURL session and get the response
        // $response = curl_exec($ch);
        // // Check for cURL errors
        // if (curl_errno($ch)) {
        //     echo 'cURL error: ' . curl_error($ch);
        // }
        
        // // Close cURL session
        // curl_close($ch);
        // $endpoint = "http://localhost:8080/api/buku/";
        // $curl = curl_init();
        // curl_setopt($curl, CURLOPT_URL, $endpoint);
        
        return view('tes');
    }
}
