<?php

/**
 * Template Name: CDA Request Submission
 * Version: 0.1
 * Description: A PDF template for a team disbursement submission
 * Author: Andre Nell
 * Group: haloELITE
 * License: GPLv2
 * Required PDF Version: 4.0-beta
 */

/* Prevent direct access to the template (always good to include this) */
if ( ! class_exists( 'GFForms' ) ) {
    return;
}

/**
 * Include your PHP variables in this section
 */
// if the plugin to pull user names is active
$isUserFetch = class_exists('GfTexasRealtorUsers', false);
// remove the filter that returns names on fronted
remove_all_filters('gform_get_input_value_27_9', 11);

 /* Transaction Variables */
 $transaction_type = $form_data['field'][2];
 $gift_assigned_to = $form_data['field'][18];
 if (ctype_digit($gift_assigned_to) && $isUserFetch && false !== ($name = GfTexasRealtorUsers::getUserName($gift_assigned_to))) {
     $gift_assigned_to = $name;
 }
 $transaction_address = $form_data['field'][69];
 $closing_date = $form_data['field'][71];

/* Financial variables */
$sales_price = $form_data['field'][6];
$commission_percentage = $form_data['field'][7];
$gross_commission = $form_data['field'][8];
$stf = $form_data['field'][13];
$ltf = $form_data['field'][15];
$ctf = $form_data['field'][72];
$tf = $stf + $ltf + $ctf;
$net_comm_before_shared_deductions = $gross_commission - ($stf + $ltf + $ctf);
$gift_amount = ($gross_commission - $tf) * (1/100);
$other_shared_deductions = $form_data['field'][20];
$shared_deductions = $gift_amount + $other_shared_deductions;
$nctd = $gross_commission - ($tf + $shared_deductions);
$commission_care = $nctd * (20/100);
$commission_create = $nctd * (20/100);
$commission_convert = $nctd * (5/100);
$commission_commit = $nctd * (5/100);
$commission_captivate = $nctd * (25/100);
$commission_captivate_cma = $nctd * (2.5/100);
$commission_captivate_closing = $nctd * (2.5/100);
$commission_captivate_apts = $nctd * (2.5/100);
$commission_captivate_door_open = $nctd * (2.5/100);
$commission_captivate_show_qualify = $nctd * (15/100);
$commission_captivate_signage = $nctd * (2.5/100);
$commission_captivate_measure = $nctd * (2.5/100);
$commission_captivate_collect = $nctd * (2.5/100);
$commission_captivate_mls = $nctd * (2.5/100);
$commission_captivate_budget = $nctd * (5/100);
$commission_captivate_manage = $nctd * (5/100);
$commission_close = $nctd * (15/100);
$commission_compliance = $nctd * (5/100);
$commission_coordinate = $nctd * (5/100); 
$sponsor_sub_total = 0;
$sponsor_total = 0;



/* Participants for each stage */ 

/* Participants List*/
$participants_list = $form_data['list'][9];
sort($participants_list);
$number_participants = count($participants_list); 
extract($participants_list, EXTR_PREFIX_ALL, "list");

/* Sponsors List */
// if these are userIDs convert to names
if (ctype_digit($participants_list[0])) { // these are likely user IDs
    // save the ids for future use in sponsor calcs
    $participants_list_ids = $participants_list;
    // map the names for the participant output
    $participants_list = array_map(function($item) {
        if (ctype_digit($item) && false !== ($user = get_user_by('ID', (int) $item))) {
            return $user->display_name;
        }
        return $item;
    }, $participants_list);
}
else {
    $participants_list_ids = false;
}

// get the sponsors
if (empty($participants_list_ids)) {
    $sponsors = array_fill(0, $number_participants, ['Participant Sponsor']);
}
else {
    $sponsors = [];
    foreach($participants_list_ids as $userId) {
        $sponsors[] = GfTexasRealtorUsers::getSponsorNames($userId);
    }
}

// these fields are user IDs 18,24,27,30,33,34,35,36,37,38,39,40,41,42,43,46,49,52

/* Create */
$participants_create = GfTexasRealtorUsers::getFormDataNames($form_data['field'][24]);
$number_create = count($participants_create);
$create_per_participant = $commission_create / $number_create;
extract($participants_create, EXTR_PREFIX_ALL, "list_create");

/* Convert */
$participants_convert = GfTexasRealtorUsers::getFormDataNames($form_data['field'][27]);
$number_convert = count($participants_convert);
$convert_per_participant = $commission_convert / $number_convert;
extract($participants_convert, EXTR_PREFIX_ALL, "list_convert");

/* Commit */
$participants_commit = GfTexasRealtorUsers::getFormDataNames($form_data['field'][30]);
$number_commit = count($participants_commit);
$commit_per_participant = $commission_commit / $number_commit;
extract($participants_commit, EXTR_PREFIX_ALL, "list_commit");

