<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<script>
    alert('접근권한이 없습니다. 관리자에게 문의해주세요.');
    location.href = "{{ env('LOGIN_DOMAIN') }}";
</script>

</body>
</html>
