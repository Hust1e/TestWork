<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\AmoAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CredentialsController extends Controller
{
    public function index(Request $request)
    {
        $apiClient = new AmoCRMApiClient(
            getenv('CLIENT_ID'),
            getenv('CLIENT_SECRET'),
            getenv('CLIENT_REDIRECT_URI')
        );
        $apiClient->setAccountBaseDomain(getenv('ACCOUNT_DOMAIN'));
        $token = $apiClient->getOAuthClient()->getAccessTokenByCode($request->code);
        file_put_contents('../token.json', json_encode($token->jsonSerialize(), JSON_PRETTY_PRINT));
        Log::info($token);
        return 'success';

    }
    public function account()
    {

    }
}
