<?php

use yii\db\Migration;

/**
 * Class m180522_021334_category_table
 */
class m180522_021334_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('kategori', [
            'id' => $this->primaryKey(),
            'nama' => $this->string(255),
        ]);

        // path tempat file csv berada
        $kategori = Yii::getAlias('@app/migrations/kategori.csv');
        
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($kategori);

        foreach ($reader as $index => $row) {
            $this->insert('kategori', [
            'id' => (int)$row[0],
            'nama' => $row[1],
            ]);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $kategori = Yii::getAlias('@app/migrations/kategori.csv');
        
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($kategori);
        
        // hapus data provinsi dari tabel provinsi
        foreach ($reader as $index => $row) {
            $this->delete('kategori', ['id' => (int)$row[0]]);
            
        }
        $this->dropTable('kategori');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180522_021334_category_table cannot be reverted.\n";

        return false;
    }
    */
}
