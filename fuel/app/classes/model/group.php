<?php

class Model_Group extends \Orm\Model
{
	protected static $_properties = array(
		'id',
		'name',
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
	);

	protected static $_table_name = 'groups';
}