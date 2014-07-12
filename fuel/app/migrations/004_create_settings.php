<?php

namespace Fuel\Migrations;

class Create_settings
{
	public function up()
	{
		\DBUtil::create_table('settings', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'core' => array('constraint' => 11, 'type' => 'int'),
			'secondary' => array('constraint' => 11, 'type' => 'int'),
			'raport' => array('constraint' => 11, 'type' => 'int'),
			'un' => array('constraint' => 11, 'type' => 'int'),
			'umum' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('settings');
	}
}