<?php

/*

 * To change this license header, choose License Headers in Project Properties.

 * To change this template file, choose Tools | Templates

 * and open the template in the editor.

 */

class dbcon {
    private $con;

    public function __construct()
	{
        $this->con ;
		
	}
    function dbcon_function() {

        $this->con = mysqli_connect("localhost", "root", "", "ccc");
        

        if (mysqli_connect_errno()) {

            echo "faild to connect to MYSQL: " . mysqli_connect_error();
        } else {
            return $this->con;
        }
    }

    function disconnect() {
        if ($this->con->connect_errno) {
            mysqli_close($this->con); // CLOSE THE CONNECTION
        }
    }

}
