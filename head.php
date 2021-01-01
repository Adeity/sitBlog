<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!--    I use Bootstrap, Google font and Jquery cdn. Font awesome is downloaded and served from server-->
    <meta charset="UTF-8">
    <title><?php echo $title;?></title>
    <link rel="icon" type="image/png" href="theme/pix/favicon.svg"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="theme/fontawesome/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="theme/scss/styles.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="js/main.js"></script>
</head>
<!--This is for remembering skin mode. Via reload_cookies.php-->
<body class="<?php echo $cookie_value?>">