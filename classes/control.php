<?php


include 'DBConnection.php';



class control_functions
{



	private $dbcon = '';
	private $con = '';

	public function __construct()
	{
		$this->dbcon = new dbcon();
		$this->con = $this->dbcon->dbcon_function();
	}

	public function execDB($query)
	{
		if (!empty($query)) {
			$ex = $this->con->query($query);

			return $ex;
		} else {
			return 'Query is Empty';
		}
	}

	public function execDBReturnId($query)
	{
		if (!empty($query)) {
			$ex = $this->con->query($query);


			if ($ex) {
				$id = $this->con->insert_id;
				return json_encode(array('status' => true, 'id' => $id));
			}
			return json_encode(array('status' => false, 'id' => ''));
		} else {
			return 'Query is Empty';
		}
	}

	public function getValueAsf($query)
	{
		$result = $this->con->query($query);
		while ($row = mysqli_fetch_array($result)) {
			return $row['f'];
		}
	}

	public function select1DB($query)
	{
		$recode_array = array();

		if (!empty($query)) {

			if ($result = $this->con->query($query)) {
				return $result->fetch_assoc();
			}else{
				return array('data' => 'Query failed');
			}
		} else {
			return array('data' => 'Query is empty');
		}
	}

	public function selectDB($query)
	{
		if (!empty($query)) {
			$result_array = array();

			$results = $this->con->query($query);
			if ($results) {
				$rowCount = mysqli_num_rows($results);

				return $resp_arr = array('rowCount' => $rowCount, 'data' => $results);
			}
		} else {
			return $resp_arr = array('rowCount' => 0, 'data' => 'Query is empty');
		}
	}

	public function escape_string($query)
	{

		return $this->con->real_escape_string($query);
	}


	public function disconnect()
	{

		return $this->dbcon->disconnect();
	}
}
