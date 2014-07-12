<?php

namespace Fuel\Migrations;

class Create_dummy_total
{
	public function up()
	{
		\DBUtil::create_table('dummy_total', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'total' => array('constraint' => array(3,2), 'type' => 'decimal'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('dummy_total');
	}
}