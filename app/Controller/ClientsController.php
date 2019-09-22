<?php

namespace App\Controller;

use App\Core\Controller;
use App\Model\Client;
use App\Model\Consultant;

class ClientsController extends Controller
{

    public function lightboard()
    {
        $client = new Client();
        $currentTime = new \DateTime(null, new \DateTimeZone('Europe/Vilnius'));
        isset($_GET['limit']) ? $dataLimit = (int)$_GET['limit'] : $dataLimit = 5;
        $data = $client->getAllClients($currentTime->format('Y-m-d H:i:s'), $dataLimit);
        $this->msg->display();
        $this->view->render('lightboard', ['data' => $data]);
    }

    public function create()
    {
        $consultant = new Consultant();
        $consultants = $consultant->getAllConsultants();
        $this->msg->display();
        $this->view->render('forms/create', ['consultants' => $consultants]);
    }

    public function store()
    {
        $data = $_POST;
        if (isset($_POST["name"]) && !empty($_POST["name"])) {
            $data["name"] = $this->validator($data["name"]);
            if ($data["name"]) {
                $client = new Client();
                $client->create($data);
                $this->msg->success('Successfully registered.');
                unset($_POST);
            } else {
                $this->msg->error('Don\'t use numbers or special characters');
            }
        } else {
            $this->msg->error('An error has occurred, please contact by phone.');
        }
        $this->redirect('clients/create');
    }

    public function index()
    {
        $client = new Client();
        $currentTime = new \DateTime(null, new \DateTimeZone('Europe/Vilnius'));
        $data = $client->getAllClients($currentTime->format('Y-m-d H:i:s'));
        $this->view->render('index', ['data' => $data]);
    }

    public function show()
    {
        $this->view->render('forms/show');
    }

    public function showClientInfo($key = '')
    {
        if (isset($_POST['login_key'])) {
            $key = $_POST['login_key'];
        }
        $currentTime = new \DateTime(null, new \DateTimeZone('Europe/Vilnius'));
        $client = new Client();
        $data = $client->getClient($key, $currentTime->format('Y-m-d H:i:s'));
        $this->view->render('show', ['client' => $data[0], 'average' => $data[1]]);
    }


    public function served($id)
    {
        $client = new Client();
        $client->served($id);
        $this->redirect('clients/index');
    }

    public function delete($id)
    {
        $client = new Client();
        $client->delete($id);
        $this->redirect('clients/lightboard');
    }

    public function setNewData($id)
    {
        $secondClientDate = $this->getSecondClientDate($id);
        if ($secondClientDate) {
            $dateChanges = $this->changeDatetime($secondClientDate);
            $client = new Client();
            $client->setLaterDate($id, $dateChanges);
        }
        $this->redirect('clients/lightboard');
    }

//TODO move to Model
    private function getSecondClientDate($id)
    {
        $client = new Client();
        $second = $client->getSecondClient($id);
        if ($second) {
            return $second['created_at'];
        } else {
            $this->msg->error('You\'re last in line');
            return false;
        }
    }

    private function changeDatetime($date)
    {
        return date("Y-m-d H:i:s", (strtotime(date($date)) + 1));
    }

    public function statistic($data = [], $consultantId = 0)
    {
        $consultant = new Consultant();
        $consultants = $consultant->getAllConsultants();
        $consult = null;
        if ($data == null) {
            $client = new Client();
            $data = $client->getStatistic();
        } else {
            $consult = $consultant->getConsultant($consultantId);
        }
        $this->view->render('statistic', ['clients' => $data, 'consultants' => $consultants, 'consult' => $consult]);
    }

    public function selectConsultantStatistic()
    {
        $consultantId = $_GET['consultant'];
        $client = new Client();
        $data = $client->getStatisticByConsultantId($consultantId);
        $this->statistic($data, $consultantId);
    }

}
