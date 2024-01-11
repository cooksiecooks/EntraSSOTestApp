<?php
session_start();

// Define your client credentials
$client_id = '43d2670a-9b12-48c8-a7c6-2d0636e91e65';
$client_secret = 'P1B8Q~INYW5bZOjLDGDLHS8outVDb2kkYjE6QaeK';
$redirect_uri = 'https://tchyentra.azurewebsites.net/callback.php';
$tenant_id = '0408fa1a-f2a2-484f-bed5-576d7716ad89';

// Ensure code is in the query string
if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Prepare URL for token request
    $url = "https://login.microsoftonline.com/$tenant_id/oauth2/v2.0/token";

    // Prepare the body for token request
    $token_request_data = array(
        'grant_type' => 'authorization_code',
        'code' => $code,
        'redirect_uri' => $redirect_uri,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'scope' => 'openid email profile offline_access'
    );

    // Make the token request
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($token_request_data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    // Decode the response
    $response_data = json_decode($response, true);

    // Check if access token is received
    if (isset($response_data['access_token'])) {
        // Extract user information from id token
        $id_token = $response_data['id_token'];
        list($header, $payload, $signature) = explode(".", $id_token);
        $decoded_payload = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+', $payload))), true);

        // Store user data in session
        $_SESSION['user_name'] = $decoded_payload['name'];

        // Redirect to main page or success page
        header('Location: main.php');
        exit;
    } else {
        // Redirect to error page
        header('Location: error.html');
        exit;
    }
} else {
    // Redirect to error page
    header('Location: error.html');
    exit;
}
?>
