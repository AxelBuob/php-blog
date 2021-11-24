<?php

namespace App\Controller\Admin;

use Core\Html\Form;

class SkillController extends \App\Controller\Admin\AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('skill');
    }

    public function index()
    {
        $skills = $this->skill->all();
        $this->render('admin.skill.index', compact('skills'));
    }

    public function add()
    {
        if (!empty($_POST)) {
            $result = $this->skill->create([
                'name' => $_POST['name'],
                'class' => $_POST['class']
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = 'La compétence a bien été ajouté';
                header('Location: /portofolio/admin/skill/');
                throw new \Exception();;
            }
        }
        $form = new Form();
        $this->render('admin.skill.edit', compact('form'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $result = $this->skill->update($_GET['id'],[
                'name' => $_POST['name'],
                'class' => $_POST['class']
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = 'La compétence a bien été modifié';
                header('Location: /portofolio/admin/skill/');
                throw new \Exception();;
            }
        }
        $skill = $this->skill->find($_GET['id']);
        $form = new Form($skill);
        $this->render('admin.skill.edit', compact('skill', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->skill->delete($_POST['id']);
            if ($result) {
                $_SESSION['flash']['success'] = 'La compétence a bien été supprimé';
                header('Location: /portofolio/admin/skill/');
                throw new \Exception();;
            }
        }
    }
}
