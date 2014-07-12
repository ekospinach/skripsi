<?php

class Model_Student extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
		'group_1',
		'group_2',
		'suggestion',
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
	protected static $_table_name = 'students';

	protected static $_has_one = array('score', 'result');
}
