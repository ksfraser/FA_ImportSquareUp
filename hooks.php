<?php

define( 'MENU_IMPORT', 'menu_import' );
define ('SS_IMPORTSQUARE', 107<<8);
$SS = SS_IMPORTSQUARE;

class hooks_ksf_import_square extends hooks {
    //var $module_name; 			//Trying to set in constructor - Cannot call constructor in...
    //var $module_name = basename( __DIR__ ); 	//Invalid operation for CONST
    var $module_name = 'ksf_import_square'; 

/**
* Cannot call constructor in .../hooks.php
*	function __construct()
*	{
*    		$this->module_name = basename( __DIR__ ); 
*		parent::__construct();
*	}
*/

    /*
    * Install additonal menu options provided by module
    */

    	function install_options($app) 
	{
		global $path_to_root;


		switch($app->id) 
		{
			case 'GL':
			case 'orders':
				$app->add_lapp_function(3, _('Square Import'),
					$path_to_root . "/modules/" . $this->module_name . "/" . $this->module_name . ".php", 'SA_' . $this->module_name );
				//$app->add_rapp_function(3, _("Manage Partners Bank Accounts"),
				//	$path_to_root."/modules/" . $this->module_name . "/manage_partners_data.php", 'SA_CUSTOMER', MENU_IMPORT);
				$app->add_rapp_function(3, _("Import Square Transactions"),
					$path_to_root."/modules/" . $this->module_name . "/import_statements.php", 'SA_BANKACCOUNT', MENU_MAINTENANCE);
				$app->add_rapp_function(3, _("Process Square Transactions"),
					$path_to_root."/modules/" . $this->module_name . "/process_statements.php", 'SA_BANKACCOUNT', MENU_IMPORT);
				//$app->add_rapp_function(3, _("Bank Statements Inquiry"),
				//	$path_to_root."/modules/" . $this->module_name . "/view_statements.php", 'SA_BANKACCOUNT', MENU_INQUIRY);
				break;
			case 'system';
				$app->add_lapp_function(3, _("Import Square Setup"),
					$path_to_root."/modules/" . $this->module_name . "/" . $this->module_name . "_setup.php", 'SA_' . $this->module_name, MENU_MAINTENANCE);
				break;
		}
    	}

    	function activate_extension($company, $check_only=true) 
	{
		//$updates = array( 'update.sql' => array($this->module_name) );
		//return $this->update_databases($company, $updates, $check_only);
    	}
	/**//****************************************************************************
	* Create security access configs for the module
	*
	* 	https://frontaccounting.com/fawiki/index.php?n=Devel.AccessControl
	*
	* @param none
	* @returns array
	********************************************************************************/
        function install_access()
        {
		global $SS;
                $security_sections[$SS] = _("Import Square");
                $security_areas['SA_'. $this->module_name] = array( $SS|1, _("Import Square"));
                //$security_areas['SA_'. $this->module_name'] = array( $SS|101, _("Generate Catalogue"));

                return array($security_areas, $security_sections);
        }
 

    	//this is required to cancel bank transactions when a voiding operation occurs
    	function db_prevoid($trans_type, $trans_no) 
	{
	    //SET status=0
/*
	$sql = "
	    UPDATE ".TB_PREF."bi_transactions
	    SET status=0, fa_trans_no=0, fa_trans_type=0
	    WHERE
		fa_trans_no=".db_escape($trans_no)." AND
		fa_trans_type=".db_escape($trans_type)." AND
		status = 1";
	display_notification($sql);
	db_query($sql, 'Could not void transaction');
*/

    	}
}
?>
