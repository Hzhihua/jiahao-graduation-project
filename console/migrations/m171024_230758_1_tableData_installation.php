<?php

use hzhihua\dump\Migration;

/**
 * Class m171024_230758_1_tableData_installation
 * @property yii\db\Transaction $_transaction
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class m171024_230758_1_tableData_installation extends Migration
{

	/**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $this->_transaction = $this->getDb()->beginTransaction();
        $this->batchInsert('{{%installation}}', 
            ['id', 'title', 'content', 'author_id', 'created_at', 'updated_at'], 
            [
                ['1', '我的文章哎', '<img src="images/i/f17.jpg" alt="" class="blog-entry-img blog-article-margin">
<p>
    炊烟 <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;／阿城 <br/><br/>


 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张得了一个闺女。老张说，挺好，就是大了别长得像我，那可嫁不出去了。因此，女儿名美丽，自然姓张。

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张的大学同学都说，叫个美丽，没什么不好，就是俗了点。老张你也是读过书的人，怎么不能想个雅点儿的呢？ &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张说，俗有什么不好？实惠。这年头你还想怎么着？结结实实的吧。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张的同学说，结实？那叫矿石好了，叫火成岩，水成岩也成。咱们这行就是学了个结实。<br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张在大学读的地质。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张疼闺女。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张抽烟。<br/><br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张的老婆说，你要想要孩子，就把烟忌了，书上说，大人抽烟，会影响胎儿的基因。老张正抽到了一半儿，马上扔掉，用脚碾灭，戒了。美丽生出来了，老张买了一包烟。老张的老婆说，你叫美丽从小肺就是黑的吗？老张凄凄的样子。老张的老婆说，你抽吧，别在美丽的旁边儿抽。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;美丽是冬天生的。春天了，老张的老婆抱着美丽出来晒太阳。起风了，老张说，还不回去，看吹着。老张的老婆说，不晒太阳，美丽吃的钙根本就吸收不了。老张说，那就屋里窗户边儿上晒嘛。老张的老婆说，紫外线透不过玻璃，人体吸收钙，靠的就是个紫外线，隔着玻璃，还不是白晒。老张说，那就等风停了。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张瞧着老婆给美丽喂奶。老张的老婆书也念得不少，瞧老张老盯着，说，还没瞧够呀，又不是没瞧过。老张说，谁瞧你了，我是怕美丽吃不饱。俩人都笑了，美丽换过一口气，也笑了。 <br/><br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;秋天了，美丽大了点儿，手会指东西，指妈妈，指爸爸，还会抓耳朵，抓妈妈的头发，抓爸爸的鼻子。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;有一天，老张的老婆抱着美丽，老张在旁边挤眉弄眼，逗得美丽嘎嘎乐，两只小手儿奓着。老张的老婆把美丽凑到老张的脸前，美丽的手就伸进爸爸的嘴里。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;说时迟，那时快，老张抬手就是一掌，把母女两个打了个趔趄。老张在地质队，天天握探锤打石头，手上总有百来斤的力气。老张的老婆没有提防，就跌到了。到底是母亲，着地的关头，一扭身仰着将美丽抓在胸口。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;美丽大哭。老张的老婆脑后淌出血来，从来没有骂过人的人，骂人了，老张的老婆骂老张。<br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张呆了，浑身哆嗦着，喘不出气来，汗从头上淌进领子里。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;老张进了医院，两天一夜，才说出话来—— <br/><br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;六零年，闹饥荒，饿死人，全国都闹，除了云南。那年，我毕业实习，进山找矿。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;后来，我迷路了。有指南针，没用。我饿，我饿呀。慌，心慌，一慌就急。本来还会想，这下完了。一直就吃不够，体力差，肝里的糖说耗完就耗完。后来就出汗，后来汗也不出了。什么也不敢想，用脑子最消耗热量了。躺着。胃里冒酸水儿，杀得牙软。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;后来，从肚子开始发热，脚心，脖子，指头尖儿，越来越烫。安徒生不是写过个卖火柴的小女孩儿吗？这个丹麦的老东西，他写得对。人饿死前，就是发热，热过了，就是死。 <br/>
 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;我没死。死了怎么还能跟你结婚？怎么还能有美丽？ <br/><br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;我醒的时候，好半天才看得清东西。我瞧见远处有烟。当时，我只有一个念头儿，烧饭才会有烟。爬吧。<br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;就别说怎么才爬到了吧。到了，是个人家。我趴在门口说，救个命吧，给口吃的吧。没人应。对，可能我的声音太小。我进去了。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;灶前头靠着个人瘦得牙龇着，眼睛亮得吓人。我说，给口吃的。那人半天才摇摇头。我说，你就是我爷爷，祖宗，给口吃的吧。那人还是摇头。我说，你是说没有吗？那你这灶上烧的什么？喝口热水也行啊。那人眼泪就流下来了。 <br/>

 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;我不管了，伸手就把锅盖揭了。水气散了，我看见了，锅里煮着个小孩儿的手。 &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
</p>', '1', '123', '123'],
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
