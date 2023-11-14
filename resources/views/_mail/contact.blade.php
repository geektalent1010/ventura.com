<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta http-equiv="x-ua-compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>New Contact For Join</title>
</head>
<body>
    <p>
        Name: {{ $data['username'] }}
    </p>
    <p>
        Country: {{ $data['country'] }}
    </p>
    <p>
        Email: {{ $data['email'] }}
    </p>
</body>
</html>