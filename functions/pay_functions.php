<?php

function authToken()
{
    $url = 'https://sandbox-auth-api.mypos.com/oauth/token';
    // $url = 'https://auth-api.mypos.com/oauth/token';
    $client_id = 'DdzVVtGUAW2Y0OmufLEZtZWh';
    $client_secret = 'E5jcr6EaKr1HpjCFaCdPECr4OmUDFCyTExaBe4RyZB6w3msP';

    $data = 
        array(
            'grant_type' => 'client_credentials',
        )
    ;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => $data,
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "Authorization: Basic " . base64_encode($client_id.":".$client_secret)            
        ),
    ));

    $chleadresult = curl_exec($curl);
    $chleadapierr = curl_errno($curl);
    $chleaderrmsg = curl_error($curl);
    curl_close($curl);

    return [$chleadresult,$chleadapierr,$chleaderrmsg];
}

$retorno = authToken();

var_dump($retorno);
