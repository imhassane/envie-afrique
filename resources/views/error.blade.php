<!DOCTYPE html>
<html>
<head>
    <title>Votre commande est passée</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&family=Jost:wght@200;400&family=Lobster&family=Raleway:wght@100;300&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        * {
            font-family: Railway, Jost, SansSerif;
        }
    </style>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body>
<main class="h-screen w-screen bg-primary padding flex flex-col justify-center items-center text-white">
    <h1 class="text-white title text-center" style="font-family: Lobster;">Votre commande n'a pas été prise en compte</h1>
    <div class="flex items-center justify-center mt-5">
        <p>Veuillez reessayer</p>
    </div>
</main>
</body>
</html>
