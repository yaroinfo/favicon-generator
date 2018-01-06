<?php

namespace FaviconGenerator\Platforms;

class IE10 extends Basic
{
	protected function getSizes()
	{
		return [144];
	}

	protected function getIcons()
	{
		return [
			'144x144' => $this->getFile('tile-image@144.png')
		];
	}

	protected function getHtml()
	{
		return [
			'<meta name="msapplication-TileColor" content="#FFFFFF">',
			'<meta name="msapplication-TileImage" content="/assets/favicons/tile-image@144.png">'
		];
	}
}