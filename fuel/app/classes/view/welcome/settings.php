<?php

class View_Welcome_Settings extends ViewModel
{
	public function view()
	{
		$setting = Model_Setting::find(1);
		$fieldset = Fieldset::forge()->add_model($setting)->populate($setting);
		$form = $fieldset->form();
		$form->add('submit', '&nbsp;', array('type' => 'submit', 'value' => 'Simpan Perubahan', 'class' => 'btn btn-lg btn-success pull-right'));

		$this->set('settings', $form->build(), false);
	}
}