/* Captivate - CMA */
$participants_captivate_cma = GfTexasRealtorUsers::getFormDataNames($form_data['field'][33]);
$number_captivate_cma = count($participants_captivate_cma);
$captivate_cma_per_participant = $commission_captivate_cma / $number_captivate_cma;
extract($participants_captivate_cma, EXTR_PREFIX_ALL, "list_captivate_cma");

/* Captivate Captivate Closing */
$participants_captivate_closing = GfTexasRealtorUsers::getFormDataNames($form_data['field'][34]);
$number_captivate_closing = count($participants_captivate_closing);
$captivate_closing_per_participant = $commission_captivate_closing / $number_captivate_closing;
extract($participants_captivate_closing, EXTR_PREFIX_ALL, "list_captivate_closing");

/* Captivate Appointments */
$participants_captivate_set_apts = GfTexasRealtorUsers::getFormDataNames($form_data['field'][35]);
$number_captivate_set_apts = count($participants_captivate_set_apts);
$captivate_set_apts_per_participant = $commission_captivate_apts / $number_captivate_set_apts;
extract($participants_captivate_set_apts, EXTR_PREFIX_ALL, "list_captivate_set_apts");

/* Captivate Door Opener */
$participants_captivate_door_open = GfTexasRealtorUsers::getFormDataNames($form_data['field'][36]);
$number_captivate_door_open = count($participants_captivate_door_open);
$captivate_door_open_per_participant = $commission_captivate_door_open / $number_captivate_door_open;
extract($participants_captivate_door_open, EXTR_PREFIX_ALL, "list_captivate_door_open");

/* Captivate Showing 37 */
$participants_captivate_show_qualify = GfTexasRealtorUsers::getFormDataNames($form_data['field'][37]);
$number_captivate_show_qualify = count($participants_captivate_show_qualify);
$captivate_show_qualify_per_participant = $commission_captivate_show_qualify / $number_captivate_show_qualify;
extract($participants_captivate_show_qualify, EXTR_PREFIX_ALL, "list_captivate_show_qualify");

/* Captivate Signage 38 */
$participants_captivate_signage = GfTexasRealtorUsers::getFormDataNames($form_data['field'][38]);
$number_captivate_signage = count($participants_captivate_signage);
$captivate_signage_per_participant = $commission_captivate_signage / $number_captivate_signage;
extract($participants_captivate_signage, EXTR_PREFIX_ALL, "list_captivate_signage");

/* Captivate Measure 39 */
$participants_captivate_measure = GfTexasRealtorUsers::getFormDataNames($form_data['field'][39]);
$number_captivate_measure = count($participants_captivate_measure);
$captivate_measure_per_participant = $commission_captivate_measure / $number_captivate_measure;
extract($participants_captivate_measure, EXTR_PREFIX_ALL, "list_captivate_measure");

/* Captivate Collect Data 40 */
$participants_captivate_collect = GfTexasRealtorUsers::getFormDataNames($form_data['field'][40]);
$number_captivate_collect = count($participants_captivate_collect);
$captivate_collect_per_participant = $commission_captivate_collect / $number_captivate_collect;
extract($participants_captivate_collect, EXTR_PREFIX_ALL, "list_captivate_collect");

/* Captivate MLS 41 */
$participants_captivate_mls = GfTexasRealtorUsers::getFormDataNames($form_data['field'][41]);
$number_captivate_mls = count($participants_captivate_mls);
$captivate_mls_per_participant = $commission_captivate_mls / $number_captivate_mls;
extract($participants_captivate_mls, EXTR_PREFIX_ALL, "list_captivate_mls");

/* Captivate Marketing Budget 42 */
$participants_captivate_marketing = GfTexasRealtorUsers::getFormDataNames($form_data['field'][42]);
$number_captivate_marketing = count($participants_captivate_marketing);
$captivate_marketing_per_participant = $commission_captivate_budget / $number_captivate_marketing;
extract($participants_captivate_marketing, EXTR_PREFIX_ALL, "list_captivate_marketing");

/* Captivate Management 43 */
$participants_captivate_management = GfTexasRealtorUsers::getFormDataNames($form_data['field'][43]);
$number_captivate_management = count($participants_captivate_management);
$captivate_management_per_participant = $commission_captivate_manage / $number_captivate_management;
extract($participants_captivate_management, EXTR_PREFIX_ALL, "list_captivate_management");

/* Close */
$participants_close = GfTexasRealtorUsers::getFormDataNames($form_data['field'][46]);
$number_close = count($participants_close);
$close_per_participant = $commission_close / $number_close;
extract($participants_close, EXTR_PREFIX_ALL, "list_close");

