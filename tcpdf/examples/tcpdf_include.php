<?php
// always load alternative config file for examples
require_once('tcpdf/config/tcpdf_config.php');

// Include the main TCPDF library (search the library on the following directories).
$tcpdf_include_dirs = array(
    realpath(dirname(__FILE__) . '/../tcpdf.php'),// True source file
	realpath('../tcpdf.php'),// Relative from $PWD
	'/usr/share/php/tcpdf/tcpdf.php',
	'/usr/share/tcpdf/tcpdf.php',
	'/usr/share/php-tcpdf/tcpdf.php',
	'/var/www/tcpdf/tcpdf.php',
	'/var/www/html/tcpdf/tcpdf.php',
	'/usr/local/apache2/htdocs/tcpdf/tcpdf.php'
);
foreach ($tcpdf_include_dirs as $tcpdf_include_path) {
	if (@file_exists($tcpdf_include_path)) {
		require_once($tcpdf_include_path);
		break;
	}
}

//============================================================+
// END OF FILE
//============================================================+
