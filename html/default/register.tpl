<div id="content">
	<div class="topBelow" style="text-align: center; font-size: 32px; font-weight: bold;">Zarejestruj konto</div>
	<div style="width: 50%; margin: 0 auto; margin-top: 40px;">
		<form method="POST" action="/register.php">
			<div style="width: 45%; float: left;">Login: <input style="padding: 4px; border-radius: 6px; width: 100%;" type="text" name="login" placeholder="Wpisz nazwę użytkownika" required /> </div>
			<div style="width: 45%; float: right;">Email: <input style="padding: 4px; border-radius: 6px; width: 100%;" type="email" name="email" placeholder="Wpisz adres email" required /></div>

			<div style="clear: both; margin-top: 20px;"></div>

			<div style="width: 45%; float: left;">Hasło: <input style="padding: 4px; border-radius: 6px; width: 100%;" type="password" name="pass" placeholder="Prowadź hasło" required /> </div>
			<div style="width: 45%; float: right;">Powtórz hasło: <input style="padding: 4px; border-radius: 6px; width: 100%;" type="password" name="re_pass" placeholder="Wpisz haslo ponownie" required /></div>

			<div style="clear: both; margin-bottom: 25px;"></div>

			<div style="margin: 0 auto; text-align: center;"><input style="padding: 4px; border-radius: 6px;" type="submit" name="send" value="Wyślij formularz" /></div>
		</form>
		<span style="text-align: center; width: 100%; margin-top: 20px;">{result}</span>
	</div>
</div>