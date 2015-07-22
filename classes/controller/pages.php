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
            'media/labyrinth/js/script.js',
            'media/labyrinth/js/jquery.fitvids.js'
        );

        $this->template->header->title = $this->title;
        $this->template->footer = View::factory('template/footer');

        $page = $this->request->param('template', 'page');
        $this->template->body = View::factory('template/' . $page);
    }

    public function action_index() {

        $this->template->body->content = View::factory('page/index');

        $media_title_id = Path::lookup('pages/media-title-top')['id'];
        $media_title_content = Post::dcache($media_title_id, 'page', Config::load('pages'));
        $this->template->body->content->mediatitle = $media_title_content->body;

        $five_words_id = Path::lookup('pages/index-five-words')['id'];
        $five_words_content = Post::dcache($five_words_id, 'page', Config::load('pages'));
        $this->template->body->content->fivewords = $five_words_content->body;

        $this->template->body->content->video = View::factory('block/video-embed');

        $left_room_id = Path::lookup('pages/index-left-room')['id'];
        $left_room_content = Post::dcache($left_room_id, 'page', Config::load('pages'));
        $this->template->body->content->lroom = $left_room_content->body;

        $right_room_id = Path::lookup('pages/index-right-room')['id'];
        $right_room_content = Post::dcache($right_room_id, 'page', Config::load('pages'));
        $this->template->body->content->rroom = $right_room_content->body;

        $right_blurb_id = Path::lookup('pages/blurb-right')['id'];
        $right_blurb_content = Post::dcache($right_blurb_id, 'page', Config::load('pages'));
        $this->template->body->content->blurbright = $right_blurb_content->body;

        $center_blurb_id = Path::lookup('pages/blurb-center')['id'];
        $center_blurb_content = Post::dcache($center_blurb_id, 'page', Config::load('pages'));
        $this->template->body->content->blurbcenter = $center_blurb_content->body;

        $left_blurb_id = Path::lookup('pages/blurb-left')['id'];
        $left_blurb_content = Post::dcache($left_blurb_id, 'page', Config::load('pages'));
        $this->template->body->content->blurbleft = $left_blurb_content->body;
    }
    
    public function action_faq() {
        $this->template->body->content = View::factory('page/faq');
        
        $maintext_id = Path::lookup('pages/faq-maintext')['id'];
        $maintext_content = Post::dcache($maintext_id, 'page', Config::load('pages'));
        $this->template->body->content->maintext = $maintext_content->body;
        
        $this->template->body->content->faqs = array();
        
        for ($i = 0; $i < 8; $i++){
            $faq = View::factory('block/picture-text');
            if($i %2 ===0){
                $side = 'left';
            } else {
                $side = 'right';
            }
            $faq->title = 'test title';
            $faq->icon = 'fa-question-circle';
            $faq->text = 'This is test content. There\'s other content like this, but this content is mine.';
            $faq->side = $side;
            $this->template->body->content->faqs[] = $faq;
        }
    }
    
    public function action_contact() {
        
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
            if(empty($this->template->body->content)){
                $this->template->body->content = '';
            }
            $body = $this->template->header->render();
            $body .= $this->template->body->render();
            $body .= $this->template->footer->render();
            $this->response->body($body);
        }
    }

}
