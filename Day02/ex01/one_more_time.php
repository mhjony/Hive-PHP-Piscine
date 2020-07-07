#!/usr/bin/php
<?php
    function error()
    {
        echo "Wrong Format\n";
        exit();
    }
    function get_key($needle, $array)
    {
        $key = 0;
        foreach ($array as $elem){
            if (in_array($needle, $elem)){
                $key = array_search($elem, $array);
                break;
            }
        }
        return $key;
    }
    // if 2 argumnets proceed, else print error message
    if($argc == 2)
    {
        if((substr_count($argv[1], ' ') != 4) || (substr_count($argv[1], ':') != 2))
            error();
        $array_key = array("dayofweek", "dd","mm", "yy","time");
        $array_value = explode(' ', $argv[1]);
		$input = array_combine($array_key, $array_value);
		//print_r($input);
		$array_key = array("hour", "min", "sec");
		//print_r($array_key);
		$array_value = explode(':', $input['time']);
		//print_r($array_value);
		$time = array_combine($array_key, $array_value);
		//print_r($time);
		//print_r($input);
        $day_of_week = array("1" => "lundi", "2" => "mardi", "3" => "mercredi", "4" => "jeudi", "5" => "vendredi", "6" => "samedi", "0" => "dimanche");
        $months = array("1" => ["janvier","Janvier"],"2" => ["février","Février","Fevrier","fevrier"],"3" => ["mars","Mars"], "4" => ["avril","Avril"],
        "5" => ["mai","Mai"], "6" => ["juin","Juin"] , "7" => ["juillet","Juillet"], "8" => ["août","Août","Aout","aout"], "9" => ["septembre","Septembre"],
        "10" => ["octobre","Octobre"], "11" => ["novembre","Novembre"], "12" => ["décembre","Décembre","Decembre","decembre"]);
        // check validity on the input: day of the week, date, month, year, and time are in correct format
        if ((preg_match("/([Ll]undi|[Mm]ardi|[Mm]ercredi|[Jj]eudi|[Vv]endredi|[Ss]amedi|[Dd]imanche)/", $input['dayofweek'])) &&
            (preg_match('/^(([0-3]){1}([0-9]){1}|([1-9]){1})$/', $input['dd']) && $input['dd'] > 0 && $input['dd'] < 32) &&
            (get_key($input['mm'], $months) != 0) &&
            (preg_match('/^([0-9]){4}$/', $input['yy']) && $input['yy'] > 1969) &&
            (preg_match('/^([0-9]){2}$/', $time['hour']) && $time['hour'] > -1 && $time['hour'] < 24) &&
            (preg_match('/^([0-9]){2}$/', $time['min']) && $time['min'] > -1 && $time['min'] < 60) &&
            (preg_match('/^([0-9]){2}$/', $time['sec']) && $time['sec'] > -1 && $time['sec'] < 60)){
                $input['dayofweek'] = strtolower($input['dayofweek']);
				$input['dayofweek'] = array_search($input['dayofweek'], $day_of_week);
                $input['mm'] = get_key($input['mm'], $months);
				$day_real = date('w', strtotime($input['yy']."-".$input['mm']."-".$input['dd']." ".$input['time']));
				//echo $day_real;
                // if the date exists and the day of the week matches to day_real proceed calculating seconds
                if (checkdate($input['mm'], $input['dd'], $input['yy']) && $input['dayofweek'] == $day_real){
                        date_default_timezone_set("Europe/Paris");
                        echo strtotime($input['yy']."-".$input['mm']."-".$input['dd']." ".$input['time'])."\n";
                }
                else {
                    error();
                }
        }
        else
            error();
    }
    else {
        exit();
    }
?>