<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pulse Auth</title>
</head>
<body>
    <form action="/admin/auth" method="POST">
        @csrf
        <input type="text" name="login" placeholder="login">
        <input type="password" name="password" placeholder="password">
        <button>submit</button>
    </form>
</body>
</html>
