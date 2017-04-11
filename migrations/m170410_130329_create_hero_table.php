<?php

use yii\db\Migration;

/**
 * Handles the creation of table `hero`.
 */
class m170410_130329_create_hero_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('hero', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'avatar' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('hero');
    }
}
