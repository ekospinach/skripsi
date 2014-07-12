<?php

namespace Fuel\Migrations;

class Create_results
{
	public function up()
	{
		\DBUtil::create_table('results', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'student_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'raport_1' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'un_1' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'umum_1' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'total_1' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'raport_2' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'un_2' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'umum_2' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'total_2' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('results');
	}
}