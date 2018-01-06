<?php

namespace FaviconGenerator\Platforms;

use IMagick;

/**
 * Very basic favicon.ico platform.
 * And basic class for other platforms.
 */
class Basic
{
	protected $app;
	private $img;
	private $output;

	public function __construct($file = null)
	{
		if ($file) {
			$this->load($file);
		}
	}

	public function setApplication($app)
	{
		$this->app = $app;
	}

	public function load($file)
	{
		$this->img = new IMagick($file);		
	}

	public function convert($directory)
	{
		if (!$this->img) {
			return false;
		}

		$this->output = $directory . DIRECTORY_SEPARATOR . 'favicons';
		if (!is_dir($this->output)) {
			@mkdir($this->output, 0777);
		}
		if (!is_dir($this->output)) {
			return false;
		}

		$this->render();

		foreach ($this->getIcons() as $size => $file) {
			$arr    = explode('x', $size);
			$width  = array_shift($arr);
			$height = array_shift($arr);
			$img    = clone $this->img;
			$img->resizeImage($width, $height, IMagick::FILTER_UNDEFINED, 0);
			$img->writeImage($file);
		}

		return $this->getHtml();
	}

	protected function render()
	{
		$img  = clone $this->img;
		$file = $this->getFile('favicon.ico');
		$img->setImageBorderColor('#ffffff');
		$img->resizeImage(64, 64, IMagick::FILTER_UNDEFINED, 0);
		$img->writeImage($file);
	}

	protected function getIcons()
	{
		return [];
	}

	protected function getFile($name)
	{
		return $this->output . DIRECTORY_SEPARATOR . $name;
	}

	protected function getHtml()
	{
		// generate sizes: 16x16 32x32 64x64
		return [
			'<link rel="shortcut icon" href="/assets/favicons/favicon.ico">'
		];
	}
}