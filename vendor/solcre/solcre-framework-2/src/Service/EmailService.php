<?php

namespace Solcre\SolcreFramework2\Service;

use Exception;
use Solcre\SolcreFramework2\Entity\EmailAddress;
use Solcre\SolcreFramework2\Utility\Strings;

class EmailService
{

    const INVALID_EMAIL_FROM = 1;
    const NO_VALID_RECIPIENTS = 2;

    private static $errorList;
    private $mailer;
    protected $configuration;

    function __construct(\PHPMailer $mailer, $configuration)
    {
        $this->mailer = $mailer;
        $this->configuration = $configuration;
    }

    public static function getErrorList()
    {
        return Email::$errorList;
    }

    public function send(EmailAddress $from, $addresses, $subject, $content, $altText = "", $charset = null)
    {

        try {
            if (!is_null($charset)) {
                $this->mailer->CharSet = $charset;
            }
            EmailService::$errorList = array();
            if (!$from->isValid()) {
                EmailService::$errorList[] = EmailService::INVALID_EMAIL_FROM;
                return false;
            }
            /* agrego FROM y REPLY-TO */
            $this->mailer->SetFrom($from->getEmail(), $from->getName());
            // $this->mailer->AddReplyTo($from->getEmail(), $from->getName());
            /* agrego RECIPIENTES */
            if ($addresses instanceof EmailAddress) {
                $addresses = array($addresses);
            }
            $valid = false;
            if (is_array($addresses) && count($addresses) > 0) {
                foreach ($addresses as $address) {

                    if ($address->isValid()) {
                        $valid = true;
                        switch ($address->getType()) {
                            case EmailAddress::TYPE_CC: {
                                $this->mailer->AddCC($address->getEmail(), $address->getName());
                                break;
                            }
                            case EmailAddress::TYPE_BCC: {
                                $this->mailer->AddBCC($address->getEmail(), $address->getName());
                                break;
                            }
                            case EmailAddress::TYPE_REPLAY_TO: {
                                $this->mailer->AddReplyTo($address->getEmail(), $address->getName());
                                break;
                            }
                            case EmailAddress::TYPE_TO:
                            default: {
                                $this->mailer->AddAddress($address->getEmail(), $address->getName());
                                break;
                            }
                        }
                    }
                }
            }
            if (!$valid) {
                EmailService::$errorList[] = Email::NO_VALID_RECIPIENTS;
                return false;
            }
            //  $this->mailer->AddBCC('diego.sorribas@solcre.com');
            /* asunto */
            $this->mailer->Subject = html_entity_decode($subject);
            /* contenido */
            $this->mailer->AltBody = Strings::default_text($altText, 'To view the message, please use an HTML compatible email viewer!');
            $this->mailer->MsgHTML($content);

            /* send */
            if (!$this->mailer->send()) {
                throw new \Exception($this->mailer->ErrorInfo, 400);
            }

            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }

    public function sendTpl(
        EmailAddress $from,
        $addresses,
        $template,
        $vars,
        $subject = "",
        $altText = "",
        $charset = null,
        $fullTemplatePath = null
    ) {
        $templateRel = $fullTemplatePath ? $fullTemplatePath : $this->configuration['templates_email_default'] . $template;
        /* config smarty */
        $smarty = new \Smarty();
        if (!empty($vars)) {
            $smarty->assign('data', $vars);
        }
        $content = $smarty->fetch($templateRel);
        /* get subject and alt_text */
        $lineMatches = array();
        preg_match("/^(.*)$/m", $content, $lineMatches);
        if (isset($lineMatches[1])) {
            $firstLine = $lineMatches[1];
            $pattern = "^<!--(.*)-->$";
            $matches = array();
            if (preg_match("/" . $pattern . "/", $firstLine, $matches)) {
                if (isset($matches[1])) {
                    $data = json_decode($matches[1], true);
                    if (json_last_error() == JSON_ERROR_NONE) {
                        if (isset($data['subject'])) {
                            $subject = $data['subject'];
                        }
                        if (isset($data['alt_text'])) {
                            $altText = $data['alt_text'];
                        }
                        $content = preg_replace("/" . $pattern . "/m", "", $content, 1);
                    }
                }
            }
        }
        return self::send($from, $addresses, $subject, $content, $altText, $charset);
    }

}
