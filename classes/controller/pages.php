<?php

class Controller_Pages extends Controller_Template
{

    public $template = 'template/blank';
    public $title;

    /**
     * Loads the template [View] object.
     */
    public function before()
    {
        parent::before();

        Theme::set_theme('labyrinth');

        $this->title = $this->request->param('template');
        if (empty($this->title)) {
            $this->title = 'Labyrinth';
        }

        $this->template->header          = View::factory('template/header');
        $this->template->header->scripts = array(
            'https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js',
            '/media/labyrinth/js/script.js',
            '/media/labyrinth/js/jquery.fitvids.js'
        );

        $this->template->header->title = $this->title;
        $this->template->footer        = View::factory('template/footer');

        $page                 = $this->request->param('template', 'page');
        $this->template->body = View::factory('template/' . $page);

        $footer_blurb_id                      = Path::lookup('pages/footer-blurb')['id'];
        $footer_blurb_content                 = Post::dcache($footer_blurb_id, 'page', Config::load('pages'));
        $this->template->body->footerblurb    = $this->_sanitize_text($footer_blurb_content->body);
        $this->template->body->footnav        = View::factory('template/footnav');
        $this->template->body->footnav->links = array(
            'home' => '/',
            'FAQ' => '/faq',
            'contact' => '/contact',
            'chapters' => '/chapters',
            'facebook' => 'https://www.facebook.com/solvethelabyrinth',
            'twitter' => 'https://twitter.com/labyrinthpdx'
        );

        $meta_tag_id                       = 5;
        $meta_list                         = ORM::factory('tag', $meta_tag_id)->posts->order_by('id', 'ASC')->find_all();
        $this->template->header->meta_data = array();
        foreach ($meta_list as $meta_single) {
            $this->template->header->meta_data[$this->_sanitize_text($meta_single->title)] = $this->_sanitize_text($meta_single->body);
        }

        $opengraph_tag_id                       = 6;
        $opengraph_list                         = ORM::factory('tag', $opengraph_tag_id)->posts->order_by('id', 'ASC')->find_all();
        $this->template->header->opengraph_data = array();
        foreach ($opengraph_list as $opengraph_single) {
            $this->template->header->opengraph_data[$this->_sanitize_text($opengraph_single->title)] = $this->_sanitize_text($opengraph_single->body);
        }
    }

    public function action_index()
    {

        $this->template->body->content = View::factory('page/index');

        $pitch_id                                  = Path::lookup('pages/index-top-pitch')['id'];
        $pitch_content                             = Post::dcache($pitch_id, 'page', Config::load('pages'));
        $this->template->body->content->pitchtitle = $this->_sanitize_text($pitch_content->title);
        $this->template->body->content->pitch      = $this->_sanitize_text($pitch_content->body);

        $followup_id                                  = Path::lookup('pages/index-followup')['id'];
        $followup_content                             = Post::dcache($followup_id, 'page', Config::load('pages'));
        $this->template->body->content->followuptitle = $this->_sanitize_text($followup_content->title);
        $this->template->body->content->followup      = $this->_sanitize_text($followup_content->body);

        $this->template->body->content->video = View::factory('block/video-embed');

        $left_room_id                             = Path::lookup('pages/index-left-room')['id'];
        $left_room_content                        = Post::dcache($left_room_id, 'page', Config::load('pages'));
        $this->template->body->content->lroom_img = $left_room_content->image;
        $this->template->body->content->lroom     = $left_room_content->body;

        $right_room_id                            = Path::lookup('pages/index-right-room')['id'];
        $right_room_content                       = Post::dcache($right_room_id, 'page', Config::load('pages'));
        $this->template->body->content->rroom_img = $right_room_content->image;
        $this->template->body->content->rroom     = $right_room_content->body;

        $right_blurb_id                            = Path::lookup('pages/blurb-right')['id'];
        $right_blurb_content                       = Post::dcache($right_blurb_id, 'page', Config::load('pages'));
        $this->template->body->content->blurbright = $right_blurb_content->body;

        $center_blurb_id                            = Path::lookup('pages/blurb-center')['id'];
        $center_blurb_content                       = Post::dcache($center_blurb_id, 'page', Config::load('pages'));
        $this->template->body->content->blurbcenter = $center_blurb_content->body;

        $left_blurb_id                            = Path::lookup('pages/blurb-left')['id'];
        $left_blurb_content                       = Post::dcache($left_blurb_id, 'page', Config::load('pages'));
        $this->template->body->content->blurbleft = $left_blurb_content->body;

        $closing_id                             = Path::lookup('pages/blurb-closing')['id'];
        $closing_content                        = Post::dcache($closing_id, 'page', Config::load('pages'));
        $this->template->body->content->closing = $closing_content->body;
    }

