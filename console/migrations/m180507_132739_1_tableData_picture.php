<?php

use hzhihua\dump\Migration;

/**
 * Class m180507_132739_1_tableData_picture
 * @property \yii\db\Transaction $_transaction
 * @Github https://github.com/Hzhihua
 */
class m180507_132739_1_tableData_picture extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%picture}}', 
            ['id', 'file_key', 'new_name', 'origin_name', 'size', 'extension', 'type', 'new_directory', 'created_at', 'updated_at'],
            [
                [13, '5aed0c329e524', '274c80e5671846ed3867f372ce03d179', '2', 37427, 'png', 'image/png', '05/05/2018', 1525484594, 1525484594],
                [14, '5aed0c6c5856b', 'c32f1b33ca4f9657a2a9ac54ed2c421d', '194fccecc31d3d654d4106055a2d58de _1_', 37427, 'png', 'image/png', '05/05/2018', 1525484652, 1525484652],
                [16, '5aed0e2aba986', 'b764c647ac7be5efb78a861434d82489', '2', 37427, 'png', 'image/png', '05/05/2018', 1525485098, 1525485098],
                [17, '5aed0e514113c', 'new_file_name', '1', 37427, 'png', 'image/png', '/a/b/c/', 1525485137, 1525485137],
                [18, '5aed1394b3a63', 'new_file_name', '2', 37427, 'png', 'image/png', '/a/b/c/', 1525486484, 1525486484],
                [19, '5aed1424de6d8', 'new_file_name', '2', 37427, 'png', 'image/png', '/a/b/c/', 1525486628, 1525486628],
                [20, '5aed15b504240', 'new_file_name', '2', 37427, 'png', 'image/png', '/a/b/c/', 1525487028, 1525487028],
                [21, '5aed16165f2a6', 'new_file_name', '2', 37427, 'png', 'image/png', '/a/b/c/', 1525487126, 1525487126],
                [22, '5aed162782309', 'new_file_name', '1', 37427, 'png', 'image/png', '/a/b/c/', 1525487143, 1525487143],
                [23, '5aed4e9e84003', '21bf32d95adf4f5459b2ed045af1c81d', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '05/05/2018', 1525501598, 1525501598],
                [24, '5aed4f35c1211', 'd9a4effa7234417d871191bb7596a5b9', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '05/05/2018', 1525501749, 1525501749],
                [25, '5aed4f4554833', '4c041f6a52edd95da01e21a82a1f0d9e', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '05/05/2018', 1525501765, 1525501765],
                [26, '5aed4fb2b0623', '4d5b9ebc4e0da363fb6122c40a9c48b7', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '05/05/2018', 1525501874, 1525501874],
                [27, '5aed50186784c', '9543311d7eda0d4ff755ba927c15ecf2', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '05/05/2018', 1525501976, 1525501976],
                [29, '5aed546c79e8e', '51b3f744dd615296eae81c1dde0dfbdd', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '05/05/2018', 1525503084, 1525503084],
                [30, '5aed587faa1d7', '8f623d20d25fdba115e7c7069c96d70b', '深度截图_选择区域_20180505141941 _1_', 1358127, 'png', 'image/png', '05/05/2018', 1525504127, 1525504127],
                [31, '5aed58aa2a628', '38ed2b9506724544a1b08287ee080c88', '深度截图_选择区域_20180505141941 _1_', 1358127, 'png', 'image/png', '05/05/2018', 1525504170, 1525504170],
                [32, '5aed5a7240f05', '0658ebc2d7cef74a7c13b8d9a32d12ba', '深度截图_选择区域_20180505141941 _1_', 1358127, 'png', 'image/png', '05/05/2018', 1525504626, 1525504626],
                [33, '5aee9bf83cf8c', '4fda657cf216b756cc5fcb7312227120', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '06/05/2018', 1525586936, 1525586936],
                [34, '5aeea159deac8', '4d628dd01dc9938937374ace88c84f0c', '深度截图_选择区域_20180505141941 _1_', 1358127, 'png', 'image/png', '06/05/2018', 1525588313, 1525588313],
                [35, '5aeeaca3b2b2c', '97cea45ff8465662d21cab1f28222cd6', '深度截图_选择区域_20180505141941', 1358127, 'png', 'image/png', '06/05/2018', 1525591203, 1525591203],
                [36, '5aeeaecad05ac', '1ae7f0716e49cf5a8a6da8427fa7fe26', '1', 37427, 'png', 'image/png', '06/05/2018', 1525591754, 1525591754],
            ]
        );
        $this->_transaction->commit();

    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        
        $this->_transaction->rollBack();

    }
}
