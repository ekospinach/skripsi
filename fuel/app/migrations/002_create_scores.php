<?php

namespace Fuel\Migrations;

class Create_scores
{
	public function up()
	{
		\DBUtil::create_table('scores', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'student_id' => array('constraint' => 11, 'type' => 'int', 'unsigned' => true),
			'raport_pai' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'raport_bin' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'raport_big' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'raport_mtk' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'raport_ipa' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'raport_ips' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'un_bin' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'un_big' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'un_mtk' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'un_ipa' => array('constraint' => array(4,2), 'type' => 'decimal'),
			'tpa' => array('constraint' => 3, 'type' => 'int'),
			'bta' => array('constraint' => 3, 'type' => 'int'),
			'iq' => array('constraint' => 3, 'type' => 'int'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('scores');
	}
}