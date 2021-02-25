<?php


if (!class_exists('RGForms')) {
    /* Accessed directly */
    exit;
}

 PDF_Common::setup_ids();

$form = RGFormsModel::get_form_meta($form_id);


global $pdf;

$pdf_name = PDF_TEMPLATE_LOCATION . 'pdfs/SDN.pdf';

 $template = gfpdfe_business_plus::initilise($pdf_name);

foreach ($lead_ids as $lead_id) {
    $lead = RGFormsModel::get_lead($lead_id);
       
    $form_data = GFPDFEntryDetail::lead_detail_grid_array($form, $lead);
    
    /* --------------------------------------------------------------------------
     *Add data field which will be printed on the pdf here
     */

    /* PERSONAL INFORMATION */
    $clients_first_name = $form_data['field']['2']['first']; /* Clients First Name  */
    $clients_last_name = $form_data['field']['2']['last']; /* Clients Last Name */
            
    $realtors_first_name = $form_data['field']['3']['first']; /* Realtors First Name  */
    $realtors_last_name = $form_data['field']['3']['last']; /* Realtors Last Name */

    $property_address_street1 =  $form_data['field']['277']['street'];
    $property_address_street2 =  $form_data['field']['277']['street2'];
    $property_address_city = $form_data['field']['277']['city'];
    $property_address_state = $form_data['field']['277']['state'];
    $property_address_zip = $form_data['field']['277']['zip'];

    /* Occuppied */
    $occupied_current = $form_data['field']['8'];
    $occupied_previously = $form_data['field']['10'];
    $occupied_date = $form_data['field']['11'];

    /* Section 1 Checkmark Items - Page 1 */
    $section1_cable = $form_data['field']['7'];
    $section1_monoxide_detector = $form_data['field']['13'];
    $section1_ceiling_fans = $form_data['field']['14'];
    $section1_cooktop = $form_data['field']['15'];
    $section1_dishwasher = $form_data['field']['16'];
    $section1_disposal = $form_data['field']['17'];
    $section1_emergencey_ladders = $form_data['field']['18'];
    $section1_exhaust_fans = $form_data['field']['19'];
    $section1_fences = $form_data['field']['20'];
    $section1_fire_equitment = $form_data['field']['21'];
    $section1_french_drain = $form_data['field']['22'];
    $section1_gas_fixtures = $form_data['field']['23'];
    $section1_natural_gas_fixtures = $form_data['field']['24'];
    $section1_cable = $form_data['field']['7'];


    /* Section 1 Checkmark Items - Page 2 */
    $section1_liquid_propane_gas = $form_data['field']['26'];
    $section1_lp_community = $form_data['field']['27'];
    $section1_lp_property = $form_data['field']['28'];
    $section1_hot_tub = $form_data['field']['29'];
    $section1_intercom_system = $form_data['field']['30'];
    $section1_microwave = $form_data['field']['31'];
    $section1_outdoor_grill = $form_data['field']['32'];
    $section1_patio_decking = $form_data['field']['33'];
    $section1_plumbing_system = $form_data['field']['34'];
    $section1_pool = $form_data['field']['35'];
    $section1_pool_quitment = $form_data['field']['36'];
    $section1_pool_maintenance = $form_data['field']['37'];
    $section1_pool_heater= $form_data['field']['38'];

    /* Section 1 Checkmark Items - Page 3 */
    $section1_pump = $form_data['field']['40'];
    $section1_pump_type = $form_data['field']['42'];
    $section1_rain_gutters = $form_data['field']['41'];
    $section1_range_stove = $form_data['field']['43'];
    $section1_roof_attic = $form_data['field']['44'];
    $section1_sauna = $form_data['field']['45'];
    $section1_smoke_detector = $form_data['field']['46'];
    $section1_sd_hearing_impaired = $form_data['field']['47'];
    $section1_spa = $form_data['field']['48'];
    $section1_trash_compactor = $form_data['field']['49'];
    $section1_tv_antenna = $form_data['field']['50'];
    $section1_washer_dryer_hookup = $form_data['field']['51'];
    $section1_window_screens = $form_data['field']['52'];
    $section1_public_sewer_system = $form_data['field']['53'];

    /* Section 1 Checkmark Items - Page 4 */
    $section1_central_ac = $form_data['field']['55'];
    $section1_ac_type = $form_data['field']['56'];
    $section1_ac_nou = $form_data['field']['58'];
    $section1_evaporative_coolers = $form_data['field']['57'];
    $section1_ecnou = $form_data['field']['59'];
    $section1_wall_window_ac_units = $form_data['field']['60'];
    $section1_wall_window_ac_nou= $form_data['field']['61'];
    $section1_attic_fans = $form_data['field']['62'];
    $section1_attic_fans_des = $form_data['field']['63'];
    $section1_central_heat = $form_data['field']['64'];
    $section1_central_heat_type = $form_data['field']['66'];
    $section1_central_heat_nou = $form_data['field']['65'];
    $section1_other_heat = $form_data['field']['69'];
    $section1_other_heat_desc = $form_data['field']['70'];
    $section1_oven = $form_data['field']['68'];
    $section1_number_of_ovens = $form_data['field']['71'];
    $section1_oven_type = $form_data['field']['73'];
    $section1_oven_type_other = $form_data['field']['74'];
    $section1_fireplace_chimney = $form_data['field']['75'];
    $section1_fireplace_chimney_type = $form_data['field']['76'];
    $section1_fireplace_other = $form_data['field']['77'];
    $section1_carport = $form_data['field']['78'];
    $section1_carport_type = $form_data['field']['79'];
    $section1_garage = $form_data['field']['80'];
    $section1_garage_type = $form_data['field']['81'];
    $section1_garage_door_openers = $form_data['field']['82'];
    $section1_garage_door_openers_nou = $form_data['field']['84'];
    $section1_garage_door_openers_remotes = $form_data['field']['85'];

    /* Section 1 Checkmark Items - Page 5 */
    $section1_satellite_dish_controls = $form_data['field']['86'];
    $section1_satellite_owned_leased = $form_data['field']['91'];
    $section1_setellite_leased_from = $form_data['field']['88'];
    $section1_security_system = $form_data['field']['89'];
    $section1_security_system_leased_owned = $form_data['field']['87'];
    $section1_security_system_leased_from = $form_data['field']['90'];
    $section1_solar_panels = $form_data['field']['92'];
    $section1_solar_panels_leased_owned = $form_data['field']['98'];
    $section1_solar_panels_leased_from = $form_data['field']['99'];
    $section1_water_heater = $form_data['field']['93'];
    $section1_water_heater_type = $form_data['field']['100'];
    $section1_water_heater_nou = $form_data['field']['102'];
    $section1_water_softener = $form_data['field']['94'];
    $section1_water_softener_leased_owned = $form_data['field']['103'];
    $section1_water_softener_leased_from = $form_data['field']['104'];
    $section1_other_leased_items = $form_data['field']['95'];
    $section1_other_leased_items_desc = $form_data['field']['105'];
    $section1_underground_lawn_sprinkler = $form_data['field']['96'];
    $section1_underground_lawn_sprinkler_automatic_manual = $form_data['field']['106'];
    $section1_underground_lawn_sprinkler_areas_covered = $form_data['field']['107'];
    $section1_septic_onsite_sewer_facility = $form_data['field']['97'];

    /* Section 1 Checkmark Items - Page 6 */
    $section1_water_supply = $form_data['field']['110'];
    $section1_built_before_1978 = $form_data['field']['111'];
    $section1_roof_type = $form_data['field']['112'];
    $section1_roof_age = $form_data['field']['113'];
    $section1_overlay_roof_covering = $form_data['field']['114'];
    $section1_roof_covering_desc = $form_data['field']['115'];

    /* Section 2 Checkmark Items - Page 7 */
    $section2_basement = $form_data['field']['118'];
    $section2_ceilings = $form_data['field']['119'];
    $section2_doors = $form_data['field']['120'];
    $section2_driveways = $form_data['field']['121'];
    $section2_electrical_systems = $form_data['field']['122'];
    $section2_exterior_walls = $form_data['field']['123'];
    $section2_floors = $form_data['field']['124'];
    $section2_foundation_slabs = $form_data['field']['125'];
    $section2_interior_walls = $form_data['field']['126'];
    $section2_lighting_fixtures = $form_data['field']['127'];
    $section2_plumbing_systems = $form_data['field']['128'];
    $section2_roof = $form_data['field']['129'];
    $section2_sidewalks = $form_data['field']['130'];
    $section2_walls_fences = $form_data['field']['131'];
    $section2_windows = $form_data['field']['132'];
    $section2_other_structral_components = $form_data['field']['133'];
    $section2_items_explanation = $form_data['field']['134'];

    /* Section 3 Checkmark Items - Page 8 */
    $section3_aluminum_wiring = $form_data['field']['138'];
    $section3_asbestos_components = $form_data['field']['139'];
    $section3_diseased_trees = $form_data['field']['140'];
    $section3_diseased_trees_type = $form_data['field']['142'];
    $section3_endangered_species = $form_data['field']['141'];
    $section3_fault_lines = $form_data['field']['143'];
    $section3_hazardous_toxic_waste = $form_data['field']['144'];
    $section3_improper_drainage = $form_data['field']['145'];
    $section3_intermittent_weather_springs = $form_data['field']['146'];
    $section3_landfill = $form_data['field']['147'];
    $section3_lead_based_hazards = $form_data['field']['148'];
    $section3_encroachments = $form_data['field']['149'];
    $section3_improvements_encroaching = $form_data['field']['150'];
    $section3_located_historic_district = $form_data['field']['151'];
    $section3_historic_property = $form_data['field']['152'];
    $section3_previous_foundation_repairs = $form_data['field']['153'];
    $section3_previous_roof_repairs = $form_data['field']['154'];
    $section3_manufacture_methamphetamine = $form_data['field']['155'];
    $section3_radon_gas = $form_data['field']['156'];
    $section3_settling = $form_data['field']['157'];
    $section3_soil_movement = $form_data['field']['158'];
    $section3_subsurface_structure_pits = $form_data['field']['159'];
    $section3_underground_storage_tanks = $form_data['field']['160'];
    $section3_unplatted_easements = $form_data['field']['161'];
    $section3_unrecorded_easements = $form_data['field']['162'];
    $section3_ureaformaldehyde_insulation = $form_data['field']['163'];
    $section3_water_damage = $form_data['field']['164'];
    $section3_wetlands = $form_data['field']['165'];
    $section3_wood_rot = $form_data['field']['166'];
    $section3_active_infestation_wdi = $form_data['field']['167'];
    $section3_previous_treatment_wdi = $form_data['field']['168'];
    $section3_previous_wdi_damage_repaired = $form_data['field']['169'];
    $section3_previous_fires = $form_data['field']['170'];
    $section3_wdi_damage_needing_repair = $form_data['field']['171'];
    $section3_single_drain = $form_data['field']['172'];
    $section3_items_explanation = $form_data['field']['173'];

    /* Section 4 Repairs - Page 9 */
    $section4_aware_of_repairs = $form_data['field']['176'];
    $section4_repairs_explanation = $form_data['field']['175'];


    /* Section 5 Flooding - Page 10 */
    $section5_present_flood_coverage = $form_data['field']['180'];
    $section5_previous_flooding_reservoir = $form_data['field']['181'];
    $section5_present_flooding_natural_flood = $form_data['field']['182'];
    $section5_previous_water_penetration = $form_data['field']['183'];
    $section5_located_100_year_floodplain = $form_data['field']['185'];
    $section5_100_year_floodplain_wholly_partly = $form_data['field']['189'];
    $section5_located_500_year_floodplain = $form_data['field']['188'];
    $section5_500_year_floodplain_wholly_partly = $form_data['field']['190'];
    $section5_located_floodway = $form_data['field']['184'];
    $section5_floodway_wholly_partly = $form_data['field']['191'];
    $section5_located_flood_pool = $form_data['field']['186'];
    $section5_flood_pool_wholly_partly = $form_data['field']['192'];
    $section5_located_reservoir = $form_data['field']['187'];  
    $section5_reservoir_wholly_partly = $form_data['field']['193'];

     /* Section 6 Flood Damage Claim - Page 11 */
    $section6_flood_claim = $form_data['field']['196'];
    $section6_explanation = $form_data['field']['197'];


     /* Section 7 Flood Assistance - Page 12 */
     $section7_flood_assistance = $form_data['field']['201'];
     $section7_explanation = $form_data['field']['200'];    

      /* Section 8 HOA - Page 13 */
    $section8_noncompliant_alterantions = $form_data['field']['204'];
    $section8_hoa_fees_maintenance = $form_data['field']['205'];
    $section8_name_of_association = $form_data['field']['206'];
    $section8_manager_name = $form_data['field']['207'];
    $section8_manager_phone = $form_data['field']['276'];
    $section8_fees_assessments = $form_data['field']['209'];
    $section8_fees_period = $form_data['field']['210'];
    $section8_fees_mandatory_voluntary = $form_data['field']['211'];
    $section8_unpaid_fees = $form_data['field']['212'];
    $section8_amount = $form_data['field']['213'];
    $section8_common_facilities = $form_data['field']['214'];
    $section8_optional_fees = $form_data['field']['215'];
    $section8_optional_fees_desc = $form_data['field']['216'];
    $section8_violations = $form_data['field']['217'];
    $section8_lawsuits = $form_data['field']['218'];
    $section8_death = $form_data['field']['219'];
    $section8_condition_affecting_health_safety = $form_data['field']['220'];
    $section8_hazard_treatments = $form_data['field']['221'];
    $section8_rainwater_harvesting_system = $form_data['field']['222'];
    $section8_located_propance_gas_area = $form_data['field']['223'];
    $section8_located_groundwater_conservation_district = $form_data['field']['224'];
    $section8_explanation = $form_data['field']['225'];
  

    /* Section 9 Survey - Page 14 */
    $section9_survey = $form_data['field']['228'];

    /* Section 10 Inspections - Page 15 */
    $section10_previous_inspections = $form_data['field']['231'];
    $section10_inspection_date = $form_data['field']['232'];
    $section10_type = $form_data['field']['233'];
    $section10_inspector_name = $form_data['field']['234'];
    $section10_no_pages = $form_data['field']['235'];
    $section10_another_inspection = $form_data['field']['336'];
    $section10_inspection_date_2 = $form_data['field']['240'];
    $section10_type_2 = $form_data['field']['239'];
    $section10_inspector_name_2 = $form_data['field']['238'];
    $section10_no_pages_2 = $form_data['field']['237'];

    /* Section 11 Tax Exemptions - Page 16 */
    $section11_tax_exemptions = $form_data['field']['243'];
    $section11_other = $form_data['field']['244'];

    /* Section 12 Damage Claim - Page 17 */
    $section12_damage_claim = $form_data['field']['247'];

    /* Section 13 Damage Claim - Page 18 */
    $section13_damage_claim_misused = $form_data['field']['250'];
    $section13_explanation = $form_data['field']['251'];

    /* Section 14 Smoke Detectors - Page 19 */
    $section14_smoke_detectors = $form_data['field']['254'];
    $section14_explanation = $form_data['field']['255'];


     /* Services - Page 20 */
    $services_electric = $form_data['field']['258'];
    $services_electric_phone = $form_data['field']['259'];
    $services_sewer = $form_data['field']['260'];
    $services_sewer_phone = $form_data['field']['261'];
    $services_water = $form_data['field']['262'];
    $services_water_phone = $form_data['field']['263'];
    $services_cable = $form_data['field']['264'];
    $services_cable_phone = $form_data['field']['265'];
    $services_trash = $form_data['field']['266'];
    $services_trash_phone = $form_data['field']['267'];
    $services_natural_gas = $form_data['field']['268'];
    $services_natural_gas_phone = $form_data['field']['269'];
    $services_phone_company = $form_data['field']['270'];
    $services_phone_company_phone = $form_data['field']['271'];
    $services_propane = $form_data['field']['272'];
    $services_propane_phone = $form_data['field']['273'];
    $services_internet = $form_data['field']['274'];
    $services_internet_phone = $form_data['field']['275'];






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
					color: #0000CC;
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

    /* Application Address Details, Monthly Rent and Deposit if provided*/
    $pdf->WriteText(52, 68.5, $property_address_street1 . ' ' . $property_address_street2 . ' ' . $property_address_city . ' ' . $property_address_state . ' ' . $property_address_zip); /* Application Property Address */
    $pdf->WriteText(83, 73.5, $property_move_in_date); /* Desired Move In Date */
    $pdf->WriteText(140.5, 73.5, $property_rent_amount); /* Rent Amount*/
    $pdf->WriteText(216, 73.5, $property_security_deposit_amount); /* Required Desposit */
    $pdf->setXY(17.5, 94);
    $pdf->Multicell(200, 4.5, $property_description); /*Property Condition */
                        
    /* Agents Details */
    $pdf->WriteText(25, 121, 'X');
    $pdf->WriteText(66, 121, $realtors_first_name . ' ' . $realtors_last_name); /* Realtors Name */
    $pdf->WriteText(180, 121, $realtors_phone); /* Realtors Phone */
                            
    /* Applicants Details */
    $pdf->WriteText(87, 135, $applicant_first_name . ' ' . $applicant_last_name); /* Applicants Name */

    if ($co_applicant_y_n == 'Yes') {
        $pdf->WriteText(80.5, 140, 'X'); /* Co Applicant Yes */
    } else {
        $pdf->WriteText(98.5, 140, 'X'); /* Co Applicant No */
    }

    $pdf->WriteText(126, 145.5, $applicant_name_former_last); /* Maiden Name */
    $pdf->WriteText(31.5, 150, $applicant_email); /* Email */
    $pdf->WriteText(176, 150, $applicant_phone_home); /* Home Phone */
    $pdf->WriteText(42, 156, $applicant_phone_work); /* Work Phone */
    $pdf->WriteText(176, 156, $applicant_phone_cell); /* Mobile */
    $pdf->WriteText(45, 161, $applicant_ssn); /* SSN */
    $pdf->WriteText(152.5, 161, $applicant_drivers_license_number); /* Drivers License */
    $pdf->WriteText(220, 161, $applicant_drivers_license_state); /* D-Lic State */
    $pdf->WriteText(43, 166, $applicant_dob); /* DOB */
    $pdf->WriteText(107.5, 166, $applicant_height); /* Height */
    $pdf->WriteText(157, 166, $applicant_weight); /* Weight */
    $pdf->WriteText(211, 166, $applicant_eye_color); /* Eye Color */
    $pdf->WriteText(38.5, 171.5, $applicant_hair_color); /* Hair Color */
    $pdf->WriteText(98.5, 171.5, $applicant_marital_status); /* Marital Status */
    $pdf->WriteText(185, 171.5, $applicant_citizenship); /* Citizenship */

                
    /* Emergency Contact Information */
    $pdf->WriteText(63, 188, $property_name_first . ' ' . $property_name_last); /* Emergency Name */
    $pdf->WriteText(68, 193, $property_address_street1 . ' ' . $property_address_street2 . ' ' .
                $property_address_city . ' ' . $property_address_state . ' ' . $property_address_zip . ' ' .
                $property_address_country); /* Emergency Address */
    $pdf->WriteText(64.5, 198, $property_phone); /* Emergency Phone */
    $pdf->WriteText(145, 198, $property_email); /* Emergency Email */

    /* Occupants */
    $pdf->WriteText(31, 213, $occupant_1_name); /* Occupant 1 Name */
    $pdf->WriteText(183, 213, $occupant_1_relationship); /* Occupant 1 Relationship */
    $pdf->WriteText(229, 213, $occupant_1_age); /* Occupant 1 Age */
    $pdf->WriteText(31, 218, $occupant_2_name); /* Occupant 2 Name */
    $pdf->WriteText(183, 218, $occupant_2_relationship); /* Occupant 2 Relationship */
    $pdf->WriteText(229, 218, $occupant_2_age); /* Occupant 2 Age */
    $pdf->WriteText(31, 223, $occupant_3_name); /* Occupant 3 Name */
    $pdf->WriteText(183, 223, $occupant_3_relationship); /* Occupant 3 Relationship */
    $pdf->WriteText(229, 223, $occupant_3_age); /* Occupant 3 Age */
    $pdf->WriteText(31, 228, $occupant_4_name); /* Occupant 4 Name */
    $pdf->WriteText(183, 228, $occupant_4_relationship); /* Occupant 4 Relationship */
    $pdf->WriteText(229, 228, $occupant_4_age); /* Occupant 4 Age */

    /* Current Address */
    $pdf->WriteText(72.5, 239, $current_address_street1); /* Current Address */
    $pdf->WriteText(223.5, 239, $current_address_street2); /* Apartment # */
    $pdf->WriteText(72.5, 244, $current_address_city . ' ' . $current_address_state . ' ' . $current_address_zip); /* Current Address CITY, STATE, ZIPCODE */
    $pdf->WriteText(100, 250, $landlord_1_name_first . ' ' . $landlord_1_name_last); /* Landlords Name */

    $pdf->WriteText(39, 254.5, $landlord_1_email);  /* Landlords Email */
            
    $pdf->WriteText(46, 260, $landlord_1_phone_day); /* Phone Day */
    $pdf->WriteText(98.5, 260, $landlord_1_phone_day); /* Phone Night */
    $pdf->WriteText(151, 260, $landlord_1_phone_mobile); /* Phone Mobile */
    $pdf->WriteText(205, 260, $landlord_1_phone_fax); /* Phone Fax */

    $pdf->WriteText(54, 265, $landlord_1_move_in);  /* Move In Date */
    $pdf->WriteText(139, 265, $landlord_1_move_out);  /* Move Out Date */
    $pdf->WriteText(197.5, 265, $landlord_1_rent_amount);  /* Rent Amount */

    $pdf->WriteText(60, 270, $landlord_1_reason_move);  /* Reason For Moving */
            
    /* Previous Address */
    $pdf->WriteText(74, 279.5, $previous_address_street1); /* Previous Address Street 1 */
    $pdf->WriteText(227, 279.5, $previous_address_street2); /* Previous Address APT # */
    $pdf->WriteText(74, 285, $previous_address_city . ' ' . $previous_address_state . ' ' . $previous_address_zip); /* Previous Address CITY, STATE, ZIPCODE*/
    $pdf->WriteText(117, 290, $landlord_2_name_first . ' ' . $landlord_2_name_last); /* Previous Landlords Name */

    $pdf->WriteText(37, 295, $landlord_2_email);  /* Previous Landlords Email */
            
    $pdf->WriteText(46.5, 300, $landlord_2_phone_day); /* Previous Phone Day */
    $pdf->WriteText(99, 300, $landlord_2_phone_night); /* Previous Phone Night */
    $pdf->WriteText(151.5, 300, $landlord_2_phone_mobile); /* Previous Phone Mobile */
    $pdf->WriteText(205, 300, $landlord_2_phone_fax); /* Previous Phone Fax */
             
    /* --------------------------------------------------------------------------
     *Load Page 2
     */
               
    $pdf->AddPageByArray(array(
                    'orientation' => 'P',
                    'sheet-size' => array($template['size'][2]['w'], $template['size'][2]['h'])
                ));
    $pdf->useTemplate($template['load'][2]);
               
    /* --------------------------------------------------------------------------
     *Data to output on page 2
     */

    /* Address at top of page 2 if applicable*/
    $pdf->WriteText(89, 21, $property_address_street1 . ' ' . $property_address_street2 . ' ' . $property_address_city . ' ' .
            $property_address_state . ' ' . $property_address_zip); /* Application Property Address */


    /* Previous Address CONTINUED*/
    $pdf->WriteText(54, 30, $landlord_2_move_in);  /* Previous Move In Date */
    $pdf->WriteText(141.5, 30, $landlord_2_move_out);  /* Previous Move Out Date */
    $pdf->WriteText(197, 30, $landlord_2_rent_amount);  /* Previous Rent Amount */

    $pdf->WriteText(60, 35, $landlord_2_reason_move);  /* Previous Reason For Moving */
            
    /* Current Employer */
    $pdf->WriteText(75.5, 43.5, $current_employer_name); /* Employer Name */

    $pdf->WriteText(43, 48.5, $current_employer_address_street1 . ' ' . $current_employer_address_street2 . ' ' .
            $current_employer_address_city . ' ' . $current_employer_address_state . ' ' . $current_employer_address_zip); /* Employer Address */

    $pdf->WriteText(63, 53.5, $current_employer_sup_name_first . ' ' . $current_employer_sup_name_last); /* Sup Last Name */

    $pdf->WriteText(144.5, 53.5, $current_employer_phone); /* Employer Phone */
    $pdf->WriteText(39, 59, $current_employer_email);  /* Employer Email */
            
    $pdf->WriteText(46, 64, $current_employer_start_date);  /* Start Date */

    $pdf->WriteText(144.5, 64, $current_employer_gross_income);  /* Gross Monthly Income */
    $pdf->WriteText(210.5, 64, $current_employer_position);  /* Position */
                        
    /* Previous Employer */
    $pdf->WriteText(77, 82.5, $previous_employer_name); /* Previous Employer Name */

    $pdf->WriteText(43.5, 87.5, $previous_employer_address_street1 . ' ' . $previous_employer_address_street2 . ' ' .
            $previous_employer_address_city . ' ' . $previous_employer_address_state . ' ' . $previous_employer_address_zip); /* Previous Employer Address */

    $pdf->WriteText(64, 92.5, $previous_employer_sup_name_first . ' ' . $previous_employer_sup_name_last); /* Sup Last Name */

    $pdf->WriteText(145, 92.5, $previous_employer_phone); /* Previous Employer Phone */
    $pdf->WriteText(38.5, 97.5, $previous_employer_email);  /* Previous Employer Email */
            
    $pdf->WriteText(55.5, 103, $previous_employer_start_date);  /* Previous Start Date */
    $pdf->WriteText(89, 103, $previous_employer_end_date);  /* Previous End Date */

    $pdf->WriteText(168, 103, $previous_employer_gross_income);  /* Previous Gross Monthly Income */
    $pdf->WriteText(227, 103, $previous_employer_position);  /* Previous Position */
            
    /* Other Income Considerations */
    $pdf->setXY(17, 114);
    $pdf->Multicell(200, 4.5, $other_income); /* Income Considerations */
            
    /* Vehicles */
    $pdf->WriteText(29, 143.5, $veh_1_type);  /* Vehicle 1 Type */
    $pdf->WriteText(65, 143.5, $veh_1_year);  /* Vehicle 1 Year */
    $pdf->WriteText(93, 143.5, $veh_1_make);  /* Vehicle 1 Make */
    $pdf->WriteText(137, 143.5, $veh_1_model);  /* Vehicle 1 Model */
    $pdf->WriteText(171, 143.5, $veh_1_license_number. '   ' . $veh_1_license_state);  /* Vehicle 1 License Number and State */
    $pdf->WriteText(223, 143.5, $veh_1_installment);  /* Vehicle 1 Mo. Payment */

    $pdf->WriteText(29, 148.5, $veh_2_type);  /* Vehicle 2 Type */
    $pdf->WriteText(65, 148.5, $veh_2_year);  /* Vehicle 2 Year */
    $pdf->WriteText(93, 148.5, $veh_2_make);  /* Vehicle 2 Make */
    $pdf->WriteText(137, 148.5, $veh_2_model);  /* Vehicle 2 Model */
    $pdf->WriteText(171, 148.5, $veh_2_license_number. '   ' . $veh_2_license_state);  /* Vehicle 1 License Number and State */
    $pdf->WriteText(223, 148.5, $veh_2_installment);  /* Vehicle 2 Mo. Payment */

    $pdf->WriteText(29, 153.5, $veh_3_type);  /* Vehicle 3 Type */
    $pdf->WriteText(65, 153.5, $veh_3_year);  /* Vehicle 3 Year */
    $pdf->WriteText(93, 153.5, $veh_3_make);  /* Vehicle 3 Make */
    $pdf->WriteText(137, 153.5, $veh_3_model);  /* Vehicle 3 Model */
    $pdf->WriteText(171, 153.5, $veh_3_license_number. '   ' . $veh_3_license_state);  /* Vehicle 1 License Number and State */
    $pdf->WriteText(223, 153.5, $veh_3_installment);  /* Vehicle 3 Mo. Payment */
            
    /* Pets */
    if ($pets_y_n == 0) {
        $pdf->WriteText(199.25, 163.5, 'X'); /* Pet 1 Neutered Yes */
    } else {
        $pdf->WriteText(183.75, 163.5, 'X'); /* Pet 1 Neutered Yes */
    }


    $pdf->WriteText(17, 183.5, $pet_1_type);  /* Pet 1 Type*/
    $pdf->WriteText(60, 183.5, $pet_1_name);  /* Pet 1 Name */
    $pdf->WriteText(89, 183.5, $pet_1_color);  /* Pet 1 Color */
    $pdf->WriteText(105, 183.5, $pet_1_weight);  /* Pet 1 Weight */
    $pdf->WriteText(121, 183.5, $pet_1_age);  /* Pet 1 Age */
    $pdf->WriteText(145, 183.5, $pet_1_gender);  /* Pet 1 Gender */

    if ($pet_1_neutered == 'Yes') {
        $pdf->WriteText(164, 183.5, 'X'); /* Pet 1 Neutered Yes */
    } elseif ($pet_1_neutered == 'No') {
        $pdf->WriteText(179.5, 183.5, 'X'); /* Pet 1 Neutered No */
    }

    if ($pet_1_declawed == 'Yes') {
        $pdf->WriteText(195, 183.5, 'X'); /* Pet 1 Declawed Yes */
    } elseif ($pet_1_declawed == 'No') {
        $pdf->WriteText(210, 183.5, 'X'); /* Pet 1 Declawed No */
    }

    if ($pet_1_shots == 'Yes') {
        $pdf->WriteText(225, 183.5, 'X'); /* Pet 1 Shots Yes */
    } elseif ($pet_1_shots == 'No') {
        $pdf->WriteText(241, 183.5, 'X'); /* Pet 1 Shots No */
    }

    $pdf->WriteText(17, 189, $pet_2_type);  /* Pet 2 Type*/
    $pdf->WriteText(60, 189, $pet_2_name);  /* Pet 2 Name */
    $pdf->WriteText(89, 189, $pet_2_color);  /* Pet 2 Color */
    $pdf->WriteText(105, 189, $pet_2_weight);  /* Pet 2 Weight */
    $pdf->WriteText(121, 189, $pet_2_age);  /* Pet 2 Age */
    $pdf->WriteText(145, 189, $pet_2_gender);  /* Pet 2 Gender */

    if ($pet_2_neutered == 'Yes') {
        $pdf->WriteText(164, 189, 'X'); /* Pet 2 Neutered Yes */
    } elseif ($pet_2_neutered == 'No') {
        $pdf->WriteText(179.5, 189, 'X'); /* Pet 2 Neutered No */
    }

    if ($pet_2_declawed == 'Yes') {
        $pdf->WriteText(195, 189, 'X'); /* Pet 2 Declawed Yes */
    } elseif ($pet_2_declawed == 'No') {
        $pdf->WriteText(210, 189, 'X'); /* Pet 2 Declawed No */
    }

    if ($pet_2_shots == 'Yes') {
        $pdf->WriteText(225, 189, 'X'); /* Pet 2 Shots Yes */
    } elseif ($pet_2_shots == 'No') {
        $pdf->WriteText(241, 189, 'X'); /* Pet 2 Shots No */
    }

    $pdf->WriteText(17, 194, $pet_3_type);  /* Pet 3 Type*/
    $pdf->WriteText(60, 194, $pet_3_name);  /* Pet 3 Name */
    $pdf->WriteText(89, 194, $pet_3_color);  /* Pet 3 Color */
    $pdf->WriteText(105, 194, $pet_3_weight);  /* Pet 3 Weight */
    $pdf->WriteText(121, 194, $pet_3_age);  /* Pet 3 Age */
    $pdf->WriteText(145, 194, $pet_3_gender);  /* Pet 3 Gender */

    if ($pet_3_neutered == 'Yes') {
        $pdf->WriteText(164, 194, 'X'); /* Pet 3 Neutered Yes */
    } elseif ($pet_3_neutered == 'No') {
        $pdf->WriteText(179.5, 194, 'X'); /* Pet 3 Neutered No */
    }

    if ($pet_3_declawed == 'Yes') {
        $pdf->WriteText(195, 194, 'X'); /* Pet 3 Declawed Yes */
    } elseif ($pet_3_declawed == 'No') {
        $pdf->WriteText(210, 194, 'X'); /* Pet 3 Declawed No */
    }

    if ($pet_3_shots == 'Yes') {
        $pdf->WriteText(225, 194, 'X'); /* Pet 3 Shots Yes */
    } elseif ($pet_3_shots == 'No') {
        $pdf->WriteText(241, 194, 'X'); /* Pet 3 Shots No */
    }

    $pdf->WriteText(17, 199, $pet_4_type);  /* Pet 4 Type*/
    $pdf->WriteText(60, 199, $pet_4_name);  /* Pet 4 Name */
    $pdf->WriteText(89, 199, $pet_4_color);  /* Pet 4 Color */
    $pdf->WriteText(105, 199, $pet_4_weight);  /* Pet 4 Weight */
    $pdf->WriteText(121, 199, $pet_4_age);  /* Pet 4 Age */
    $pdf->WriteText(145, 199, $pet_4_gender);  /* Pet 4 Gender */

    if ($pet_4_neutered == 'Yes') {
        $pdf->WriteText(164, 199, 'X'); /* Pet 4 Neutered Yes */
    } elseif ($pet_4_neutered == 'No') {
        $pdf->WriteText(179.5, 199, 'X'); /* Pet 4 Neutered No */
    }

    if ($pet_4_declawed == 'Yes') {
        $pdf->WriteText(195, 199, 'X'); /* Pet 4 Declawed Yes */
    } elseif ($pet_4_declawed == 'No') {
        $pdf->WriteText(210, 199, 'X'); /* Pet 4 Declawed No */
    }

    if ($pet_4_shots == 'Yes') {
        $pdf->WriteText(225, 199, 'X'); /* Pet 4 Shots Yes */
    } elseif ($pet_4_shots == 'No') {
        $pdf->WriteText(241, 199, 'X'); /* Pet 4 Shots No */
    }
        
    /* Questionaire */
    if ($questionaire_waterbed == 'Yes') {
        $pdf->WriteText(20.5, 212.5, 'X'); /* Waterbed Yes */
    } else {
        $pdf->WriteText(33, 212.5, 'X'); /* Waterbed No */
    }

    if ($questionaire_smoker == 'Yes') {
        $pdf->WriteText(20.5, 218, 'X'); /* Smoker Yes */
    } else {
        $pdf->WriteText(33, 218, 'X'); /* Smoker No */
    }

    if ($questionaire_insurance == 'Yes') {
        $pdf->WriteText(20.5, 223, 'X'); /* Insurance Yes */
    } else {
        $pdf->WriteText(33, 223, 'X'); /* Insurance No */
    }

    if ($questionaire_military == 'Yes') {
        $pdf->WriteText(20.5, 228, 'X'); /* Military Yes */
    } else {
        $pdf->WriteText(33, 228, 'X'); /* Military No */
    }

    if ($questionaire_orders == 'Yes') {
        $pdf->WriteText(20.5, 233, 'X'); /* Orders Yes */
    } else {
        $pdf->WriteText(33, 233, 'X'); /* Orders No */
    }

    if ($questionaire_eviction == 'Yes') {
        $pdf->WriteText(20.5, 248.5, 'X'); /* Eviction Yes */
    } else {
        $pdf->WriteText(33, 248.5, 'X'); /* Eviction No */
    }

    if ($questionaire_move_out == 'Yes') {
        $pdf->WriteText(20.5, 253.5, 'X'); /* Move Out Yes */
    } else {
        $pdf->WriteText(33, 253.5, 'X'); /* Move Out No */
    }

    if ($questionaire_breach == 'Yes') {
        $pdf->WriteText(20.5, 258.5, 'X'); /* Breached Yes */
    } else {
        $pdf->WriteText(33, 258.5, 'X'); /* NBreached No */
    }

    if ($questionaire_bankruptcy == 'Yes') {
        $pdf->WriteText(20.5, 264, 'X'); /* Bankruptcy Yes */
    } else {
        $pdf->WriteText(33, 264, 'X'); /* Bankruptcy No */
    }

    if ($questionaire_foreclosure == 'Yes') {
        $pdf->WriteText(20.5, 269, 'X'); /* Foreclosure Yes */
    } else {
        $pdf->WriteText(33, 269, 'X'); /* Foreclosure No */
    }

    if ($questionaire_credit == 'Yes') {
        $pdf->WriteText(20.5, 274.5, 'X'); /* Credit Yes */
    } else {
        $pdf->WriteText(33, 274.5, 'X'); /* Credit No */
    }

    if ($questionaire_crime == 'Yes') {
        $pdf->WriteText(20.5, 284.5, 'X'); /* Crime Yes */
    } else {
        $pdf->WriteText(33, 284.5, 'X'); /* Crime No */
    }

    if ($questionaire_sex_offender == 'Yes') {
        $pdf->WriteText(20.5, 289.5, 'X'); /* Sex Offender Yes */
    } else {
        $pdf->WriteText(33, 289.5, 'X'); /* Sex Offender No */
    }

    if ($questionaire_criminal_matters == 'Yes') {
        $pdf->WriteText(20.5, 294.5, 'X'); /* Criminal Matter Yes */
    } else {
        $pdf->WriteText(33, 294.5, 'X'); /* Criminal Matter No */
    }

    if ($questionaire_additional == 'Yes') {
        $pdf->WriteText(20.5, 300, 'X'); /* Additional Yes */
    } else {
        $pdf->WriteText(33, 300, 'X'); /* Additional No */
    }


    /* --------------------------------------------------------------------------
     *Load Page 3
     */
            
    $pdf->AddPageByArray(array(
                    'orientation' => 'P',
                    'sheet-size' => array($template['size'][3]['w'], $template['size'][3]['h'])
                ));
    $pdf->useTemplate($template['load'][3]);
               
    /* --------------------------------------------------------------------------
     *Data to output on page 3
     */

    /* Address at top of page 3 if applicable*/
    $pdf->WriteText(89, 24, $property_address_street1 . ' ' . $property_address_street2 . ' ' .
            $property_address_city . ' ' . $property_address_state . ' ' . $property_address_zip);
            
    /* Questionnaire Continued */
    $pdf->setXY(60, 31);
    $pdf->Multicell(400, 4.5, $questionaire_comments); /* Additional Comments */

    /*  Fees */
    $pdf->WriteText(114, 116.5, $application_fee_amount); /* Application Fee Amount  */
    $pdf->WriteText(165, 116.5, $application_fee_payee); /* Made Out To  */

    if ($application_deposit_y_n == 'Yes') {
        $pdf->WriteText(165.5, 121, 'X'); /* Deposit Yes */
    } elseif ($application_deposit_y_n == 'No') {
        $pdf->WriteText(188.5, 121, 'X'); /* Deposit No */
    } else {
    }
            
    $pdf->WriteText(40, 127, $application_deposit_amount); /* Deposit Amount  */
            
            
    /* Signature Page 3 */

    $pdf->Image($sign_pg_3, 17, 178, 52, 18);
    $pdf->WriteText(155, 194, $sign_date_pg_3); /* Date Signed */
            
    /* --------------------------------------------------------------------------
     *Load Page 4
     */
                           
    $pdf->AddPageByArray(array(
                    'orientation' => 'P',
                    'sheet-size' => array($template['size'][4]['w'], $template['size'][4]['h'])
                ));
    $pdf->useTemplate($template['load'][4]);
               
    /* --------------------------------------------------------------------------
     *Data to output on page 4
     */

    /* Address at top of page 4 if applicable*/
    $pdf->WriteText(90, 26, $property_address_street1 . ' ' . $property_address_street2 . ' ' .
            $property_address_city . ' ' . $property_address_state . ' ' . $property_address_zip);
            
    /* Applicants Name */
    $pdf->WriteText(22, 89, $applicant_first_name . ' ' . $applicant_last_name);
            
    /* Application Address */
    $pdf->WriteText(75, 96, $property_address_street1 . ' ' . $property_address_street2); /* Street, Street2 */
    $pdf->WriteText(20, 102, $property_address_city . ' ' . $property_address_state . ' ' . $property_address_zip); /* City State Zipcode */
            
    /* Landlord, Broker, or Landlord Representative Info  */
    $pdf->WriteText(41, 120, $list_agent_landlord_name_first . ' ' . $list_agent_landlord_name_last); /* Name */
    $pdf->WriteText(41, 126, $list_address_street1 . ' ' . $list_address_street2); /* Street, Street2 */
    $pdf->WriteText(41, 133, $list_address_city . ' ' . $list_address_state . ' ' . $list_address_zip); /* City State Zipcode */
    $pdf->WriteText(41, 140, $list_agent_phone); /* OtherAgent Phone */
    $pdf->WriteText(41, 146, $list_agent_email); /* OtherAgent Email */
            
            

    /* Signature Page 4 */

    if ($application_type == "making an application on a specific property") {
        $pdf->Image($sign_pg_4, 17, 240, 52, 18);
        $pdf->WriteText(145, 257, $sign_date_pg_4); /* Date Signed */
    } else {
    }
}