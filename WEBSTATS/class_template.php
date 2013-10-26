<?php
/*
================================================
CLASS - PAGE TEMPLATE
Copyright (c) 2006-2009 Mitchell Sleeper
Originall developed for WWW.MSLEEPER.COM
================================================
Template class file - "class_template.php"
================================================
*/

class Template {
	// Primary variable array, used to store static data and output it into the template file
	var $vars;

	// Loads a template file $file to be used by the object
	function Template($file = null) {
		$this->file = $file;
		$this->setcommontemplatevariables();
	}

	function setcommontemplatevariables() {
		global $template_properties, $language_pack, $header_extra, $site_name, $playercount, $realismlink, $realismversuslink, $mutationslink, $scavengelink, $realismcmblink, $realismversuscmblink, $mutationscmblink, $scavengecmblink, $timedmapslink, $templatefiles;

		$this->set("template_properties", $template_properties); // Template properties
		$this->set("language_pack", $language_pack); // Language pack

		$this->set("header_extra", $header_extra); // Players served
		$this->set("site_name", $site_name); // Site name

		$this->set("realismlink", $realismlink); // Realism stats link
		$this->set("realismversuslink", $realismversuslink); // Realism Versus stats link
		$this->set("mutationslink", $mutationslink); // Mutations stats link
		$this->set("scavengelink", $scavengelink); // Scavenge stats link

		$this->set("realismcmblink", $realismcmblink); // Realism stats link
		$this->set("realismversuscmblink", $realismversuscmblink); // Realism Versus stats link
		$this->set("mutationscmblink", $mutationscmblink); // Mutations stats link
		$this->set("scavengecmblink", $scavengecmblink); // Scavenge stats link

		$this->set("stylesheet", $templatefiles['style.css']); // Stylesheet for the page
		$this->set("statstooltip", $templatefiles['statstooltip.js']); // Tooltip javascript file
		$this->set("statscombobox", $templatefiles['statscombobox.js']); // Combobox javascript file

		$this->set("timedmapslink", $timedmapslink); // Timed maps stats link
	}

	// Sets the variable $name to $value, to be recalled in the loaded template file
	function set($name, $value) {
		$this->vars[$name] = is_object($value) ? $value->fetch() : $value;
	}

	// Opens the file $file, dumps all of the vars in $var to local variables, and then parses
	// the variables into the template, dumping it into $contents to be used later.
	// Note: $file does not have to be passed if it has been loaded with Template($filename)
	function fetch($file = null) {
		if(!$file) $file = $this->file;

		extract($this->vars);		  // Extract the vars to local namespace

		ob_start();					// Start output buffering
		include($file);				// Include the file
		$contents = ob_get_contents(); // Get the contents of the buffer
		ob_end_clean();				// End buffering and discard

		if (preg_match('/<\/body>/i', $contents))
		{
			global $debug, $template_properties, $language_pack, $templates_path;
			$footerTpl = new Template($templates_path . 'footer.tpl');
			$newcontent = $footerTpl->fetch($templates_path . 'footer.tpl');

			if ($debug)
			{
				$newcontent .= "Listing of template properties:<br>";
				foreach ($template_properties as $key => $value)
				{
					$newcontent .= $key . "=" . $value . "<br>";
				}

				$newcontent .= "<br>Language pack content:<br>";
				foreach ($language_pack as $key => $value)
				{
					$newcontent .= $key . "=" . $value . "<br>";
				}
			}

			$contents = preg_replace('/<\/body>/i', $newcontent . '</body>', $contents);
		}

		return $contents;			  // Return the contents
	}
}
?>
