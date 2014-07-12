<?php

class Model_Result extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'student_id',
		'raport_1',
		'un_1',
		'umum_1',
		'total_1',
		'raport_2',
		'un_2',
		'umum_2',
		'total_2',
		'created_at',
		'updated_at',
	);

	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
	);

	protected static $_table_name = 'results';

	protected static $_belongs_to = array('student');
}
