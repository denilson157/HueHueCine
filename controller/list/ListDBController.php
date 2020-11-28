<?php

require_once(dirname(__FILE__) . "/../../model/ListDB.php");


class ListDBController
{
    private $user;

    public function __construct()
    {
        $this->user = $_SESSION['user'];
    }

    public function getListByUser($typeMTV)
    {
        $list = new ListaDB();

        $return = $list->getListByUser($this->user, $typeMTV);

        return $return;
    }
}
