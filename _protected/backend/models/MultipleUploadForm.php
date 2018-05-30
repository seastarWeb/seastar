<?php
namespace backend\models;
use yii\base\Model;
use yii\web\UploadedFile;
class MultipleUploadForm extends Model
{
    /**
     * @var UploadedFile[] files uploaded
     */
    public $files;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['files'], 'file', 'extensions' => 'jpg, gif, png', 'mimeTypes' => 'image/jpeg', 'maxFiles' => 10, 'skipOnEmpty' => false],
        ];
    }

    public function upload($path=0)
    {
        if ($this->validate()) { 
            foreach ($this->files as $file) {
                if (!$path){
                    $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                }else{
                    $file->saveAs($path.'/' . $file->baseName . '.' . $file->extension);
                }
            }
            return true;
        } else {
            return false;
        }
    }
}