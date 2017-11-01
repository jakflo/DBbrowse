<?php

namespace App\Presenters;
use Nette\Application\UI;
use Nette\Application\UI\Form;
use Nette\Utils\Validators;
use Nette\Http\Session;
use Nette\Http\SessionSection;

use App\Model\dbtManager;


class DbtPresenter extends UI\Presenter {
    protected $curr_page;
    protected $items_p_page;
    protected $dbtManager;
    public function renderDefault() {
        $session = $this->getSession();
        $mySection = $this->getSession('mySection');
        if (!isset($mySection->items_p_page)){$mySection->items_p_page = 20;}
        if (!isset($this->dbtManager)){$this->dbtManager = new dbtManager($mySection->items_p_page);}
        $mySection->pages = ceil($this->dbtManager->get_page_count() / $mySection->items_p_page);
        if (!isset($this->curr_page)){$this->curr_page = 1;}
        $rows = $this->dbtManager->get_page($this->curr_page);
        $this->template->pages = $mySection->pages;
        $this->template->rows = $rows;
        $this->template->curr_page = $this->curr_page;
        $this->template->items_p_page_list = array(10,20,50);
        $this->template->curr_items_p_page = $mySection->items_p_page;
    }
    protected function createComponentFormPage() {
        $FormPage = new UI\Form;
        $FormPage->addText("page", "",6);
        $FormPage->addSubmit("subm", "hop!");
        $FormPage->onSuccess[] = [$this, 'FormPage_proc'];
        return $FormPage;
    }
    public function FormPage_proc(UI\Form $FormPage, $values) {
        if (Validators::isnumericint($values["page"])){$this->curr_page = $values["page"];}
        else {$this->curr_page = 1;}
        $session = $this->getSession();
        $mySection = $this->getSession('mySection');
        $pages = $mySection->pages;
        if ($this->curr_page < 1 or $this->curr_page > $pages){$this->curr_page = 1;}
    }
    public function HandleChangePerPage($newPP){
        if (!in_array($newPP, array(10,20,50))){return;}
        $session = $this->getSession();
        $mySection = $this->getSession('mySection');
        $mySection->items_p_page = (int)$newPP;
        $this->redirect('Dbt:default');
    }
    public function renderShowSalary($empno) {
        $stat = "OK";
        $name = "";
        if (!isset($empno)){$stat = "name_missing";}
        if (!isset($this->dbtManager)){$this->dbtManager = new dbtManager(25);}
        if ($stat == "OK"){$name = $this->dbtManager->get_name($empno);}
        if ($name == "" and $stat == "OK"){$stat = "not_found";}
        if ($stat == "OK"){$rows = $this->dbtManager->get_salaries($empno);}
        $this->template->stat = $stat;
        if ($stat != "name_missing"){$this->template->name = $name;}
        if ($stat == "OK"){$this->template->rows = $rows;}
    }
    
}
