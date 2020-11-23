<?php

header("Content-Type: application/json");

require_once(dirname(__FILE__) . "./Comment/CommentController.php");

$comment = new CommentController();

echo json_encode($comment->insertComment());
