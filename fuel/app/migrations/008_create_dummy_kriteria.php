<?php

namespace Fuel\Migrations;

class Create_dummy_kriteria
{
	public function up()
	{
		\DBUtil::create_table('dummy_kriteria', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'raport' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'un' => array('constraint' => array(3,2), 'type' => 'decimal'),
			'umum' => array('constraint' => array(3,2), 'type' => 'decimal'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('dummy_kriteria');
	}
}