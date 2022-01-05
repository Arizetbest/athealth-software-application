        <?php

            if($_SERVER["REMOTE_ADDR"]=="127.0.0.1"){
                $add = "http://localhost/athealth-software-application/";
            }else{
                $add = "https://athealth-project.herokuapp.com/";
            }
        ?>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="<?php echo $add; ?>bootstrap/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $add; ?>css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $add; ?>css/fontawesome-free-5.11.2-web/css/all.css">
        <link rel="stylesheet" href="<?php echo $add; ?>css/Chart.css">
        <link rel="stylesheet" href="<?php echo $add; ?>css/style.css">
        <title>AT-HEALTH: HMS</title>