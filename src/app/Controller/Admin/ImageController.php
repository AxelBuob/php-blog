<?php

namespace App\Controller\Admin;

use \App\Controller\Admin\AppController;

class ImageController extends AppController
{
    private $tmp_name;
    private $name;
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
    
    public function add($image, $path, $post_id)
    {
        $finfo = new \finfo();

        $this->tmp_name = $image['tmp_name'];
        $this->name = $image['name'];
        $this->size = $image['size'];
        $this->mime_type = $finfo->file($this->tmp_name, FILEINFO_MIME_TYPE);
        $this->upload_path = $path;


        $filename   = uniqid() . "-" . time();
        $extension  = pathinfo($this->name, PATHINFO_EXTENSION);
        $basename   = $filename . "." . $extension;
        $source       = $this->tmp_name;
        $destination  = $this->upload_path . $basename;


        if($this->validateImage() && $this->moveImage($source, $destination))
        { 
           $this->image->create([
                'name' => $basename,
                'path' => $destination,
                'image_post' => $post_id
            ]);
            $_SESSION['flash']['success'] = 'Image ajouté avec succès';
        }
        else
        {
            $_SESSION['flash']['danger'] = 'Oups une erreur est survenus';
        }
    }

    public function delete()
    {
        if(isset($_GET['id']))
        {
            $image = $this->image->find($_GET['id']);
            if(file_exists($image->path) && unlink($image->path) && $this->image->delete($image->id))
            {
                $_SESSION['flash']['success'] = 'Image supprimé avec succès !';
                header('Location: ?p=admin.post.edit&id='. $image->image_post);
                die();
            }
            else
            {
                $_SESSION['flash']['warning'] = 'Oups une erreur est survenus !';   
            }
        }



    }

}

