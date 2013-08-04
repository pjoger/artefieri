<?php
//Yii::import('application.extensions.artefieri.CArtefieriComponent');

class ArtefieriCommand extends CConsoleCommand
{
  public $verbose=false;

 /*
  public function actionIndex($limit=5) {
    echo('Hello');
  }
  */

  private function setArtCoverInfo($id,$cover,$w,$h){
    $dbh = Yii::app()->db;

  }

  public function actionMkcovers(array $arts) {
    $artstr = join(',',$arts);
    if (!preg_match('/^(all|\d+(\d+,)*)$/', $artstr)){
      die('[ERR] expected ^(all|\d+(\d+,)*)$ but there: '.$artstr);
    }
    $arts = split(',',$artstr);
    if (count($arts) > 100){
      die('[ERR] Too many arts!');
    }
    $dbh = Yii::app()->db;

    //$aList = Arts::model()->findAll('options & 2');
    $dbcmd = $dbh->createCommand()
      ->select('id, cover, cover_w, cover_h')
      ->from('arts');
    if ($artstr != "all"){
      $dbcmd->where(array('in','id',$arts));
    }
    $aList = $dbcmd->query();
    $artsCnt = 0;
    $errCover = 0;
    $noCover = 0;
    $okArts = 0;
    foreach ($aList as $art){
      $artsCnt++;
      $file_info = Yii::app()->artefieri->getCoverInfo($art['id']);
      foreach (array('ext', 'width', 'height') as $prop){ $file_info[$prop] = NULL; }
      if ($art['cover']){
        $file_info['ext'] = $art['cover'];
        $orig_file = $file_info['filepath'].'/'.$file_info['name'].'_orig.'.$file_info['ext'];
        $must_orig = $file_info['filepath'].'/'.$file_info['name'].'.'.$file_info['ext'];
        if (file_exists($orig_file) && !file_exists($file_info['fullname'])){
          $img = Yii::app()->image->load($orig_file);
          $img->save($file_info['fullname']);
        }elseif (!file_exists($orig_file) && file_exists($must_orig)){
          rename($must_orig, $orig_file);
          $img = Yii::app()->image->load($orig_file);
          $img->save($file_info['fullname']);
        }elseif (!file_exists($orig_file) && file_exists($file_info['fullname'])){
          $file_info['ext'] = 'jpg';
          $orig_file = $file_info['filepath'].'/'.$file_info['name'].'_orig.'.$file_info['ext'];
          copy($file_info['fullname'],$orig_file);
        }
        if (file_exists($orig_file)){
          $img = Yii::app()->image->load($orig_file);
          foreach (array('ext','width','height') as $prop) {
            $file_info[$prop] = $img->__get($prop);
          }
        }
        if (file_exists($file_info['fullname'])){
          $rmfiles = glob($file_info['filepath'].'/'.$file_info['name'].'*');
          $rmfiles = preg_grep('/'.$file_info['name'].'(_orig)?\.[^.]+$/', $rmfiles, PREG_GREP_INVERT);
          foreach ($rmfiles as $f) { unlink($f); }
          Yii::app()->artefieri->resizeCovers($file_info['fullname']);
          $okArts++;
        } else {
          foreach (array('ext', 'width', 'height') as $prop){
            $file_info[$prop] = NULL;
          }
          $errCover++;
          if ($this->verbose){
            print 'art='.$art['id']." not found file: '$orig_file'\n";
          }
        }
      } else {
        $noCover++;
        if ($this->verbose){
          print 'art='.$art['id']." no cover\n";
        }
      }
      if ($art['cover'] != $file_info['ext'] ||
          $art['cover_w'] != $file_info['width'] ||
          $art['cover_h'] != $file_info['height']
      ){
        $r = $dbh->createCommand()->update('arts',
          array(
            'cover' => $file_info['ext'],
            'cover_w' => $file_info['width'],
            'cover_h' => $file_info['height'],
          ),
          'id=:id', array(':id' => $art['id'])
        );
      }
     // die(print_r($art). "\n rows: ".$r);
    }
    print "arts=$artsCnt, ok=$okArts, fail=$errCover, noCover=$noCover\n";
  }
}
