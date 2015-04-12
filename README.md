<h1>CodeIgniter-Feeds</h1>
<p>RSS Feed Generator for CodeIgniter Framework</p>
<h2>Installation</h2>
<p>Just copy the files from this package to the corresponding folder in your application folder</p>
<h2>Example</h2>

```php
public function index() {
        //Fetch latest news, products, movies...etc what you need.
        $posts = $this->db->get('news')->result();

        //Load Feed library
        $this->load->library('feeds');
        $feeds = new Feeds();
        $feeds->encoding = "UTF-8";

        //Required channel properties in terms of RSS Feeds
        $feeds->title = "Title of the channel";
        $feeds->description = "Channel description";
        $feeds->link = "Channel URL";

        //optional channel properties in terms of RSS Feeds
        $feeds->copyright = "Copyright details";
        $feeds->language = 'The language the feed is written in. eg. en';
        $feeds->docs = "URL to the documentation of the format used in the feed";
        $feeds->generator = "Specifies the program used to generate the feed";
        $feeds->pub_date =   date('D, d M Y H:i:s O', time());//Last publication date for the content of the feed;
        $feeds->web_master_email = "E-mail address to the webmaster of the feed";
        
        // add posts to the feed
        foreach ($posts as $post) {
            $feeds->add($post->title, $post->link, $post->created_at, $post->author, $post->slug, $post->description, array('cat1','cat2'));
        }
        //Display feeds
        $feeds->display();
    }
