<?php

// contact_form.php

require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])) {
    $userData[] = trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING));
    $userData[] = trim(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL));
    $userData[] = trim(filter_var($_POST['phone'], FILTER_SANITIZE_STRING));
    
        

    if (!in_array(null, $userData)) {
        $phoneRegexp = "/^0(2|3|4|5|8|9)(\d)?\d{7}$/";


        if (mb_strlen($userData[0]) >= 2 && mb_strlen($userData[0]) <= 2) {
            if (preg_match($phoneRegexp, $userData[2])) {

              
                    // database connection to real server
                    if ($_SERVER['SERVER_ADMIN'] == 'webmaster@job2u.idan.work') {
                        $dbcon = 'mysql:host=localhost;dbname=job2u_lp;charset=utf8';
                        $db = new PDO($dbcon, 'portu', 'porty3709');
                    } else {
                        $dbcon = 'mysql:host=localhost;dbname=job2u-lp;charset=utf8';
                        $db = new PDO($dbcon, 'root', '');
                    }
 
                    $sql = "INSERT INTO contact VALUES('',?,?,?,NOW())";
                    $query = $db->prepare($sql);
                   
                    // send email to company
                    $mail = new PHPMailer();
                    $mail->Charset = 'UTF-8';
                    $mail->setFrom('no-reply@job2u.co.il', 'job2u');
                    $mail->addAddress('idanco77@gmail.com', 'Liat Razabi'); // should be: (job2u.li@gmail.com, 'Liat Razabi') 
                    $mail->Subject = 'new lead - career landing page';

                    $mail->Body = <<<EOT
<body dir="rtl" style="font-family: arial; color: #2C3E50; height: 100%; float: right;">
<div style="background-color: #d6e9f6; border: 3px solid #3498DB; padding: 10px; width: 90%;">
<h3 style="text-align: center; color: #04AA55;">שלום ליאת. התווסף ליד חדש עם הפרטים כדלהלן:</h3>
<hr style="border: 1px solid #3498DB">
<table style="width: 100%; border-collapse: collapse;">
<tr>
<td style="border: 2px solid #3498DB; width: 20%"><b>שם הגולש: </b></td>
<td style="border: 2px solid #3498DB">{$userData[0]}</td>
</tr>
<tr>
<td style="border: 2px solid #3498DB; width: 20%"> <b>האימייל של הגולש: </b></td>
<td style="border: 2px solid #3498DB"> {$userData[1]}</td>
</tr>
<tr>
<td style="border: 2px solid #3498DB; width: 20%"> <b>הטלפון של הגולש: </b></td>
<td style="border: 2px solid #3498DB">{$userData[2]}</td>
</tr>
<tr>
<td style="border: 2px solid #3498DB; text-align: center;" colspan="2"><a href="http://www.job2u.co.il" target="_blank"><img src="http://www.idan.online/project-landing-page/logo.png" alt="logo-job2u"></a></td>
</tr>
</table>
</div>
</body>
EOT;

                    $mail->IsHTML(true);
                    if ($mail->send()) {
                        echo $query->execute($userData);
                    }

                
            }
        }
    }
}


