<?php
    class Posts extends Controller {
        public function __construct() {
            $this->newPost = $this->model('Post');
        }

        public function index() {
           $post = $this->newPost->showAllPost();
           $data = [
            'post' => $post
           ];
            $this->view('posts/index', $data);
        }

        public function create() {
           if (!isloggedin()) {
            header('location:'. URLROOT . '/posts/create');
           }
            $data = [
                'user_id' => '',
                'title' => '',
                'body' => '',
                'titleError' => '',
                'bodyError' => ''
               ];
               if (strtoupper($_SERVER['REQUEST_METHOD'] == 'POST')) {
                    if (isset($_POST['submit'])) {
                        $data = [
                            'user_id' => $_SESSION['user_id'],
                            'title' => htmlspecialchars(rtrim($_POST['title'])),
                            'body' => htmlspecialchars(rtrim($_POST['body'])),
                            'titleError' => '',
                            'bodyError' => ''
                           ];
                        //    Validation
                        if (empty($data['title'])) {
                            $data['titleError'] = 'Enter the title of the post';
                        }
                        if (empty($data['body'])) {
                            $data['bodyError'] = 'Enter the body of the post';
                        }
                        if (empty($data['titleError']) && empty($data['bodyError'])) {
                            if ($this->newPost->createPost($data)){
                                header('location:'. URLROOT . '/posts/index');
                            }else {
                                $data['bodyError'] = 'Something went wrong, please try again';
                                header('location:'. URLROOT . '/posts/create');
                            }
                         
                        } else {
                            $this->view('posts/create', $data);
                        }
                    }
               }
                $this->view('posts/create', $data);
        }

        public function update($id) {
            $post = $this->newPost->findPostById($id);
            if (!isloggedIn()) {
                header('location:'. URLROOT . '/posts');
            } elseif ($post->user_id != $_SESSION['user_id']) {
                header('location:'. URLROOT . '/posts');
            }
            
            $data = [
                'post' => $post,
                'title' => '',
                'body' => '',
                'titleError' => '',
                'bodyError' => ''
            ];
            if (strtoupper($_SERVER['REQUEST_METHOD'] == 'POST')) {
                if (isset($_POST['submit'])) {
                    $data = [
                        'post' => $post,
                        'id' => $id,
                        'user_id' => $_SESSION['user_id'],
                        'title' => htmlspecialchars(rtrim($_POST['title'])),
                        'body' => htmlspecialchars(rtrim($_POST['body'])),
                        'titleError' => '',
                        'bodyError' => ''
                       ];
                    //    Validation
                    if (empty($data['title'])) {
                        $data['titleError'] = 'Enter the title of the post';
                    } elseif ($data['title'] == $post->post_title) {
                        $data['titleError'] = 'modify your title';
                    }
                    if (empty($data['body'])) {
                        $data['bodyError'] = 'Enter the body of the post';
                    } elseif ($data['body'] == $post->post_body) {
                        $data['bodyError'] = 'modify your body';
                    }
                    if (empty($data['titleError']) && empty($data['bodyError'])) {
                        if ($this->newPost->updatePost($data)){
                            header('location:'. URLROOT . '/posts/index');
                        }else {
                            $data['bodyError'] = 'Something went wrong, please try again';
                            header('location:'. URLROOT . '/posts/update');
                        }
                     
                    } else {
                }       $this->view('posts/update', $data);
            }       }
            $this->view('posts/update', $data);
        }

        public function delete($id) {
            $post = $this->newPost->findPostById($id);
            if (!isloggedIn()) {
                header('location:'. URLROOT . '/posts');
            } elseif ($post->user_id != $_SESSION['user_id']) {
                header('location:'. URLROOT . '/posts');
            }
            $data = [
                'post' => $post,
                'title' => '',
                'body' => '',
                'titleError' => '',
                'bodyError' => ''
            ];
            if (strtoupper($_SERVER['REQUEST_METHOD'] == 'POST')) {
                if (isset($_POST['submit'])) {
                    if ($this->newPost->deletePost($id)) {
                        header('location:'. URLROOT . '/posts');
                    }else {
                        die("something went wrong");
                    }
                }
            }
        }
    }