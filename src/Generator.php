<?php

namespace FaviconGenerator;

use FaviconGenerator\Platforms\Basic as Platform;

class Generator
{
	private $app;
	private $input;
	private $errors = [];
	private $platforms = [];

	public function __construct(Application $app)
	{
		$this->app = $app;
	}

	public function load($file)
	{
		if (!file_exists($file)) {
			$this->error('File %s does not exist', $file);
			return false;
		}
		if (!$this->isImage($file)) {
			$this->error('File %s is not an image', $file);
			return false;
		}
		$this->input = $file;
		return true;
	}

	public function addPlatform(Platform $platform)
	{
		$this->platforms[] = $platform;
	}

	public function generate($directory)
	{
		if (!is_dir($directory)) {
			@mkdir($directory, 0777);
		}
		if (!is_dir($directory)) {
			$this->error('Directory %s not found and cannot be created', $directory);
			return false;
		}
		
		$head = [];
		foreach ($this->platforms as $platform) {
			$platform->setApplication($this->app);
			$platform->load($this->input);
			$attrs = $platform->convert($directory);
			if (is_array($attrs)) {
				$head = array_merge($head, $attrs);
			}
		}

		$html = "<html>\n\t<head>\n\t\t%head%\n\t</head>\n\t<body>\n\t</body>\n</html>\n";
		$html = str_replace('%head%', implode("\n\t\t", $head), $html);
		file_put_contents($directory . DIRECTORY_SEPARATOR . 'index.html', $html);
	}

	protected function error($msg, $args = null)
	{
		$arr = func_get_args();
		array_shift($arr);
		if (count($arr)) {
			$this->errors[] = vsprintf($msg, $arr);
		} else {
			$this->errors[] = $msg;
		}
	}

	public function getErrors()
	{
		return $this->errors;
	}

	protected function isImage($file)
	{
		return preg_match('/\.(svg|png)$/i', $file);
	}
}