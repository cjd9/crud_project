<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'dashboard';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'user/login';
$route['logout'] = 'user/logout';$route['signin'] = 'user/login';
$route['dashboard'] = 'user/dashboard';
$route['addTimeSlot'] = 'dashboard/addTimeSlot';
$route['doctorprofile'] = 'dashboard/doctorprofile';
$route['viewpatientdetails/(:num)']= 'dashboard/viewpatientdetails/$1';
$route['doctorpatients'] = 'dashboard/doctorpatients';
$route['add-user'] = 'dashboard/doctorclinics';
$route['doctorappointments'] = 'dashboard/doctorappointments';
$route['addTimeSlotForPatient'] = 'dashboard/addTimeSlotForPatient';
$route['checkTimeSlotForClinic']='dashboard/checkTimeSlotForClinic';
$route['addNewPatient']='dashboard/addNewPatient';
$route['UpdateClinicDetails']='dashboard/UpdateClinicDetails';
$route['doctortreatments']='dashboard/doctortreatments';

$route['postAuth']='dashboard/postAuth';
$route['pastTreatments']='dashboard/pastTreatments';

$route['preAuth']='dashboard/preAuth';

$route['updateDentistDetails']='dashboard/updateDentistDetails';
$route['treatment']='dashboard/treatment';
$route['unauthorize'] = 'user/unauthorize';


$route['my-calendar'] = 'schedule/schedule';
$route['addSchedule'] = 'Schedule/addSchedule';
$route['editSchedule'] = 'Schedule/editSchedule';
$route['deleteSchedule'] = 'Schedule/deleteSchedule';
$route['fetchSameDayNextSchedule'] = 'Schedule/fetchSameDayNextSchedule';

