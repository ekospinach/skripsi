<?php

namespace Fuel\Migrations;

class Create_dummy_gap
{
	public function up()
	{
		\DBUtil::create_table('dummy_gap', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'0' => array('constraint' => 11, 'type' => 'int'),
			'1' => array('constraint' => 11, 'type' => 'int'),
			'2' => array('constraint' => 11, 'type' => 'int'),
			'3' => array('constraint' => 11, 'type' => 'int'),
			'4' => array('constraint' => 11, 'type' => 'int'),
			'5' => array('constraint' => 11, 'type' => 'int'),
			'6' => array('constraint' => 11, 'type' => 'int'),
			'7' => array('constraint' => 11, 'type' => 'int'),
			'8' => array('constraint' => 11, 'type' => 'int'),
			'9' => array('constraint' => 11, 'type' => 'int'),
			'10' => array('constraint' => 11, 'type' => 'int'),
			'11' => array('constraint' => 11, 'type' => 'int'),
			'12' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('dummy_gap');
	}
}