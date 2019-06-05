<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%colaborador}}`.
 */
class m190605_000137_create_colaborador_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('colaborador', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(50)->notNull(),
            'local_foto' => $this->string(50)->notNull(),
            'nome_foto' => $this->string(50)->notNull(),
            'data_foto' => $this->date()->notNull(),
            'foto' => $this->string(50)->notNull(),
            'termos' => $this->boolean()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('colaborador');
    }
}
