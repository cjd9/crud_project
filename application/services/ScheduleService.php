<?php
class ScheduleService
{
    private $CI;
            
    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->helper('form');
        $this->CI->load->library('form_validation');
        $this->CI->load->model('User_Model');
        $this->CI->load->model('Dentist_Model');
    }

    
	public function getDoctorSchedule($doc_id)
	{
            //$result = ScheduleModel::where('doctor_id', $doc_id)->get();
            $query = "SELECT
                                    s1.*, GROUP_CONCAT(s2.date) as skip_dates
                            FROM
                                    schedules s1
                            LEFT JOIN
                                    schedules s2
                            ON
                                    s1.id = s2.schedule_id
                            WHERE
                                    s1.doctor_id = $doc_id AND
                                    (s1.date IS NULL OR s1.date >= '".(new \DateTime())->format('Y-m-d')."')
                            GROUP BY
                                    s1.id 
                            ORDER BY
                                    s1.time_from 	";
            $result = $this->CI->Dentist_Model->query($query);
            return $result;
	}

	public function saveSchedule($save_data)
	{
            $insert_query = "INSERT INTO schedules (doctor_id, clinic_id, day, time_from, time_to, date) VALUES (
                        '".$save_data['doc_id']."', '3', '".$save_data['time_from']."', '".$save_data['time_to']."', '".(isset($save_data['schedule_date']) ? $save_data['schedule_date'] : NULL )."'
            )";
