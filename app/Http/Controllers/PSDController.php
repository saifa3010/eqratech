<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class PSDController extends Controller
{
    public function getPSDData()
    {
        try {
            // Fetch environment variables
            $baseUrl = env('PSD_BASE_URL', 'https://api-gateway.stg.gsb.gov.jo:9443/porg-g2g/g2g/api');
            $clientId = env('PSD_CLIENT_ID', '6c561f13386f9fcaecbf2b0c66a42b8e');
            $clientSecret = env('PSD_CLIENT_SECRET', 'a67425cd8bcdff691f35b535321997c6');

            // Make the HTTP request
            $response = Http::withHeaders([
                'X-IBM-Client-Id' => $clientId,
                'X-IBM-Client-Secret' => $clientSecret,
            ])->post("{$baseUrl}/psd", [
                'nationalNo' => '8004274348',
            ]);

            // Return the response as JSON
            return view('psd', ['psdData' => $response->json()]);
        } catch (\Exception $e) {
            // Return the view with error message
            return view('psd', ['error' => $e->getMessage()]);
        }
    }
}
