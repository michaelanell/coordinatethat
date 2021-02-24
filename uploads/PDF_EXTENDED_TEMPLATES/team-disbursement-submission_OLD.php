<?php

/**
 * Template Name: Team Disbursement Submission
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

 /* Transaction Variables */
 $transaction_type = $form_data['field'][2];

/* Financial variables */
$sales_price = $form_data['field'][6];
$commission_percentage = $form_data['field'][7];
$gross_commission = $form_data['field'][8];
$stf = $form_data['field'][13];
$ltf = $form_data['field'][15];
$net_comm_before_shared_deductions = $gross_commission - ($stf + $ltf);
$gift_amount = ($gross_commission - $stf - $ltf) * (1/100);
$other_shared_deductions = $form_data['field'][20];
$shared_deductions = $gift_amount + $other_shared_deductions;
$nctd = $gross_commission - $shared_deductions;
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


/* Participants for each stage */ 

/* Participants List*/
$participants_list = $form_data['list'][9];
$number_participants = count($participants_list); 
extract($participants_list, EXTR_PREFIX_ALL, "list");

/* Create */
$participants_create = $form_data['field'][24];
$number_create = count($participants_create);
$create_per_participant = $commission_create / $number_create;
extract($participants_create, EXTR_PREFIX_ALL, "list_create");

/* Convert */
$participants_convert = $form_data['field'][27];
$number_convert = count($participants_convert);
$convert_per_participant = $commission_convert / $number_convert;
extract($participants_convert, EXTR_PREFIX_ALL, "list_convert");

/* Commit */
$participants_commit = $form_data['field'][30];
$number_commit = count($participants_commit);
$commit_per_participant = $commission_commit / $number_commit;
extract($participants_commit, EXTR_PREFIX_ALL, "list_commit");

/* Captivate - CMA */
$participants_captivate_cma = $form_data['field'][33];
$number_captivate_cma = count($participants_captivate_cma);
$captivate_cma_per_participant = $commission_captivate_cma / $number_captivate_cma;
extract($participants_captivate_cma, EXTR_PREFIX_ALL, "list_captivate_cma");

/* Captivate Captivate Closing */
$participants_captivate_closing = $form_data['field'][34];
$number_captivate_closing = count($participants_captivate_closing);
$captivate_closing_per_participant = $commission_captivate_closing / $number_captivate_closing;
extract($participants_captivate_closing, EXTR_PREFIX_ALL, "list_captivate_closing");

/* Captivate Appointments */
$participants_captivate_set_apts = $form_data['field'][35];
$number_captivate_set_apts = count($participants_captivate_set_apts);
$captivate_set_apts_per_participant = $commission_captivate_apts / $number_captivate_set_apts;
extract($participants_captivate_set_apts, EXTR_PREFIX_ALL, "list_captivate_set_apts");

/* Captivate Door Opener */
$participants_captivate_door_open = $form_data['field'][36];
$number_captivate_door_open = count($participants_captivate_door_open);
$captivate_door_open_per_participant = $commission_captivate_door_open / $number_captivate_door_open;
extract($participants_captivate_door_open, EXTR_PREFIX_ALL, "list_captivate_door_open");

/* Captivate Showing 37 */
$participants_captivate_show_qualify = $form_data['field'][37];
$number_captivate_show_qualify = count($participants_captivate_show_qualify);
$captivate_show_qualify_per_participant = $commission_captivate_show_qualify / $number_captivate_show_qualify;
extract($participants_captivate_show_qualify, EXTR_PREFIX_ALL, "list_captivate_show_qualify");

/* Captivate Signage 38 */
$participants_captivate_signage = $form_data['field'][38];
$number_captivate_signage = count($participants_captivate_signage);
$captivate_signage_per_participant = $commission_captivate_signage / $number_captivate_signage;
extract($participants_captivate_signage, EXTR_PREFIX_ALL, "list_captivate_signage");

/* Captivate Measure 39 */
$participants_captivate_measure = $form_data['field'][39];
$number_captivate_measure = count($participants_captivate_measure);
$captivate_measure_per_participant = $commission_captivate_measure / $number_captivate_measure;
extract($participants_captivate_measure, EXTR_PREFIX_ALL, "list_captivate_closing");

/* Captivate Collect Data 40 */
$participants_captivate_collect = $form_data['field'][40];
$number_captivate_collect = count($participants_captivate_collect);
$captivate_collect_per_participant = $commission_captivate_collect / $number_captivate_collect;
extract($participants_captivate_collect, EXTR_PREFIX_ALL, "list_captivate_collect");

