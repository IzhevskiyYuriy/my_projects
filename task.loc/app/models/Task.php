<?php
namespace app\models;

use fw\core\base\Model;
use fw\core\libs;

class Task extends Model
{
    public $table = 'task';
    public $imgMime;

    protected $imgPathForDb = '/upload image/images/';
    protected $pathImgForDB = '';
    protected $imgName;
    protected $resSave;
    protected $inputName, $inputEmail;

    public function ajaxPreview()
    {
        if (isset($_POST)) {
            $validator = new \Validator();
            $inputName = $validator->clean($_POST['input_name']);
            $inputEmail = $validator->clean($_POST['input_email']);
            $inputTask = $validator->clean($_POST['input_task']);
            $this->inputName = $inputName;
            $this->inputEmail = $inputEmail;
        }

        if (!empty($inputName) && !empty($inputEmail) && !empty($inputTask)) {
            $email_validate = filter_var($inputEmail, FILTER_VALIDATE_EMAIL);

            if ($validator->check_length($inputName, 2, 25) &&
                $validator->check_length($inputTask, 2, 1000) && $email_validate) {
                echo '<strong>' . "Ваша имя: " . '</strong>' . $inputName;
                echo '<hr>';
                echo '<strong>' . "Ваш email: " . '</strong>' . $inputEmail;
                echo '<hr>';
                echo '<strong>' . "Задача: " . '</strong>' . $inputTask;
                echo '<div style="color: green; font-weight: bold;">Спасибо. Введено все правильно.</div>';
            } else {
                echo '<div class="error msg" style="color: #FF7423; font-weight: bold;">Введенные данные некорректные</div>';
            }
        } else {
            echo '<div class="error msg" style="color: red; font-weight: bold;">Заполните пустые поля</div>';
        }
    }


    /**
     * @param $fileImg
     * @return bool
     */
    public function validationImage($fileImg)
    {
        if (isset($fileImg)) {
            if (is_uploaded_file($fileImg['tmp_name'])) {
                if ($this->checkAllowed($fileImg['name']) && $this->checkImgMime($fileImg['name'])){
                    return true;
                }
            }else{
                MessageSendError(2, 'Вы забыли загрузить изображение!');
            }
        } else {
            MessageSendError(2, 'Не удачная попытка загрузить файл!');
        }
    }

    /**
     * @param $fileImg
     * @return bool
     */
    public function saveImage($fileImg)
    {
        if (move_uploaded_file($fileImg["tmp_name"], $saveTempFolder = IMG_TEMP . $this->randomNameForImage())) {
            $load = $this->resizeImage($saveTempFolder,320, 240);
            $this->savingImageAfterResizing($this->imgMime,  $load, $this->pathImgForDB = IMG. $this->randomNameForImage());

            unlink($saveTempFolder);
            return true;
        } else {
            MessageSendError(2, 'Ошибка валидации формы!');
        }
    }

    /**
     * @return string
     */
    public function pathImgForDB()
    {
        $imgPathForDb = $this->imgPathForDb . basename($this->pathImgForDB);
        return  $imgPathForDb;
    }

    /**
     * @param $filename
     * @return bool
     */
    public function checkAllowed($filename)
    {
        $fileExt = strrchr($filename, '.');

        $whiteList = [".jpg",".jpeg",".gif",".png"];
        if (!(in_array($fileExt, $whiteList))) {
            MessageSendError(3, 'Загруженный файл не является изображением!');
        } else {
            return true;
        }
    }

    /**
     * Checks the true mime type of the given file
     * @param $fileName
     * @return bool
     */
    private function checkImgMime($fileName){
        $allowed  =  [
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png",
        ];

        $imgMime  =  pathinfo($fileName, PATHINFO_EXTENSION);

        if (!array_key_exists($imgMime, $allowed )) {
            MessageSendError(3, 'Загруженный файл не является изображением!');
        } else {
            $this->imgMime = $imgMime;
            return true;
        }
    }

    /**
     * @return string
     */
    public function randomNameForImage()
    {
        $randNameFile = substr(md5(microtime() . rand(0, 9999)), 0, 20);
        return $randNameFile . '.' . $this->imgMime;
    }

    /**
     * @param $filename
     * @param $w
     * @param $h
     * @return resource
     */
    public function resizeImage($filename, $w, $h) {
        $imageInfo = getimagesize($filename);
        list($width, $height) = getimagesize($filename);

        $imageType = $imageInfo[2];

        if( $imageType == IMAGETYPE_JPEG ) {
            $src = imagecreatefromjpeg($filename);
            $dst = imagecreatetruecolor($w, $h);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
            return $dst;
        } elseif( $imageType == IMAGETYPE_GIF ) {
            $src = imagecreatefromgif($filename);
            imageinterlace($src, true);
            $dst = imagecreatetruecolor($w, $h);
            imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
            return $dst;
        } elseif( $imageType == IMAGETYPE_PNG ) {
            $src = imagecreatefrompng($filename);
            $dst = imagecreatetruecolor($w, $h);

            imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
            imagedestroy($src);

            return $dst;
        }
    }

    /**
     * перемещает картинку в заданую папку с измененными размерами
     * @param $imageType
     * @param $load
     * @param $path
     */
   public  function savingImageAfterResizing($imageType, $load, $path) {

        if( $imageType == 'jpg') {
            imagejpeg($load, $path );
        } elseif( $imageType == 'gif')  {
            imagegif($load,  $path );
        } elseif( $imageType == 'png') {
            imagepng($load,  $path );
        }
        imagedestroy($load);
   }

   /**
     * @param $inputName
     * @param $inputEmail
     * @param $inputTask
     * @return bool
     */
   public function validationFormAddData($inputName, $inputEmail, $inputTask)
    {
        $validator = new \Validator();

        if (!empty($inputName) && !empty($inputEmail) && !empty($inputTask)) {
            $email_validate = is_email(filter_var($inputEmail, FILTER_VALIDATE_EMAIL));

            if ($validator->check_length($inputName, 2, 25) &&
                $validator->check_length($inputTask, 2, 1000) && $email_validate) {
                return true;
            } else {
                MessageSendError(2, 'Ошибка валидации формы!');
            }
        } else {
            MessageSendError(2, 'Заполните пустые поля!');

        }
    }

    /**
     * @param $inputTask
     * @return bool
     */
    public function validationFormEditData($inputTask)
    {
        $validator = new \Validator();

        if (!empty($inputTask) && $validator->check_length($inputTask, 2, 1000)) {
            return true;
        } else {
            MessageSendError(2, 'Ошибка валидации формы! Возможно вы пытаетесь оставить поле задачи пустым или
             превысили количество символов.');
        }
    }

    /**
     * return the result to the controller, editAction and viewAction
     * @param $get
     * @return array
     */
    public function getDataId($get)
    {
        return $this->findBySql(
            "SELECT  t.id, t.name, t.email, t.task, t.img, t.status_id, s.status_name
                      FROM {$this->table} AS t
                          INNER JOIN `status` AS s ON (s.id = t.status_id)
                              WHERE t.id = ?", [ $get]
        );
    }





}