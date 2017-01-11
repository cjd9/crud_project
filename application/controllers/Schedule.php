<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//include '../services/ScheduleService.php';

class Schedule extends CI_Controller {

    
    private $scheduleService;

	public function __construct()
	{
            parent::__construct();
            $this->load->library('schedule_Service');
            $this->load->model('Dentist_Model');
            $this->scheduleService  = new ScheduleService();
	}

	public function Schedule()
	{
            $doc_id = $this->session->user_id;

            $schedules = $this->scheduleService->getDoctorSchedule($doc_id);
            $this->data['schedules'] = $this->scheduleService->getSchedulesForPlotting($doc_id, $schedules);
            $this->data['dentist_clinics'] = $this->Dentist_Model->DentistClinicMount($doc_id);
            //echo "<pre>"; print_r($res); exit;
            $this->data['dentist_details'] = $this->Dentist_Model->GetFullDentistDetails($this->session->user_id);

            $this->load->view('common/headpart',$this->data);
            $this->load->view('common/sidebar',$this->data);
            $this->load->view('my_calendar',$this->data);
            $this->load->view('common/footer',$this->data);

	}

	public function addSchedule()
	{
		$data = $_POST;
		//print_r($data); exit;
		$doc_id = $this->session->user_id;
		$return = [];

		if(!$data['schedule_from'] || !$data['schedule_to']) {
			$return['error'] = "Please enter schedule time.";
		} else {
			$now = new \DateTime();
			$schedule_from = new \DateTime(date('Y-m-d H:i:s', strtotime($data['schedule_from'])));
			$schedule_to = new \DateTime(date('Y-m-d H:i:s', strtotime($data['schedule_to'])));
			if($schedule_from >= $schedule_to) {
				$return['error'] = "Invalid time range.";
			}
		}

		if(!isset($data['days'])) {
			$return['error'] = isset($return['error']) ? $return['error']."<br>Please select a day for the schedule." : "Please select a day for the schedule.";
		}

		//if user is adding schedule by clicking inside fullcalendar and manipulates the schedule date then throw error
		if(isset($data['repeat_action']) && $data['repeat_action'] == 'oneday') {
			if(!$data['schedule_date']) {
				$return['error'] = "Failed to add schedule.";
			} else {
				$schedule_date = new \DateTime(date('Y-m-d H:i:s', strtotime($data['schedule_date'])));
			}
		}

		if(!isset($return['error'])) {

			//multiple week days schedule
			if(is_array($data['days'])) {
				$overlapping_schedules = $this->scheduleService->getOverlappingSchedules($doc_id, $data);
				$delete_schedule = [];

				//create default array for inserting new schdules
				foreach ($data['days'] as $day) {
					$insert_new_schedule[$day]['doctor_id'] = $doc_id;
					$insert_new_schedule[$day]['day'] = $day;
					$insert_new_schedule[$day]['time_from'] = $schedule_from;
					$insert_new_schedule[$day]['time_to'] = $schedule_to;
				}
				
				//proces overlapping schedules and create insert and update queries data array accordingly
				foreach ($overlapping_schedules as $key => $schedule) {
					$time_from = new \DateTime(date('Y-m-d H:i:s', strtotime($schedule['time_from'])));
					$time_to = new \DateTime(date('Y-m-d H:i:s', strtotime($schedule['time_to'])));

					//skip/delete day key from insert schedules array if the new schedule falls exactly in between this overlapping schedule
					if($schedule_from >= $time_from && $schedule_to <= $time_to) {
						unset($insert_new_schedule[$schedule['day']]);
					}
					else {
						/*if(!empty($schedule->schedule_id))
							$insert_new_schedule[$schedule->day]['update_schedule_ids'][] = $schedule->schedule_id;
						else*/
							$delete_schedule[] = $schedule['id'];

						if(isset($insert_new_schedule[$schedule['day']])) {
							if($schedule_from < $time_from && $schedule_to <= $time_to) {
								$insert_new_schedule[$schedule['day']]['time_from'] = $insert_new_schedule[$schedule['day']]['time_from'] < $schedule_from ? $insert_new_schedule[$schedule['day']]['time_from'] : $schedule_from;
								$insert_new_schedule[$schedule['day']]['time_to'] = $time_to;
							}

							else if($schedule_from >= $time_from && $schedule_to > $time_to) {
								$insert_new_schedule[$schedule['day']]['time_from'] = $time_from;
								$insert_new_schedule[$schedule['day']]['time_to'] = $insert_new_schedule[$schedule['day']]['time_to'] > $schedule_to ? $insert_new_schedule[$schedule['day']]['time_to'] : $schedule_to;
							}

							else if($schedule_from < $time_from && $schedule_to > $time_to) {
								$insert_new_schedule[$schedule->day]['time_from'] = $insert_new_schedule[$schedule['day']]['time_from'] < $schedule_from ? $insert_new_schedule[$schedule['day']]['time_from'] : $schedule_from;
								$insert_new_schedule[$schedule->day]['time_to'] = $insert_new_schedule[$schedule['day']]['time_to'] > $schedule_to ? $insert_new_schedule[$schedule['day']]['time_to'] : $schedule_to;
							}
						}
					}
				}
/*print_r($overlapping_schedules);
print_r($insert_new_schedule); 
print_r($delete_schedule); 
exit;*/
				$this->scheduleService->saveWeekWiseSchedules($insert_new_schedule, $delete_schedule);
			}
			//single week day schedule
			else {
				$save_data['days'] = is_array($data['days']) ? implode('|', $data['days']) : $data['days'];
				$save_data['doc_id'] = $doc_id;
				$save_data['time_from'] = $schedule_from;
				$save_data['time_to'] = $schedule_to;
				if(isset($schedule_date))
					$save_data['schedule_date'] = $schedule_date;

				$save_result = $this->scheduleService->saveSchedule($save_data);
			}

			//refetch events from database
			$schedules = $this->scheduleService->getDoctorSchedule($doc_id);
			$schedules = $this->scheduleService->getSchedulesForPlotting($doc_id, $schedules);

			$return['schedules'] = $schedules;
			$return['success'] = true;
			$return['message'] = "Schedule saved successfully.";

		}

		echo json_encode($return);
	}

