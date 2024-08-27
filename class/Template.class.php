<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once ( 'engine/config.php' );
require_once ( 'TemplateElement.class.php' );

class Template
{

	private $templateName;
	private $currentValue;
	private $path;
	private $dataContrainer;
	private $constContrainer;

	function __construct( $templateName /* Nazwa szablonu */ )
	{
		$this->templateName = $templateName;
		$this->dataContrainer = array();
		$this->currentValue = "";
		global $config;

		$this->constContrainer[] =  new TemplateElement( "template_name", $templateName );
		$this->constContrainer[] =  new TemplateElement( "title", $config['title'] );
		$this->constContrainer[] =  new TemplateElement( "description", $config['description'] );
		$this->constContrainer[] =  new TemplateElement( "header", $config['header'] );

		if(isset($_SESSION['login']))
		{
			$this->constContrainer[] =  new TemplateElement( "username", $_SESSION['username'] );
		}else
		{
			$this->constContrainer[] =  new TemplateElement( "username", 'Gość' );
		}

	}

	public function init()
	{
		$this->path = TEMPLATE_PATH . $this->templateName;

		if(!is_dir($this->path)) {
		    throw new Exception("Wybrany folder szablonu nie istnieje.");
		}

		return true;
	} 

	public function addRule( $name, $val )
	{
		$exists = false;
		if(is_array($this->dataContrainer)){

			foreach($this->dataContrainer as $value)
			{
				if( $value->getName() == $name )
					$exists = true; 
			}
		}

		if($exists)
		{
			throw new Exception ("Istnieje duplikat w regułach szablonu. <br />Nazwa reguły: " . $name );
			die();
		}else
		{
			$this->dataContrainer[] =  new TemplateElement( $name, $val );
			return true;
		}
	}

	private function renderTemplate()
	{
		if(empty($this->currentValue)){
			throw new Exception ( "Szablon nie został załadowany. \nNie można wyświetlić pustego szablonu." );
			die();
		}

		foreach($this->constContrainer as $value)
		{		
			$this->currentValue = str_replace('{' . $value->getName() . '}', $value->getValue(), $this->currentValue);
		}


		if(is_array($this->dataContrainer)){
			foreach($this->dataContrainer as $value)
			{		
				$this->currentValue = str_replace('{' . $value->getName() . '}', $value->getValue(), $this->currentValue);
			}

			$this->currentValue = preg_replace('/{+[a-zA-Z0-9_]+\}/', '', $this->currentValue);
			$this->dataContrainer = array();

			while($this->getGroup());
			while($this->getNotGroup());
		}
	}

	private function getGroup()
	{
		preg_match('/\[group=+([0-9])+\]/', $this->currentValue, $matchingBegin, PREG_OFFSET_CAPTURE);
		
		if(!empty($matchingBegin)){
			preg_match('/\[\/group\]/', $this->currentValue, $matchingEnd, PREG_OFFSET_CAPTURE);
			return $this->renderGroup($matchingBegin, $matchingEnd, false);
		}else
		{
			return false;
		}
	} 

	private function getNotGroup()
	{
		preg_match('/\[not-group=+([0-9])+\]/', $this->currentValue, $matchingBegin, PREG_OFFSET_CAPTURE);
		
		if(!empty($matchingBegin)){
			preg_match('/\[\/not-group\]/', $this->currentValue, $matchingEnd, PREG_OFFSET_CAPTURE);
			return $this->renderGroup($matchingBegin, $matchingEnd, true);
		}else
		{
			return false;
		}
	} 

	private function renderGroup($matchingBegin, $matchingEnd, $not)
	{
		$group = 0;
		if(isset($_SESSION['login']))
			$group = $_SESSION['group'];

			if(empty($matchingEnd))
				throw new Exception("Wystąpił błąd w przetwarzaniu szablonu. Brak tagu zamykającego.", 1);
				

			$toBegin = $matchingBegin[0][1];
			$beginLength = strlen($matchingBegin[0][0]);

			$toEnd = $matchingEnd[0][1];
			$endLength = strlen($matchingEnd[0][0]);
			$toGroup =  $matchingBegin[1][0];

			if($toBegin > $toEnd)
				throw new Exception("Wystąpił błąd w przetwarzaniu szablonu. Szablon zawiera tag zamykający przed tagiem otwierającym.", 1);

			if(($toGroup == $group && $not == false) || ($toGroup != $group && $not == true)){
				$matchingEndUpdate = str_replace("/", "\\/", $matchingEnd[0][0]);
				
				$this->currentValue = preg_replace('/\\'.$matchingBegin[0][0].'/i', '', $this->currentValue, 1);
				$this->currentValue = preg_replace('/\\'.$matchingEndUpdate.'/i', '', $this->currentValue, 1);
				
			}else
			{
				$directText = substr($this->currentValue, $toBegin, $toEnd - $toBegin + $endLength );
				$this->currentValue = str_replace($directText, "", $this->currentValue);
			}
			return true;
		
	}


	public function loadTemplate($name)
	{
		if(!file_exists($this->path . '/' . $name))
		{
			throw new Exception("Szablon który próbowano załadować nie istnieje.");
		}

		$this->currentValue = $this->currentValue .  file_get_contents( $this->path . '/' . $name );

		$this->renderTemplate();
	}

	public function showTemplate()
	{
		if(!empty($this->dataContrainer)){
			throw new Exception("Masz niezrenderowane reguły szablonu.");
			die();
		}

		echo $this->currentValue;
	}

	public function returnTemplate()
	{
		if(!empty($this->dataContrainer)){
			throw new Exception("Masz niezrenderowane reguły szablonu.");
			die();
		}
		$to_return = $this->currentValue;
		$this->currentValue = "";
		return $to_return;
	}


}

?>