<?php

require_once(dirname(__FILE__) . "/../../model/Comment.php");

session_start();

class CommentController
{
    private $user;
    private $comment;
    private $commentId;
    private $movie;

    public function __construct()
    {
        $this->user = $_SESSION['user'];
        $this->comment = isset($_POST['comment']) ? $_POST['comment'] : null;
        $this->commentId = isset($_POST['commentId']) ? $_POST['commentId'] : null;
        $this->movie = isset($_POST['movieId']) ? $_POST['movieId'] : null;;
    }

    public function insertComment()
    {
        if (
            $this->user != null &&
            $this->comment != null &&
            $this->movie != null
        ) {
            $commentClass = new Comment();

            $return = $commentClass->insertComment($this->user, $this->comment, $this->movie);

            if ($return->rowCount() != 0)
                return 200;
            else
                return 400;
        }
    }

    public function getComments()
    {
        if (
            $this->user != null &&
            $this->movie != null
        ) {
            $commentClass = new Comment();

            $return = $commentClass->getComments($this->movie);


            return $return;
        }
    }

    public function deleteComment()
    {
        if (
            $this->commentId != null
        ) {
            $commentClass = new Comment();

            $return = $commentClass->deleteComment($this->commentId);


            return $return;
        }
    }
}
