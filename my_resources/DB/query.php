ALTER TABLE `therapists` CHANGE `mobilenumber` `mobilenumber` BIGINT(10) NOT NULL, CHANGE `alternet_mobile_no` `alternet_mobile_no` BIGINT(10) NULL DEFAULT NULL;


ALTER TABLE `therapy_type` ADD `status` TINYINT(1) NOT NULL DEFAULT '1' AFTER `price`, ADD `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status`;
ALTER TABLE `patient_therapy_charges` ADD `patient_treatment_id` INT(11) NOT NULL COMMENT 'From patient treatement id' AFTER `id`;

ALTER TABLE `therapy_type` CHANGE `updated_by` `updated_by` INT(11) NULL;
ALTER TABLE `country_master` ADD `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status`;
ALTER TABLE `education_master` ADD `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' AFTER `status`;
ALTER TABLE `patient_therapy_charges` CHANGE `therapy_type` `therapy_id` FLOAT(8,2) NOT NULL;
ALTER TABLE `patients_treatments` ADD `treatment_title` VARCHAR(100) NOT NULL AFTER `patient_id`;
ALTER TABLE `patients_treatments` ADD `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' AFTER `commision_percentage`;


ALTER TABLE `assign_patients_to_therapiest` ADD `patient_treatement_id` INT NOT NULL COMMENT 'From patient treatment ' AFTER `therapist_id`;
ALTER TABLE `assign_patients_to_therapiest` ADD `therapist_amount` FLOAT(8,2) NULL COMMENT 'Payout to therapist' AFTER `patient_treatement_id`;


=================================================
ALTER TABLE `users` ADD `country` VARCHAR(50) NULL AFTER `state`;


===================================
ALTER TABLE `payment_collection` ADD `package_type` TINYINT(1) NULL COMMENT '1. Package \r\n2. Visit' AFTER `year`;

ALTER TABLE `payment_collection`  ADD `rp_count` INT(11) NULL  AFTER `package_amount`,  ADD `rp_amount` FLOAT(8,2) NULL  AFTER `rp_count`,  ADD `rp_total_amount` FLOAT NULL  AFTER `rp_amount`,  ADD `ct_count` INT NULL  AFTER `rp_total_amount`,  ADD `ct_amount` FLOAT NULL  AFTER `ct_count`,  ADD `ct_total_amount` FLOAT NULL  AFTER `ct_amount`,  ADD `dn_count` INT NULL  AFTER `ct_total_amount`,  ADD `dn_amount` FLOAT NULL  AFTER `dn_count`,  ADD `dn_total_amount` FLOAT NULL  AFTER `dn_amount`,  ADD `fu_count` INT NULL  AFTER `dn_total_amount`,  ADD `fu_amount` FLOAT NULL  AFTER `fu_count`,  ADD `fu_total_amount` FLOAT NULL  AFTER `fu_amount`,  ADD `fc_count` INT NULL  AFTER `fu_total_amount`,  ADD `fc_amount` FLOAT NULL  AFTER `fc_count`,  ADD `fc_total_amount` FLOAT NULL  AFTER `fc_amount`,  ADD `ij_count` INT NULL  AFTER `fc_total_amount`,  ADD `ij_amount` FLOAT NULL  AFTER `ij_count`,  ADD `ij_total_amount` FLOAT NULL  AFTER `ij_amount`,  ADD `ms_count` INT NULL  AFTER `ij_total_amount`,  ADD `ms_amount` FLOAT NULL  AFTER `ms_count`,  ADD `ms_total_amount` FLOAT NULL  AFTER `ms_amount`;

ALTER TABLE `payment_collection` CHANGE `received` `payment_collected` TINYINT(1) NOT NULL COMMENT '0. No\r\n1. Yes';


ALTER TABLE `daily_therapist_visit_transection` ADD `patient_charge` FLOAT(8,2) NULL AFTER `is_attend_same_time`;


ALTER TABLE `patient_invoices` CHANGE `mop` `mop` TINYINT(1) NULL COMMENT '1- Cash\r\n2 - UPI\r\n3 - Online\r\n4 - Cheque', CHANGE `payment_collected` `payment_collected` TINYINT(1) NULL COMMENT '0. No\r\n1. Yes', CHANGE `payment_received_date` `payment_received_date` DATETIME NULL;


ALTER TABLE `payout_to_therapist` ADD `no_of_visit` INT NULL AFTER `therapiest_id`, ADD `visit_charge` FLOAT(8,2) NULL AFTER `no_of_visit`;
ALTER TABLE `payout_to_therapist` ADD `patient_treatment_id` INT(11) NULL AFTER `therapiest_id`;

ALTER TABLE `payout_to_therapist` CHANGE `therapiest_id` `therapist_id` INT(11) NOT NULL COMMENT 'user management';


===============
ALTER TABLE `patients` ADD `carry_balance` FLOAT(8,2) NULL AFTER `is_premium`;
ALTER TABLE `patients`  ADD `pending_balance` FLOAT(8,2) NULL  AFTER `carry_balance`;
ALTER TABLE `patient_invoices` ADD `discount_amount` FLOAT(8,2) NULL AFTER `hand_over_account`;
ALTER TABLE `patient_invoices` ADD `is_amount_change` TINYINT(1) NOT NULL DEFAULT '0' AFTER `discount_amount`;


==========================
ALTER TABLE `patient_invoices` ADD `paid_amount` FLOAT(8,2) NULL AFTER `final_amount`;
ALTER TABLE `patient_invoices` ADD `credit_balance` FLOAT(8,2) NULL AFTER `discount_amount`;


===================

