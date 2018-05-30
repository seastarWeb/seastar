<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TblProductLines;
use common\models\TblModelRange;
use yii\db\Query;
use himiklab\thumbnail\EasyThumbnailImage;
/**
 * ProductLineSearch represents the model behind the search form about `app\models\TblProductLines`.
 */
class ProductLineFuzzy  extends Model
{
        public $SearchTerm;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['SearchTerm'], 'safe'],
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
      
        $this->load($params);
        $query = TblProductLines::find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        if (isset($params['SearchTerm'])){
        $query->where(['like', 'ProductLine', $params['SearchTerm']])
            ->orwhere(['like', 'Department', $params['SearchTerm']])
            ->orwhere(['like', 'Category', $params['SearchTerm']])
            ->orwhere(['like', 'SubCategory', $params['SearchTerm']])
            ->orwhere(['like', 'Description', $params['SearchTerm']])
            ->orwhere(['like', 'Colours', $params['SearchTerm']]);
        }
        //$this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
             $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }

    public function getAccessories()
    {
        $query = TblProductLines::find()->where(['=', 'Department', 'Accessories']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
//        $query->andFilterWhere(['=', 'Department', 'Accessories'])
//            ->andFilterWhere(['=', 'Brand', 'Ducati'])->distinct('Category')
    //    $query->groupBy(['Category']);

        return $dataProvider;        
    }

    public function getKawasakiClothingCatsDP()
    {
        $query = TblProductLines::find()->distinct(['category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Clothing'])
            ->andFilterWhere(['=', 'Brand', 'Kawasaki'])->distinct('Category')
            ->andFilterWhere(['=', 'Active', true])
        ->groupBy(['Category']);

        return $dataProvider;
    }

    public function getKawasakiAccessoryCatsDP()
    {
        $query = TblProductLines::find()->distinct(['category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Accessories'])
            ->andFilterWhere(['=', 'Brand', 'Kawasaki'])->distinct('Category')
        ->groupBy(['Category']);

        return $dataProvider;
    }

    public function getKawasakiAccessories()
    {
        $query = TblProductLines::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Accessories'])
            ->andFilterWhere(['=', 'Brand', 'Kawasaki']);

        return $dataProvider;
    }

    public function getDucatiAccessoryDP()
    {
        $query = TblProductLines::find()->distinct(['category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Accessories'])
            ->andFilterWhere(['=', 'Brand', 'Ducati'])->distinct('Category')
        ->groupBy(['Category']);

        return $dataProvider;
    }
    public function categories()
    {
        $query = TblProductLines::find()->distinct(['category']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Clothing'])
            ->andFilterWhere(['=', 'Brand', 'Ducati'])->distinct('Category')
        ->groupBy(['Category']);

    return $dataProvider;
    }  
    
    public function getDistinctCategories()
    {
        $query = TblProductLines::find()->distinct(['category'])
        ->select(['Category'])
        ->asArray()
        ->orderBy('Category')
        ->all();;
        return $query;
    }  
    
    public function getDistinctBrands()
    {
        $query = TblProductLines::find()->distinct(['brand'])
        ->select(['Brand'])
        ->asArray()
        ->orderBy('Brand')
        ->all();
        return $query;
    }  
   public function getDucatiAccessoryCategories()
    {
        $query = TblProductLines::find()->distinct(['Category'])->where("Brand='Ducati'")->andwhere("Department='Accessories'")
        ->select(['Category'])
        ->asArray()
        ->orderBy('Category')
        ->all();
        return $query;
    }  
    

    public function SubCategories($params)
    {
        $query = TblProductLines::find();
        $this->load($params);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $query->andFilterWhere(['=', 'Department', 'Clothing'])
            ->andFilterWhere(['=', 'Brand', 'Ducati'])
            ->andFilterWhere(['like', 'Category',$this->Category ]);//->distinct('SubCategory')
        //->groupBy(['SubCategory']);
    return $dataProvider;
    }  

    
    
    /*
     * Function to retrieve associated partnumbers
     * Accepts product line as text input
     * Returns associated parts to Superceded partno
     *  */
    public function getPartNumbers($pline)
    {
    $bits=ProductLineSearch::find()->select('PartNumbers')
        ->where(['Url'=>$pline])
        ->asArray()
        ->all();
    $qry=explode(',',implode(',',$bits[0]));
    $parts=SearchParts::find()->select ('PARTNO,REFERNO,DESCRIPTION,PRICE,partid,STOCK_LEVEL')
        ->where(['IN','PARTNO',$qry])
        ->andWhere("REFERNO = ''")
        ->all();
    return $parts;
    }

/*
*Function to find Model Fitment
*Input ProductLineID returns array of models this product line is fitted to.
*/
public function getModelsFitted($toFit){
    $pl=$toFit[0]['id'];
    $query=new query;
    $query->select(['partnumber', 'model_description','year'])
        ->from('tbl_partmodel')
        ->join('INNER JOIN','tbl_models','model_id = tbl_models.id')
        ->join('INNER JOIN','tbl_model_range','model_range_id = tbl_model_range.`id`')
        ->where('FIND_IN_SET(partnumber,(SELECT PartNumbers FROM tbl_product_lines WHERE tbl_product_lines.id = '.$pl.'))') ;
        $rows = $query->all();
    return $rows;
    }

/*
*Function to find all product lines associated with a motorcycle Model
*Input model id - returns array of products fitted
*/
    public function getPartsForModelRange($mr){
        $products=[];
        $items=TblProductLines::find()
        ->where('FIND_IN_SET(PartNumbers,(SELECT GROUP_CONCAT(DISTINCT partnumber) FROM tbl_partmodel WHERE model_id IN (Select id from tbl_models where model_range_id='.$mr.')))')
        ->all();

        foreach ($items as $item) {
             $pictureFile='backend/uploads/images/'.strtolower($item['Brand']).$item['DefaultImage'];
             $img=EasyThumbnailImage::thumbnailImg($pictureFile, 200,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $item['ProductLine'],'class'=>'img-rounded']);
             $products[] =array('Brand'=>$item['Brand'],'Category'=>$item['Category'],'Image'=>$img,'ProductLine'=>$item['ProductLine'],'Url'=>$item['Url']);
        }
        return $products;
    }
/*
*Function to find all product line Clothing associated with a motorcycle Model
*Input model id - returns array of products fitted
*/
    public function getClothingFromDescription($description){
        $products=[];
        $items=TblProductLines::find()
        //->where('FIND_IN_SET(PartNumbers,(SELECT GROUP_CONCAT(partnumber) FROM tbl_partmodel WHERE model_id = '.$modelid.'))')
        ->Where(['LIKE','Description',$description])
        ->andwhere(['=','Department','Clothing'])
        ->all();

        foreach ($items as $item) {
             $pictureFile='backend/uploads/images/'.strtolower($item['Brand']).$item['DefaultImage'];
             $img=EasyThumbnailImage::thumbnailImg($pictureFile, 200,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $item['ProductLine'],'class'=>'img-rounded']);
             $products[] =array('Brand'=>$item['Brand'],'Category'=>$item['Category'],'Image'=>$img,'ProductLine'=>$item['ProductLine'],'Url'=>$item['Url']);
        }
        return $products;
    }

