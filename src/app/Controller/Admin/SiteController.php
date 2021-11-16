<?php

namespace App\Controller\Admin;

use Core\Html\Form;

class SiteController extends \App\Controller\Admin\AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('site');
    }

    public function index()
    {
        $id = 1;
        $site = $this->site->find($id);
        $form = new Form($site);
        
        if (!empty($_POST)) {
            if (is_array($_FILES['image']) && $_FILES['image']['tmp_name']) {
                $image = new ImageController();
                if ($site->site_logo !== null) {
                    $this->site->update($id, ['site_logo' => null]);
                    $image->delete($site->site_logo);
                    $image_last_insert_id = $image->add($_FILES['image']);
                    $image->createFavicon($_FILES['image']['tmp_name']);
                } else {
                    $image_last_insert_id = $image->add($_FILES['image']);
                }
            }
            $result = $this->site->update($id, [
                'description' => $_POST['description'],
                'name' => $_POST['name'],
                'charset' => $_POST['charset'],
                'language' => $_POST['language'],
                'site_logo' => $image_last_insert_id
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = 'La configuration du site a bien été modifié';
                header('Location: /portofolio/admin/site/');
                exit();
            }
        }
        $this->render('admin.site.edit', compact('site', 'form'));
    }
}
