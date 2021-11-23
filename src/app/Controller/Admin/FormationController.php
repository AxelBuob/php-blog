<?php

namespace App\Controller\Admin;

use Core\Html\Form;

class FormationController extends \App\Controller\Admin\AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('formation');
    }

    public function index()
    {
        $formations = $this->formation->all();
        $this->render('admin.formation.index', compact('formations'));
    }

    public function add()
    {
        if (!empty($_POST)) {

            $start_date = ($_POST['start_date'] === '') ? null : $_POST['start_date'];
            $end_date = ($_POST['end_date'] === '') ? null : $_POST['end_date'];
            $result = $this->formation->create([
                'name' => $_POST['name'],
                'school' => $_POST['school'],
                'city' => $_POST['city'],
                'postcode' => $_POST['postcode'],
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = "La formation a bien été ajouté";
                header('Location: /portofolio/admin/formation/');
                throw new \Exception();;
            }
        }
        $form = new Form;
        $this->render('admin.formation.edit', compact('form'));
    }

    public function edit()
    {
        if (!empty($_POST)) {
            $start_date = ($_POST['start_date'] === '') ? null : $_POST['start_date'];
            $end_date = ($_POST['end_date'] === '') ? null : $_POST['end_date'];
            $result = $this->formation->update($_GET['id'], [
                'name' => $_POST['name'],
                'school' => $_POST['school'],
                'city' => $_POST['city'],
                'postcode' => $_POST['postcode'],
                'start_date' => $start_date,
                'end_date' => $end_date
            ]);
            if ($result) {
                $_SESSION['flash']['success'] = "La formation a bien été modifié";
                header('Location: /portofolio/admin/formation/');
                throw new \Exception();;
            }
        }
        $formation = $this->formation->find($_GET['id']);
        $form = new Form($formation);
        $this->render('admin.formation.edit', compact('formation', 'form'));
    }

    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->formation->delete($_POST['id']);
            if ($result) {
                $_SESSION['flash']['success'] = "La formation a bien été supprimé";
                header('Location: /portofolio/admin/formation/');
                throw new \Exception();;
            }
        }
    }
}
