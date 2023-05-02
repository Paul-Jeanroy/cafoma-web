<?php
    ini_set("smtp_port",587);
    ini_set("SMTP","smtp.gmail.com");
    if(mail("fessardnet@gmail.com","sujet test","message test ")){
        echo("Mail envoyé");
    } else {
        echo("Mail non envoyé");
    }
    phpinfo();
?>