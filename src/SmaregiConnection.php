<?php

namespace Anwar\Smaregi;

use Anwar\Smaregi\Interface\Connection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Cache;
use Spatie\FlareClient\Http\Exceptions\BadResponse;
use Illuminate\Config\Repository as Config;

class SmaregiConnection implements Connection
{
    protected object $authorization;
    protected Client $httpClient;

    protected Config $config;
    /**
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->authorization = collect($this->getAccessToken());
        $baseUri = rtrim($this->config->get('smaregi.base_url'), '/');
        $this->httpClient = new Client([
            'base_uri' => $baseUri,
            'headers' => [
                'Authorization' => 'Bearer ' . $this->authorization->get('access_token'), // Replace with your token
                'Accept'        => 'application/json',
//                'Content-Type'  => 'application/json',
            ],
        ]);
    }

    /**
     * @return mixed|string
     */
    public function getAccessToken()
    {
        if (Cache::has('smaregi_token')) {
            return json_decode(decrypt(Cache::get('smaregi_token')));
        }
        $configValidation = collect(config('smaregi'))->filter(function ($value, $key) {
            return $value == '';
        });
        if ($configValidation->isNotEmpty()){
            return $configValidation->map(function ($value, $key) {
                return "$key is required. Please check .env or smaregi.php config file;";
            });
        }
        $contract_id = config('smaregi.contract_id');
        $grant_type = config('smaregi.grant_type');
        $scope = config('smaregi.scope');
        $client_id = config('smaregi.client_id');
        $client_secret = config('smaregi.client_secret');
        $base_url = config('smaregi.token_base_url');

        $httpClient = new Client();
        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'
        ];
        $options = [
            'form_params' => [
                'scope' => $scope,
                'grant_type' => $grant_type,
                'client_id' => $client_id,
                'client_secret' => $client_secret
            ]];
        try {
            $request = new Request('POST', rtrim($base_url, '/')."/$contract_id/token", $headers);
            $res = $httpClient->sendAsync($request, $options)->wait();
            if ($res->getStatusCode() == 200){
                $res = $res->getBody()->getContents();
                Cache::add('smaregi_token', encrypt($res), json_decode($res)->expires_in);
                return json_decode(decrypt(Cache::get('smaregi_token')));

            }else{
                throw new BadResponse("Bad response", $request);
            }

        }catch (GuzzleException|BadResponse $e){
            return $e->getMessage();
        }

    }

    public function get(string $path, array $params = [])
    {
        $path = $this->config->get('smaregi.contract_id')."/".$path;
        try {
            $res = $this->httpClient->getAsync($path, [
                'params' => $params
            ])->wait();
            if ($res->getStatusCode() == 200){
                return $res->getBody()->getContents();
            }
        }catch (GuzzleException|BadResponse $e){
            return $e->getMessage();
        }

    }

    public function post(string $path, array $body = []){
        $path = $this->config->get('smaregi.contract_id')."/".$path;
        try {
            $res = $this->httpClient->postAsync($path, [
                'json' => $body
            ])->wait();
            if ($res->getStatusCode() == 200){
                return $res->getBody()->getContents();
            }
        }catch (GuzzleException|BadResponse $e){
            return $e->getMessage();
        }
    }

    public function patch(string $path, array $body = []){
        $path = $this->config->get('smaregi.contract_id')."/".$path;
        try {
            $res = $this->httpClient->patchAsync($path, [
                'json' => $body
            ])->wait();
            if ($res->getStatusCode() == 200){
                return $res->getBody()->getContents();
            }
        }catch (GuzzleException|BadResponse $e){
            return $e->getMessage();
        }
    }

    public function delete(string $path, array $body = []){
        $path = $this->config->get('smaregi.contract_id')."/".$path;
        try {
            $res = $this->httpClient->deleteAsync($path, [
                'json' => $body
            ])->wait();
            if ($res->getStatusCode() == 200){
                return $res->getBody()->getContents();
            }
        }catch (GuzzleException|BadResponse $e){
            return $e->getMessage();
        }
    }

    /**
     * @param string $path
     * @param array $body
     * @return mixed
     */
    public function put(string $path, array $body = [])
    {
        $path = $this->config->get('smaregi.contract_id')."/".$path;
        try {
            $res = $this->httpClient->putAsync($path, [
                'json' => $body
            ])->wait();
            if ($res->getStatusCode() == 200){
                return $res->getBody()->getContents();
            }
        }catch (GuzzleException|BadResponse $e){
            return $e->getMessage();
        }
    }
}
