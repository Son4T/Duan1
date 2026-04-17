<?php
class AdminCommentController
{
    public function index()
    {
        $categories = (new Category)->all();
        $message = session_flash('message');
        $comments = (new Comment)->getAllComments();
        return view('Admin.comment.list', compact('comments', 'message'));
    }

    public function delete()
    {
        $id = $_GET['id'];
        (new Comment)->deleteComment($id);
        header("Location: index.php?role=admin&act=Comment");
        exit();
    }
}
