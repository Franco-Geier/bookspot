<?php
    namespace Classes;
    use PHPMailer\PHPMailer\PHPMailer;
    
    class Email {
        public $email;
        public $nombre;
        public $token;

        public function __construct($nombre, $email, $token) {
            $this->nombre = $nombre;
            $this->email = $email;
            $this->token = $token;
        }

        public function enviarConfirmacion() {
            // Crear el objeto de email
            $mail = new PHPMailer();
            // Configurar SMTP (Protocolo)
            $mail->isSMTP();
            $mail->Host = "sandbox.smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = 'b0ba581ebf57f6';
            $mail->Password = '189d63aa39f836';
            $mail->SMTPSecure = "tls";
            $mail->Port = 2525;

            // Configurar el contenido del mail
            $mail->setFrom("admin@bookspot.com"); // Quien envia el email
            $mail->addAddress("admin@bookspot.com", "BookSpot.com"); // A que email va a llegar el correo
            
            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            // Contenido
            $mail->Subject = "Confirma tu cuenta"; // El asunto que el usuario va a leer
            
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre. "</strong> Has creado tu cuenta en BookSpot, solo debes confirmarla presionando el siguiente enlace</p>";
            $contenido .= "<p>Presiona aquí: <a href='http://localhost/bookspot/public/index.php/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
            $contenido .= "<p>Si no solicitaste restablecer la contraseña, puedes ignorar este mensaje</p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;

            // Enviar el mail
            $mail->send();
        }


        public function enviarInstrucciones() {
            // Crear el objeto de email
            $mail = new PHPMailer();
            // Configurar SMTP (Protocolo)
            $mail->isSMTP();
            $mail->Host = "sandbox.smtp.mailtrap.io";
            $mail->SMTPAuth = true;
            $mail->Username = 'b0ba581ebf57f6';
            $mail->Password = '189d63aa39f836';
            $mail->SMTPSecure = "tls";
            $mail->Port = 2525;

            // Configurar el contenido del mail
            $mail->setFrom("admin@bookspot.com"); // Quien envia el email
            $mail->addAddress("admin@bookspot.com", "BookSpot.com"); // A que email va a llegar el correo
            
            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = "UTF-8";

            // Contenido
            $mail->Subject = "Restablece tu contraseña"; // El asunto que el usuario va a leer
            
            $contenido = "<html>";
            $contenido .= "<p><strong>Hola " . $this->nombre. "</strong> Has solicitado restablecer tu contraseña, sigue el siguiente enlace para hacerlo</p>";
            $contenido .= "<p>Presiona aquí: <a href='http://localhost/bookspot/public/index.php/recuperar?token=" . $this->token . "'>Restablecer Contraseña</a></p>";
            $contenido .= "<p>Si no solicitaste esta cuenta, puedes ignorar este mensaje</p>";
            $contenido .= "</html>";
            $mail->Body = $contenido;

            // Enviar el mail
            $mail->send();
        }
    }