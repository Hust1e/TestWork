<?php

namespace App\Http\Controllers;

use AmoCRM\Client\AmoCRMApiClient;
use Illuminate\Http\Request;

class CredentialsController extends Controller
{
    public function index()
    {
        $apiClient = new AmoCRMApiClient(
            getenv('CLIENT_ID'),
            getenv('CLIENT_SECRET'),
            getenv('CLIENT_REDIRECT_URI')
        );
        $apiClient->setAccountBaseDomain(getenv('ACCOUNT_DOMAIN'));
        $token = $apiClient->getOAuthClient()->getAccessTokenByCode($_GET['code']);
        return $token;
    }
}