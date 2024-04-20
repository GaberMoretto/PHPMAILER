<?php

namespace App\Communication;

/**
 * Dependencias do PHPMAILER
 */
 use PHPMailer\PHPMailer\PHPMailer;
 use  PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email
{
    /**
     * Credenciais de acesso ao SMTP
     */
    const HOST = 'smtp.gmail.com';
    const USER = 'gabriel.moretto@universo.univates.br';
    //Inserir a senha do email no pass
    const PASS = ' ';
    const SECURE = 'TLS';
    const PORT = '587';
    const CHARSET = 'UTF-8';

    /**
     * Dados de remetente
     */
    const FROM_EMAIL = 'gabriel.moretto@universo.univates.br';
    const FROM_NAME = 'Gabriel Moretto';
    /**
     * Mensagem de erro do envio
     * @var string
     */
    private $error;

    /**
     * Retorna mensagem de erro de envio
     * @return string
     */
    public function getError()
    {
        return $this->error;    
    }

    /**
     * Método responsável por enviar um e-mail
     * @param string|array $addresses  destinatários,, 
     * @param string $subject
     * @param string $body,
     * @param string|array $atachments = []
     * @param string|array $ccs = []
     * @param string|array $bccs = []
     * @return boolen
     */
    public function sendEMail ($addresses, $subject, $body, $atachments = [], $ccs = [], $bccs = [])
    {
        //LIMPAR MENSAGEM DE ERRO
        $this->error= '';

        //Instancia de PHPMAILER
        $obMail = new PHPMailer(true);

        try {

            //CREDENCIAS DE ACESSO AO SMTP
            $obMail->isSMTP(true);
            $obMail->Host       = self::HOST;
            $obMail->SMTPAuth   = true;
            $obMail->Username   = self::USER;
            $obMail->Password   = self::PASS;
            $obMail->SMTPSecure = self::SECURE;
            $obMail->Port       = self::PORT;
            $obMail->CharSet    = self::CHARSET;

            //REMETENTE
            $obMail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

            //DESTINATÁRIOS
            //? = significa se for igual
            //: = Negação recebe um array com o valor dela dentro
            $addresses = is_array($addresses) ? $addresses : [$addresses];

            foreach($addresses as $address)
            {
                $obMail->addAddress($address);
            }

            //ANEXOS
            $atachments = is_array($atachments) ? $atachments : [$atachments];

            foreach($atachments as $atachment)
            {
                $obMail->addAttachment($atachment);
            }

            //CÓPIA CC
            $ccs = is_array($ccs) ? $ccs : [$ccs];

            foreach($ccs as $cc)
            {
                $obMail->addCC($cc);
            }

            //CÓPIA OCULTA
            $bccs = is_array($bccs) ? $bccs : [$bccs];

            foreach($bccs as $bcc)
            {
                $obMail->addBcc($bcc);
            }

            //CONTEÚDO DO EMAIL

            $obMail->isHTML(true);
            $obMail->Subject = $subject;
            $obMail->Body    = $body;

            //ENVIA O EMAIL
            return $obMail->send();
        }catch(PHPMailerException $e){
            $this->error = $e->getMessage();
            return false;
        }
    }
}