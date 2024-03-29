<!doctype html>
<html class="no-js" lang="DE">
<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta name="description" content="unused">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.2/css/bootstrap.min.css" integrity="sha512-CpIKUSyh9QX2+zSdfGP+eWLx23C8Dj9/XmHjZY2uDtfkdLGo0uY12jgcnkX9vXOgYajEKb/jiw67EYm+kBf+6g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @yield("cssextra")
    <meta name="theme-color" content="#dadada">
</head>
<body>
<div class="container">
    <div class="row">
        @yield("header")
    </div>
    <div class="row">
        @yield("main")
    </div>
    <div class="row">
        @yield("footer")
    </div>
</div>

@yield("jsextra")
</body>

</html>