/* Compliance */
$participants_compliance = GfTexasRealtorUsers::getFormDataNames($form_data['field'][49]);
$number_compliance = count($participants_compliance);
$compliance_per_participant = $commission_compliance / $number_compliance;
extract($participants_compliance, EXTR_PREFIX_ALL, "list_compliance");

/* Coordinate */
$participants_coordinate = GfTexasRealtorUsers::getFormDataNames($form_data['field'][52]);
$number_coordinate = count($participants_coordinate);
$coordinate_per_participant = $commission_coordinate / $number_coordinate;
extract($participants_coordinate, EXTR_PREFIX_ALL, "list_coordinate");

?>

<!-- Any PDF CSS styles can be placed in the style tag below -->
<style>
    .participant {
        width: 350px;
        float:left;
        font-size: 10px;
    }

    .currencySymbol {
    width: 30px;
    float:left;
    text-align: left;
    font-size: 10px;
    }

    .amount {
    width: 80px;
    float:left;
    text-align: right;
    font-size: 10px;
    }

    #logo {
        float: right;
        width: 150px;        
    }
    
    h1 {
    	font-size: 18px;
    }
    
    h2 {
    	font-size: 14px;
padding:0;
margin:0;
    }

    h3 {
    	font-size: 12px;
    }
	
	.captivate_heading {
		color: #666666;
	}
	
	.final_submission {
		color: #ffffff;
		background-color: #333;
		padding: 5px;
		width: 100%;
		margin-top: 40px;
	}
    
    p {
    	font-size: 10px;
    }

    
</style>


<!-- HTML Starts Here -->


<div id="logo"><img src="http://haloelite.com/wp-content/uploads/2018/01/HER_200x51_red_emblem_black.png" /></div>

<h1>CDA Request Submission</h1><br><hr>

<h2>Transaction Overview</h2>
<p><b>Deal Owner:</b> <?php echo $form_data['field'][1]['first']; ?> <?php echo $form_data['field'][1]['last']; ?><br>
<b>Submission Date:</b> &nbsp; &nbsp;<?php echo $form_data['date_created_usa']; ?><br> 
<b>Transaction Type:</b> <?php echo $transaction_type; ?><br>
<b>Client Name/s:</b> <?php echo $form_data['field'][3]; /*Clients Name */?><br >
<b>Transaction Address:</b> <br>
<?php echo $transaction_address; ?><br>
<b>Closing Date:</b><?php echo $closing_date; ?><br>
<b>Sales Price:</b> $ <?php echo number_format($sales_price, 2); ?><br>
<b>Commission Percentage:</b> <?php echo $commission_percentage; ?> %<br>
<b>Gross Commission:</b> $ <?php echo number_format($gross_commission,2); ?>
<hr> 
<h2>Brokerage Fees</h2>
<p><b>Transaction Fee:</b> 
$ <?php     echo number_format($tf,2); ?>
<hr>
<h2>Shared Deductions</h2>
<p><b>Net Commission before shared deductions:</b> $ <?php echo number_format($net_comm_before_shared_deductions,2); ?></p>
<h3>Less </h3>
<p><b>Gift:</b> $ <?php echo number_format($gift_amount,2); ?><br>
Assigned to purchase gift: <?php echo $gift_assigned_to?> (The amount aportioned for the gift will be included in CDA total for <?php echo $gift_assigned_to?>) <br><br>
<b>Other:</b> $ <?php echo number_format($other_shared_deductions,2); ?><br>
Details of Other shared deductions:</b> <?php echo $form_data['field']['21.Other Shared Deductions Description']; ?></p>

<p><b>Total Shared Deductions:</b> $ <?php echo number_format($shared_deductions,2); ?></p>
<hr><br>
<h3>Net Income for Distribution</h3>
<p>Net Commission after Transaction Fee and before Shared Deductions: $ <?php echo number_format($net_comm_before_shared_deductions,2); ?><br>
&nbsp; - Less: Total Shared Deductions: $ <?php echo number_format($shared_deductions,2); ?><br ><br>
<b>Net Income for Distribution (NID): $<?php echo number_format($nctd,2); ?></b></p>
<hr>

<pagebreak>

<h2>Assignments of Commissions</h2>

<!-- Care -->
<h3>Care</h3>
<p>20% of NID:<br>
HaloELITE: $ <?php echo number_format($commission_care, 2); ?></p>
<hr>

<!-- Create -->
<h2>Create</h2>
<p>20% of NID:<br> 
Total Commission for Create: $ <?php echo number_format($commission_create,2); ?><br>
Participant/s: <br >
<?php if ( is_array( $participants_create) ) {

    foreach ( $participants_create as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($create_per_participant,2) . '</div><br>';
    }

}

?>
<hr>

<!-- Convert -->
<h3>Convert</h3>
<p>5% of NID<br>
Total Commission for Convert: $ <?php echo number_format($commission_convert,2); ?></p>
<p>Participant/s: <br >
<?php if ( is_array( $participants_convert) ) {

    foreach ( $participants_convert as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($convert_per_participant,2) . '</div><br>';
    }

}

