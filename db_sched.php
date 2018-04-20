<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 4.7.0
 */

/**
 * Database `db_sched`
 */

/* `db_sched`.`accounts` */
$accounts = array(
  array('Account_ID' => '1','Employee_ID' => '2122','Acc_Uname' => 'marserrano','Acc_Pass' => '1234','acc_type' => 'admin','count' => '0'),
  array('Account_ID' => '3','Employee_ID' => '123','Acc_Uname' => 'marjaygab1','Acc_Pass' => '123456','acc_type' => 'user','count' => '0'),
  array('Account_ID' => '4','Employee_ID' => '678','Acc_Uname' => 'mishelkate','Acc_Pass' => '12345','acc_type' => 'admin','count' => '0'),
  array('Account_ID' => '5','Employee_ID' => '2014164791','Acc_Uname' => 'alaindannpaciteng','Acc_Pass' => 'nexus777esports','acc_type' => '','count' => '0'),
  array('Account_ID' => '123456','Employee_ID' => '1234567890','Acc_Uname' => 'user','Acc_Pass' => 'password','acc_type' => 'user','count' => '0'),
  array('Account_ID' => '123457','Employee_ID' => '914','Acc_Uname' => 'mikaaguilar','Acc_Pass' => 'mikamaganda','acc_type' => '','count' => '0')
);

/* `db_sched`.`announcements` */
$announcements = array(
  array('announcements' => '','ID' => '0'),
  array('announcements' => '-This is where your announcement go!!!                  ','ID' => '1')
);

/* `db_sched`.`employee` */
$employee = array(
  array('Employee_ID' => '2122','Emp_FN' => 'Mar','Emp_LN' => 'Serrano','Emp_Address' => 'Sampaguita','Emp_Age' => '20','Emp_Department' => 'CpE','Emp_Email' => 'mar@gmail.com','Emp_Gender' => 'Male','Emp_CNumber' => '639208434262','Emp_Photo' => '59641db9ac.jpg'),
  array('Employee_ID' => '123','Emp_FN' => 'Marjay','Emp_LN' => 'Tapay','Emp_Address' => '085,','Emp_Age' => '19','Emp_Department' => 'Technical','Emp_Email' => 'tapaymarjay@gmail.com','Emp_Gender' => 'Male','Emp_CNumber' => '639153591108','Emp_Photo' => '325974483e.jpg'),
  array('Employee_ID' => '1234567890','Emp_FN' => 'alain','Emp_LN' => 'dann','Emp_Address' => 'alaindannpaciteng@gmail.com','Emp_Age' => '20','Emp_Department' => '','Emp_Email' => 'alaindannpaciteng@gmail.com','Emp_Gender' => 'men','Emp_CNumber' => '','Emp_Photo' => '')
);

/* `db_sched`.`tbl_room` */
$tbl_room = array(
  array('room_id' => '699','emp_id' => '1234','time_in' => '09:00:00','time_out' => '09:01:00','date' => '2018-04-03','u_code' => '17074','Status' => '1','time_millis' => '60000')
);

/* `db_sched`.`tbl_sched` */
$tbl_sched = array(
  array('id' => '29','room_id' => '699','emp_id' => '1234','time_in' => '09:00:00','time_out' => '09:01:00','date' => '2018-04-03','u_code' => '17074','Status' => '1'),
  array('id' => '30','room_id' => '699','emp_id' => '123','time_in' => '01:00:00','time_out' => '03:00:00','date' => '2018-11-01','u_code' => '52039','Status' => '1'),
  array('id' => '31','room_id' => '699','emp_id' => 'reado','time_in' => '03:22:00','time_out' => '05:33:00','date' => '2019-04-01','u_code' => '91554','Status' => '1')
);
