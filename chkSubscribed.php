<?php
if (isset($_REQUEST['emailid']) && $_REQUEST['emailid'] != '') {
    include('../../../wp-config.php');
	global $wpdb;
    $user_email = $_REQUEST['emailid'];
	$emailExists = $wpdb->get_results("SELECT * FROM newsletter WHERE useremail='" . $user_email . "'");
	$subscribedAlready = count($emailExists);

	if ($subscribedAlready == 0) {
		$insert = $wpdb->insert('newsletter', array('useremail' => $user_email));
		if ($insert) {
			echo "1";
		}
	}  else {
		echo "0";
	}
}
?>