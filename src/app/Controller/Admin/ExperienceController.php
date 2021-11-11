<?php

namespace App\Controller\Admin;

use Core\Html\Form;

class ExperienceController extends \App\Controller\Admin\AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('experience');
    }

    public function index()
    {
        $experiences = $this->experience->all();
        $this->render('admin.experience.index', compact('experiences'));
    }

    public function add()
    {
        if (!empty($_POST)) {

            $start_date = ($_POST['start_date'] === '') ? null : $_POST['start_date'];
            $end_date = ($_POST['end_date'] === '') ? null : $_POST['end_date'];
            $result = $this->experience->create([
                'name' => $_POST['name'],
                'company' => $_POST['company'],
                'city' => $_POST['city'],
                'postcode' => $_POST['postcode'],
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = "L'expérience a bien été ajouté";
                header('Location: /portofolio/admin/experience');
                exit();
            }
        }
        $form = new Form;
        $this->render('admin.experience.edit', compact('form'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $start_date = ($_POST['start_date'] === '') ? null : $_POST['start_date'];
            $end_date = ($_POST['end_date'] === '') ? null : $_POST['end_date'];
            $result = $this->experience->update($_GET['id'], [
                'name' => $_POST['name'],
                'company' => $_POST['company'],
                'city' => $_POST['city'],
                'postcode' => $_POST['postcode'],
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = "L'expérience a bien été modifié";
                header('Location: /portofolio/admin/experience');
            }
        }
        $experience = $this->experience->find($_GET['id']);
        $form = new Form($experience);
        $this->render('admin.experience.edit', compact('experience', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->experience->delete($_POST['id']);
            if ($result) {
                $_SESSION['flash']['success'] = "L'expérience a bien été supprimé";
                header('Location: /portofolio/admin/experience');
                die();
            }
        }
    }
}
