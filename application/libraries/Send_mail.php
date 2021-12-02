<?php

require_once(APPPATH . '/libraries/PHPMailer/class.phpmailer.php');

class Send_Mail {

    var $ci;
    var $_email_view = "";
    var $_data_mail = array();
    var $_to = array();
    var $_from = "";
    var $_subject = "";
    var $_adjuntos = array();

    function __construct($props = array()) {
        if (count($props) > 0) {
            $this->init($props);
        }

        $this->ci = get_instance();
        $this->ci->load->library('parser');
    }

    function init($props = array()) {
        if (count($props) > 0) {
            foreach ($props as $key => $val) {
                $this->$key = $val;
            }
        }
    }

    function send() {
        foreach ($this->_data_mail as $key => $value) {
            if (!is_array($value))
                $this->_data_mail[$key] = ($value);
        }

        $htmlMessage = $this->ci->parser->parse($this->_email_view, $this->_data_mail, true);
        $htmlMessage = utf8_decode($htmlMessage);
        //print $htmlMessage;

        if (count($this->_to) > 0) {
            $error = array();
            foreach ($this->_to as $value) {

                $to = $value["email_notificacion"];
                $rs = $this->_send_email($this->_data_mail['nombre_sistema'], $this->_from, $to, utf8_decode($this->_subject), $htmlMessage);

                if ($rs != "true")
                    $error[] = $rs;
            }

            return count($error) > 0 ? false : true;
        }
    }

    function _send_email($txtFrom, $From, $To, $Subject, $Message, $Cc = '') {
        if (defined('ENVIRONMENT') && ENVIRONMENT == 'development') {
            try {
                $this->ci->myprofilerlib->addMail($To, $Subject, $Message);
            } catch (Exception $e) { }

            return "true"; // no enviar correos en desarrollo
        }

        // logs
        $controller = & get_instance();
        $controller->load->model('mod_seguridad', 'logs');
        $info = array(
            'para' => utf8_encode($To),
            'asunto' => utf8_encode($Subject),
            'texto' => utf8_encode($Message)
        );

        $mail = new PHPMailer(true);
        //$mail->IsSMTP(); // telling the class to use SMTP
        try {
		
		
		/*	$mail->Host       = "mail.hotelnacional.cu"; // SMTP server
		  $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
		  $mail->SMTPAuth   = true;                  // enable SMTP authentication
		  $mail->SMTPSecure = "none";                 // sets the prefix to the servier
		  $mail->Host       = "mail.hotelnacional.cu";      // sets GMAIL as the SMTP server
		  $mail->Port       = 25;                   // set the SMTP port for the GMAIL server
		  $mail->Username   = "noreply@hotelnacional.cu";  // GMAIL username
		  $mail->Password   = "Fiz5m^46";*/
            /*$mail->Host = "smtp.googlemail.com"; // SMTP server
            $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
            $mail->SMTPAuth = true;                  // enable SMTP authentication
            $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
            $mail->Host = "smtp.googlemail.com";      // sets GMAIL as the SMTP server
            $mail->Port = 465;                   // set the SMTP port for the GMAIL server
            $mail->Username = "ofertascubanas@gmail.com";  // GMAIL username
            $mail->Password = "85012821649*";*/
			//$mail->Username   = "noreply@hotelnacional.cu"
            $mail->Timeout = 100;

            $mail->SetFrom($From, $txtFrom);
            $mail->AddAddress($To);

            if ($Cc)
                $mail->AddAddress($Cc);
            $mail->IsHTML(true);

            $mail->Subject = $Subject;
            $mail->Body = $Message;
            //PARA VNIAR ADJUNTOS
            foreach ($this->_adjuntos as $adjunto) {
                $mail->AddAttachment($adjunto);
            }
            //$mail->MsgHTML($Message);
            $headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= "From: $From\r\n";
            //mail($To,$Subject,$Message,$headers);
            $mail->Send();
        } catch (phpmailerException $e) {
            $info['error'] = utf8_encode($e->errorMessage());
            $controller->logs->email_logs($info);

            return $e->errorMessage(); //Pretty error messages from PHPMailer
        } catch (Exception $e) {
            $info['error'] = utf8_encode($e->getMessage());
            $controller->logs->email_logs($info);

            return $e->getMessage(); //Boring error messages from anything else!
        }

        $info['error'] = 'sin error';
        $controller->logs->email_logs($info);

        return "true";
    }

    function email_to_file($txtFrom, $From, $To, $Subject, $Message, $Cc = '') {
        $carpeta = '/home/luisl/tmp/';

        if (is_dir($carpeta))
        {
            $correo  = "<div>para: $To<br>";
            $correo .= "de: $txtFrom <$From> <br>";
            $correo .= "asunto: $Subject</div>";
            $correo .= $Message;

            file_put_contents($carpeta . 'HN-' . microtime() . '.html', $correo);
        }
    }

}

?>