<?php
class email
{
    public function getEmail()
    {
        $to="indiana@ensaludybelleza.com";

        $subject="Activa tu cuenta de surface";

        $message="Dale click en el link para activar";

        mail($to, $subject,$message);
        echo "email enviado";
    }
}
?>