//".$save_data['clinic_id']."
            return $this->CI->Dentist_Model->query($query);
	}

	/**
	 * function return json encoded array which is then initialized to schedules variable
	 * this variable is used in javascript fullcalendar plugin to diplay all schedules
	 * @param array $schedules
	 * @return json encoded array
	 */
	public function getSchedulesForPlotting($doc_id, $schedules, $for_appointment = false, $getJson = true)
	{
		$appointmentDuration = 30;
		$dates = $plot_schedules = [];
		$status_array = [0=>'pending', 1=>'confirmed', 2=>'cancelled', 3=>'completed'];
        $scheduleMinDate = new \DateTime('midnight');
        $scheduleMaxDate = new \DateTime('midnight');
        $queryScheduleMinDate = new \DateTime('midnight');
        $queryScheduleMaxDate = new \DateTime('midnight');
        //get week end of scheduleMinDate AND add next 2 weeks to scheduleMaxDate
        $scheduleMaxDate->modify('+'.((6 - $scheduleMaxDate->format('w')) + (7 * TOTAL_SCHEDULE_WEEKS_TO_SHOW) + $scheduleMaxDate->format('w')).' days');
        $queryScheduleMaxDate->modify('+'.((6 - $scheduleMaxDate->format('w')) + (7 * TOTAL_SCHEDULE_WEEKS_TO_SHOW) + $scheduleMaxDate->format('w')).' days');

		$query = "	SELECT *, DATE_FORMAT(time_from,'%Y-%m-%d') AS date
					FROM
                                            appointments
					WHERE
                                            doctor_id = $doc_id AND
                                            time_from BETWEEN '".$scheduleMinDate->format('Y-m-d H:i:s')."' AND '".$scheduleMaxDate->format('Y-m-d H:i:s')."' AND
                                            status IN (0, 1, 3) AND
                                            offline_patient_id IS NULL AND
                                            cases_id IS NOT NULL	";
		$result = [];//$this->CI->Dentist_Model->query($query);

		$appointments = [];

		foreach ($result as $appointment) {
			/*if(!$for_appointment)
				$appointments[$appointment->time_from] = $appointment;
			else {*/
				$a['from'] = strtotime($appointment->time_from);
				$a['to'] = strtotime($appointment->time_to);
				$a['id'] = $appointment->id;
				$a['statusClass'] = $appointment->status == 0 ? 'pending' : 'confirmed';
				$appointments[$appointment->date][$a['from']] = $a;
			//}
		}

        //prepare array of dates grouped by day number
        for($i = $scheduleMinDate; $i <= $scheduleMaxDate; $i->modify('+1 days')) {
        	$dates[$i->format('w')][] = new \DateTime(date('Y-m-d', strtotime($i->format('Y-m-d'))));
        }
//echo "<pre>"; print_r($schedules); exit;
		foreach ($schedules as $schedule) {
			$schedule_days = explode('|', $schedule['day']);
			$schedule_from = explode(':', $schedule['time_from']);
			$schedule_to = explode(':', $schedule['time_to']);
			$skip_dates = explode(',', $schedule['skip_dates']);
			$deleted_dates = json_decode($schedule['deleted_date']);

			if($schedule['date'] == 0) {
				foreach($schedule_days as $day) {
					foreach ($dates[$day] as $date) {
						$plot = true;

						if(!is_null($skip_dates) && in_array($date->format('Y-m-d'), $skip_dates))
							$plot = false;
						if(!is_null($deleted_dates) && in_array($date->format('Y-m-d'), $deleted_dates))
							$plot = false;

						if($plot) {
							if(!$for_appointment) {
								$plot_schedule['schedule_id'] = $schedule['id'];
								$plot_schedule['allDay'] = false;								
								$plot_schedule['singleDay'] = $schedule['date'] != 0 ? true : false;

								$date->setTime($schedule_from[0], $schedule_from[1], $schedule_from[2]);
								$plot_schedule['start'] = $date->format("Y-m-d h:i:s A");
								$date->setTime($schedule_to[0], $schedule_to[1], $schedule_to[2]);
								$plot_schedule['end'] = $date->format("Y-m-d h:i:s A");

								$plot_schedule['appointments'] = '';
								$top = 0;
								$start_timestamp = strtotime($plot_schedule['start']);
								$end_timestamp = strtotime($plot_schedule['end']);
								for($j = $start_timestamp; $j <= $end_timestamp; $j = strtotime("+$appointmentDuration minutes", $j)) {
									if(isset($appointments[$date->format("Y-m-d")][$j]))
										$plot_schedule['appointments'] .= '<div class="schedule-appointment '.$appointments[$date->format("Y-m-d")][$j]['statusClass'].' pos-absolute width100 text-center" style="top: '.$top.'px;"><a class="display-block" href="'. route('view.doctor.appointment', $appointments[$date->format("Y-m-d")][$j]['id']) .'">'.date('h:i A', $j).'</a></div>';									
									$top = $top + 21;
								}

								if($plot_schedule['appointments'] == '') {
									$plot_schedule['disabled'] = false;
									$plot_schedule['className'] = 'cursor-pointer';
								} else {
									$plot_schedule['disabled'] = true;
									$plot_schedule['className'] = '';
								}
								

								/*if(isset($appointments[$date->format('Y-m-d H:i:s')])) {
									$plot_schedule['appointment_id'] = $appointments[$date->format('Y-m-d H:i:s')]->id;
									$plot_schedule['className'] .= " ".$status_array[$appointments[$date->format('Y-m-d H:i:s')]->status];
									$plot_schedule['disabled'] = true;
								} else {
									$plot_schedule['className'] .= ' vacant';
									$plot_schedule['disabled'] = false;
								}*/
								$plot_schedules[] = $plot_schedule;
							}
							else {
								$ymd = $date->format('Y-m-d');
								$plot_schedule['schedule_id'] = $schedule['id'];
								$date->setTime($schedule_from[0], $schedule_from[1], $schedule_from[2]);
								$plot_schedule['start'] = $date->getTimestamp();
								$date->setTime($schedule_to[0], $schedule_to[1], $schedule_to[2]);
								$plot_schedule['end'] = $date->getTimestamp();

								$plot_schedules[$ymd]['schedules'][] = $plot_schedule;
								if(isset($appointments[$ymd]))
									$plot_schedules[$ymd]['appointments'] = $appointments[$ymd];
								else 
									$plot_schedules[$ymd]['appointments'] = [];
							}
						}
					}
				}
			} else {
				$date = new \DateTime($schedule['date']);

				if(!$for_appointment) {
					$plot_schedule['schedule_id'] = $schedule['id'];
					$plot_schedule['allDay'] = false;
					$plot_schedule['singleDay'] = $schedule['date'] != 0 ? true : false;

					$date->setTime($schedule_from[0], $schedule_from[1], $schedule_from[2]);
					$plot_schedule['start'] = $date->format("Y-m-d h:i:s A");
					$date->setTime($schedule_to[0], $schedule_to[1], $schedule_to[2]);
					$plot_schedule['end'] = $date->format("Y-m-d h:i:s A");					

					$plot_schedule['appointments'] = '';
					$top = 0;
					$start_timestamp = strtotime($plot_schedule['start']);
					$end_timestamp = strtotime($plot_schedule['end']);
					for($j = $start_timestamp; $j <= $end_timestamp; $j = strtotime("+$appointmentDuration minutes", $j)) {
						if(isset($appointments[$date->format("Y-m-d")][$j]))
							$plot_schedule['appointments'] .= '<div class="schedule-appointment '.$appointments[$date->format("Y-m-d")][$j]['statusClass'].' pos-absolute width100 text-center" style="top: '.$top.'px;"><a class="display-block" href="'. route('view.doctor.appointment', $appointments[$date->format("Y-m-d")][$j]['id']) .'">'.date('h:i A', $j).'</a></div>';
							$top = $top + 21;
					}

					if($plot_schedule['appointments'] == '') {
						$plot_schedule['disabled'] = false;
						$plot_schedule['className'] = 'cursor-pointer';
					} else {
						$plot_schedule['disabled'] = true;
						$plot_schedule['className'] = '';
					}

					/*if(isset($appointments[$date->format('Y-m-d H:i:s')])) {
						$plot_schedule['appointment_id'] = $appointments[$date->format('Y-m-d H:i:s')]->id;
						$plot_schedule['className'] .= " ".$status_array[$appointments[$date->format('Y-m-d H:i:s')]->status];
						$plot_schedule['disabled'] = true;
					} else {
						$plot_schedule['className'] .= ' vacant';
						$plot_schedule['disabled'] = false;
					}*/
					$plot_schedules[] = $plot_schedule;
				}
				else {
					$ymd = $date->format('Y-m-d');
					$plot_schedule['schedule_id'] = $schedule['id'];
					$date->setTime($schedule_from[0], $schedule_from[1], $schedule_from[2]);
					$plot_schedule['start'] = $date->getTimestamp();
					$date->setTime($schedule_to[0], $schedule_to[1], $schedule_to[2]);
					$plot_schedule['end'] = $date->getTimestamp();

					$plot_schedules[$ymd]['schedules'][] = $plot_schedule;
					if(isset($appointments[$ymd]))
						$plot_schedules[$ymd]['appointments'] = $appointments[$ymd];
					else 
						$plot_schedules[$ymd]['appointments'] = [];					
				}
			}
		}

		/*$query = "	SELECT *, DATE_FORMAT(time_from,'%Y-%m-%d') AS date
					FROM
						appointments
					WHERE
						time_from BETWEEN ? AND ? AND
						status IN (0, 1, 3) AND
						type = 'offline' AND
						cases_id IS NOT NULL	";
		$result = DB::select($query, [$scheduleMinDate->format('Y-m-d H:i:s'), $scheduleMaxDate->format('Y-m-d H:i:s')]);	*/	

		if(!$for_appointment) {
                    usort($plot_schedules, array(get_class(), 'sortSchedules'));
		}

		return $getJson ? json_encode($plot_schedules) : $plot_schedules;
	}

	private function sortSchedules($schedule1, $schedule2)
	{
		$s1 = strtotime($schedule1['start']);
		$s2 = strtotime($schedule2['start']);

		if($s1 == $s2)
			return 0;

		return $s1 < $s2 ? -1 : 1;
	}

	public function fetchSameDayNextSchedule($schedule_end)
	{
		$schedule_id = "";

		$date = new \DateTime(date('Y-m-d H:i:s', strtotime($schedule_end)));
		$query = "SELECT id, schedule_id, time_from FROM schedules WHERE time_from >= '" .$date->format('H:i:s'). "' AND day = '" .$date->format('w'). "' AND date = '" .$date->format('Y-m-d'). "' ORDER BY time_from LIMIT 1";
		$single_day_schedule = $this->CI->Dentist_Model->query($query);

		$query = "SELECT id, time_from FROM schedules WHERE time_from >= '" .$date->format('H:i:s'). "' AND day = '" .$date->format('w'). "' AND date IS NULL ORDER BY time_from LIMIT 1";
		$common_schedule = $this->CI->Dentist_Model->query($query);

		if(!empty($common_schedule)) {
			$schedule_id = $common_schedule[0]->id;
		}

		if(!empty($single_day_schedule)) {
			if(!is_null($single_day_schedule[0]->schedule_id) && !empty($common_schedule) && $single_day_schedule[0]->schedule_id == $common_schedule[0]->id) {
				$schedule_id = $single_day_schedule[0]->id;
			} else {
				if(!empty($common_schedule)) {
					$schedule_id = $single_day_schedule[0]->time_from < $common_schedule[0]->time_from ? $single_day_schedule[0]->id : $common_schedule[0]->id;
				} else {
					$schedule_id = $single_day_schedule[0]->id;
				}
			}
		}

		return $schedule_id;
	}

	public function getOverlappingSchedules($doctor_id, $data)
	{
		$days = implode("', '", $data['days']);
		$time_from = date('H:i:s', strtotime($data['schedule_from']));
		$time_to = date('H:i:s', strtotime($data['schedule_to']));

		$query = "SELECT
					s1.*
				FROM
					schedules s1
				WHERE
					s1.doctor_id = $doctor_id AND
					s1.day IN ('$days') AND
					(s1.date = 0 OR s1.date > NOW()) AND
					(
						CAST('$time_from' AS TIME) BETWEEN s1.time_from  AND s1.time_to OR
                        CAST('$time_to' AS TIME) BETWEEN s1.time_from  AND s1.time_to OR
                        s1.time_from BETWEEN CAST('$time_from' AS TIME) AND CAST('$time_to' AS TIME) OR
                        s1.time_to BETWEEN CAST('$time_from' AS TIME) AND CAST('$time_to' AS TIME)
					)
				ORDER BY 
					s1.day, s1.time_from 	";

		$result = $this->CI->Dentist_Model->query($query);

		return $result;
	}

	public function saveWeekWiseSchedules($insert_new_schedule, $delete_schedule)
	{
		foreach ($insert_new_schedule as $schedule) {

                    $insert_query = "INSERT INTO schedules (doctor_id, clinic_id, day, time_from, time_to) VALUES (
                        '".$schedule['doctor_id']."', '3', '".$schedule['day']."', '".$schedule['time_from']->format('H:i:s')."', '".$schedule['time_to']->format('H:i:s')."'
                    )";
//".$save_data['clinic_id']."
                    $last_inserted_schedule_id = $this->CI->Dentist_Model->insertQuery($insert_query);

                    if(isset($schedule['update_schedule_ids'])) {
                        $update_query = "UPDATE schedules SET schedule_id = $last_inserted_schedule_id WHERE schedule_id IN ({$schedule['update_schedule_ids']})";
                        $this->CI->Dentist_Model->updateDeleteQuery($update_query);
                    }
		}

		//delete old schedules
                $this->CI->Dentist_Model->updateDeleteQuery("DELETE FROM schedules WHERE id IN ('".implode("', '", $delete_schedule)."')");

		return true;
	}
}