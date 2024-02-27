<?php

namespace App\Http\Controllers;

use Artisaninweb\SoapWrapper\SoapWrapper;
use Illuminate\Support\Facades\Log;

class NoCriminalController extends Controller
{
    public function getDataFromNcrc()
    {
        try {
            $apiBaseUrl = env('CUSTOM_BINDING_INCRC_INQUIRY_SVC_BASE_URL');
            $clientId = env('X_IBM_Client_Id');
            $clientSecret = env('X_IBM_Client_Secret');

            $soap = new SoapWrapper;
            $soap->add('moj-ncrcinquirysvc', function ($service) use ($apiBaseUrl, $clientId, $clientSecret) {
                $service
                    ->wsdl(app_path('config/POC/NCRC/moj-ncrcinquirysvc-all 1.0.0.wsdl'))
                    ->trace(true)
                    ->header([
                        'X-IBM-Client-Id' => $clientId,
                        'X-IBM-Client-Secret' => $clientSecret,
                    ]);
            });

            $response = $soap->call('moj-ncrcinquirysvc.GetDataFromNcrc');

            return response()->json($response);
        } catch (\Exception $e) {
            // Log the exception for further investigation
            Log::error('Error in GetDataFromNcrc: ' . $e->getMessage());

            // Dump the exception details for debugging
            dd($e);
        }
    }
}

