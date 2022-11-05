<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use App\Models\AmoAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use League\OAuth2\Client\Token\AccessToken;

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
        $apiClient = new AmoCRMApiClient(
            getenv('CLIENT_ID'),
            getenv('CLIENT_SECRET'),
            getenv('CLIENT_REDIRECT_URI')
        );
        $apiClient->setAccountBaseDomain(getenv('ACCOUNT_DOMAIN'));
        $raw_token = json_decode(file_get_contents('../token.json'), 1);
        $token = new AccessToken($raw_token);
        $apiClient->setAccessToken($token);
        $account = $apiClient->account()->getCurrent();
        echo "<pre>";
        print_r($account->toArray());
    }
    public function leads()
    {
        $apiClient = new AmoCRMApiClient(
            getenv('CLIENT_ID'),
            getenv('CLIENT_SECRET'),
            getenv('CLIENT_REDIRECT_URI')
        );
        $apiClient->setAccountBaseDomain(getenv('ACCOUNT_DOMAIN'));
        $raw_token = json_decode(file_get_contents('../token.json'), 1);
        $token = new AccessToken($raw_token);
        $apiClient->setAccessToken($token);
        $leads = $apiClient->leads();
        echo "<pre>";
        print_r($leads);
    }
}
