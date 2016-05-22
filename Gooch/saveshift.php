

<?php
require_once('config.php'); 
$shift_data = json_decode($_POST['shift_data']);
$save_shift = new SaveShiftData($mysqli, $shift_data);
$newly_inserted_shift_id = $save_shift->insertShiftData();
$save_shift->insertWaitersData($newly_inserted_shift_id);
$return_msg = array('success' => True, 'msg' => "Shift Added successfully");

echo json_encode($return_msg);

class SaveShiftData
{
	private $m_mysqli, $m_shift_data;

	public function __construct($i_connection, $i_shift_data)
	{
		$this->m_mysqli = $i_connection;
		$this->m_shift_data = $i_shift_data;
	}

	public function insertShiftData()
	{
		$new_shift_id = NULL;

		$check_if_already_exists_query = $this->m_mysqli->prepare("SELECT `id`, `date`, `is_morning` FROM `shifts` WHERE date=? AND is_morning=?");

		$check_if_already_exists_query->bind_param('si', $this->m_shift_data->m_Date,  $this->m_shift_data->m_IsMorning);
		$check_if_already_exists_query->execute();
		$result = $check_if_already_exists_query->get_result();
		if(mysqli_fetch_assoc($result))
		{
			$return_msg = array('success' => False, 'msg' => "Shift Already exists !");
			echo json_encode($return_msg);
			exit;
		}

		$sql_query = $this->m_mysqli->prepare("INSERT INTO `shifts`(`id`, `date`, `total_hours`, `total_money`, `allowance`, `is_morning`, `is_checker`) VALUES (?,?,?,?,?,?,?)");
		$sql_query->bind_param('isdddii', $new_shift_id, $this->m_shift_data->m_Date, $this->m_shift_data->m_TotalHours, $this->m_shift_data->m_TotalInitialTipsAmount, $this->m_shift_data->m_TotalAllowance, $this->m_shift_data->m_IsMorning, $this->m_shift_data->m_isCheckerExists);
		$query_result = $sql_query->execute();
		checkQueryAndDieIfFailed($this->m_mysqli, $query_result);

		

		return mysqli_insert_id($this->m_mysqli);
	}

	public function insertWaitersData($i_newly_inserted_shift_id)
	{
		$waitersData = $this->m_shift_data->m_ShiftWaitersData;
		$new_waiter_shift_id = NULL;

		foreach ($waitersData as $waiter) {

			$sql_query = $this->m_mysqli->prepare("INSERT INTO `usershiftline` (`id`, `users_fk`, `shifts_fk`, `hours`, `money_earned`) VALUES (?,?,?,?,?)");
		  	$sql_query->bind_param('iiidd',$new_waiter_shift_id, $waiter->Id, $i_newly_inserted_shift_id, $waiter->Hours, $waiter->EarnedInShift);
			$query_result = $sql_query->execute();
			checkQueryAndDieIfFailed($this->m_mysqli, $query_result);
		}
	}
}

function checkQueryAndDieIfFailed($i_mysqli, $i_query_result)
{
	if (!$i_query_result) {
	    echo "DB Error, could not process the query\n";
	    echo 'MySQL Error: ' . mysqli_error($i_mysqli);
	    exit;
	}
}

  
?>