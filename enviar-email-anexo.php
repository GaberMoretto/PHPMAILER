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
$subject = 'Arquivo Anexo';
$body    = '<b> Segue arquivo em anexo</b><br><br><i>Olá mundo</i>';
$attachment = __DIR__ . '/anexo.txt';

$obEmail = new Email;
$sucesso = $obEmail->sendEMail($addres,$subject,$body, $attachment);

echo $sucesso ? 'Mensagem enviada com sucesso' : $obEmail->getError();

?>