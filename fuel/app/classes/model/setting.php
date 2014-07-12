<?php

class Model_Setting extends \Orm\Model
{
	protected static $_table_name = 'settings';

	protected static $_properties = array(
		'id',
		'core' => array(
			'data_type' => 'int',
			'label' => 'Core Factor',
			'validation' => array('required', 'numeric_between' => array(0, 100)),
			'form' => array('type' => 'text', 'class' => 'form-control', 'required'),
		),
		'secondary' => array(
			'data_type' => 'int',
			'label' => 'Secondary Factor',
			'validation' => array('required', 'numeric_between' => array(0, 100)),
			'form' => array('type' => 'text', 'class' => 'form-control', 'required'),
		),
		'raport' => array(
			'data_type' => 'int',
			'label' => 'Kriteria Raport',
			'validation' => array('required', 'numeric_between' => array(0, 100)),
			'form' => array('type' => 'text', 'class' => 'form-control', 'required'),
		),
		'un' => array(
			'data_type' => 'int',
			'label' => 'Kriteria UN',
			'validation' => array('required', 'numeric_between' => array(0, 100)),
			'form' => array('type' => 'text', 'class' => 'form-control', 'required'),
		),
		'umum' => array(
			'data_type' => 'int',
			'label' => 'Kriteria Umum',
			'validation' => array('required', 'numeric_between' => array(0, 100)),
			'form' => array('type' => 'text', 'class' => 'form-control', 'required'),
		),
	);
}