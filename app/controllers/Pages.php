<?php

class Pages extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        if (isLogedIn()) {
            redirect('posts');
        }
        $data = [
            'header' => 'Share Post App',
            'description' => 'Simple social network build on the NamliMVC framework',
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'header' => 'About Us',
            'description' => 'App to share posts with other users',
        ];
        $this->view('pages/about', $data);
    }
}
