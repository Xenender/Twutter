<!DOCTYPE html>
<html>
<head>
	<title>Twutter</title>
	<!--<link rel="stylesheet" type="text/css" href="{{ asset('css/hub/HubPageStyle.css'); }}">-->


<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    @vite('resources/css/hub/HubPageStyle.css')



<style>



</style>
</head>
<body>

<header>
		<h1>Twutter</h1>
		@if ($errors->any())
		<div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
		@endif
	</header>
	<div class="main">  	

	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
				<form action="/register" method="post">
				@csrf
					<label for="chk" aria-hidden="true">Créer un compte</label>

					<input id="firstInput" type="text" name="username" placeholder="Nom d'utilisateur" required>
					<input type="email" name="email" placeholder="Email" required>
					<input type="password" name="password" placeholder="Mot de passe" required>
        			<input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
					<input type="submit" value="Créer un compte" />
				</form>
			</div>

			<div class="login">
			
				<form action="/login" method="post">
				@csrf
					<label for="chk" aria-hidden="true">Se connecter</label>
					<input type="email" name="email" placeholder="Email" required>
					<input type="password" name="password" placeholder="Mot de passe" required>
					<input id="firstInput" type="hidden" name="username" value="**********a***a">

					<input type="submit" value="Se connecter"/>
				</form>
			</div>
	</div>

</body>
</html>