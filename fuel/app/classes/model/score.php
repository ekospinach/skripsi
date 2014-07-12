<?php

class Model_Score extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'student_id',
		'raport_pai',
		'raport_bin',
		'raport_big',
		'raport_mtk',
		'raport_ipa',
		'raport_ips',
		'un_bin',
		'un_big',
		'un_mtk',
		'un_ipa',
		'tpa',
		'bta',
		'iq',
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

	protected static $_table_name = 'scores';

	protected static $_belongs_to = array('student');
}
