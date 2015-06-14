<?php

class Controller_Pages extends Controller_Template {

    public $template = 'template/blank';
    public $title;

    /**
     * Loads the template [View] object.
     */
    public function before() {
        parent::before();

        Theme::set_theme('labyrinth');

        $this->title = $this->request->param('template');
        if (empty($this->title)) {
            $this->title = 'Labyrinth';
        }

        $this->template->header = View::factory('template/header');
        $this->template->header->scripts = array(
            'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
            'media/labyrinth/js/script.js'
        );

        $this->template->header->title = $this->title;
        $this->template->footer = View::factory('template/footer');
    }

    public function action_index() {
        
        $page = $this->request->param('template', 'index');

        $this->template->body = View::factory('static/' . $page);

        switch ($page) {
            case 'index':
                $five_words_id = Path::lookup('pages/index-five-words')['id'];
                $five_words_content = Post::dcache($five_words_id, 'page', Config::load('pages'));
                $this->template->body->fivewords = $five_words_content->body;

                $elevator_pitch_id = Path::lookup('pages/index-elevator-pitch')['id'];
                $elevator_pitch_content = Post::dcache($elevator_pitch_id, 'page', Config::load('pages'));
                $this->template->body->pitch = $elevator_pitch_content->body;

                $left_room_id = Path::lookup('pages/index-left-room')['id'];
                $left_room_content = Post::dcache($left_room_id, 'page', Config::load('pages'));
                $this->template->body->lroom = $left_room_content->body;

                $right_room_id = Path::lookup('pages/index-right-room')['id'];
                $right_room_content = Post::dcache($right_room_id, 'page', Config::load('pages'));
                $this->template->body->rroom = $right_room_content->body;

                break;

            default:
                break;
        }
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
