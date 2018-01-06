<?php

namespace FaviconGenerator\Platforms;

class iOS extends Basic
{
	protected function getSizes()
	{
		return [72, 120, 152, 180];
	}

	protected function getIcons()
	{
		$result = [];
		foreach ($this->getSizes() as $size) {
			$file = $this->getFile(sprintf('apple-touch-icon-precomposed@%d.png', $size));
			$result[$size . 'x' . $size] = $file;
		}
		return $result;
	}

	protected function getHtml()
	{
		$result = [];
		foreach ($this->getSizes() as $size) {
			$result[] = sprintf('<link rel="apple-touch-icon-precomposed" sizes="%dx%d" href="/assets/favicons/apple-touch-icon-precomposed@%d.png">', $size, $size, $size);
		}
		return $result;
	}
}