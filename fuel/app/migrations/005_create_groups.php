<?php

namespace Fuel\Migrations;

class Create_groups
{
	public function up()
	{
		\DBUtil::create_table('groups', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'name' => array('constraint' => 10, 'type' => 'varchar'),
			'raport_pai' => array('constraint' => 11, 'type' => 'int'),
			'raport_bin' => array('constraint' => 11, 'type' => 'int'),
			'raport_big' => array('constraint' => 11, 'type' => 'int'),
			'raport_mtk' => array('constraint' => 11, 'type' => 'int'),
			'raport_ipa' => array('constraint' => 11, 'type' => 'int'),
			'raport_ips' => array('constraint' => 11, 'type' => 'int'),
			'un_bin' => array('constraint' => 11, 'type' => 'int'),
			'un_big' => array('constraint' => 11, 'type' => 'int'),
			'un_mtk' => array('constraint' => 11, 'type' => 'int'),
			'un_ipa' => array('constraint' => 11, 'type' => 'int'),
			'tpa' => array('constraint' => 11, 'type' => 'int'),
			'bta' => array('constraint' => 11, 'type' => 'int'),
			'iq' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('groups');
	}
}