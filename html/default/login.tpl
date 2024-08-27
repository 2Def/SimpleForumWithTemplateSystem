<div id="content">
	<div class="topBelow" style="text-align: center; font-size: 32px; font-weight: bold;">Zaloguj się</div>
	<div style="width: 50%; margin: 0 auto; margin-top: 40px;">
		<div style="width: 45%; float: left;">Login: <input style="padding: 4px; border-radius: 6px; width: 100%;" type="text" id="login" placeholder="Wpisz nazwę użytkownika" required /> </div>
		<div style="width: 45%; float: right;">Hasło: <input style="padding: 4px; border-radius: 6px; width: 100%;" type="password" id="pass" placeholder="Hasło" required /></div>

		<div style="clear: both; margin-bottom: 25px;"></div>

		<div style="margin: 0 auto; text-align: center;"><button style="padding: 4px; border-radius: 6px;" id="log"> Zaloguj się </button></div>
		<span style="text-align: center; width: 100%; margin-top: 20px;">{result}</span>
	</div>
</div>
<script>
	$(document).ready(function(){
		 $("#log").click(function(){
			  username=$("#login").val();
			  password=$("#pass").val();
			  $.ajax({
			   type: "POST",
			   url: "/login.php",
				data: "login="+username+"&pass="+password,
			   success: function(html){
				
				if(html == 1){
					alert("Zostałeś pomyślnie zalogowany");
					$("#log").fadeOut();
					window.location.reload(false);
				}else
				{
					alert("Błędne hasło...");
					$("#log").html("Zaloguj się");
				}
			   },
			   beforeSend:function()
			   {
				$("#log").html("Czekam na odpowiedź serwera...");
			   }
			  });
			return false;
		});
		
		$(document).keypress(function (e) {
		  if (e.which == 13) { 
			username=$("#login").val();
			password=$("#password").val();
			
			if(username != "" && password != ""){			
				$('#log').click();
				return false;
			}
		  }
		});
	});
</script>