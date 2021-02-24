<?php


if(!class_exists('RGForms') ) {
	/* Accessed directly */
    exit;
}

 PDF_Common::setup_ids();

$form = RGFormsModel::get_form_meta($form_id);


global $pdf;

$pdf_name = PDF_TEMPLATE_LOCATION . 'pdfs/100G_Plan_Template.pdf';

 $template = gfpdfe_business_plus::initilise($pdf_name);

foreach($lead_ids as $lead_id) {

	        $lead = RGFormsModel::get_lead($lead_id);
       
            $form_data = GFPDFEntryDetail::lead_detail_grid_array($form, $lead);
	
			/* --------------------------------------------------------------------------
			 *Add data field which will be printed on the pdf here 
			 */
			
			/* Personal Information*/
			$form_data['field']['1']['first']; /* Applicants First Name */
			$form_data['field']['1']['last']; /* Applicants Last Name */
			$todays_date = date('M d, Y');	/* Date Created */	
						
			/* The Goal*/
			$form_data['field']['5']; /* Net Commission Income Goal for the Year */ 

			/* Average Income Per Sale */			
			$form_data['field']['6']; /* Average Gross Home Sale Prices */
			$form_data['field']['7']; /* Average Commission Percentage */		
			$form_data['field']['8']; /* Average Gross Commission Income per Sale */		
			$form_data['field']['10']; /* Average Net Commission Income per Sale */		
							
			/* Number of Sales Per Month */
			$form_data['field']['12']; /* Number of Sales Needed in Next 12 Months  */
			$form_data['field']['17']; /* Number of Active Months */
			$form_data['field']['16']; /* Number of Sales Per Month */			
				
			/* Number of Leads Per Month */
			$form_data['field']['36']; /* Leads to Sale Ratio */
			$form_data['field']['32'];  /* Number of Leads Needed Per Month */

			/* Prospecting Methods */
			$form_data['field']['21']; /* Number Buyer Leads */
			$form_data['field']['29']; /* Number Seller Leads */
			$form_data['field']['28']; /* Number Door To Door Leads */
			$form_data['field']['27']; /* Number Expired Listing Leads */
			$form_data['field']['26']; /* Number FSBO Leads */
			$form_data['field']['25']; /* Number of Leads from Buyer Seminars */
			$form_data['field']['24']; /* Number of Leads from Seller Seminars */
			$form_data['field']['23']; /* Number of Leads from Referrals */
			$form_data['field']['30']; /* Number of Leads from Social Media */
			$form_data['field']['31']; /* Total Number of Leads */
			$form_data['field']['33']; /* Goal per month */

			/* --------------------------------------------------------------------------
			 *End of data fields added 
			 */	

			PDF_Common::view_data($form_data);	
			

			/* --------------------------------------------------------------------------
			 *Text formatting for pdf output 
			 */				
			 $styles = '
			 	body {
					font-family: Arial, Helvetica, sans-serif;;
					letter-spacing: -0.2px;
					color: #333333;
				}
			 ';
			/* --------------------------------------------------------------------------
			 *Load Page 1 
			 */	
			 
			$pdf->WriteHTML($styles, 1);
			$pdf->SetFontSize(10);						
			$pdf->AddPageByArray(array(
				'orientation' => 'P', 
				'sheet-size' => array($template['size'][1]['w'], $template['size'][1]['h'])
			)); 		
		
			$pdf->useTemplate($template['load'][1]); 	
			
			
			/* --------------------------------------------------------------------------
			 *Data to output on page 1 
			 */	

			/* Applicants Details */
			$pdf->WriteText(30, 40.5, $form_data['field']['1']['first'] . '  ' . $form_data['field']['1']['last']); /* Applicants Name */
			$pdf->WriteText(151, 40.5, $todays_date); /* Home Phone */

			/* The Goal */
			$pdf->WriteText(67, 60, $form_data['field']['5']); /* The Goal Amount */


			/* Average Income Per Sale*/	
			$pdf->WriteText(117, 75, $form_data['field']['6']); /* Average Gross Home Sale Price */
			$pdf->WriteText(117, 81, $form_data['field']['7'] . 'Percent'); /* Average Commission Per Sale Percentage */
			$pdf->WriteText(117, 87, $form_data['field']['8']); /* Gross Income Per Sale */
			$pdf->WriteText(117, 93, $form_data['field']['10']); /* Net Income Per Sale */
			
			
			/* Numer of Sales Per Month */
			$pdf->WriteText(148, 109, $form_data['field']['12']); /* Total # Sales for Period */
			$pdf->WriteText(148, 115, $form_data['field']['17']); /* Number of Active Months */
			$pdf->WriteText(148, 121, $form_data['field']['16']); /* Number of Sales Per Month*/
			
			/* Number of Leads Per Month */
			$pdf->WriteText(148, 137, $form_data['field']['36']); /* Height */
			$pdf->WriteText(148, 143, $form_data['field']['32']); /* Weight */
			
			
			/* Prospecting Methods */
			$pdf->WriteText(120, 166, $form_data['field']['21']); /* Buyer Leads */
			$pdf->WriteText(120, 170.25, $form_data['field']['29']); /* Seller Leads */
			$pdf->WriteText(120, 174.5, $form_data['field']['28']); /* Door To Door */
			$pdf->WriteText(120, 178.75, $form_data['field']['27']); /* Expireds */
			$pdf->WriteText(120, 183, $form_data['field']['26']); /* FSBO */
			$pdf->WriteText(120, 187.25, $form_data['field']['25']); /* Buyer Seminars */
			$pdf->WriteText(120, 191.5, $form_data['field']['24']); /* Seller Seminars */
			$pdf->WriteText(120, 195.75, $form_data['field']['23']); /* Social Media */
			$pdf->WriteText(120, 199, $form_data['field']['30']); /* Referrals */
			$pdf->WriteText(120, 251, $form_data['field']['31']); /* Total Leads */
			$pdf->WriteText(120, 261, $form_data['field']['33']); /* Goal Leads */

			 
			/* --------------------------------------------------------------------------
			 *Load Page 2 
			 */	
			   
				// $pdf->AddPageByArray(array(
				// 	'orientation' => 'P', 
				//	'sheet-size' => array($template['size'][2]['w'], $template['size'][2]['h'])
				// ));
	            // $pdf->useTemplate($template['load'][2]);     			   
			   
			/* --------------------------------------------------------------------------
			 *Data to output on page 2 
			 */	




			/* --------------------------------------------------------------------------
			 *Load Page 3 
			 */	
			
   			   
			   
			/* --------------------------------------------------------------------------
			 *Data to output on page 3 
			 */	


			
			/* --------------------------------------------------------------------------
			 *Load Page 4 
			 */	
			 			   

			/* --------------------------------------------------------------------------
			 *Data to output on page 4 
			 */	
		 	 		
			 
} /* close the foreach loop */