    public function action_faq()
    {
        $this->template->body->content = View::factory('page/faq');

        $maintext_id                             = Path::lookup('pages/faq-maintext')['id'];
        $maintext_content                        = Post::dcache($maintext_id, 'page', Config::load('pages'));
        $this->template->body->content->maintext = $maintext_content->body;

        $this->template->body->content->faqs = array();

        $count      = 0;
        $faq_tag_id = 3;
        $faqs       = ORM::factory('tag', $faq_tag_id)->posts->order_by('id', 'ASC')->find_all();
        foreach ($faqs as $faq_data) {
            $faq = View::factory('block/faq');
            if ($count % 2 === 0) {
                $side = 'left';
            } else {
                $side = 'right';
            }
            $faq->title                            = $faq_data->title;
            $faq->icon                             = 'fa-question-circle';
            $faq->text                             = $this->_sanitize_text($faq_data->body);
            $faq->side                             = $side;
            $this->template->body->content->faqs[] = $faq;
            $count++;
        }
    }

    private function _sanitize_text($text)
    {
        $needles = array(
            'Â',
            ' Â ',
            '  ',
            ' &nbsp;',
            '&nbsp; ',
            'Ã',
            'Â'
        );

        return trim(str_replace($needles, '', $text));
    }

    public function action_contact()
    {
        $this->template->body->content = View::factory('page/contact');

        $maintext_id                             = Path::lookup('pages/contact-maintext')['id'];
        $maintext_content                        = Post::dcache($maintext_id, 'page', Config::load('pages'));
        $this->template->body->content->maintext = $maintext_content->body;

        $subscribe_id                             = Path::lookup('pages/subscribe')['id'];
        $subscribe_content                        = Post::dcache($subscribe_id, 'page', Config::load('pages'));
        $this->template->body->content->subscribe = $subscribe_content->body;

        $this->template->body->content->profiles = array();

        $count          = 0;
        $contact_tag_id = 4;
        $profiles       = ORM::factory('tag', $contact_tag_id)->posts->order_by('title', 'ASC')->find_all();

        foreach ($profiles as $profile) {
            $profile_block = View::factory('block/profile');
            if ($count % 2 === 0) {
                $side = 'left';
            } else {
                $side = 'right';
            }
            $profile_block->title                      = $profile->title;
            $profile_block->image                      = $profile->image;
            $profile_block->icon                       = 'fa-question-circle';
            $profile_block->text                       = $this->_sanitize_text($profile->body);
            $profile_block->side                       = $side;
            $this->template->body->content->profiles[] = $profile_block;
            $count++;
        }

        $address_id                             = Path::lookup('pages/contact-address')['id'];
        $address_content                        = Post::dcache($address_id, 'page', Config::load('pages'));
        $this->template->body->content->address = $address_content->body;
    }

    public function action_rendertest()
    {

        $section = $this->request->param('section', 'cmsblock');
        $view    = $this->request->param('view', 'rendertest');

        $this->template->body = View::factory($section . '/' . $view);


        $template = 'pages/' . $this->request->param('alias', 'index');

        $post = Post::dcache(Path::lookup($template)['id'], 'page', Config::load('pages'));

        $this->template->body->text = $post->body;
    }

    public function action_unsubscribe()
    {
        $this->template->body->content = View::factory('page/unsubscribe');

        $email_name                                   = filter_var($this->request->param('email'), FILTER_SANITIZE_EMAIL);
        $email_encoded_domain                         = filter_var($this->request->param('domain'), FILTER_SANITIZE_EMAIL);
        $email_domain                                 = str_replace('DOT', '.', $email_encoded_domain);
        $this->template->body->content->email_address = filter_var($email_name . "@" . $email_domain, FILTER_SANITIZE_EMAIL);


        $unsubscribe_id                                    = Path::lookup('pages/unsubscribe-message')['id'];
        $unsubscribe_content                               = Post::dcache($unsubscribe_id, 'page', Config::load('pages'));
        $this->template->body->content->unsubscribe_image  = $unsubscribe_content->image;
        $this->template->body->content->unsubscribe_notice = $this->_sanitize_text($unsubscribe_content->body);

        $email_address = $this->request->post('email');
        if (isset($email_address)) {
            $db_newsletter   = Model::factory("Newsletter");
            $duplicate_check = $db_newsletter->check_duplicate_email($email_address);
            if ($duplicate_check->count() === 0) {
                $this->template->body->content->response = 'UNREGISTERED';
            } else {
                $opt_out_check = $db_newsletter->get_opt_out($email_address);
                if (isset($opt_out_check->as_array()[0]['opt_out'])) {
                    if ($opt_out_check->as_array()[0]['opt_out'] == 0) {
                        if ($db_newsletter->set_opt_out($email_address, TRUE)) {
                            $db_newsletter->add_subscription_note_by_email($email_address, $this->request->post('note'));
                            $this->template->body->content->response = 'UNSUBSCRIBED';
                        }
                    } else {
                        $this->template->body->content->response = 'REUNSUBSCRIBED';
                    }
                }
            }
        }
    }

