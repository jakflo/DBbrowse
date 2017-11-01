<?php

namespace App\Model;

use app\entities\DBwrap;
use app\entities\rowObj_employees;
use app\entities\rowObj_salaries;

class dbtManager {
   private $items_p_page;
   private $DBwrap;
   
   public function __construct($items_p_page) {
       $this->items_p_page = $items_p_page;
       $this->DBwrap = new DBwrap;
   }
   public function get_page_count() {
       $this->DBwrap->sendSQL("select count(*) as count from employees;", array());
       $pages = $this->DBwrap->fetch()["count"];
       $this->DBwrap->fetch();
       return $pages;
   }
   public function get_page($page) {
       $start_row = ($page - 1) * $this->items_p_page;
        $sql = "CREATE temporary TABLE `tmp2` (`emp_no` int(11) NOT NULL,
      `max_date` date, PRIMARY KEY (`emp_no`)) ENGINE=MEMORY DEFAULT CHARSET=utf8;";
        $this->DBwrap->sendSQL($sql,array());
        $sql = "CREATE temporary TABLE `tmp` (`emp_no` int(11) NOT NULL,
            PRIMARY KEY (`emp_no`)) ENGINE=MEMORY DEFAULT CHARSET=utf8;";
        $this->DBwrap->sendSQL($sql,array());
        $sql = "insert into tmp select emp_no from employees limit ?, ?;";
        $this->DBwrap->sendSQL_varType_forced($sql, array($start_row,$this->items_p_page), array("i","i"));
        $sql = "insert into tmp2 select emp_no, max(to_date) from titles t
            where t.emp_no in (select emp_no from tmp) group by emp_no;";
        $this->DBwrap->sendSQL($sql,array());
        $sql = "select e.emp_no, first_name, last_name, gender, title,
            round(DATEDIFF(DATE(NOW()),hire_date)/365.25,1) as yrs_wrk from employees e, titles t, tmp2
            where e.emp_no = tmp2.emp_no and t.emp_no = e.emp_no and t.to_date = tmp2.max_date;";
        $this->DBwrap->sendSQL($sql,array());
       $result = array();
       while ($row = $this->DBwrap->fetch()){
           $result[] = new rowObj_employees($row["emp_no"], $row["first_name"], $row["last_name"], $row["gender"], $row["title"], $row["yrs_wrk"]);
       }
       $this->DBwrap->sendSQL("drop temporary TABLE tmp;",array());
       $this->DBwrap->sendSQL("drop temporary TABLE tmp2;",array());
       return $result;
   }
   public function get_salaries($emp_no){
       $sql = "select year(s.to_date) as rok, salary as plat, title  from salaries s, employees e, titles t
                where e.emp_no = ?
                and e.emp_no = s.emp_no
                and e.emp_no = t.emp_no
                and s.to_date between t.from_date and t.to_date
                order by rok;";
       $this->DBwrap->sendSQL($sql, array($emp_no));
       $result = array();
       while ($row = $this->DBwrap->fetch()){
           if ($row["rok"] == 9999){$row["rok"] = 2002;}
           $result[] = new rowObj_salaries($row["rok"], $row["plat"], $row["title"]);
       }
       return $result;
   }
   public function get_name($empno){
       $this->DBwrap->sendSQL("select concat(first_name, ' ', last_name) as name from employees where emp_no = ?;"
               , array($empno));
       if ($name = $this->DBwrap->fetch()){
           return $name["name"];
       }
       else {return "";}
   }
}
