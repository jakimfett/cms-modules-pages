<?php

class Controller_Pages extends Controller_Template {

    public $template = 'template/blank';
    public $title;

    /**
     * Loads the template [View] object.
     */
    public function before() {
        parent::before();

        $this->title = $this->request->param('template');
        if (empty($this->title)) {
            $this->title = 'Labyrinth';
        }

        $this->template->header = View::factory('template/header');
        $this->template->header->title = $this->title;
        $this->template->footer = View::factory('template/footer');
    }

    public function action_index() {

        $this->template->body = View::factory('static/index');


        $template = 'pages/' . $this->request->param('template', 'index');

        $post = Post::dcache(Path::lookup($template)['id'], 'page', Config::load('pages'));

        $this->template->body->promotext = $post->body;
    }

    public function action_rendertest() {

        $section = $this->request->param('section', 'cmsblock');
        $view = $this->request->param('view', 'rendertest');
        
        $this->template->body = View::factory($section . '/' . $view);


        $template = 'pages/' . $this->request->param('alias', 'index');

        $post = Post::dcache(Path::lookup($template)['id'], 'page', Config::load('pages'));

        $this->template->body->text = $post->body;
    }

    public function after() {
        if ($this->auto_render === TRUE) {
            $body = $this->template->header->render();
            $body .= $this->template->body->render();
            $body .= $this->template->footer->render();
            $this->response->body($body);
        }
    }

}
