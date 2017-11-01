<?php
// source: C:\Program Files (x86)\Ampps\www\nette_db\app\presenters/templates/Dbt/default.latte

use Latte\Runtime as LR;

class Template719a3bf6a0 extends Latte\Runtime\Template
{
	public $blocks = [
		'content' => 'blockContent',
	];

	public $blockTypes = [
		'content' => 'html',
	];


	function main()
	{
		extract($this->params);
		if ($this->getParentName()) return get_defined_vars();
		$this->renderBlock('content', get_defined_vars());
		return get_defined_vars();
	}


	function prepare()
	{
		extract($this->params);
		if (isset($this->params['row'])) trigger_error('Variable $row overwritten in foreach on line 7');
		if (isset($this->params['ipp'])) trigger_error('Variable $ipp overwritten in foreach on line 27');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
?>
<h1>Seznam zaměstnanců</h1>
<table id="empee_tab" class="norm_tab">
    <tr>
        <th>Osobní číslo</th><th>Jméno</th><th>Příjmení</th><th>Pohlaví</th><th>Funkce</th><th>Pracuje let</th>
    </tr>
<?php
		$iterations = 0;
		foreach ($rows as $row) {
?>
        <tr>
            <td><?php echo LR\Filters::escapeHtmlText($row->emp_no) /* line 9 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($row->first_name) /* line 10 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($row->last_name) /* line 11 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($row->gender) /* line 12 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($row->title) /* line 13 */ ?></td>
            <td><?php echo LR\Filters::escapeHtmlText($row->yrs_wrk) /* line 14 */ ?></td>
        </tr>
<?php
			$iterations++;
		}
?>
</table>
<br>
<?php
		$form = $_form = $this->global->formsStack[] = $this->global->uiControl["formPage"];
		?><form class="form"<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormBegin(end($this->global->formsStack), array (
		'class' => NULL,
		), false) ?>>
    <input value=<?php echo LR\Filters::escapeHtmlAttrUnquoted($curr_page) /* line 20 */ ?> style="text-align:right;"<?php
		$_input = end($this->global->formsStack)["page"];
		echo $_input->getControlPart()->addAttributes(array (
		'value' => NULL,
		'style' => NULL,
		))->attributes() ?>> z <?php echo LR\Filters::escapeHtmlText($pages) /* line 20 */ ?>

    <input class="btn btn-default"<?php
		$_input = end($this->global->formsStack)["subm"];
		echo $_input->getControlPart()->addAttributes(array (
		'class' => NULL,
		))->attributes() ?>>
    <button onclick="turn_page('prev')">&lt;</button>
    <button onclick="turn_page('next')">&gt;</button>
    <button onclick="show_sals()" id="sals_btn" disabled>Ukázat plat</button>
<?php
		echo Nette\Bridges\FormsLatte\Runtime::renderFormEnd(array_pop($this->global->formsStack), false);
?></form>
<div id='items_per_page_select'>
<?php
		$iterations = 0;
		foreach ($items_p_page_list as $ipp) {
			if ($ipp == $curr_items_p_page) {
				?>            <b><?php echo LR\Filters::escapeHtmlText($ipp) /* line 29 */ ?></b>
<?php
			}
			else {
				?>            <a href='/dbt?do=changePerPage&newPP=<?php echo LR\Filters::escapeHtmlAttr(LR\Filters::safeUrl($ipp)) /* line 31 */ ?>' id="lnk"><?php
				echo LR\Filters::escapeHtmlText($ipp) /* line 31 */ ?></a>
<?php
			}
			$iterations++;
		}
?>
</div>
<a href="" id="sally" style="visibility: hidden;">sally</a>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    var curr_page = <?php echo LR\Filters::escapeJs($curr_page) /* line 38 */ ?>;
    var pages = <?php echo LR\Filters::escapeJs($pages) /* line 39 */ ?>;
    var empno_selected;
</script>
<script src="/js/main_template.js"></script>
<?php
	}

}