/* Captivate MLS 41 */
$participants_captivate_mls = $form_data['field'][41];
$number_captivate_mls = count($participants_captivate_mls);
$captivate_mls_per_participant = $commission_captivate_mls / $number_captivate_mls;
extract($participants_captivate_mls, EXTR_PREFIX_ALL, "list_captivate_mls");

/* Captivate Marketing Budget 42 */
$participants_captivate_marketing = $form_data['field'][42];
$number_captivate_marketing = count($participants_captivate_marketing);
$captivate_marketing_per_participant = $commission_captivate_budget / $number_captivate_marketing;
extract($participants_captivate_marketing, EXTR_PREFIX_ALL, "list_captivate_marketing");

/* Captivate Management 43 */
$participants_captivate_management = $form_data['field'][43];
$number_captivate_management = count($participants_captivate_management);
$captivate_management_per_participant = $commission_captivate_manage / $number_captivate_management;
extract($participants_captivate_management, EXTR_PREFIX_ALL, "list_captivate_management");

/* Close */
$participants_close = $form_data['field'][46];
$number_close = count($participants_close);
$close_per_participant = $commission_close / $number_close;
extract($participants_close, EXTR_PREFIX_ALL, "list_close");

/* Compliance */
$participants_compliance = $form_data['field'][49];
$number_compliance = count($participants_compliance);
$compliance_per_participant = $commission_compliance / $number_compliance;
extract($participants_compliance, EXTR_PREFIX_ALL, "list_compliance");

/* Coordinate */
$participants_coordinate = $form_data['field'][52];
$number_coordinate = count($participants_coordinate);
$coordinate_per_participant = $commission_coordinate / $number_coordinate;
extract($participants_coordinate, EXTR_PREFIX_ALL, "list_coordinate");

?>

<!-- Any PDF CSS styles can be placed in the style tag below -->
<style>
    #participant {
        width: 300px;
        float:left;
    }

    #amount {
    width: 300px;
    float:left;
}

    #logo {
        float: right;
        width: 150px;        
    }
</style>


<!-- HTML Starts Here -->


<div id="logo"><img src="http://haloelite.com/wp-content/uploads/2016/09/HaloELITE-logo-Black-with-TRANSPARENT-BACK.png" /></div>

<h1>Team Disbursement Submission</h1>

<h2>Transaction Overview</h2>
<p>Deal Owner: <?php echo $form_data['field'][1]['first']; ?> <?php echo $form_data['field'][1]['last']; ?><br>
Submission Date: &nbsp; &nbsp;<?php echo $form_data['date_created_usa']; ?><br> 
Transaction Type: <?php echo $transaction_type; ?></p>
<p>Client Name/s: <br>
&nbsp; - &nbsp;<?php echo $form_data['field'][3]; /*Clients Name */?><br >
<p>Transaction Address: <br>
&nbsp; &nbsp;<?php echo $form_data['field'][4]['street']; ?><br >
&nbsp; &nbsp;<?php echo $form_data['field'][4]['street2']; ?><br >
&nbsp; &nbsp;<?php echo $form_data['field'][4]['city']; ?><br >
&nbsp; &nbsp;<?php echo $form_data['field'][4]['state']; ?><br >
&nbsp; &nbsp;<?php echo $form_data['field'][4]['zip']; ?></p>
Closing Date: <?php echo $form_data['field']['5.Closing Date']; ?><br>
Sales Price: $ <?php echo number_format($sales_price, 2); ?><br>
Commission Percentage: <?php echo $commission_percentage; ?> %</p>
<b>Gross Commission: $ <?php echo number_format($gross_commission,2); ?></b>
<hr> 
<h2>Brokerage Fees</h2>
<p>Transaction Fee: 
$ <?php if ( $transaction_type == "Seller" || $transaction_type == "Buyer") {
            echo number_format($stf,2);
        } else {
            echo number_format($ltf,2);
        } 
?>
<hr>
<h2>Shared Deductions</h2>
<p>Net Commission before shared deductions: $ <?php echo number_format($net_comm_before_shared_deductions,2); ?></p>
<h3>Less </h3>
<p>Gift: $ <?php echo number_format($gift_amount,2); ?><br>
Other: $ <?php echo number_format($other_shared_deductions,2); ?><br>
Details of Other shared deductions: <?php echo $form_data['field']['21.Other Shared Deductions Description']; ?></p>

