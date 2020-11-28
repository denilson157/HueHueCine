<?php
require_once(dirname(__FILE__) . "/../../model/List.php");
require_once(dirname(__FILE__) . "/../../model/ListDB.php");
session_start();

class ListController
{
    private $user;
    private $state;
    private $movie;
    private $typeMTV;
    private $listid;

    public function __construct()
    {
        $this->user = $_SESSION['user'];
        $this->state = isset($_POST['state']) ? $_POST['state'] : null;
        $this->movie = isset($_POST['movieId']) ? $_POST['movieId'] : null;
        $this->listid = isset($_POST['listid']) ? $_POST['listid'] : null;
        $this->typeMTV = isset($_POST['typeMTV']) ? $_POST['typeMTV'] : null;
    }

    public function insertList()
    {
        if (
            $this->user != null &&
            $this->state != null &&
            $this->movie != null &&
            $this->typeMTV != null
        ) {
            $listClass = new Lista();

            $return = $listClass->insertList($this->user, $this->state, $this->movie, $this->typeMTV);

            if ($return->rowCount() != 0)
                return 200;
            else
                return 400;
        }
    }

    public function getList()
    {
        if (
            $this->user != null &&
            $this->movie != null &&
            $this->typeMTV != null
        ) {
            $listClass = new Lista();

            $return = $listClass->getList($this->user, $this->movie, $this->typeMTV);


            return $return;
        }
    }

    public function deleteList()
    {
        if (
            $this->user != null &&
            $this->movie != null &&
            $this->typeMTV != null
        ) {
            $listClass = new Lista();

            $return = $listClass->deleteList($this->user, $this->movie, $this->typeMTV);


            return $return;
        }
    }


    public function updateList()
    {
        if (
            $this->user != null &&
            $this->movie != null &&
            $this->typeMTV != null
        ) {
            $listClass = new Lista();

            $return = $listClass->updateList($this->user, $this->movie, $this->typeMTV);


            return $return;
        }
    }

    public function getListByUser($userEmail, $typeMTV)
    {
        $list = new ListaDB();

        $return = $list->getListByUser($userEmail, $typeMTV);

        return $return;
    }
}
