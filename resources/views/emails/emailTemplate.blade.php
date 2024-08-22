<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de contact</title>
</head>
<body>
    <h1>Vous venez d'effectuer une demande de contact au support de Twutter</h1>
    <h4>Voici un résumé de votre demande</h4>
    <h5>{{ $details['title'] }}</h5>
    <h6>De: {{$details['name']}}</h6>
    <p>{{ $details['body'] }}</p>
</body>
</html>
