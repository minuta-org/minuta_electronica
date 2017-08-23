<?php 

namespace app\components\web;

use yii\base\Widget;
use yii\helpers\Html;

class WSideNavBar extends Widget
{
	public $options = [];
	public $photo = null;
	public $title = '';
	public $subtitle = '';
	public $searchField = null;
	public $search = true;
	public $searchUrl = ['site/index'];

	private $header;
	private $nav;


	public function init()
	{

	}

	public function run()
	{
		$this->buildHeader();
		$this->buildNav();
		return $this->joinNav();
	}

	private function buildHeader()
	{
		$headerContent = '';
		$this->buildPhoto($headerContent);
		$this->buildSearch($headerContent);
		$this->header = Html::tag('div', $headerContent, ['class' => 'nav-header']);
		$this->nav = $this->buildNav();
	}

	private function buildPhoto(&$headerContent)
	{
		if($this->photo == null) $photo = '';
		else $photo = Html::tag('div', Html::img($this->photo), ['class' => 'photo']);
		$title = Html::tag('p', $this->title, ['class' => 'title']);
		$subtitle = Html::tag('p', $this->subtitle);
		$data = Html::tag('div', $title . $subtitle, ['class' => 'data']);
		$headerContent .= Html::tag('div', $photo . $data, ['class' => 'user-info']);
		$headerContent .= Html::tag('div', '', ['class' => 'simple-separator']);
	}

	private function buildSearch(&$headerContent)
	{
		if(!$this->search) return false;
		$input = $this->searchField != null? $this->searchField : 
				Html::textInput('search-nav', '', ['class' => 'form-control', 'placeholder' => 'Buscar...']);
		$i = Html::tag('i', '', ['class' => 'fa fa-search']);
		$form = Html::tag('form', $input . $i);				
		$headerContent .= Html::tag('div', $form, ['class' => 'nav-search']);
	}

	private function buildNav()
	{
		$options = $this->buildOptions($this->options);
		$this->nav = Html::tag('ul', $options, ['class' => 'nav']);
	}

	private function buildOptions($options, $subMenu = false)
	{
		$items = [];
		foreach($options AS $option) {
			$label = isset($option['label'])? $option['label'] : '';
			$url = isset($option['url'])? $option['url'] : '#';
			$i = isset($option['i']) && $option['i'] != null? Html::tag('i', '', ['class' => "fa fa-" . $option['i']]) : '';
			if(is_string($url) && $url != "#") $url = [$url];
			if(isset($option['items']) && !$subMenu){
				$subMenuItems = $this->buildOptions($option['items'], true);
				$caret = Html::tag('span', '', ['class' => 'fa fa-chevron-right']);
				$link = Html::a($i . " " . $label . $caret, $url);
				$li = Html::tag('li', $link . $subMenuItems, ['class' => 'dropdown']);
			} else {
				$link = Html::a($i . " " . $label, $url);
				$li = Html::tag('li', $link);
			}
			$items[] = $li;
		}
		$menu = implode('', $items);		
		if($subMenu){
			return Html::tag("ul", $menu, ['class' => 'submenu', 'style' => 'display:none']);
		} 
		return $menu;
	}

	private function joinNav()
	{
		$nav = Html::tag('nav', $this->header . $this->nav, ['class' => 'main-side-nav-bar']);
		return Html::tag('div', $nav, ['class' => 'side-nav-bar-container']);
	}
}