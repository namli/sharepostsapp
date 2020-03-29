<?php

class Posts extends Controller
{
    public function __construct()
    {
        if (!isLogedIn()) {
            redirect('users/login');
        }
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts,
        ];

        try {
            $this->view('posts/index', $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function add()
    {
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];

            // Validate
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body';
            }

            // Load View with errors
            if (!empty($data['title_err']) || !empty($data['body_err'])) {
                try {
                    $this->view('posts/add', $data);
                } catch (\Throwable $th) {
                    die($th);
                }
            } else {
                // add post to DB
                try {
                    $this->postModel->addPost($data);
                    setFlash('posts_added', 'Post added');
                    redirect('posts');
                } catch (\Throwable $th) {
                    die($th);
                }
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
                'title_err' => '',
                'body_err' => '',
            ];

            try {
                $this->view('posts/add', $data);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    // Get User by ID
    public function show(int $id = null)
    {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user,
        ];

        $this->view('posts/show', $data);
    }

    // Edit post
    public function edit(int $id = null)
    {
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'id' => $id,
                'title_err' => '',
                'body_err' => '',
            ];

            // Validate
            if (empty($data['title'])) {
                $data['title_err'] = 'Please enter title';
            }

            if (empty($data['body'])) {
                $data['body_err'] = 'Please enter body';
            }

            // Load View with errors
            if (!empty($data['title_err']) || !empty($data['body_err'])) {
                try {
                    $this->view('posts/edit', $data);
                } catch (\Throwable $th) {
                    die($th);
                }
            } else {
                // add post to DB
                try {
                    $this->postModel->editPost($data);
                    setFlash('posts_added', 'Post updated');
                    redirect('posts');
                } catch (\Throwable $th) {
                    die($th);
                }
            }
        } else {
            $post = $this->postModel->getPostById($id);

            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body,
                'title_err' => '',
                'body_err' => '',
            ];

            try {
                $this->view('posts/edit', $data);
            } catch (\Throwable $th) {
                throw $th;
            }
        }
    }

    // Delete post
    public function delete(int $id = null)
    {
        if ('POST' == $_SERVER['REQUEST_METHOD']) {
            $post = $this->postModel->getPostById($id);

            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }

            try {
                $this->postModel->deletePost($id);
                setFlash('post_message', 'Post deleted');
                redirect('posts');
            } catch (\Throwable $th) {
                die($th);
            }
        } else {
            redirect('pages');
        }
    }
}
