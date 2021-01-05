<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FINSMART</title>
</head>
<body>
    <h4>Hi, {{$details->surname.' '.$details->othername}}</h4><br>
    <p>Please click on the link below to reset your password, the link will expire in 2 hours</p><br>
    <p>127.0.0.1:8000/resetpassword/{{hashId($details->userid)}}</p>
</body>
</html>