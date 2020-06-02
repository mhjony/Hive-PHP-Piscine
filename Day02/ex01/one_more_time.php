#!/usr/bin/php
<?php

	function ft_validation($str)
	{
		$days = array("lundi", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");
		$months = array("janvier", "Janvier", "février", "Février", "mars", "Mars", "avril", "Avril" , "mai", "Mai", "juin", "Juin", "juillet", "Juillet", "aout" , "Aout", "septembre", "Septembre", "octobre", "Octobre", "novembre", "Novembre", "décembre", "Décembre");

		$tmp = preg_split("/ +/", trim($str));
		$i = 0;
		$count = 0;
		while ($days[$i])
		{
			if (strstr($str, $days[$i]))
			{
				$i = 0;
				while ($months[$i])
				{
					if (strstr($str, $months[$i]))
						$count++;
					$i++;
				}
			}
			$i++;
		}
		echo $count;

		if (substr_count($str, " ") == 4)
			$count++;
		if (preg_match('/^(([0-3]){1}([0-9]){1}|([1-9]){1})$/', $tmp[1]) == 1 )
			$count++;
		if (preg_match("/^([0-9]){4}$/", $tmp[3]) == 1 && $tmp[3] > 1969)
			$count++;
		$time = explode(":", "$tmp[4]");
		if (count($time) != 3)
			return (0);
		if ((preg_match("/^([0-9]){2}$/", $time[0]) && $time[0] >= 0 && $time[0] < 24) &&
			(preg_match("/^([0-9]){2}$/", $time[1]) && $time[1] >= 0 && $time[1] < 60) &&
			(preg_match("/^([0-9]){2}$/", $time[2]) && $time[2] >= 0 && $time[2] < 60))
			$count++;
		if ($count == 5)
			return (1);
		return (0);
	}

	function replace_days($str)
	{
		if (preg_match('/[Ll]undi/', $str) == 1)
			$str = str_ireplace("lundi", "Monday", $str);
		else if ((preg_match('/[Mm]ardi/', $str) == 1))
			$str = str_ireplace("mardi", "Tuesday", $str);
		else if ((preg_match('/[Mm]ercredi/', $str) == 1))
			$str = str_ireplace("mercredi", "Wednesday", $str);
		else if ((preg_match('/[Jj]eudi/', $str) == 1))
			$str = str_ireplace("jeudi", "Thursday", $str);
		else if ((preg_match('/[Vv]endredi/', $str) == 1))
			$str = str_ireplace("vendredi", "Friday", $str);
		else if ((preg_match('/[Ss]amedi/', $str) == 1))
			$str = str_ireplace("samedi", "Saturday", $str);
		else if ((preg_match('/[Dd]imanche/', $str) == 1))
			$str = str_ireplace("dimanche", "Sunday", $str);
		return $str;
	}

	function replace_months($str)
	{
		if (preg_match('/[Jj]anvier/', $str) == 1)
			$str = str_ireplace("janvier", "January", $str);
		else if (preg_match('/[Ff]février/', $str) == 1)
			$str = str_ireplace("février", "February", $str);
		else if (preg_match('/[Mm]ars/', $str) == 1)
			$str = str_ireplace("mars", "March", $str);
		else if (preg_match('/[Aa]vril/', $str) == 1)
			$str = str_ireplace("avril", "April", $str);
		else if (preg_match('/[Mm]ai/', $str) == 1)
			$str = str_ireplace("mai", "May", $str);
		else if (preg_match('/[Jj]uin/', $str) == 1)
			$str = str_ireplace("juin", "June", $str);
		else if (preg_match('/[Jj]uillet/', $str) == 1)
			$str = str_ireplace("juillet", "July", $str);
		else if (preg_match('/[Aa]out/', $str) == 1)
			$str = str_ireplace("aout", "August", $str);
		else if (preg_match('/[Ss]eptembre/', $str) == 1)
			$str = str_ireplace("septembre", "September", $str);
		else if (preg_match('/[Oo]ctobre/', $str) == 1)
			$str = str_ireplace("octobre", "October", $str);
		else if (preg_match('/[Nn]ovembre/', $str) == 1)
			$str = str_ireplace("novembre", "November", $str);
		else if (preg_match('/[Dd]écembre/', $str) == 1)
			$str = str_ireplace("décembre", "December", $str);
		else if (preg_match('/[Dd]ecembre/', $str) == 1)
			$str = str_ireplace("decembre", "December", $str);
		return $str;
	}
	if ($argc == 2)
	{
		if (!ft_validation($argv[1]))
		{
			echo "Wrong Format";
			return (0);
		}
		$argv[1] = replace_days($argv[1]);
		$argv[1] = replace_months($argv[1]);
		print ($time = strtotime($argv[1]));
		print "\n";
	}
?>