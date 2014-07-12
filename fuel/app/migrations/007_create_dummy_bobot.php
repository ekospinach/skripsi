<?php

namespace Fuel\Migrations;

class Create_dummy_bobot
{
	public function up()
	{
		\DBUtil::create_table('dummy_bobot', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'0' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'1' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'2' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'3' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'4' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'5' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'6' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'7' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'8' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'9' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'10' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'11' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'12' => array('constraint' => array(3,2), 'type' => 'decimal'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('dummy_bobot');
	}
}