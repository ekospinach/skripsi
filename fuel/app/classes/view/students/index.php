<?php

class View_Students_Index extends ViewModel
{
	public function view()
	{
		$students = Model_Student::find('all', array('related' => array('score', 'result')));

		$this->students = $students;
	}
}