<?php

namespace FaviconGenerator\Platforms;

class IE11 extends Basic
{
	protected function getSizes()
	{
		return [];
	}

	protected function getIcons()
	{
		return [
			'70x70' => $this->getFile('ie-smalltile.png'),
			'150x150' => $this->getFile('ie-mediumtile.png'),
			'310x150' => $this->getFile('ie-widetile.png'),
			'310x310' => $this->getFile('ie-largetile.png')
		];
	}

	protected function getHtml()
	{
		return [
			'<meta name="application-name" content="' 
				. htmlspecialchars($this->app->name) . '">',
			'<meta name="msapplication-tooltip" content="' 
				. htmlspecialchars($this->app->description) . '">',
			'<meta name="msapplication-config" content="/assets/favicons/ieconfig.xml">'
		];
	}

	protected function render()
	{
		$xml = '<?xml version="1.0" encoding="utf-8"?>
    <browserconfig>
      <msapplication>
        <tile>
          <square70x70logo src="/assets/favicons/ie-smalltile.png"/>
          <square150x150logo src="/assets/favicons/ie-mediumtile.png"/>
          <square310x310logo src="/assets/favicons/ie-largetile.png"/>
          <TileColor>' . $this->app->bgColor . '</TileColor>
        </tile>
      </msapplication>
    </browserconfig>';
   	$file = $this->getFile('ieconfig.xml');
   	file_put_contents($file, $xml);
	}
}