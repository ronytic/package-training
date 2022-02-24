<?php

namespace ProcessMaker\Package\PackageTraining\Http\Controllers;

use ProcessMaker\Http\Controllers\Controller;
use ProcessMaker\Http\Resources\ApiCollection;
use ProcessMaker\Package\PackageTraining\Models\Sample;
use RBAC;
use Illuminate\Http\Request;
use ProcessMaker\Package\PackageTraining\Models\PackageCountry;
use URL;


class PackageTestAdminController extends Controller
{
    public function index()
    {
        // Load page index
        return view('package-test::index-admin');
    }


    public function searchCountries(Request $request)
    {
        try {
            // Get the region
            $region = $request->input('region', '');
            $curl = curl_init();
            // Get countries from the API
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.first.org/data/v1/countries?region=' . $region,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));

            $response = curl_exec($curl);
            curl_close($curl);
            // In case of error
            if ($response === false) {
                throw new \Exception('Error Processing Request', 1);
            }
            $response = json_decode($response);

            $dataResponse = [
                "status" => "success",
                'data' => $response->data,
                "message" => ""
            ];
            // Return the response in json format
            return response()->json($dataResponse);
        } catch (\Exception $e) {
            $dataResponse = [
                "status" => "error",
                'message' => $e->getMessage()
            ];
            return response()->json($dataResponse);
        }
    }

    public function store(Request $request)
    {
        try {
            // Get the country
            $country = $request->input('country', '');
            $region = $request->input('region', '');
            $countryId = $request->input('country_id', '');
            // Search if the country already exists
            $countries = PackageCountry::searchCountry($countryId);
            if (count($countries) > 0) {
                // If the country already exists, return an error
                throw new \Exception('Country already exists', 1);
            }
            // If the country does not exist, create it
            $dataCountry = [
                'country' => $country,
                'region' => $region,
                'country_id' => $countryId,
                'status' => 'ENABLED'
            ];
            // Save the country
            $country = PackageCountry::store(new Request($dataCountry));
            // If not country was created, return an error
            if (is_null($country)) {
                throw new \Exception('Error Processing Request', 1);
            }

            // If the country was saved, return the country
            $dataResponse = [
                "status" => "success",
                'data' => $country,
                "message" => "The request was saved successfully"
            ];
            // Return the response in json format
            return response()->json($dataResponse);
        } catch (\Exception $e) {
            // If an error occurs, return the error
            $dataResponse = [
                "status" => "error",
                'message' => $e->getMessage()
            ];
            // Return the response in json format
            return response()->json($dataResponse);
        }
    }

    public function getregisters()
    {

        try {
            // Get All Country Registered
            $countries = PackageCountry::getAll();
            // If the country was saved, return the country
            $dataResponse = [
                "status" => "success",
                'data' => $countries,
                "message" => ""
            ];
            // Return the response in json format
            return response()->json($dataResponse);
        } catch (\Exception $e) {
            $dataResponse = [
                "status" => "error",
                'message' => $e->getMessage()
            ];
            return response()->json($dataResponse);
        }
    }


    public function update(Request $request, $id_country)
    {
        // Get the country
        $country = $request->input('country', '');
        $region = $request->input('region', '');
        $countryId = $request->input('country_id', '');


        $packageCountry = PackageCountry::find($id_country);
        if (is_null($packageCountry)) {
            throw new \Exception('Country not found', 1);
        } else {

            $data = [
                'country' => $country,
                'region' => $region,
                'country_id' => $countryId,
            ];
            $packageCountry->updatePackageCountry(new Request($data));
        }

        return response()->json(['status' => 'success']);
    }
}
