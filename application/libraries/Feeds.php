<?php if (!defined('BASEPATH')) exit ('No direct script access allowed');
/**
 * RSS Feed generator library for CodeIgniter Framework.
 *
 * @author Rajitha Bandara
 * @version 1.0.0
 * @link http://roumen.it/projects/ci-feed
 * @license http://opensource.org/licenses/mit-license.php MIT License
 */

class Feeds
{
    public $title;
    public $description;
    public $link;
    
    public $copyright;
    public $language;
    public $docs;
    public $generator;
    public $pub_date;
    public $web_master_email;

    public $encoding = 'utf-8';
    public $items = array();

    public function __construct() {
        $CI =& get_instance();
        $CI->load->helper('xml');
        $CI->load->helper('url');
    }
    /**
     * Add Feed item
     *
     * @param string $title
     * @param string $link
     * @param string $pubdate
     * @param string $author
     * @param string $slug
     * @param string $description
     * @param array $categories
     *
     * @return void
     */
    public function add($title, $link, $pub_date, $author, $slug, $description, $categories = array())
    {
        $item = array(
            'title' => $title,
            'link' => $link,
            'pub_date' => $pub_date,
            'author' => $author,
            'slug' => $slug,
            'categories' => $categories,
            'description' => $description
        );
        array_push($this->items, $item);
    }


    /**
     * Returns feeds
     * @return view
     */
    public function display()
    {
        $CI =& get_instance();

        if (empty($this->language)) $this->lang = $CI->config->item('language');
        if (empty($this->link)) $this->link = $CI->config->item('base_url');
        if (empty($this->pub_date)) $this->pub_date = date('D, d M Y H:i:s O');

        $channel = array(
            'encoding' => $this->encoding,
            'title'=>$this->title,
            'description'=>$this->description,
            'link'=>$this->link,
            'copyright'=>$this->copyright,
            'language'=>$this->language,
            'docs' => $this->docs,
            'generator' => $this->generator,
            'pub_date' => $this->pub_date,
            'web_master_email' => $this->web_master_email
        );
        $data['channel'] = $channel;
        $data['items'] = $this->items;

        $CI->load->view('rss', $data);
    }

}