<h3>Summary</h3>
<p>Net Commission before shared deductions: $ <?php echo number_format($net_comm_before_shared_deductions,2); ?><br>
&nbsp; - Less: Total Shared Deductions: $ <?php echo number_format($shared_deductions,2); ?><br >
<b>Net Income for Distribution: $<?php echo number_format($nctd,2); ?></b></p>
<hr>

<pagebreak>
<!-- Care -->
<h2>Care</h2>
<p>Amount: $ <?php echo number_format($commission_care, 2); ?></p>
<p>8% to Sponsor<br>
4% Coaching<br>
4% Cybertools</p>
<hr>

<!-- Create -->
<h2>Create</h2>
<p>Amount: $ <?php echo number_format($commission_create,2); ?></p>
<p>Participant/s: <br >
<?php if ( is_array( $participants_create) ) {

    foreach ( $participants_create as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($create_per_participant,2) . '</div><br>';
    }

}

?>
<hr>

<!-- Convert -->
<h2>Convert</h2>
<p>Amount: $ <?php echo number_format($commission_convert,2); ?></p>
<p>Participant/s: <br >
<?php if ( is_array( $participants_convert) ) {

    foreach ( $participants_convert as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($convert_per_participant,2) . '</div><br>';
    }

}

?>
<hr>

<!-- Commit -->
<h2>Commit</h2>
<p>Amount: $ <?php echo number_format($commission_commit,2); ?></p>
<p>Participant/s: <br >
<?php if ( is_array( $participants_commit) ) {

    foreach ( $participants_commit as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($commit_per_participant,2) . '</div><br>';
    }

}

?>
<hr>
<pagebreak>

<!-- Captivate -->
<h2>Captivate</h2>
<p>Amount: $ <?php echo number_format($commission_captivate,2); ?></p>
<hr>

<!-- CMA -->
<h3>CMA's</h3>
<p>Amount: $ <?php echo number_format($commission_captivate_cma,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_captivate_cma) ) {

    foreach ( $participants_captivate_cma as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_cma_per_participant,2) . '</div><br>';
    }

}
?>
<hr>

<!-- Attend Closing -->
<h3>Attend Closing</h3>
<p>Amount: $ <?php echo number_format($commission_captivate_closing,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_captivate_closing) ) {

    foreach ( $participants_captivate_closing as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_closing_per_participant,2) . '</div><br>';
    }

}
?>
<hr>

<!-- Captivate Buyer Specific Items -->

