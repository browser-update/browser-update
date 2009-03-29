<?php

require_once(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'init.php'); // just to be sure
define('BU_LANG_PATH', BU_PATH . 'lang' . DIRECTORY_SEPARATOR);

/**
 * Normalizes the language-string
 *
 * There are many different ways to id languages for the system, for example:
 *  - de_de
 *  - de-de
 *  - de_DE
 *  - ...
 *
 * This function tries to return a normalized version, regardless of the format
 * given. This is done by replacing "_" with "-" and converting the string to
 * lower case.
 * @return string
 */
function lang_normalize($lang)
{
	return strtolower(str_replace('_', '-', $lang));
}

/**
 * Get language used fot this request.
 *
 * Each request needs to have its own language assigned. This function tries
 * to find the right language by searching for supported languages matching
 * the languages given in $_SERVER['HTTP_ACCEPT_LANGUAGE']. If no language
 * is supported it returns $default_lang.
 *
 * Additionally it is possible to set the language using $_GET['lang'], which
 * puts $_GET['lang'] in front of every other language given in
 * $_SERVER['HTTP_ACCEPT_LANGUAGE']. This way it is possible to force the
 * language to a particular value if neccessary.
 * @return string Language for the request.
 */
function request_lang()
{
	global $default_lang;
	static $request_lang = null;
	if (!is_null($request_lang)) return $request_lang;
	$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$lang = preg_split('#[,;]#', $lang);
	$lang = array_map('lang_normalize', $lang);
	if (isset($_GET['lang']))
	{
		$lang = array_merge(array($_GET['lang']), $lang);
	}
	foreach ($lang as $ll)
	{
		if (file_exists(BU_LANG_PATH . $ll))
		{
			$request_lang = $ll;
			return $request_lang;
		}
	}
	// Second try, use only the first two chars
	foreach ($lang as $ll)
	{
		if (strlen($ll) <= 2) continue;
		$ll = substr($ll, 0, 2);
		if (file_exists(BU_LANG_PATH . $ll))
		{
			$request_lang = $ll;
			return $request_lang;
		}
	}
	$request_lang = $default_lang;
	return $request_lang;
}

/**
 * Get language used for logging.
 *
 * Inside the log it is not neccessary to find a supported language. Instead
 * the first language can be used.
 * @return string Preferred Language for logging purposes
 */
function log_lang()
{
	$lang = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$lang = preg_split('#[,;]#', $lang);
	return lang_normalize($lang[0]);
}

/**
 * Load a translation and returns its strings.
 */
function load_translation($l)
{
	$lang = array();
	require_once(BU_LANG_PATH . $l . DIRECTORY_SEPARATOR . 'strings.php');
	return $lang;
}

/**
 * Translates a given string to the request language.
 *
 * 
 */
function translate($string)
{
	static $translation = null;
	if (is_null($translation))
	{
		$l = request_lang();
		$translation = load_translation($l);
	}
	$args = func_get_args();
	if (isset($translation[$string]))
	{
		// remove $string
		array_shift($args);
		// add translation as first arg
		array_unshift($args, $translation[$string]);
	}
	return call_user_func_array('sprintf', $args);
}

/**
 * Shortcut for translate()
 */
function t()
{
	$args = func_get_args();
	return call_user_func_array('translate', $args);
}

/**
 * Loads a template in the request language
 *
 * Falls back to $default_lang if template does not exist.
 */
function translate_template($filename, $vars=array())
{
	global $default_lang;
	$incfilename = BU_LANG_PATH . request_lang() .
		DIRECTORY_SEPARATOR . $filename;
	if (!file_exists($incfilename))
	{
		$incfilename = BU_LANG_PATH . $default_lang .
			DIRECTORY_SEPARATOR . $filename;
	}
	if (file_exists($incfilename))
	{
		if ($vars)
			extract($vars, EXTR_SKIP | EXTR_REFS);
		unset($vars);
		include($incfilename);
	}
	else
	{
		throw new Exception('translate_template(): $filename not found');
	}
}

/**
 * Shortcut for translate_template()
 */
function tt()
{
	$args = func_get_args();
	return call_user_func_array('translate_template', $args);
}

?>
