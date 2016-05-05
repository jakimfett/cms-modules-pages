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
            '/media/labyrinth/js/jquery.fitvids.js',
            '/media/labyrinth/js/viewport.js',
            '/media/labyrinth/js/skrollr.js',
            '/media/labyrinth/js/labyrinth-main.js'
        );

        $this->template->header->title = $this->title;
        $this->template->footer        = View::factory('template/footer');

        $page                 = $this->request->param('template', 'page');
        $this->template->body = View::factory('template/' . $page);

        $this->template->body->navigation        = View::factory('template/navigation');
        $this->template->body->navigation->fixed = false;
        $this->template->body->navigation->group = Request::current()->action();


        $this->template->body->impressum                  = View::factory('template/impressum');
        $address_id                                       = Path::lookup('pages/contact-address')['id'];
        $address_content                                  = Post::dcache($address_id, 'page', Config::load('pages'));
        $this->template->body->impressum->contact_address = $address_content->body;
        $footer_blurb_id                                  = Path::lookup('pages/footer-blurb')['id'];
        $footer_blurb_content                             = Post::dcache($footer_blurb_id, 'page', Config::load('pages'));
        $this->template->body->impressum->footer_blurb    = $this->_sanitize_text($footer_blurb_content->body);
        $copyright_id                                     = Path::lookup('pages/copyright')['id'];
        $copyright_content                                = Post::dcache($copyright_id, 'page', Config::load('pages'));
        $this->template->body->impressum->copyright       = $this->_sanitize_text($copyright_content->body);

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

        $this->template->body->content           = View::factory('page/index');
        $this->template->body->navigation->fixed = "#about";

        $cover                                = View::factory('block/box');
        $this->template->body->content->cover = $cover;
        $cover->id                            = 'intro';
        $cover->classes                       = 'intro macro-fullwidth';
        $cover->container_tween               = 'data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -500px;" data-anchor-target="#intro"';
        $cover->content_tween                 = 'data-150-top="opacity: 1" data-0-top="opacity: 0" data-anchor-target="#intro img"';
        $cover->content                       = View::factory('staticblock/index-cover');

        $pitch_id      = Path::lookup('pages/index-top-pitch')['id'];
        $pitch_content = Post::dcache($pitch_id, 'page', Config::load('pages'));

        $pitch                                = View::factory('block/box');
        $this->template->body->content->pitch = $pitch;
        $pitch->id                            = 'about';
        $pitch->classes                       = 'about bigtex macro-fullwidth';
        $pitch->container_tween               = 'data-center="background-position: 50% 0px;" data-top-bottom="background-position: 50% -100px;" data-anchor-target="#about"';
        $pitch->content_tween                 = 'data-anchor-target="#about .cols"';
        $pitch->content                       = View::factory('block/cols');
        $pitch->content->mode                 = 'er';
        $pitch->content->left                 = View::factory('block/video-embed');
        $pitch->content->right                = View::factory('block/text-region');
        $pitch->content->right->heading       = $this->_sanitize_text($pitch_content->title);
        $pitch->content->right->heading_level = 1;
        $pitch->content->right->content       = $this->_sanitize_text($pitch_content->body);

        $followup_id      = Path::lookup('pages/index-followup')['id'];
        $followup_content = Post::dcache($followup_id, 'page', Config::load('pages'));


        $games                                     = View::factory('block/box');
        $this->template->body->content->post_pitch = $games;
        $games->id                                 = 'games';
        $games->classes                            = 'games macro-fullwidth';
        $games->content_classes                    = 'bigtex backfill';
        $games->container_tween                    = 'data-bottom-top="background-position: 50% 0px;" data-top-bottom="background-position: 50% -150px;" data-anchor-target="#games"';
        $games->content_tween                      = '';
        $games->content                            = array();

        $preamble                = View::factory('block/text-region');
        $games->content[]        = $preamble;
        $preamble->heading       = $this->_sanitize_text($followup_content->title);
        $preamble->heading_level = 1;
        $preamble->content       = $this->_sanitize_text($followup_content->body);

        $left_room_id      = Path::lookup('pages/index-left-room')['id'];
        $left_room_content = Post::dcache($left_room_id, 'page', Config::load('pages'));

        $middle_room_id      = Path::lookup('pages/index-center-room')['id'];
        $middle_room_content = Post::dcache($middle_room_id, 'page', Config::load('pages'));

        $right_room_id      = Path::lookup('pages/index-right-room')['id'];
        $right_room_content = Post::dcache($right_room_id, 'page', Config::load('pages'));

        $rooms             = View::factory('block/grid');
        $games->content[]  = $rooms;
        $rooms->mode       = 'gamma';
        $rooms->one        = View::factory('block/room');
        $rooms->one->image = $left_room_content->image;
        $rooms->one->body  = $left_room_content->body;

        $rooms->two        = View::factory('block/room');
        $rooms->two->image = $middle_room_content->image;
        $rooms->two->body  = $middle_room_content->body;

        $rooms->three        = View::factory('block/room');
        $rooms->three->image = $right_room_content->image;
        $rooms->three->body  = $right_room_content->body;


        $parables                             = View::factory('block/box');
        $this->template->body->content->blurb = $parables;
        $parables->id                         = 'parables';
        $parables->classes                    = 'parables macro-fullwidth';
        $parables->content_classes            = 'wrap backfill bigtex pop';
        $parables->container_tween            = 'data-bottom-top="opacity: 0; top: 400px" data-100-top="opacity: 1; top: 0px;" data-top-bottom="top: -400px;" data-anchor-target="#parables"';
        $parables->content_tween              = 'data-anchor-target="#about .cols"';
        $parables->content                    = array();


        $left_blurb_id        = Path::lookup('pages/blurb-left')['id'];
        $left_blurb_content   = Post::dcache($left_blurb_id, 'page', Config::load('pages'));
        $center_blurb_id      = Path::lookup('pages/blurb-center')['id'];
        $center_blurb_content = Post::dcache($center_blurb_id, 'page', Config::load('pages'));
        $right_blurb_id       = Path::lookup('pages/blurb-right')['id'];
        $right_blurb_content  = Post::dcache($right_blurb_id, 'page', Config::load('pages'));

        $circles                 = View::factory('block/grid');
        $parables->content[]     = $circles;
        $circles->mode           = 'gamma';
        $circles->id             = 'blurbs';
        $circles->one            = View::factory('block/glyph-circle');
        $circles->one->type      = 'cogs';
        $circles->one->subtext   = $left_blurb_content->body;
        $circles->two            = View::factory('block/glyph-circle');
        $circles->two->type      = 'leanpub';
        $circles->two->subtext   = $center_blurb_content->body;
        $circles->three          = View::factory('block/glyph-circle');
        $circles->three->type    = 'key';
        $circles->three->subtext = $right_blurb_content->body;

        $closing_id            = Path::lookup('pages/blurb-closing')['id'];
        $closing_content       = Post::dcache($closing_id, 'page', Config::load('pages'));
        $closer                = View::factory('block/text-region');
        $parables->content[]   = $closer;
        $closer->heading       = $closing_content->body;
        $closer->heading_level = 1;
        $closer->content       = '';
    }

    private function page_band($uid, $title, $text)
    {
        $brief                                = View::factory('block/box');
        $brief->id                            = $uid;
        $brief->classes                       = 'about bigtex macro-halfwidth';
        $brief->content_classes               = '';
        $brief->container_tween               = 'data-0-top="background-position: 50% 100%;" data-top-bottom="background-position: 50% 0%;" data-anchor-target="#' . $uid . '"';
        $brief->content_tween                 = 'data-anchor-target="#' . $uid . ' .cols"';
        $brief->content                       = View::factory('block/cols');
        $brief->content->mode                 = 'sr';
        $brief->content->left                 = '';
        $brief->content->right                = View::factory('block/text-region');
        $brief->content->right_classes        = 'backfill';
        $brief->content->right->heading       = $title;
        $brief->content->right->heading_level = 1;
        $brief->content->right->content       = $text;
        return $brief;
    }

    private function tabulate($elements, $cols)
    {
        $count     = count($elements);
        $rows      = array();
        $odd_items = ($count % $cols);
        $odd_rows  = $odd_items != 0;

        if ($odd_rows) {
            $old_elements = $elements;
            $elements     = array();
            $pad          = $cols - $odd_items;
            for ($i = 0; $i < $count + $pad; $i++) {
                if ($i >= $count)
                    $elements[$i] = "";
                else
                    $elements[$i] = $old_elements[$i];
            }
        }

        for ($i = 0; $i < $count; $i += $cols) {
            $row = View::factory('block/grid');
            if ($cols == 2) {
                $row->mode = 'beta';
                $row->one  = $elements[$i];
                $row->two  = $elements[$i + 1];
            } else {
                $row->mode  = 'gamma';
                $row->one   = $elements[$i];
                $row->two   = $elements[$i + 1];
                $row->three = $elements[$i + 2];
            }
            $rows[] = $row;
        }

        return $rows;
    }

    public function action_faq()
    {
        $this->template->body->content         = View::factory('page/faq');
        $this->template->body->content->banner = $this->page_band("header-faqs", "Frequently Asked Questions", "Answers to all your questions!");

        $maintext_id      = Path::lookup('pages/faq-maintext')['id'];
        $maintext_content = Post::dcache($maintext_id, 'page', Config::load('pages'));

        $content                                = View::factory('block/box');
        $this->template->body->content->content = $content;
        $content->id                            = 'content';
        $content->classes                       = 'wrap bigtex backfill';
        $content->content_classes               = '';
        $content->container_tween               = '';
        $content->content_tween                 = '';
        $content->content                       = array();

        $preamble           = View::factory('block/text-region');
        $content->content[] = $preamble;
        $preamble->content  = $maintext_content->body;

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
            $faq->title         = $faq_data->title;
            $faq->icon          = 'fa-question-circle';
            $faq->text          = $this->_sanitize_text($faq_data->body);
            $faq->side          = $side;
            $content->content[] = $faq;
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
        $this->template->body->content         = View::factory('page/contact');
        $this->template->body->content->banner = $this->page_band("header-who", "About Us", "Meet the minds behind Labyrinth.");

        $maintext_id      = Path::lookup('pages/contact-maintext')['id'];
        $maintext_content = Post::dcache($maintext_id, 'page', Config::load('pages'));

        $subscribe_id      = Path::lookup('pages/subscribe')['id'];
        $subscribe_content = Post::dcache($subscribe_id, 'page', Config::load('pages'));

        $content                                = View::factory('block/box');
        $this->template->body->content->content = $content;
        $content->id                            = 'content';
        $content->classes                       = 'wrap backfill';
        $content->content_classes               = '';
        $content->container_tween               = '';
        $content->content_tween                 = '';
        $content->content                       = array();

        $preamble                = View::factory('block/text-region');
        $content->content[]      = $preamble;
        $preamble->classed       = true;
        $preamble->classes       = 'bigtex';
        $preamble->heading       = $maintext_content->body;
        $preamble->heading_level = 1;
        $preamble->content       = $subscribe_content->body;

        $profile_list = array();

        $count          = 0;
        $contact_tag_id = 4;
        $profiles       = ORM::factory('tag', $contact_tag_id)->posts->order_by('title', 'ASC')->find_all();

        foreach ($profiles as $profile) {
            $profile_block = View::factory('block/profile');
            $description   = $profile->title;
            $anchor        = strrpos($description, " - ");

            if ($anchor !== false) {
                $profile_block->name  = substr($description, 0, $anchor);
                $profile_block->title = substr($description, $anchor + 3);
            } else {
                $profile_block->name  = $description;
                $profile_block->title = "";
            }

            $profile_block->image = $profile->image;
            $profile_block->text  = $this->_sanitize_text($profile->body);
            $profile_list[]       = $profile_block;
            $count++;
        }

        $rows               = $this->tabulate($profile_list, 3);
        foreach ($rows as $row)
            $content->content[] = $row;

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

    public function action_games()
    {
        $this->template->body->content         = View::factory('page/games');
        $this->template->body->content->banner = $this->page_band("header-games", "games", "Immerse yourself in the narrative world of Labyrinth.");

        $content                                = View::factory('block/box');
        $this->template->body->content->content = $content;
        $content->id                            = 'content';
        $content->classes                       = 'wrap backfill';
        $content->content_classes               = '';
        $content->container_tween               = '';
        $content->content_tween                 = '';
        $content->content                       = array();

        $game_number = filter_var($this->request->param('game_id'), FILTER_SANITIZE_NUMBER_INT);

        if (is_numeric($game_number)) {

            $game_id      = Path::lookup("pages/game-{$game_number}")['id'];
            $game_content = Post::dcache($game_id, 'page', Config::load('pages'));

            $game = View::factory('block/game');

            $game->title      = $game_content->title;
            $game->image      = $game_content->image;
            $game->text       = $this->_sanitize_text($game_content->body);
            $content->content = $game;
        } else {

            $game_tag_id = 7;
            $games       = ORM::factory('tag', $game_tag_id)->posts->order_by('id', 'DESC')->find_all();

            $this->template->body->content->games = array();

            $count = 0;

            // @TODO - add a chapter ID field to the CMS admin
            // This is not a good way to do this
            $game_ids = array(
                1 => 'Inheritance',
                2 => 'Crucifixus',
                3 => 'Blitzkreig',
                4 => 'Cosmos'
            );

            foreach ($games as $game_data) {

                foreach ($game_ids as $game_id => $game_name) {
                    if (strpos(strtolower($game_data->title), strtolower($game_name)) !== false) {
                        $game_number = $game_id;
                        break;
                    }
                }
                if (empty($game_number)) {
                    continue;
                }

                $game        = View::factory('block/game-list');
                $game->title = $game_data->title;
                $game->link  = "/games/{$game_number}";
                $game->image = $game_data->image;
                if ($count % 2 == 0) {
                    $game->image_align = 'right';
                } else {
                    $game->image_align = 'left';
                }
                $count++;

                $game_paragraphs = explode('<p>', $this->_sanitize_text($game_data->body));
                $start           = 2;
                $end             = 3;
                $teaser          = '';

                foreach ($game_paragraphs as $key => $game_paragraph) {
                    if ($key >= $start) {
                        $teaser .= trim(str_replace('</p>', '', $game_paragraphs[$key]));
                        $teaser .= '<br/><br/>';
                        if ($key >= $end) {
                            break;
                        }
                    }
                }

                $game->teaser                   = $teaser;
                $content->content[$game_number] = $game;
            }

            ksort($content->content);
        }

        $closing_id                             = Path::lookup('pages/blurb-closing')['id'];
        $closing_content                        = Post::dcache($closing_id, 'page', Config::load('pages'));
        $this->template->body->content->closing = $closing_content->body;

        $maintext_id                             = Path::lookup('pages/games-maintext')['id'];
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