17-6-2022
ALTER TABLE `daily_therapist_visit_transection` ADD `is_same_charge` TINYINT(1) NOT NULL COMMENT '1-same charge,0-not same' AFTER `patient_charge`;
ALTER TABLE `lead_provider` CHANGE `primary_mobile_no` `mobilenumber` BIGINT(11) NOT NULL;
ALTER TABLE `lead_provider` CHANGE `modified_date` `updated_at` DATETIME NULL;
ALTER TABLE `lead_provider` CHANGE `modified_by` `updated_by` DATETIME NULL;
ALTER TABLE `lead_provider` CHANGE `alternate_mobile_no` `alternet_mobile_no` DATETIME NULL;
ALTER TABLE `lead_provider` CHANGE `alternet_mobile_no` `alternet_mobile_no` BIGINT(11) NULL;

ALTER TABLE `therapists` ADD `preferred_area` VARCHAR(255) NULL AFTER `IFSC_code`;

ALTER TABLE `company_expenses` ADD `is_deleted` TINYINT(1) NOT NULL DEFAULT '0' AFTER `mop`;

SELECT *,count(id) as total_visit FROM `daily_therapist_visit_transection` WHERE `patient_id` = 22 and is_attend = 1 group by therapist_id,therapy_id;

SELECT *,SUM(case when therapy_id = 1 then 1 else 0 end) as rp_count,SUM(case when therapy_id = 2 then 1 else 0 end) as dn_count,SUM(case when therapy_id = 3 then 1 else 0 end) as ct_count,SUM(case when therapy_id = 4 then 1 else 0 end) as fu_count,SUM(case when therapy_id = 5 then 1 else 0 end) as ij_count,SUM(case when therapy_id = 6 then 1 else 0 end) as ms_count,SUM(case when therapy_id = 7 then 1 else 0 end) as fc_count,SUM(case when therapy_id = 8 then 1 else 0 end) as package_count FROM `daily_therapist_visit_transection` WHERE `patient_id` = 22 and is_attend = 1 group by therapy_id

SELECT pi.*,concat(COALESCE(p.first_name,''),' ',COALESCE(p.last_name,'')) as patient_name FROM `daily_therapist_visit_transection` left join patients as p on p.id= daily_therapist_visit_transection.patient_id left join patient_invoices as pi on pi.patient_id= p.id where pi.month='5' and pi.year = 2022 group by daily_therapist_visit_transection.patient_id;

===============================================
ALTER TABLE `patient_invoices` ADD `last_month_pending_amount` FLOAT(8,2) NULL AFTER `credit_balance`, ADD `current_month_pending_amount` FLOAT(8,2) NULL AFTER `last_month_pending_amount`;

ALTER TABLE `daily_therapist_visit_transection` ADD `is_packged` TINYINT(1) NOT NULL DEFAULT '0' AFTER `therapy_id`;


ALTER TABLE `patients_treatments` ADD `is_assigned` TINYINT(1) NOT NULL COMMENT '0-not assigned,1-assigned' AFTER `lead_provider_id`;
INSERT INTO `master_treatment_status` (`id`, `treatement_status_title`, `status`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES (NULL, 'Confirm', '1', '0', '1', '2022-07-14 00:57:03', NULL, NULL);



=================================
INSERT INTO `master_therapy_type` (`id`, `type_name`, `type_full_name`, `price`, `status`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES (NULL, 'GV', 'Guidance Visit', '150', '1', '0', '1', '2022-08-23 19:41:15', '1', '2022-08-23 19:41:15');
INSERT INTO `master_treatment_status` (`id`, `treatement_status_title`, `status`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES (NULL, 'Hold', '1', '0', '1', '2022-08-27 01:01:13', '1', '2022-08-27 01:01:13');

INSERT INTO `master_visit_type` (`id`, `visit_type_title`, `status`, `is_deleted`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES (NULL, 'Online Session', '1', '0', '1', '2022-08-27 12:56:23', '1', '2022-08-27 12:56:23');


ALTER TABLE `therapists` ADD `total_available_visit` TINYINT NULL AFTER `preferred_area`;
ALTER TABLE `therapists` CHANGE `total_available_visit` `total_available_visit` TINYINT(4) NULL DEFAULT '8';


physiocare_visit_count


===============================
ALTER TABLE `daily_therapist_visit_transection` ADD `visit_at` TINYINT(1) NOT NULL DEFAULT '1' COMMENT '1-Home,2-Clinic,3-Hospital' AFTER `is_same_charge`;
ALTER TABLE `daily_therapist_visit_transection` ADD `is_amount_paid` TINYINT(1) NOT NULL DEFAULT '0' AFTER `visit_at`;
ALTER TABLE `patient_invoices` ADD `deduction` FLOAT(8,2) NULL AFTER `is_amount_change`;
ALTER TABLE `patient_invoices` ADD `this_month_advance_amount` FLOAT(8,2) NULL AFTER `current_month_pending_amount`;


ALTER TABLE `patients_treatments` ADD `payment_collected_by` TINYINT(1) NULL DEFAULT '1' COMMENT '1-Physiocare.2-Hospital,3-Clinic' AFTER `clinic_id`;


ALTER TABLE `master_hospitals` ADD `carry_balance` FLOAT(8,2) NULL AFTER `longitude`, ADD `pending_balance` FLOAT(8,2) NULL AFTER `carry_balance`;


ALTER TABLE `master_clinics` ADD `carry_balance` FLOAT(8,2) NULL AFTER `longitude`, ADD `pending_balance` FLOAT(8,2) NULL AFTER `carry_balance`;
