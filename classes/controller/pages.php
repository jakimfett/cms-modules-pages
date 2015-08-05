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
        
        $footer_blurb_id = Path::lookup('pages/footer-blurb')['id'];
        $footer_blurb_content = Post::dcache($footer_blurb_id, 'page', Config::load('pages'));
        $this->template->body->footerblurb = $this->_sanitize_text($footer_blurb_content->body);
        $this->template->body->footnav = View::factory('template/footnav');
        $this->template->body->footnav->links = array(
            'home' => '/',
            'FAQ' => '/faq',
            'contact' => '/contact',
            'facebook' => 'https://www.facebook.com/solvethelabyrinth',
            'twitter' => 'https://twitter.com/labyrinthpdx'
        );
        
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

        $count = 0;
        $faq_tag_id = 3;
        $faqs = ORM::factory('tag', $faq_tag_id)->posts->order_by('id', 'ASC')->find_all();
        foreach ($faqs as $faq_data) {
            $faq = View::factory('block/faq');
            if ($count % 2 === 0) {
                $side = 'left';
            } else {
                $side = 'right';
            }
            $faq->title = $faq_data->title;
            $faq->icon = 'fa-question-circle';
            $faq->text = $this->_sanitize_text($faq_data->body);
            $faq->side = $side;
            $this->template->body->content->faqs[] = $faq;
            $count++;
        }
    }

    private function _sanitize_text($text) {
        $needles = array(
            'Â',
            ' Â ',
            '  ',
            ' &nbsp;',
            '&nbsp; ',
            'Ã',
            'Â'
        );

        return str_replace($needles, '', $text);
    }

    public function action_contact() {
        $this->template->body->content = View::factory('page/contact');

        $maintext_id = Path::lookup('pages/contact-maintext')['id'];
        $maintext_content = Post::dcache($maintext_id, 'page', Config::load('pages'));
        $this->template->body->content->maintext = $maintext_content->body;

        $this->template->body->content->profiles = array();

        $count = 0;
        $contact_tag_id = 4;
        $profiles = ORM::factory('tag', $contact_tag_id)->posts->order_by('title', 'ASC')->find_all();
        
        foreach ($profiles as $profile) {
            $profile_block = View::factory('block/profile');
            if ($count % 2 === 0) {
                $side = 'left';
            } else {
                $side = 'right';
            }
            $profile_block->title = $profile->title;
            $profile_block->image = $profile->image;
            $profile_block->icon = 'fa-question-circle';
            $profile_block->text = $this->_sanitize_text($profile->body);
            $profile_block->side = $side;
            $this->template->body->content->profiles[] = $profile_block;
            $count++;
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
            if (empty($this->template->body->content)) {
                $this->template->body->content = '';
            }
            $body = $this->template->header->render();
            $body .= $this->template->body->render();
            $body .= $this->template->footer->render();
            $this->response->body($body);
        }
    }

}
