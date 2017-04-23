<?php
add_action('admin_menu', 'campaignmenu');

function campaignmenu() {
    add_menu_page('Contact Entries', 'Contact Entries', 'add_users', 'capmaign.php', 'campaginentries');
    add_submenu_page('capmaign.php', 'Newsletter ', 'Newsletter', 'add_users', 'availability_entries', 'availability_entries');
    add_submenu_page('capmaign.php', 'Contact Us ', 'Contact Us', 'add_users', 'contact_entries', 'contact_entries');
}

function campaginentries() {
    global $wpdb;
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
		<h2>Contact Enquiries</h2></div>';
	if($_REQUEST['fromdate'] && $_REQUEST['todate']){
		$fromdate = date('Y-m-d 00:00:00', strtotime($_REQUEST['fromdate']));
		$todate = date('Y-m-d 23:59:59', strtotime($_REQUEST['todate']));
		$condition = " where (createddt >= '$fromdate' AND createddt <= '$todate') ";
	}else{
		$condition = "";
	}
    $sql = "SELECT * FROM homecontact ".$condition." ORDER BY createddt DESC";
	?>
	<div style="100%">
	<br />
	<br />
		<div style="50%">
			<form name="campaginentries" id="campaginentries" action="" method="POST">
				From Date: <input type="text" name="fromdate" id="fromdate" value="<?php echo $_REQUEST['fromdate'] ?>"/> &nbsp;&nbsp;&nbsp;
				To Date: <input type="text" name="todate" id="todate" value="<?php echo $_REQUEST['todate'] ?>"/>&nbsp;&nbsp;
				<input type="submit" value="Filter" />
			</form>
		</div>
	</div>
	<br />
	<br />
    <table cellspacing="0" class="wp-list-table widefat fixed pages" id="example">
        <thead>
            <tr>
                <th class="manage-column sortable" id="id" scope="col"><span>S.No</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Name</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Email</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Message</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Date</span><span class="sorting-indicator"></span></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="manage-column sortable" id="id" scope="col"><span>S.No</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Name</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Email</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Message</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Date</span><span class="sorting-indicator"></span></th>
            </tr>
        </tfoot>

        <tbody id="the-list">
            <?php
			$rows = $wpdb->get_results($sql);
            if ($_REQUEST['num'] > 1) {
                $i = 1 + (($_REQUEST['num'] - 1) * 30);
            } else {
                $i = 1;
            }
            $pagination = new pagination();
            $paged_rows = $pagination->generate($rows, 30);
            foreach ($paged_rows as $row) {
                ?>    
                <tr valign="top" class="alternate">        
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->username; ?></td>
                    <td><?php echo $row->useremail; ?></td>
                    <td><?php echo $row->queries; ?></td>
                    <td><?php echo $row->createddt; ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
	<style>
	.manage-column{
		height: 40px;
		padding-left: 10px !important;
	}
	</style>
    <?php
    echo '<ul class="pagination">';
    echo $pagination->links();
    echo '</ul>';
}
function availability_entries() {
    global $wpdb;
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
		<h2>Newsletter Subscribers</h2></div>';
		
	if(isset($_REQUEST['fromdate']) && isset($_REQUEST['todate'])){
		$fromdate = date('Y-m-d 00:00:00', strtotime($_REQUEST['fromdate']));
		$todate = date('Y-m-d 23:59:59', strtotime($_REQUEST['todate']));
		$condition = " where (createddt >= '$fromdate' AND createddt <= '$todate') ";
	}else{
		$condition = "";
	}
    $sql = "SELECT * FROM newsletter ".$condition."  ORDER BY createddt DESC";
    ?>
	<div style="100%">
	<br />
	<br />
		<div style="50%">
			<form name="campaginentries" id="campaginentries" action="" method="POST">
				From Date: <input type="text" name="fromdate" id="fromdate" value="<?php echo $_REQUEST['fromdate'] ?>"/> &nbsp;&nbsp;&nbsp;
				To Date: <input type="text" name="todate" id="todate" value="<?php echo $_REQUEST['todate'] ?>"/>&nbsp;&nbsp;
				<input type="submit" value="Filter" />
			</form>
		</div>
	</div>
	<br />
	<br />
    <table cellspacing="0" class="wp-list-table widefat fixed pages" id="example">
        <thead>
            <tr>
                <th class="manage-column sortable" id="id" scope="col"><span>S.No</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Email</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Date</span><span class="sorting-indicator"></span></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="manage-column sortable" id="id" scope="col"><span>S.No</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Email</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" id="date" scope="col"><span>Date</span><span class="sorting-indicator"></span></th>
            </tr>
        </tfoot>

        <tbody id="the-list">
            <?php
            $rows = $wpdb->get_results($sql);
            if ($_REQUEST['num'] > 1) {
                $i = 1 + (($_REQUEST['num'] - 1) * 30);
            } else {
                $i = 1;
            }
            $pagination = new pagination();
            $paged_rows = $pagination->generate($rows, 30);
            foreach ($paged_rows as $row) {
                ?>    
                <tr valign="top" class="alternate">      
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->useremail; ?></td>
                    <td><?php echo $row->createddt; ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
	<style>
	.manage-column{
		height: 40px;
		padding-left: 10px !important;
	}
	</style>
    <?php
    echo '<ul class="pagination">';
    echo $pagination->links();
    echo '</ul>';
}
function contact_entries() {
    global $wpdb;
    echo '<div class="wrap"><div id="icon-options-general" class="icon32"><br></div>
		<h2>Contact Enquiries</h2></div>';
		
	if(isset($_REQUEST['fromdate']) && isset($_REQUEST['todate'])){
		$fromdate = date('Y-m-d 00:00:00', strtotime($_REQUEST['fromdate']));
		$todate = date('Y-m-d 23:59:59', strtotime($_REQUEST['todate']));
		$condition = " where (createddt >= '$fromdate' AND createddt <= '$todate') ";
	}else{
		$condition = "";
	}
    $sql = "SELECT * FROM contactme ".$condition."  ORDER BY createddt DESC";
    ?>
	<div style="100%">
	<br />
	<br />
		<div style="50%">
			<form name="campaginentries" id="campaginentries" action="" method="POST">
				From Date: <input type="text" name="fromdate" id="fromdate" value="<?php echo $_REQUEST['fromdate'] ?>"/> &nbsp;&nbsp;&nbsp;
				To Date: <input type="text" name="todate" id="todate" value="<?php echo $_REQUEST['todate'] ?>"/>&nbsp;&nbsp;
				<input type="submit" value="Filter" />
			</form>
		</div>
	</div>
	<br />
	<br />
    <table cellspacing="0" class="wp-list-table widefat fixed pages" id="example">
        <thead>
            <tr>
                <th class="manage-column sortable" scope="col"><span>S.No</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Name</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Email</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Phone</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Subject</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Message</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Date</span><span class="sorting-indicator"></span></th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th class="manage-column sortable" scope="col"><span>S.No</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Name</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Email</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Phone</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Subject</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Message</span><span class="sorting-indicator"></span></th>
                <th class="manage-column sortable" scope="col"><span>Date</span><span class="sorting-indicator"></span></th>
            </tr>
        </tfoot>

        <tbody id="the-list">
            <?php
            $rows = $wpdb->get_results($sql);
            if ($_REQUEST['num'] > 1) {
                $i = 1 + (($_REQUEST['num'] - 1) * 30);
            } else {
                $i = 1;
            }
            $pagination = new pagination();
            $paged_rows = $pagination->generate($rows, 30);
            foreach ($paged_rows as $row) {
                ?>    
                <tr valign="top" class="alternate">      
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row->username; ?></td>
                    <td><?php echo $row->useremail; ?></td>
                    <td><?php echo $row->phone; ?></td>
                    <td><?php echo $row->subject; ?></td>
                    <td><?php echo $row->queries; ?></td>
                    <td><?php echo $row->createddt; ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
	<style>
	.manage-column{
		height: 40px;
		padding-left: 10px !important;
	}
	</style>
    <?php
    echo '<ul class="pagination">';
    echo $pagination->links();
    echo '</ul>';
}
?>