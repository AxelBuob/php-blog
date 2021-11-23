<?php

namespace App\Controller\Admin;

use \App\Controller\Admin\AppController;
use Intervention\Image\ImageManager;

class ImageController extends AppController
{
    private $tmp_name;
    private $name;

    protected $upload_dir;
    protected $upload_path;

    private $size;
    private $mime_type;

    private $allowed_mime_types = ['image/png', 'image/jpeg'];
    private $max_file_size = 5 * MB;

    public function __construct()
    {
        parent::__construct();
        $this->loadModel('image');

    }


    private function validateImage()
    {
        if (!in_array($this->mime_type, $this->allowed_mime_types))
        {
            $_SESSION['flash']['warning'] = 'Allowed mime type: image/png, image/jpeg';
            return false;
        }
        elseif ($this->size > $this->max_file_size)
        {
            $_SESSION['flash']['warning'] = 'Max file size: 5MB';
            return false;
        }
        elseif (file_exists($this->upload_path . $this->name))
        {
            $_SESSION['flash']['danger'] = 'File already exist';
            return false;
        }
        else 
        {
            return true;
        }
    }

    private function moveImage($source, $destination)
    {
        if (move_uploaded_file($source, $destination)) {
            return true;
        } else {
            
            return false;
        }
    }

    public function createFavicon($image)
    {
        $manager = new ImageManager(array('driver' => 'imagick'));
        $manager->make($image)
            ->resize(16,16)
            ->encode('ico',100)
            ->save(ROOT .'/public/favicon.ico');
    }
    
    public function add($image)
    {
        $finfo = new \finfo();

        $this->tmp_name = $image['tmp_name'];
        $this->name = $image['name'];
        $this->size = $image['size'];
        $this->mime_type = $finfo->file($this->tmp_name, FILEINFO_MIME_TYPE);
        
        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo($this->name, PATHINFO_EXTENSION);
        $basename   = $filename . "." . $extension;
        $source       = $this->tmp_name;
        
        $destination  = UPLOAD_DIR . $basename;
        $image_path = UPLOAD_PATH . $basename;

        if($this->validateImage() && $this->moveImage($source, $destination))
        { 
           $image_create = $this->image->create([
                'name' => $basename,
                'path' =>  $image_path,
                'dir' => $destination
            ]);

            if($image_create)
            {
                $image_last_insert_id = $this->image->getLastId();
                $_SESSION['flash']['success'] = 'Image ajouté avec succès';
            }
        }
        else
        {
            $_SESSION['flash']['danger'] = 'Oups une erreur est survenus';
        }
        return $image_last_insert_id;
    }

    public function delete($id)
    {
        $image = $this->image->find($id);
        
        if(file_exists($image->dir) && unlink($image->dir) && $this->image->delete($image->id))
        {
            $_SESSION['flash']['success'] = 'Image supprimé avec succès !';
        }
        else
        {
            $_SESSION['flash']['warning'] = 'Oups une erreur est survenus !';
        }
    }

}

