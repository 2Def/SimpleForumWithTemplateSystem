[not-group=0]
<div class="topBelow" style="text-align: left;">
	<div class="cattitle" style="width:98%; padding-left: 2%;  float: left;">Dodaj nowy temat.</div>
</div>
<form method="POST" action="#">
	<hr />
<div style="width: 20%; float: left;">
	<span style="font-size: 24px; font-weight: bold; padding-left: 20px;">Nazwa tematu:</span>
</div>
<div style="width: 80%; float: left;">
	<input type="text" style="width: 90%; border-radius: 9px; padding-top: 4px; padding-bottom: 4px; padding-left: 0.5%;" placeholder="Chce zapytać o..." name="title" />
</div>
<div style="clear: both;"></div>
<hr />
<div style="width: 20%; float: left;">
	<span style="font-size: 24px; font-weight: bold; padding-left: 20px;">Treść tematu:</span>
</div>
<div style="width: 80%; float: left;">
	<textarea style="width: 90%; height: 400px; border-radius: 9px; padding-top: 4px; padding-bottom: 4px; padding-left: 0.5%;" placeholder="Dokładnie wyjaśnij o co chcesz zapytać..." name="content"></textarea>
</div>
<div style="clear: both;"></div>
<hr />
<div style="width: 100% margin: 0 auto; text-align: center; margin-bottom: 0px;">
	<input type="submit" name="send" style="border-radius: 9px; margin-bottom: 12px; " value="Dodaj temat" />
</div>
</form>
{result}
[/not-group]
[group=0]
<script>
	alert("Jesteś niezalogowany!\nZaloguj się aby móc dodawać tematy.");
	window.history.back();
</script>
[/group]