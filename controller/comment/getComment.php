<?php


header("Content-Type: application/json");

require_once(dirname(__FILE__) . "./CommentController.php");

$comment = new CommentController();

echo json_encode($comment->getComments());