    public function action_chapters()
    {
        $this->template->body->content = View::factory('page/chapters');

        $chapter_number = filter_var($this->request->param('chapter_id'), FILTER_SANITIZE_NUMBER_INT);

        if (is_numeric($chapter_number)) {

            $chapter_id      = Path::lookup("pages/chapter-{$chapter_number}")['id'];
            $chapter_content = Post::dcache($chapter_id, 'page', Config::load('pages'));

            $chapter = View::factory('block/chapter');

            $chapter->title                         = $chapter_content->title;
            $chapter->image                         = $chapter_content->image;
            $chapter->text                          = $this->_sanitize_text($chapter_content->body);
            $this->template->body->content->chapter = $chapter;

            $this->template->body->content->chapter_image = $chapter_content->image;
            $this->template->body->content->chapter_text  = $this->_sanitize_text($chapter_content->body);
        } else {

            $chapter_tag_id = 7;
            $chapters       = ORM::factory('tag', $chapter_tag_id)->posts->order_by('id', 'DESC')->find_all();

            $this->template->body->content->chapters = array();

            $count = 0;

            foreach ($chapters as $chapter_data) {
                $chapter_number_calculate = substr($chapter_data->title, 8);
                $chapter                  = View::factory('block/chapter-list');
                $chapter->title           = $chapter_data->title;
                $chapter->link            = "/chapters/{$chapter_number_calculate}";
                $chapter->image           = $chapter_data->image;
                if ($count % 2 == 0) {
                    $chapter->image_align = 'right';
                } else {
                    $chapter->image_align = 'left';
                }
                $count++;

                $chapter_paragraphs = explode('<p>', $this->_sanitize_text($chapter_data->body));
                $teaser             = trim(str_replace('</p>', '', $chapter_paragraphs[1]));
                $teaser .= '<br/><br/>';
                $teaser .= trim(str_replace('</p>', '', $chapter_paragraphs[2]));

                $chapter->teaser                           = $teaser;
                $this->template->body->content->chapters[] = $chapter;
            }

            $closing_id                             = Path::lookup('pages/blurb-closing')['id'];
            $closing_content                        = Post::dcache($closing_id, 'page', Config::load('pages'));
            $this->template->body->content->closing = $closing_content->body;
        }


        $maintext_id                             = Path::lookup('pages/chapters-maintext')['id'];
        $maintext_content                        = Post::dcache($maintext_id, 'page', Config::load('pages'));
        $this->template->body->content->maintext = $maintext_content->body;
    }

    public function action_subscribe()
    {
        $this->template->body->content = View::factory('page/subscribe');

        if (!empty($this->re['HTTP_CLIENT_IP'])) {
            $ip_raw = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip_raw = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip_raw = $_SERVER['REMOTE_ADDR'];
        }

        $email_address = filter_var($this->request->post('email'), FILTER_SANITIZE_EMAIL);
        $name          = filter_var($this->request->post('name'), FILTER_SANITIZE_STRING);

        if (!empty($email_address)) {
            $this->template->body->content->response = 'FAILURE';

            $db_newsletter = Model::factory("Newsletter");

            $duplicate_check = $db_newsletter->check_duplicate_email($email_address);
            if ($duplicate_check->count() !== 0) {
                $this->template->body->content->response = 'DUPLICATE';
            } else {
                $city   = null;
                $region = null;
                if (!filter_var($ip_raw, FILTER_VALIDATE_IP) === false) {

                    $details = json_decode(file_get_contents("http://ipinfo.io/{$ip_raw}/json"));

                    if (isset($details->city)) {
                        $city = $details->city;
                    }
                    if (isset($details->region)) {
                        $region = $details->region;
                    }
                    /**
                     * Note the conversion of the IP address using ip2long
                     * @link http://daipratt.co.uk/mysql-store-ip-address/
                     */
                    $insert = $db_newsletter->subscribe_user_by_email($email_address, $name, ip2long($ip_raw), $city, $region);
                } else {
                    $insert = $db_newsletter->subscribe_user_by_email($email_address, $name);
                }


                if (isset($insert[0])) {
                    if ($insert[0] > 0) {
                        if ($db_newsletter->send_email_confirmations($email_address, $name)) {
                            $this->template->body->content->response = 'SUBSCRIBED';
                        }
                    }
                }
            }
        }



        $newsletter_subscribe_id                                   = Path::lookup('pages/newsletter-subscribe')['id'];
        $newsletter_subscribe_content                              = Post::dcache($newsletter_subscribe_id, 'page', Config::load('pages'));
        $this->template->body->content->newsletter_subscribe_image = $newsletter_subscribe_content->image;
        $this->template->body->content->newsletter_subscribe       = $this->_sanitize_text($newsletter_subscribe_content->body);


        $press_notice_id                             = Path::lookup('pages/press-notice')['id'];
        $press_notice_content                        = Post::dcache($press_notice_id, 'page', Config::load('pages'));
        $this->template->body->content->press_notice = $this->_sanitize_text($press_notice_content->body);


        $this->template->body->tickets_page = true;
    }

    public function action_redeem()
    {
        header('Location: http://bookeo.com/labyrinth');
        exit;
    }

    public function after()
    {
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
