<?php 


/**
 * 
 */
class Database
{	
	protected $host="localhost";
	protected $username="root";
	protected $password="";
	protected $db_name="reserve";

	public $conn;
	
	public function __construct()
	{
		$this->conn=mysqli_connect($this->host,$this->username,$this->password,$this->db_name);
	}

	public function Check_validation($start,$end,$date)
	{
	$res=mysqli_query($this->conn,"SELECT * FROM `time` WHERE `start`<='$start' AND `date`='$date' ORDER BY `start` DESC LIMIT 1");
	$data_before=mysqli_fetch_assoc($res);
		if(empty($data_before)){$data_before["end"]=-1;}
		if($start<$data_before["end"]){return false;}
		else
		{
			$res=mysqli_query($this->conn,"SELECT * FROM `time` WHERE `start`>'$start' AND `date`='$date' ORDER BY `start` ASC LIMIT 1");
			$data_after=mysqli_fetch_assoc($res);

				if(empty($data_after)){return true;}
				elseif($end>$data_after["start"]){return false;}
				else{return true;}
		}
	}

	public function add($start,$end,$date)
	{
		mysqli_query($this->conn,"INSERT INTO `time` (`start`, `end`, `date`) VALUES('$start','$end','$date')");
		if(mysqli_affected_rows($this->conn)){return true;}
		else{return false;}
	}


	public function __destruct()
	{
		mysqli_close($this->conn);
	}
}

/*$db=new Database();
//$db->add("10:00","11:30","2021-08-19");
if( $db->Check_validation("00:00","01:30","2021-08-19")){echo "true";}
else{echo "false";}*/