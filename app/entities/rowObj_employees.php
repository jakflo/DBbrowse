<?php

namespace app\entities;


class rowObj_employees {
    public $emp_no;
    public $first_name;
    public $last_name;
    public $gender;
    public $title;
    public $yrs_wrk;
    
    public function __construct($emp_no, $first_name, $last_name, $gender, $title, $yrs_wrk) {
        $this->emp_no = $emp_no;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->gender = $gender;
        $this->title = $title;
        $this->yrs_wrk = $yrs_wrk;
    }
}
