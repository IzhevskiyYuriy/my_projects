<?php
namespace App\Model\Entity;

use Cake\Network\Exception\InternalErrorException;
use Cake\ORM\Entity;
use Cake\Filesystem\Folder;
use Cake\Utility\Text;
use Cake\Filesystem\File;



/**
 * Teaser Entity
 *
 * @property int $id
 * @property string $img
 * @property string $link
 * @property string $text
 * @property string $title
 * @property float $price
 * @property int $post_id
 * @property int $teaser_id
 *
 * @property \App\Model\Entity\Post $post
 * @property \App\Model\Entity\Teaser[] $teasers
 * @property \App\Model\Entity\BlocksTeasersExcluded[] $blocks_teasers_excludeds
 * @property \App\Model\Entity\TeasersView[] $teasers_views
 * @property \App\Model\Entity\Category[] $categories
 */
class Teaser extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
    protected $_hidden = ['post_id', 'price', 'title'];
    protected $_virtual = ['editor_id'];

    /**
     * Upload images
     */

    protected $path = '/img/uploads/teasers';

    public function deleteImageFolderTeaser(){
        $file  = new File (WWW_ROOT . $this->getPath());
        $file->delete();
        $file->close();
        return $file;
    }

    public function getDirPath()
    {
        return WWW_ROOT . $this->path;
    }

    function transliterate($s)
    {
        $s = (string)$s;
        $s = strip_tags($s);
        $s = str_replace(array("\n", "\r"), " ", $s);
        $s = preg_replace("/\s+/", ' ', $s);
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s);
        $s = strtr($s, array('а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'e', 'ж' => 'j', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch', 'ш' => 'sh', 'щ' => 'shch', 'ы' => 'y', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya', 'ъ' => '', 'ь' => ''));
        $s = str_replace(" ", "-", $s);
        return $s;
    }


    public function upload($file)
    {

        if (empty($file['name'])) return false; // have no name of uploaded file

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        $arr_ext = ['jpg', 'jpeg', 'gif','png'];

        if (in_array($ext, $arr_ext)) {
            $file['name'] = $this->transliterate($file['name'] );

            $file['name'] = time() . '-' . Text::uuid(). str_replace(' ', '_', $file['name']);
            $folder = new Folder();
            $dir = $this->getDirPath();
            $dirExists = true;
            if (file_exists(WWW_ROOT . $this->getPath())) $this->deleteImageFolderTeaser();

            if (!file_exists($dir)) $dirExists = $folder->create($dir);


            if ($dirExists) {
                move_uploaded_file($file['tmp_name'], $dir . '/'. $file['name']);
                //prepare the filename for database entry
                $this->img = $this->path. '/'. trim($file['name']);
                return true;
            }
        }
        return false;
    }

    public  function getPath($customPath = null)
    {
        if (!is_null($customPath)) $this->setPath($customPath);
        return  $this->img;
    }

    public function setPath($newPath)
    {
        $this->path = 'img' . '/' . $newPath;
    }

    // for understanding what post_id mean (editor_id)
    protected function _getEditorId()
    {
        return $this->post_id;
    }

}
