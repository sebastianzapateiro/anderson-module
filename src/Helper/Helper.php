<?php

namespace Drupal\nombres\Helper;

use Drupal\file\Entity\File;
use Drupal\media\Entity\Media;

class Helper
{
// funcion para obtener la url del servicio de load
  public function helpergetUri($mid): string
  {

    $mid = [$mid];

    $media = Media::load(reset($mid));

    $fid = $media->getSource()->getSourceFieldValue($media);
    $file = File::load($fid);

    $url = $file->createFileUrl($file->getFileUri());
    return $url;
  }
}
