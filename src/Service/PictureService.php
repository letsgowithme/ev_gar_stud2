<?php

namespace App\Service;

use Exception;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class PictureService
{
  private $params;
  public function __construct(ParameterBagInterface $params)
  {
    $this->params = $params;
  }
  public function add(UploadedFile $picture, ?string $folder = "", ?int $width = 640, ?int $height = 440)
  {

    // on donne un nouveau nom à l'image
    $fichier = md5(uniqid(mt_rand(), true)) . '.webp';
    // ON RECUP LES INFO DE L'IMAGE(LARGEUR, ETC)
    $picture_infos = getimagesize($picture);

    if ($picture_infos === false) {
      throw new Exception('Format d\'image incorrect');
    }
    // on verif le format de l'image

    switch ($picture_infos['mime']) {
      case 'image/jpeg':
        $img_source = imagecreatefromjpeg($picture);
        break;
      case 'image/png':
        $img_source = imagecreatefrompng($picture);
        break;
      case 'image/webp':
        $img_source = imagecreatefromwebp($picture);
        break;
      default:
        throw new Exception('Format d\'image incorrect');
    }
    // on recadre l'image
    // on recup les dimentions
    $imageWidth = $picture_infos[0];
    $imageHeight = $picture_infos[1];
    // on verifie l'orientation de l'image
    switch ($imageWidth <=> $imageHeight) {
      case -1; //portrait
        $squareSize = $imageWidth;
        $src_x = 0;
        $src_y = ($imageHeight - $squareSize) / 2;
        break;

      case 0; //carré
        $squareSize = $imageWidth;
        $src_x = 0;
        $src_y = 0;
        break;

      case 1; //paysage
        $squareSize = $imageHeight;
        $src_x = ($imageWidth - $squareSize) / 2;
        $src_y = 0;
        break;
    }
    // on crée une nouvelle image "vierge"
    $resized_picture = imagecreatetruecolor($width, $height);
    imagecopyresampled($resized_picture, $img_source, 0, 0, $src_x, $src_y, $width, $height, $squareSize, $squareSize);

    $path = $this->params->get('images_directory') . $folder;

    // on crée le dossier de destination s'il n'existe pas
    if (!file_exists($path . '/mini/')) {
      mkdir($path . '/mini/', 0755, true);
    }
    // on socke l'image recadrée
    imagejpeg($resized_picture, $path . '/mini/' . $width . 'x' . $height . '-' . $fichier);

    $picture->move($path . '/', $fichier);
    return $fichier;
    
  }
  public function delete(string $fichier, ?string $folder = '', ?int $width = 640, ?int $height = 440){
    if($fichier !== 'default.jpeg'){
      $success = false;
      $path = $this->params->get('images_directory') . $folder;
      $mini = $path . '/mini/' . $width . 'x' . $height . '-' . $fichier;
      if(file_exists($mini)) {
         unlink($mini);
         $success = true;
      }
      $original = $path . '/' . $fichier;
      if(file_exists($original)) {
        unlink($original);
        $success = true;
     }
     
 
     return $success;
    }
    return false; 
  }
}
