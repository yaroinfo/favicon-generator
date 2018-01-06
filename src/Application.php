<?php

namespace FaviconGenerator;

/**
 * The application class describing application for some of browsers.
 */
class Application
{
	public $name;
	public $description;
	public $bgColor = '#FFFFFF';

	/**
	 * Application constructor.
	 * Loads JSON file into class if attribute is provided.
	 * 
	 * @access public
	 * @param string $file The JSON file.
	 */
	public function __construct($file = null)
	{
		if (file_exists($file) && preg_match('/\.json$/i', $file)) {
			$json = @json_decode(file_get_contents($file));
			if ($json) {
				foreach ($json as $name => $value) {
					if (property_exists($this, $name)) {
						$this->$name = $value;
					}
				}
			}
		}
	}
}