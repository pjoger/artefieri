<?php

//Yii::import('application.extensions.artefieri.Artefieri');

class CArtefieriComponent extends CApplicationComponent
{
//    public $driver = 'GD';

//    public $params = array();
  public $coverSizes = array();
  public $covers_allowed_types = array('jpg','png','gif','tif');

  public function init()
  {
    parent::init();
  }

  public function idToTree ($id){
    $file_name = str_pad($id,8,"0",STR_PAD_LEFT);
    $splited = str_split($file_name, 2);
    $file_path = $splited[0] .'/'. $splited[1] .'/'. $splited[2];
    return array($file_path,$file_name);
  }

  public function resizeCovers ($file, $size = null){
    if (!$size){
      $size = $this->coverSizes;
    }
    if (! is_array($size) || count($size) == 0){
      throw new CException('$sizes not set');
    }
    if (file_exists($file)){
      $file_info = pathinfo($file);
      $file_path = $file_info['dirname'];
      $file_name = $file_info['filename'];
      foreach ($size as $s){
        list($w,$h) = $s;
        $mode = Image::AUTO;
        if ($w && !$h){
          $mode = Image::WIDTH;
        } elseif (!$w && $h){
          $mode = Image::HEIGHT;
        }
        $img = Yii::app()->image->load($file);
        $img->resize($w,$h,$mode);
        $img->save($file_path.'/'.$file_name.'_'.$w.'x'.$h.'.jpg');
      }
    } else {
      throw new CException("file not found: '$file'");
    }
  }

  public function saveCoverFromPost($postFile,$id){
    if (!isset($postFile) || ! is_object($postFile)){
      return;
    }
    if (!$this->chkPostFile($postFile,$this->covers_allowed_types)){
      throw new CHttpException(500,'Wrong file');
    }

    $file_info = $this->getCoverInfo($id);

    $img = Yii::app()->image->load($postFile->tempName);
    foreach (array('ext','width','height') as $prop) {
      $file_info[$prop] = $img->__get($prop);
    }

    if (!is_dir($file_info['filepath'])) {
      mkdir($file_info['filepath'],0755,true);
    }
    if (file_exists($file_info['fullname'])) {
      array_map('unlink', glob($file_info['filepath'].'/'.$file_info['name'].'*'));
      //unlink ($file_path.$file_name);
    }

    $orig_file = $file_info['filepath'].'/'.$file_info['name'].'_orig.'.$file_info['ext'];
    $img->save($file_info['fullname']);
    $postFile->saveAs($orig_file);
    $this->resizeCovers($file_info['fullname']);
    return $file_info;
  }

  public function getCoverInfo($id){
    $file_path = $this->idToTree($id);
    $file_info = array('idTree' => $file_path[0], 'name' => $file_path[1]);
    $file_info['filepath'] = Yii::app()->basePath."/../images/covers/".$file_info['idTree'];
    $file_info['fullname'] = $file_info['filepath'].'/'.$file_info['name'].'.jpg';
    return $file_info;
  }

  public function chkPostFile ($postFile, $ext = array()){
    if (isset($postFile) && is_object($postFile) && $postFile->error){
      switch ($postFile->error){
        case 1:
          $err = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
          break;
        case 2:
          $err = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
          break;
        case 3:
          $err = 'The uploaded file was only partially uploaded';
          break;
        case 4:
          $err = 'No file was uploaded';
          break;
        case 6:
          $err = 'Missing a temporary folder';
          break;
        case 7:
          $err = 'Failed to write file to disk';
          break;
        case 8:
          $err = 'A PHP extension stopped the file upload. PHP does not provide a way to ascertain which extension caused the file upload to stop';
          break;
        default :
          $err = 'Unknown error: (posterror='.$postFile->error.')';
      }
      throw new CHttpException(500,$err);
      return false;
    }
    if (is_array($ext) && count($ext) > 0 && isset($postFile) && is_object($postFile)){
      $ok = false;
      $origExt = pathinfo($postFile, PATHINFO_EXTENSION);
      foreach ($ext as $e){
        if (strtolower($e) == strtolower($origExt)){
          $ok = true;
          break;
        }
      }
      if (!$ok){ return false; }
    }
    return true;
  }
}