/*
*Function to find all product line Clothing associated with a motorcycle Model Range e.g. Diavel
*Input model_range_id -> retrieves Model RAnge Namereturns array of products fitted
*/
    public function getClothingForModelRange($mr){
        $model = TblModelRange::find()->select('model_range')->where(['=','id',$mr])->one();
        //die(var_dump($mr));
        $description = $model->model_range;
        $products=[];
        $items=TblProductLines::find()
        //->where('FIND_IN_SET(PartNumbers,(SELECT GROUP_CONCAT(partnumber) FROM tbl_partmodel WHERE model_id = '.$modelid.'))')
        ->Where(['LIKE','Description',$description])
        ->andwhere(['=','Department','Clothing'])
        ->all();

        foreach ($items as $item) {
             $pictureFile='backend/uploads/images/'.strtolower($item['Brand']).$item['DefaultImage'];
             $img=EasyThumbnailImage::thumbnailImg($pictureFile, 200,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $item['ProductLine'],'class'=>'img-rounded']);
             $products[] =array('Brand'=>$item['Brand'],'Category'=>$item['Category'],'Image'=>$img,'ProductLine'=>$item['ProductLine'],'Url'=>$item['Url']);
        }
        return $products;
    }
    public function getImageForPartNo($pno){
        $item=TblProductLines::find()
        ->where(['like','PartNumbers',$pno])
        ->one();
        $pictureFile='backend/uploads/images/'.strtolower($item['Brand']).$item['DefaultImage'];
        $img=EasyThumbnailImage::thumbnailImg($pictureFile, 200,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $item['ProductLine'],'class'=>'img-rounded']);
        return $img;
    }

    public function  getThumb(){
         // $image = \yii\helpers\Html::img('path/to/image.jpg');
           $pictureFile='backend/uploads/images/'.strtolower($item['Brand']).$item['DefaultImage'];
           $image=EasyThumbnailImage::thumbnailImg($pictureFile, 200,200,    EasyThumbnailImage::THUMBNAIL_OUTBOUND,    ['alt' => $item['ProductLine'],'class'=>'img-rounded']);
        return \yii\helpers\Html::a($image, 'site/index');
    }

}
