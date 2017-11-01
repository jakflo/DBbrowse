<?php
// source: C:\Program Files (x86)\Ampps\www\nette_db\app\presenters/templates/Dbt/showSalary.latte

use Latte\Runtime as LR;

class Templated41bfe603f extends Latte\Runtime\Template
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
		if (isset($this->params['row'])) trigger_error('Variable $row overwritten in foreach on line 14');
		Nette\Bridges\ApplicationLatte\UIRuntime::initialize($this, $this->parentName, $this->blocks);
		
	}


	function blockContent($_args)
	{
		extract($_args);
		if ($stat == "name_missing") {
?>
    <h1>Chybí číslo zaměstnance!</h1>
<?php
		}
		if ($stat == "not_found") {
			?>    <h1>Zaměstnanec <?php echo LR\Filters::escapeHtmlText($name) /* line 6 */ ?> nenalezen</h1>
<?php
		}
		if ($stat == "OK") {
			?>    <h1>Plat zaměstnance <?php echo LR\Filters::escapeHtmlText($name) /* line 9 */ ?></h1>
    <table class="norm_tab salary_mod">
        <tr>
            <th>Rok</th><th>Roční plat</th><th>Funkce</th>
        </tr>
<?php
			$iterations = 0;
			foreach ($rows as $row) {
?>
            <tr>
                <td><?php echo LR\Filters::escapeHtmlText($row->rok) /* line 16 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($row->plat) /* line 17 */ ?></td>
                <td><?php echo LR\Filters::escapeHtmlText($row->title) /* line 18 */ ?></td>
            </tr>
<?php
				$iterations++;
			}
?>
    </table>
<?php
		}
?>
<br>
<a href="/"><button>Zpět</button></a>
<?php
	}

}
