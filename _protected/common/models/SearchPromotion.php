<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblPromotion;
use himiklab\thumbnail\EasyThumbnailImage;
/**
 * SearchPromotion represents the model behind the search form about `common\models\TblPromotion`.
 */
class SearchPromotion extends TblPromotion
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['promotion', 'promotion_text', 'wef', 'wet', 'created', 'imageUrl'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TblPromotion::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'wef' => $this->wef,
            'wet' => $this->wet,
            'created' => $this->created,
        ]);

        $query->andFilterWhere(['like', 'promotion', $this->promotion])
            ->andFilterWhere(['like', 'promotion_text', $this->promotion_text])
            ->andFilterWhere(['like', 'imageUrl', $this->imageUrl]);

        return $dataProvider;
    }

    /**
     * Creates array of active Promotions
     *
     */
    public function getActive()
    {
        $today=date("Y-m-d");
        $result=[];
        $items=TblPromotion::find()->where(['<','wef',$today])->andwhere(['>=','wet',$today])->all();
        foreach ($items as $item){
            $img =SearchPromotion::getPromotionImage($item['id'],$item['imageUrl']);
            $pictureFile = $item['imageUrl'];
            $result[] =array('img'=> $img,'Title'=>$item['promotion'],'Message'=>$item['promotion_text'],'ID'=>$item['id']);
            }
        return $result;
        
    }

/*
RCM 19/11/2015
See if we have a large image stored locally if so return it if not generate the re-sized files and return 1
*/
    public static function getPromotionImage($id,$imgUrl)
    {
/*
Check if a file already exists in the productline folder
If not create one and populate it with the result of the image from the URL
*/
        $pictureFile = \Yii::getAlias('@webroot').strtolower('/promotion/'.$id.'/lg.jpg');
        $savefolder = \Yii::getAlias('@webroot').'/promotion/'.$id.'/';
       // die(var_dump($pictureFile));
// If the folder doesn't exist then create it
        if(!file_exists(dirname($pictureFile))&&$imgUrl>'')
            {
            mkdir(dirname($pictureFile), 0755, true);
// And then get the image from the Url supplied
            $imageUrl=str_replace("http://","",$imgUrl);
            $ch = curl_init('http://'.$imageUrl);
            $fp = fopen($pictureFile, 'wb');
            curl_setopt($ch, CURLOPT_FILE, $fp);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_exec($ch);
            curl_close($ch);
            fclose($fp);
            if(!file_exists($pictureFile)){
                //Image::thumbnail($pictureFile, 120, 120)->save($savefolder.'/tn.jpg', ['quality' => 90]);
                //Image::thumbnail($pictureFile, 300, 300)->save($savefolder.'/sm.jpg', ['quality' => 90]);
            }
        }

        $img=EasyThumbnailImage::thumbnailImg($pictureFile, 1200,500,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => 'Promotion','class'=>'img-rounded']);
        //die(var_dump($img));
        return $img;
    }


}
