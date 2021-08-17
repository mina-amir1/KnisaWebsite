<?php

include "class.php";
if (isset($_GET['btn'])) {
	
	$start=$_GET['start'];
	$end=$_GET['end'];
	$date=$_GET['date'];
	$db=new Database();
	if($start=="" ||$end==""||$date=="'" || $start==$end){echo "Sorry Data ERROR";}
	else
	{
		if($db->Check_validation($start,$end,$date))
		{
			if($db->add($start,$end,$date))
			{
				echo "Reservation Completed Successfuly!!";
			}
			else{echo "Error while adding";}
		}
		else{echo "Sorry this time is already reserved xD";}

	}

}