<!-- -Set Appointments -->
<?php 
    if ($transaction_type == "Buyer" || $transaction_type == "Landlord") {
            echo '<h3>Set Up Appointments</h3>
            <p>Amount: $ ' . number_format($commission_captivate_apts,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_set_apts) ) {

    foreach ( $participants_captivate_set_apts as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_set_apts_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Door Opener -->
<?php 
    if ($transaction_type == "Buyer" || $transaction_type == "Landlord") {
            echo '<h3>Show Homes - Door Opener</h3>
            <p>Amount: $ ' . number_format($commission_captivate_door_open,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_door_open) ) {

    foreach ( $participants_captivate_door_open as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_door_open_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- Qualifying -->
<?php 
    if ($transaction_type == "Buyer" || $transaction_type == "Landlord") {
            echo '<h3>Show Homes - Qualify</h3>
            <p>Amount: $ ' . number_format($commission_captivate_show_qualify,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_show_qualify) ) {

    foreach ( $participants_captivate_show_qualify as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_show_qualify_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Signs and Lockbox -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<h3>Manage Signs and Lockbox</h3>
            <p>Amount: $ ' . number_format($commission_captivate_signage,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_signage) ) {

    foreach ( $participants_captivate_signage as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_signage_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Measure -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<h3>Physically Measure the Property</h3>
            <p>Amount: $ ' . number_format($commission_captivate_measure,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_measure) ) {

    foreach ( $participants_captivate_measure as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_measure_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Collect Data from sources for MLS Listing -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<h3>Collect Data From Sources for MLS Listing</h3>
            <p>Amount: $ ' . number_format($commission_captivate_collect,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_collect) ) {

    foreach ( $participants_captivate_collect as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_collect_per_participant,2) .
         '</div><br>';
    }
    echo '<hr><pagebreak>';
}
?>

<!-- -Input To MLS -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<h3>Input Listing on MLS</h3>
            <p>Amount: $ ' . number_format($commission_captivate_mls,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_mls) ) {

    foreach ( $participants_captivate_mls as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_mls_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Marketing Budget -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<h3>Budget for Marketing Listing</h3>
            <p>Amount: $ ' . number_format($commission_captivate_budget,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_marketing) ) {

    foreach ( $participants_captivate_marketing as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_marketing_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<!-- -Manage -->
<?php 
    if ($transaction_type == "Seller" || $transaction_type == "Landlord") {
            echo '<h3>Manage Marketing the listing including Open Houses</h3>
            <p>Amount: $ ' . number_format($commission_captivate_manage,2) . '</p>  
            <p>Participants/s: <br>';
    }     
?>
<?php if ( is_array( $participants_captivate_management) ) {

    foreach ( $participants_captivate_management as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($captivate_management_per_participant,2) .
         '</div><br>';
    }
    echo '<hr>';
}
?>

<pagebreak>
<!-- Close -->
<h2>Close</h2>
<p>Amount: $ <?php echo number_format($commission_close,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_close) ) {

    foreach ( $participants_close as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($close_per_participant,2) . '</div><br>';
    }

}

?>

<hr>

<!-- Compliance -->
<h2>Compliance</h2>
<p>Amount: $ <?php echo number_format($commission_compliance,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_compliance) ) {

    foreach ( $participants_compliance as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($compliance_per_participant,2) . '</div><br>';
    }

}

?>
<hr>

<!-- Coordinate -->
<h2>Coordinate</h2>
<p>Amount: $ <?php echo number_format($commission_coordinate,2); ?></p>

<p>Participant/s: <br >
<?php if ( is_array( $participants_coordinate) ) {

    foreach ( $participants_close as $participant ) {
        echo '<div id="participant"> - ' . $participant . '</div><div id="amount"> $ ' . number_format($coordinate_per_participant,2) . '</div><br>';
    }

}

?>
<hr>

<!-- SUMMARY -->


<h2>Summary</h2>
<p><div id="participant">Gross Commission:</div> <div id="amount">$ <?php echo number_format($gross_commission,2); ?></div><br><br><hr>
<div id="participant">Halo Group Realty Transaction Fee:</div> <div id="amount">$  
<?php if ( $transaction_type == "Seller" || $transaction_type == "Buyer") {
            echo number_format($stf,2);
        } else {
            echo number_format($ltf,2);
        } 
?></div><br><hr>
<div id="participant">HaloELITE Care:</div> <div id="amount">$ <?php echo number_format($commission_care, 2); ?></div><br><hr>

<!-- List participants and total commission -->

<!-- FOR LOOP -->

<?php     

    for ($i = 0; $i < $number_participants; $i++) {                

            ${'list_subtotal_'.$i} = 0;

            // Create
            for ($create_i = 0; $create_i < $number_create; $create_i++) {
                    if (${'list_'.$i} === ${'list_create_'.$create_i}) {
                        ${'list_subtotal_'.$i} += $create_per_participant;
                    }
            }

            // Convert
            for ($convert_i = 0; $convert_i <= $number_convert; $convert_i++) {
                    if (${'list_'.$i} === ${'list_convert_'.$convert_i}) {
                        ${'list_subtotal_'.$i} += $convert_per_participant;
                    }
            }

            // Commit
            for ($commit_i = 0; $commit_i <= $number_commit; $commit_i++) {
                    if (${'list_'.$i} === ${'list_commit_'.$commit_i}) {
                        ${'list_subtotal_'.$i} += $commit_per_participant;
                    }
            }

            // Close
            for ($close_i = 0; $close_i <= $number_close; $close_i++) {
                    if (${'list_'.$i} === ${'list_close_'.$close_i}) {
                        ${'list_subtotal_'.$i} += $close_per_participant;
                    }
            }

            // Compliance
            for ($compliance_i = 0; $compliance_i <= $number_compliance; $compliance_i++) {
                    if (${'list_'.$i} === ${'list_compliance_'.$compliance_i}) {
                        ${'list_subtotal_'.$i} += $compliance_per_participant;
                    }
            }

             //Close
            for ($coordinate_i = 0; $coordinate_i <= $number_coordinate; $coordinate_i++) {
                if (${'list_'.$i} === ${'list_coordinate_'.$coordinate_i}) {
                    ${'list_subtotal_'.$i} += $coordinate_per_participant;  

                //Print Summary 
                echo '<div id="participant"> - ' . ${'list_'.$i} . '</div><div id="amount"> $ ' 
                . number_format(${'list_subtotal_'.$i},2) . '</div><br><hr>';
                }

                
            }

    }
    
?>