?>
<hr>

<!-- Commit -->
<h3>Commit</h3>
<p>5% of NID<br>
Total Commission for Commit: $ <?php echo number_format($commission_commit,2); ?></p>
<p>Participant/s: <br >
<?php if ( is_array( $participants_commit) ) {

    foreach ( $participants_commit as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($commit_per_participant,2) . '</div><br>';
    }

}

?>
<hr>
<!-- Captivate -->
<h3>Captivate</h3>
<p>25% of NID<br>
Total Commission for Captivate: $ <?php echo number_format($commission_captivate,2); ?></p>
<hr>

<!-- CMA -->
<p class="captivate_heading">Captivate - Create CMA's</p>
<p>2.5% of NID<br>
Total Commission for Captivate - Create CMA's: $ <?php echo number_format($commission_captivate_cma,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_captivate_cma) ) {

    foreach ( $participants_captivate_cma as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_cma_per_participant,2) . '</div><br>';
    }

}
?>
<hr>

<!-- Attend Closing -->
<p class="captivate_heading">Captivate - Attend Closing</p>
<p>2.5% of NID<br>
Total Commission for Captivate - Attend Closing: $ <?php echo number_format($commission_captivate_closing,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_captivate_closing) ) {

    foreach ( $participants_captivate_closing as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_closing_per_participant,2) . '</div><br>';
    }

}
?>
<hr>

<!-- Captivate Buyer Specific Items -->

