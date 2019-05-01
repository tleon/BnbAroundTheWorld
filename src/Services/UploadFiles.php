<?php

namespace App\Services;

class UploadFiles
{
    const MIME_TYPE_ALLOWED = [
        'image/png',
        'image/jpg',
        'image/gif',
        'image/jpeg',
    ];

    const EXTENSION = ['png', 'jpg', 'gif', 'jpeg'];

    private $maxFilesAuthorized = 3;
    private $dir;
    private $nbFiles;

    public function __construct($id)
    {
        $this->dir = "assets/images/" . $id . '/';
        $this->nbFiles = $this->nbFilesInDir();

    }

    public function nbFilesInDir()
    {
        $count = 0;
        $allFiles = scandir($this->dir);
        foreach($allFiles as $file){
            if( in_array( pathinfo($file, \PATHINFO_EXTENSION), self::EXTENSION )){
                $count += 1;
            }
        }
        return $count;
    }

    public function getNbFiles()
    {
        return $this->nbFiles;
    }
    

    /**
     * Check size, mime & number of images then upload files.
     * Return name files, sizes, extensions & status.
     * 
     * @param array $files
     * @param integer $id
     * @return array
     */
    public function uploadNewImages(array $files, int $id) : array
    {   
        $filesUploaded = [];
        if($this->maxFilesAuthorized - $this->nbFiles === 0){
            $filesUploaded['errors']="Deja 3 images";
            return $filesUploaded;
        } else {
            // On compte le nombre de fichiers recus
            $countfiles = count($files['image-upload']['name']);
            // on boucle sur chacun des fichiers
            $nbPlace = $this->maxFilesAuthorized - $this->nbFiles;
            for ($i = 0; $i < $countfiles; $i++) {
                if($nbPlace > 0){
                        // on verifie leur mime
                    if (!in_array(mime_content_type($files['image-upload']['tmp_name'][$i]), self::MIME_TYPE_ALLOWED)) {
                        $filesUploaded['errors'] = [$files['image-upload']['tmp_name'][$i] => 'Not an Image'];
                        // On verifie leur tailles (1000000 bytes = 1MB)
                    } elseif ($files['image-upload']['size'][$i] >= 1000000) {
                        $filesUploaded['errors'] = [$files['image-upload']['tmp_name'][$i] => 'Too big'];
                    } else {
                        // On renomme les images par "image" + identifiant unique +  extension
                        $filename = "image" . uniqid() . '.' . strtolower(pathinfo($files["image-upload"]["name"][$i], \PATHINFO_EXTENSION));
                        // On deplace les images
                        if (move_uploaded_file($files['image-upload']['tmp_name'][$i], $this->dir . $filename)) {
                            $filesUploaded['success'] = $files['image-upload']['tmp_name'][$i];
                            $nbPlace -= 1;
                        } else {
                            $filesUploaded['errors'] = [$files['image-upload']['tmp_name'][$i] => 'upload failed'];
                        };
                    }
                } else {
                    $filesUploaded['errors'] = [$files['image-upload']['tmp_name'][$i] => 'Empty directory'];
                }
                
            }
        return $filesUploaded;
        }
        
    }

    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return array
     */
    public function getAllImg($id) : array
    {
        $files = scandir($this->dir);
        $images = [];
        
        if(!empty($files)){
            foreach($files as $file){
                if( in_array( pathinfo($file, \PATHINFO_EXTENSION), self::EXTENSION )){
                    $images[]= $id . '/' . $file;
                }
            }
        }
        return $images;
    }
}
