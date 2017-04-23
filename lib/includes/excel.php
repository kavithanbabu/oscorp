<?php

error_reporting(E_ALL ^ E_DEPRECATED);
include('../../../../../wp-config.php');
$action = $_REQUEST['action'];
$condition = $_REQUEST['condition'];
global $wpdb;

if ($action == 'contact_entry') {
	if($condition){
		$decoded = base64_decode($condition);
		$query = "SELECT username, phone, email, address AS message, createddt FROM contactus $decoded ORDER BY createddt DESC";
	}else{
		$query = "SELECT username, phone, email, address AS message, createddt FROM contactus ORDER BY createddt DESC";
	}
} elseif ($action == 'availability_entry') {
    if($condition){
		$decoded = base64_decode($condition);
		$query = "SELECT username, budget, email, message, createddt FROM enquiry $decoded ORDER BY createddt DESC";
	}else{
		$query = "SELECT username, budget, email, message, createddt FROM enquiry ORDER BY createddt DESC";
	}
}

$results = $wpdb->get_results($query, 'ARRAY_A');
foreach ($results as $result_key => $result) {
    foreach ($result as $result_data_key => $result_data) {
        $newstring = preg_replace("/[\n\r]/","",$result_data); 
        
        if (empty($newstring)) {
            $result_data_new[$result_key][$result_data_key] = '----';
        } else {
            $result_data_new[$result_key][$result_data_key] = $newstring;
        }
    }
}

foreach ($result_data_new as $result_new) {
    $aData[] = $result_new;
}

//feed the final array to our formatting function...
$contents = getExcelData($aData);

if ($action == 'contact_entry') {
    $filename = "Contact_Enquiry" . date('d/m/Y') . ".xls";
} elseif ($action == 'availability_entry') {
    $filename = "Availability_Enquiry" . date('d/m/Y') . ".xls";
}

//prepare to give the user a Save/Open dialog...
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $filename);

//setting the cache expiration to 30 seconds ahead of current time. an IE 8 issue when opening the data directly in the browser without first saving it to a file
$expiredate = time() + 30;
$expireheader = "Expires: " . gmdate("D, d M Y G:i:s", $expiredate) . " GMT";
header($expireheader);

//output the contents
echo $contents;
exit;
?>

<?php

function getExcelData($data) {
    $retval = "";
    if (is_array($data) && !empty($data)) {
        $row = 0;
        foreach (array_values($data) as $_data) {
            if (is_array($_data) && !empty($_data)) {
                if ($row == 0) {
                    // write the column headers
                    $retval = implode("\t", array_keys($_data));
                    $retval .= "\n\n";
                }
                //create a line of values for this row...
                $retval .= implode("\t", array_values($_data));
                $retval .= "\n";
                //increment the row so we don't create headers all over again
                $row++;
            }
        }
    }
    return $retval;
}
?>