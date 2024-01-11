<?php
$client_id = '43d2670a-9b12-48c8-a7c6-2d0636e91e65';
$redirect_uri = 'https://tchyentra.azurewebsites.net/callback.php';
$tenant_id = '0408fa1a-f2a2-484f-bed5-576d7716ad89';
$url = "https://login.microsoftonline.com/$tenant_id/oauth2/v2.0/authorize?client_id=$client_id&response_type=code&redirect_uri=$redirect_uri&scope=openid email profile offline_access&response_mode=query";
header("Location: $url");
exit;
?>