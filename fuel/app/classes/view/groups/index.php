<?php

class View_Groups_Index extends ViewModel
{
	public function view()
	{
		$groups = Model_Group::find('all');

		$this->groups = $groups;
	}
}