<?php

namespace app\entities;

class rowObj_salaries {
    public $rok;
    public $plat;
    public $title;
    
    public function __construct($rok, $plat, $title) {
        $this->rok = $rok;
        $this->plat = $plat;
        $this->title = $title;
    }
}