	public function editSchedule()
	{
            $data = $_POST;

            $doc_id = $this->session->user_id;
            $return = [];

            if(!$data['schedule_from'] || !$data['schedule_to']) {
                    $return['error'] = "Please enter schedule time.";
            } else {
                    $now = new \DateTime();
                    $schedule_from = new \DateTime(date('Y-m-d H:i:s', strtotime($data['schedule_from'])));
                    $schedule_to = new \DateTime(date('Y-m-d H:i:s', strtotime($data['schedule_to'])));
                    if($schedule_from >= $schedule_to) {
                            $return['error'] = "Invalid time range.";
                    }
            }

            //if user is adding schedule by clicking inside fullcalendar and manipulates the schedule date then throw error
            if(isset($data['repeat_action']) && $data['repeat_action'] == 'oneday') {
                    if(!$data['schedule_date']) {
                            $return['error'] = "Failed to add schedule.";
                    } else {
                            $schedule_date = new \DateTime(date('Y-m-d H:i:s', strtotime($data['schedule_date'])));
                    }
            }

            if(!isset($return['error'])) {

                    $schedule = $this->Dentist_Model->getScheduleById($data['schedule_id'])[0];//ScheduleModel::find($data['schedule_id']);
//var_dump($schedule); exit;
                    //for single day schedules
                    if($data['singleDay'] !== 'false') {
                        $update_query = "UPDATE schedules SET time_from = '".$schedule_from->format('H:i:s')."', time_to = '".$schedule_to->format('H:i:s')."' WHERE schedule_id = '".$data['schedule_id']."'";
                        $this->Dentist_Model->updateDeleteQuery($update_query);

                        $return['success'] = true;
                        $return['message'] = "Schedule edited successfully.";
                    }
                    //for repeated schedules
                    else {

                            if(isset($data['repeat_action']) && $data['repeat_action'] == 'oneday') {
                                //to edit single day for a common schedule we need to create a new entry in schedules table
                                //with reference to this schedule id

                                $insert_query = "INSERT INTO schedules (doctor_id, clinic_id, schedule_id, day, time_from, time_to, date) VALUES (
                                    '".$doc_id."', '3', '".$schedule['id']."', '".$schedule_date->format('w')."', '".$schedule_from->format('H:i:s')."', '".$schedule_to->format('H:i:s')."', '".$schedule_date->format('Y-m-d')."'
                                )";

                                $last_inserted_schedule_id = $this->Dentist_Model->insertQuery($insert_query);

//					$new_schedule = new ScheduleModel();
//					$new_schedule->day = $schedule_date->format('w');
//					$new_schedule->time_from = $schedule_from;
//					$new_schedule->time_to = $schedule_to;
//					$new_schedule->doctor_id = $doc_id;
//					$new_schedule->schedule_id = $schedule['id'];
//					$new_schedule->date = $schedule_date;
//
//					$new_schedule->save();
                            } else {
                                $update_query = "UPDATE schedules SET time_from = '".$schedule_from->format('H:i:s')."', time_to = '".$schedule_to->format('H:i:s')."' WHERE schedule_id = '".$data['schedule_id']."'";
                                $this->Dentist_Model->updateDeleteQuery($update_query);
                            }

                    }

                    $return['success'] = true;
                    $return['message'] = "Schedule edited successfully.";

                    //refetch events from database
                    $schedules = $this->scheduleService->getDoctorSchedule($doc_id);
                    $schedules = $this->scheduleService->getSchedulesForPlotting($doc_id, $schedules);

                    $return['schedules'] = $schedules;

            }

            echo json_encode($return);
	}

	public function deleteSchedule()
	{
		$data = Request::all();

		$doc_id = $this->session->user_id;
		$return = [];

		$schedule = ScheduleModel::find($data['schedule_id']);

		if(is_null($schedule)) {
			$return['error'] = true;
			$return['message'] = "Failed to delete schedule.";
		}
		else {

			if($data['singleDay'] !== 'false') {
				$schedule->delete();

				$return['success'] = true;
				$return['message'] = "Schedule deleted successfully.";			
			}

			else {

				if(isset($data['repeat_action']) && $data['repeat_action'] == 'oneday') {
					//add this date to the ignore dates coulumn of this schedule entry
					$deleted_date = json_decode($schedule->deleted_date);
					$deleted_date[] = $data['schedule_date'];
					$schedule->deleted_date = json_encode($deleted_date);

					$schedule->save();
				} else {
					//delete the schedule for all days
					$schedule->delete();
				}
				
				$return['success'] = true;
				$return['message'] = "Schedule deleted successfully.";
			}

			//refetch events from database
			$schedules = $this->scheduleService->getDoctorSchedule($doc_id);
			$schedules = $this->scheduleService->getSchedulesForPlotting($doc_id, $schedules);

			$return['schedules'] = $schedules;

		}

		return Json::encode($return);		
	}

	public function fetchSameDayNextSchedule()
	{
		$data = $_GET;
		$schedule_id = $this->scheduleService->fetchSameDayNextSchedule($data['schedule_end']);

		$return['schedule_id'] = $schedule_id;
		echo json_encode($return);
	}

}