<!-- -Set Appointments -->
<?php 
    if ($transaction_type == "Buyer" || $transaction_type == "Renter") {
            echo '<p class="captivate_heading">Captivate - Set Up Appointments</p><p>2.5% of NID<br>
            Total Commission for Captivate - Set Up Appointments: $ ' . number_format($commission_captivate_apts,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_set_apts) ) {

    foreach ( $participants_captivate_set_apts as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_set_apts_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Door Opener -->
<?php 
    if ($transaction_type == "Buyer" || $transaction_type == "Renter") {
            echo '<p class="captivate_heading">Captivate - Open Doors</p><p>2.5% of NID<br>
            Amount: $ ' . number_format($commission_captivate_door_open,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_door_open) ) {

    foreach ( $participants_captivate_door_open as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_door_open_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- Qualifying -->
<?php 
    if ($transaction_type == "Buyer" || $transaction_type == "Renter") {
            echo '<p class="captivate_heading">Captivate - Show Homes</p><p>15% of NID<br>
            Amount: $ ' . number_format($commission_captivate_show_qualify,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_show_qualify) ) {

    foreach ( $participants_captivate_show_qualify as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_show_qualify_per_participant,2) .
         '</div><br>';
    }
}
?>

<!-- -Signs and Lockbox -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<p class="captivate_heading">Captivate - Manage Signs and Lockbox</p><p>2.5% of NID<br>
            Amount: $ ' . number_format($commission_captivate_signage,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_signage) ) {

    foreach ( $participants_captivate_signage as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_signage_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Measure -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<p class="captivate_heading">Captivate - Physically Measure the Property</p><p>2.5% of NID<br>
            Amount: $ ' . number_format($commission_captivate_measure,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_measure) ) {

    foreach ( $participants_captivate_measure as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_measure_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Collect Data from sources for MLS Listing -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<p class="captivate_heading">Captivate - Collect Data From Sources for MLS Listing</p><p>2.5% of NID<br>
            Amount: $ ' . number_format($commission_captivate_collect,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_collect) ) {

    foreach ( $participants_captivate_collect as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_collect_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';    
}
?>

<!-- -Input To MLS -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<p class="captivate_heading">Captivate - Input Listing on MLS</p><p>2.5% of NID<br>
            Amount: $ ' . number_format($commission_captivate_mls,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_mls) ) {

    foreach ( $participants_captivate_mls as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_mls_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Marketing Budget -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<p class="captivate_heading">Captivate - Budget for Marketing Listing</p><p>5% of NID<br>
            <p>Amount: $ ' . number_format($commission_captivate_budget,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_marketing) ) {

    foreach ( $participants_captivate_marketing as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_marketing_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Manage -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<p class="captivate_heading">Captivate Manage Marketing the listing including Open Houses</p><p>5% of NID<br>
            Amount: $ ' . number_format($commission_captivate_manage,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_management) ) {

    foreach ( $participants_captivate_management as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($captivate_management_per_participant,2) .
         '</div><br>';
    }
}
?>
<hr>
<!-- Close -->
<h3>Close</h3>
<p>15% of NID<br>
Amount: $ <?php echo number_format($commission_close,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_close) ) {

    foreach ( $participants_close as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($close_per_participant,2) . '</div><br>';
    }

}

?>

<hr>

<!-- Compliance -->
<h3>Compliance</h3>
<p>5% of NID<br>
Amount: $ <?php echo number_format($commission_compliance,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_compliance) ) {

    foreach ( $participants_compliance as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($compliance_per_participant,2) . '</div><br>';
    }

}

?>
<hr>

<!-- Coordinate -->
<h3>Coordinate</h3>
<p>5% of NID<br>
Amount: $ <?php echo number_format($commission_coordinate,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_coordinate) ) {

    foreach ( $participants_coordinate as $participant ) {
        echo '<div class="participant"> - ' . $participant . '</div><div class="amount"> $ ' . number_format($coordinate_per_participant,2) . '</div><br>';
    }

}

?>
<hr>
<pagebreak>


<?php     
/*
 * Declare arrays used for summary
 */

$sub_total_create = array();
$sub_total_convert = array();
$sub_total_commit = array();

$sub_total_cap_cma = array();
$sub_total_cap_closing = array();
$sub_total_cap_apts = array();
$sub_total_cap_door_open = array();
$sub_total_cap_show_qualify = array();
$sub_total_cap_signage = array();
$sub_total_cap_measure = array();
$sub_total_cap_collect = array();
$sub_total_cap_collect = array();
$sub_total_cap_mls = array();
$sub_total_cap_budget = array();
$sub_total_cap_manage = array();

$sub_total_close = array();
$sub_total_compliance = array();
$sub_total_coordinate = array();

$total_create = array();

$total_per_user = [];

/*
 * This sections reduces the values for each participant to a single value per participant
 */

/* CREATE SECTION */
// Obtain a list of sub_totals for CREATE 
    for ($i = 0; $i < $number_participants; $i++) { 

        ${'list_create_subtotals_'.$i} = 0;
        for ($create_i = 0; $create_i < $number_create; $create_i++) {
            if ($participants_list[$i] == ${'list_create_'.$create_i}) {
                ${'list_create_subtotals_'.$i} += $create_per_participant;
                $sub_total_create[] = ${'list_create_subtotals_'.$i};
                } else {
                    $sub_total_create[] = 0;
                }
            }           
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_create = count($sub_total_create);
    $factor = $number_subtotal_create / $number_participants;

    // CREATE Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_create);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_Create Array
        $total_create[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }
    
/* CONVERT SECTION */
// Obtain a list of sub_totals for CONVERT 
    for ($i = 0; $i < $number_participants; $i++) { 

        ${'list_convert_subtotals_'.$i} = 0;
        for ($convert_i = 0; $convert_i < $number_convert; $convert_i++) {
            if ($participants_list[$i] == ${'list_convert_'.$convert_i}) {
                ${'list_convert_subtotals_'.$i} += $convert_per_participant;
                $sub_total_convert[] = ${'list_convert_subtotals_'.$i};
                } else {
                    $sub_total_convert[] = 0;
                }
            }           
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_convert = count($sub_total_convert);
    $factor = $number_subtotal_convert / $number_participants;

    // CONVERT Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_convert);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_Convert Array
        $total_convert[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* COMMIT SECTION */
// Obtain a list of sub_totals for COMMIT 
    for ($i = 0; $i < $number_participants; $i++) { 

        ${'list_commit_subtotals_'.$i} = 0;
        for ($commit_i = 0; $commit_i < $number_commit; $commit_i++) {
            if ($participants_list[$i] == ${'list_commit_'.$commit_i}) {
                ${'list_commit_subtotals_'.$i} += $commit_per_participant;
                $sub_total_commit[] = ${'list_commit_subtotals_'.$i};
                } else {
                    $sub_total_commit[] = 0;
                }
            }           
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_commit = count($sub_total_commit);
    $factor = $number_subtotal_commit / $number_participants;

    // COMMIT Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_commit);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_Commit Array
        $total_commit[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE CMA SECTION */
// Obtain a list of sub_totals for CAPTIVATE CMA 
    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_cma_subtotals_'.$i} = 0; //$list_cap_cma_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_cma; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_cma_'.$j}) {
                ${'list_cap_cma_subtotals_'.$i} += $captivate_cma_per_participant;
                $sub_total_cap_cma[] = ${'list_cap_cma_subtotals_'.$i};                
                } else {
                    $sub_total_cap_cma[] = 0;
                }
            }           
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_cma = count($sub_total_cap_cma);
    $factor = $number_subtotal_cap_cma / $number_participants;

    // CAPTIVATE CMA Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_cma);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_Create Array
        $total_cap_cma[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE CLOSING SECTION */
// Obtain a list of sub_totals for CAPTIVATE CLOSING

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_closing_subtotals_'.$i} = 0; //$list_cap_closing_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_closing; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_closing_'.$j}) {
                ${'list_cap_closing_subtotals_'.$i} += $captivate_closing_per_participant;
                $sub_total_cap_closing[] = ${'list_cap_closing_subtotals_'.$i};                
                } else {
                    $sub_total_cap_closing[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_closing = count($sub_total_cap_closing);
    $factor = $number_subtotal_cap_closing / $number_participants;

    // CAPTIVATE CLOSING Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_closing);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_closing[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }


/* Captivate Buyer Specific Sub Sections */

/* CAPTIVATE APTS SECTION */
// Obtain a list of sub_totals for CAPTIVATE APTS

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_apts_subtotals_'.$i} = 0; //$list_cap_apts_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_set_apts; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_set_apts_'.$j}) {
                ${'list_cap_apts_subtotals_'.$i} += $captivate_set_apts_per_participant;
                $sub_total_cap_apts[] = ${'list_cap_apts_subtotals_'.$i};                
                } else {
                    $sub_total_cap_apts[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_apts = count($sub_total_cap_apts);
    $factor = $number_subtotal_cap_apts / $number_participants;

    // CAPTIVATE APTS Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_apts);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_apts[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE DOOR OPENER SECTION */
// Obtain a list of sub_totals for CAPTIVATE DOOR OPENER

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_door_opener_subtotals_'.$i} = 0; //$list_cap_door_opener_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_door_open; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_door_open_'.$j}) {
                ${'list_cap_door_opener_subtotals_'.$i} += $captivate_door_open_per_participant;
                $sub_total_cap_door_opener[] = ${'list_cap_door_opener_subtotals_'.$i};                
                } else {
                    $sub_total_cap_door_opener[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_door_opener = count($sub_total_cap_door_opener);
    $factor = $number_subtotal_cap_door_opener / $number_participants;

    // CAPTIVATE DOOR OPENER Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_door_opener);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_door_opener[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE SHOW QUALIFY SECTION */
// Obtain a list of sub_totals for CAPTIVATE SHOW QUALIFY

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_show_qualify_subtotals_'.$i} = 0; //$list_cap_show_qualify_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_show_qualify; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_show_qualify_'.$j}) {
                ${'list_cap_show_qualify_subtotals_'.$i} += $captivate_show_qualify_per_participant;
                $sub_total_cap_show_qualify[] = ${'list_cap_show_qualify_subtotals_'.$i};                
                } else {
                    $sub_total_cap_show_qualify[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_show_qualify = count($sub_total_cap_show_qualify);
    $factor = $number_subtotal_cap_show_qualify / $number_participants;

    // CAPTIVATE SHOW QUALIFY Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_show_qualify);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_show_qualify[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* Captivate Seller Specific Sub Sections */

/* CAPTIVATE SIGNAGE SECTION */
// Obtain a list of sub_totals for CAPTIVATE SIGNAGE

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_signage_subtotals_'.$i} = 0; //$list_cap_signage_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_signage; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_signage_'.$j}) {
                ${'list_cap_signage_subtotals_'.$i} += $captivate_signage_per_participant;
                $sub_total_cap_signage[] = ${'list_cap_signage_subtotals_'.$i};                
                } else {
                    $sub_total_cap_signage[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_signage = count($sub_total_cap_signage);
    $factor = $number_subtotal_cap_signage / $number_participants;

    // CAPTIVATE SIGNAGE Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_signage);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_signage[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }



/* CAPTIVATE MEASURE SECTION */
// Obtain a list of sub_totals for CAPTIVATE MEASURE

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_measure_subtotals_'.$i} = 0; //$list_cap_measure_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_measure; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_measure_'.$j}) {
                ${'list_cap_measure_subtotals_'.$i} += $captivate_measure_per_participant;
                $sub_total_cap_measure[] = ${'list_cap_measure_subtotals_'.$i};                
                } else {
                    $sub_total_cap_measure[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_measure = count($sub_total_cap_measure);
    $factor = $number_subtotal_cap_measure / $number_participants;

    // CAPTIVATE MEASURE Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_measure);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_measure[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE COLLECT SECTION */
// Obtain a list of sub_totals for CAPTIVATE COLLECT

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_collect_subtotals_'.$i} = 0; //$list_cap_collect_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_collect; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_collect_'.$j}) {
                ${'list_cap_collect_subtotals_'.$i} += $captivate_collect_per_participant;
                $sub_total_cap_collect[] = ${'list_cap_collect_subtotals_'.$i};                
                } else {
                    $sub_total_cap_collect[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_collect = count($sub_total_cap_collect);
    $factor = $number_subtotal_cap_collect / $number_participants;

    // CAPTIVATE COLLECT Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_collect);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_collect[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE MLS SECTION */
// Obtain a list of sub_totals for CAPTIVATE MLS

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_mls_subtotals_'.$i} = 0; //$list_cap_mls_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_mls; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_mls_'.$j}) {
                ${'list_cap_mls_subtotals_'.$i} += $captivate_mls_per_participant;
                $sub_total_cap_mls[] = ${'list_cap_mls_subtotals_'.$i};                
                } else {
                    $sub_total_cap_mls[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_mls = count($sub_total_cap_mls);
    $factor = $number_subtotal_cap_mls / $number_participants;

    // CAPTIVATE MLS Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_mls);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_mls[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE MARKETING SECTION */
// Obtain a list of sub_totals for CAPTIVATE MARKETING

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_marketing_subtotals_'.$i} = 0; //$list_cap_marketing_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_marketing; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_marketing_'.$j}) {
                ${'list_cap_marketing_subtotals_'.$i} += $captivate_marketing_per_participant;
                $sub_total_cap_marketing[] = ${'list_cap_marketing_subtotals_'.$i};                
                } else {
                    $sub_total_cap_marketing[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_marketing = count($sub_total_cap_marketing);
    $factor = $number_subtotal_cap_marketing / $number_participants;

    // CAPTIVATE MARKETING Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_marketing);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_marketing[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CAPTIVATE MANAGEMENT SECTION */
// Obtain a list of sub_totals for CAPTIVATE MANAGEMENT

    for ($i = 0; $i < $number_participants; $i++) { 
        ${'list_cap_management_subtotals_'.$i} = 0; //$list_cap_management_subtotals_# = 0
        for ($j = 0; $j < $number_captivate_management; $j++) {            
            if ($participants_list[$i] == ${'list_captivate_management_'.$j}) {
                ${'list_cap_management_subtotals_'.$i} += $captivate_management_per_participant;
                $sub_total_cap_management[] = ${'list_cap_management_subtotals_'.$i};                
                } else {
                    $sub_total_cap_management[] = 0;
                }
            }       
 
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_cap_management = count($sub_total_cap_management);
    $factor = $number_subtotal_cap_management / $number_participants;

    // CAPTIVATE MANAGEMENT Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_cap_management);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_ Array
        $total_cap_management[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* CLOSE SECTION */
// Obtain a list of sub_totals for CLOSE 
    for ($i = 0; $i < $number_participants; $i++) { 

        ${'list_close_subtotals_'.$i} = 0;
        for ($close_i = 0; $close_i < $number_close; $close_i++) {
            if ($participants_list[$i] == ${'list_close_'.$close_i}) {
                ${'list_close_subtotals_'.$i} += $close_per_participant;
                $sub_total_close[] = ${'list_close_subtotals_'.$i};
                } else {
                    $sub_total_close[] = 0;
                }
            }           
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_close = count($sub_total_close);
    $factor = $number_subtotal_close / $number_participants;

    // CLOSE Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_close);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_Create Array
        $total_close[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }    

/* COMPLIANCE SECTION */
// Obtain a list of sub_totals for COMPLIANCE 
    for ($i = 0; $i < $number_participants; $i++) { 

        ${'list_compliance_subtotals_'.$i} = 0;
        for ($compliance_i = 0; $compliance_i < $number_compliance; $compliance_i++) {
            if ($participants_list[$i] == ${'list_compliance_'.$compliance_i}) {
                ${'list_compliance_subtotals_'.$i} += $compliance_per_participant;
                $sub_total_compliance[] = ${'list_compliance_subtotals_'.$i};
                } else {
                    $sub_total_compliance[] = 0;
                }
            }           
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_compliance = count($sub_total_compliance);
    $factor = $number_subtotal_compliance / $number_participants;

    // COMPLIANCE Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_compliance);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_Create Array
        $total_compliance[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }

/* COORDINATE SECTION */
// Obtain a list of sub_totals for COORDINATE 
    for ($i = 0; $i < $number_participants; $i++) { 

        ${'list_coordinate_subtotals_'.$i} = 0;
        for ($coordinate_i = 0; $coordinate_i < $number_coordinate; $coordinate_i++) {
            if ($participants_list[$i] == ${'list_coordinate_'.$coordinate_i}) {
                ${'list_coordinate_subtotals_'.$i} += $coordinate_per_participant;
                $sub_total_coordinate[] = ${'list_coordinate_subtotals_'.$i};
                } else {
                    $sub_total_coordinate[] = 0;
                }
            }           
        }

    /*  Reduce double variables in Sub Totals Array to one element per participant */

    // Create temporary storage for values for transferring data to new array
    $temp = 0;
    $temp_final = 0;
    $number_subtotal_coordinate = count($sub_total_coordinate);
    $factor = $number_subtotal_coordinate / $number_participants;

    // COORDINATE Sub Totals
    for ($i = 0; $i < $number_participants; $i++){
        for ($j = 0; $j < $factor; $j++) {
            $temp = array_shift($sub_total_coordinate);
            $temp_final += $temp;
            
        }
        // Move combined value for participant into Total_Create Array
        $total_coordinate[$i] = $temp_final;

        //RESET COUNTERS
        $temp = 0;
        $temp_final = 0;
    }
/* 
 * YAY - we can finally add the totals for each section into one amount to display as the summary per participant.
 */

?>

<!-- SUMMARY -->
<h2>Detailed Summary</h2>
<p><div class="participant">Gross Commission:</div> <div class="currencySymbol">$ </div><div class="amount"><?php echo number_format($gross_commission,2); ?></div><br><hr>
<p><b>Sub Totals: </b><br><hr></p>
<div class="participant">Halo Group Realty Transaction Fee:</div> <div class="currencySymbol">$ </div><div class="amount"> 
<?php if ( $transaction_type == "Seller" || $transaction_type == "Buyer") {
            echo number_format($stf,2);
        } else {
            echo number_format($ltf,2);
        } 
?></div><br><hr>
<div class="participant">Gift: <?php echo $gift_assigned_to ;?> </div> <div class="currencySymbol">$ </div><div class="amount"><?php echo number_format($gift_amount, 2); ?></div><br><hr>
<?php
// array of totals for each participant and sponsor
    $grand_totals = [];

    //Display Combine Subtotals for each participant

    for ($i = 0; $i < $number_participants; $i++) { 

         
         ${'participant_'.$i} = $total_create[$i] + $total_convert[$i] + $total_commit[$i] + $total_cap_cma[$i] + $total_cap_closing[$i] + $total_cap_apts[$i] + $total_cap_door_opener[$i] + $total_cap_show_qualify[$i] + $total_cap_signage[$i] + $total_cap_measure[$i] + $total_cap_collect[$i] + $total_cap_mls[$i] + $total_cap_marketing[$i] + $total_cap_management[$i] + $total_close[$i] + $total_compliance[$i] + $total_coordinate[$i] ;

         echo '<div class="participant">' . $participants_list[$i] . '</div><div class="currencySymbol">$ </div><div class="amount"> ' 
         . number_format(${'participant_'.$i},2) .  '</div><br><hr><br> ';
         
         $sponsor_sub_total = ${'participant_'.$i} * .1;
         $round_sponsor_sub_total = round($sponsor_sub_total,2,PHP_ROUND_HALF_UP);
   
	echo ' <div class="participant"> - Sponsored by: ' . $sponsors[$i][0] . '</div><div class="currencySymbol">$ </div><div class="amount">' 
         . number_format($round_sponsor_sub_total,2) .  '</div><br><hr><br>';
         $sponsor_total += $round_sponsor_sub_total; 

        // if it's the gift participant add the gift after the total is displayed
         if ($gift_assigned_to === $participants_list[$i]) {
             //var_dump(${'participant_'.$i});
             ${'participant_'.$i} += $gift_amount;
             //var_dump($gift_amount, ${'participant_'.$i});
         }
         // accumulate the totals
        if (isset($grand_totals[$participants_list[$i]])) {
            $grand_totals[$participants_list[$i]] += ${'participant_'.$i};
        }
        else { // initialize the totals
            $grand_totals[$participants_list[$i]] = ${'participant_'.$i};
        }
        if (isset($grand_totals[$sponsors[$i][0]])) {
            $grand_totals[$sponsors[$i][0]] += $sponsor_sub_total;
        }
        else { // initial the totals
            $grand_totals[$sponsors[$i][0]] = $sponsor_sub_total;
        }
        
    } 
?>
<div class="participant">HaloELITE Care:</div> <div class="currencySymbol">$ </div><div class="amount"><?php echo number_format($commission_care - $sponsor_total, 2); ?></div><br><hr>

<!-- Final SUMMARY -->
<h2 class="final_submission">Totals for Submission</h2>
<p><div class="participant">Gross Commission:</div> <div class="currencySymbol">$ </div><div class="amount"><?php echo number_format($gross_commission,2); ?></div><br><hr>
<div class="participant">Halo Group Realty Transaction Fee:</div> <div class="currencySymbol">$ </div><div class="amount"> 
<?php if ( $transaction_type == "Seller" || $transaction_type == "Buyer") {
            echo number_format($stf,2);
        } else {
            echo number_format($ltf,2);
        } 
?></div><br><hr>
<div class="participant">Other Deductions: <?php echo $form_data['field']['21.Other Shared Deductions Description']; ?></div> <div class="currencySymbol">$ </div><div class="amount"><?php echo number_format($other_shared_deductions,2); ?></div><br><hr>

<?php // loop this to show accumulated totals

    foreach ($grand_totals as $name => $amount) {
        echo '<div class="participant">' . $name . '</div><div class="currencySymbol">$ </div><div class="amount">  ' . number_format(round($amount,2), 2) . '</div><br><hr><br>';
    } 
?>

<div class="participant">HaloELITE Care:</div> <div class="currencySymbol">$ </div><div class="amount"><?php echo number_format($commission_care - $sponsor_total, 2); ?></div><br><hr>