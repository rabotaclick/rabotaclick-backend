<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Смена почты</title>
</head>
<body>
<a href="{{env('APP_URL') . '/api/v1/email/employer/verify/' . $token}}">Подтвердить</a>
</body>
</html>
