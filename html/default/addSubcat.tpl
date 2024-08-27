<div class="topBelow" style="text-align: left;">
	<div class="cattitle" style="width:98%; padding-left: 2%;  float: left;">Dodaj subkategorię</div>
</div>
<form method="POST" action="#">
<hr />
<div style="width: 20%; float: left;">
	<span style="font-size: 24px; font-weight: bold; padding-left: 20px;">Nazwa:</span>
</div>
<div style="width: 80%; float: left;">
	<input type="text" name="subcat" style="width: 80%; border-radius: 9px; padding: 5px; margin-bottom: 12px;" placeholder="Nazwa subkategorii" />
</div>
<div style="clear: both;"></div>
<hr />
<div style="width: 20%; float: left;">
	<span style="font-size: 24px; font-weight: bold; padding-left: 20px;">Krótki opis:</span>
</div>
<div style="width: 80%; float: left;">
	<input type="text" name="description" style="width: 80%; border-radius: 9px; padding: 5px; margin-bottom: 12px;" placeholder="Krótki opis" />
</div>
<div style="clear: both;"></div>
<hr />
<div style="width: 20%; float: left;">
	<span style="font-size: 24px; font-weight: bold; padding-left: 20px;">Kategoria nadrzędna:</span>
</div>
<div style="width: 80%; float: left;">
	<select style="width: 20%; border-radius: 9px; padding: 9px;" name="kat_id">
	  {options}
	</select>
</div>
<div style="clear: both;"></div>
<hr />
<div style="width: 100% margin: 0 auto; text-align: center; margin-bottom: 0px;">
	<input type="submit" name="send" style="border-radius: 9px; margin-bottom: 12px;" value="Dodaj subkategorię" />
</div>
</form>
<a href="/admin.php" style="margin-left: 20px; font-size: 20px; border-bottom: 2px dotted grey;"><--- POWRÓT</a>
<center>{result}</center>
