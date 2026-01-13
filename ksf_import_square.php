<?php
/**********************************************
Name: KSF Import Square 
for FrontAccounting 2.3.15 by kfraser 
Free software under GNU GPL
***********************************************/

$page_security = 'SA_ksf_import_square';
$path_to_root="../..";

include($path_to_root . "/includes/session.inc");
add_access_extensions();
set_ext_domain('modules/ksf_import_square');

include_once($path_to_root . "/includes/ui.inc");
include_once($path_to_root . "/includes/data_checks.inc");
include_once($path_to_root . "/modules/ksf_modules_common/defines.inc.php");


error_reporting(E_ALL);
ini_set("display_errors", "on");

global $db; // Allow access to the FA database connection
$debug_sql = 0;  // Change to 1 for debug messages

	include_once($path_to_root . "/modules/ksf_import_square/class.ksf_import_square.php");
	require_once( 'ksf_import_square.inc.php' ); //KSF_XXX_PREFS

	$coastc = new ksf_import_square( KSF_IMPORT_SQUARE_PREFS );
	$found = $coastc->is_installed();
	$coastc->set_var( 'found', $found );
	$coastc->set_var( 'help_context', "Import Square" );
	$coastc->set_var( 'redirect_to', "ksf_import_square.php" );
	$coastc->run();

//}

?>
