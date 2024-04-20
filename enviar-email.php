<?php
// Define o caminho de inclusão para o diretório 'vendor'
set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ . '/vendor');

// inclui o arquivo autoload.php
include 'autoload.php';

//require __DIR__ .'./vendor/autoload.php';

//DEFINE DEPENDENCIA
use \App\Communication\Email;

//o email que vai ser enviado (TESTE)
$addres  = 'gabriel.moretto@universo.univates.br';
$subject = 'Olá mundo :)';
$body    = '<b> Olá Mundo</b><br><br><i>Olá mundo</i>';

$obEmail = new Email;
$sucesso = $obEmail->sendEMail($addres,$subject,$body);

echo $sucesso ? 'Mensagem enviada com sucesso' : $obEmail->getError();
?>