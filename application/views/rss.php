<?php header('Content-type: application/rss+xml; charset=utf-8'); ?>
<?xml version="1.0" encoding="<?php echo $channel['encoding'];?>"?><rss version="2.0"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:admin="http://webns.net/mvcb/"
     xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"    
     >
    <channel>
        <title><?php echo $channel['title']; ?></title>
        <link><?php echo $channel['link']; ?></link>    
        <description><?php echo $channel['description']; ?></description>
        <pubDate><?php echo $channel['pub_date'] ?></pubDate>
        <dc:language><?php echo $channel['language']; ?></dc:language>
        <dc:rights><?php echo $channel['copyright']; ?></dc:rights>
        <admin:generatorAgent rdf:resource="<?php echo $channel['generator']; ?>" />
        <docs><?php echo $channel['docs']; ?></docs>
        <webMaster><?php echo $channel['web_master_email']; ?></webMaster>
        <?php if (!empty($items)): ?>
            <?php foreach ($items as $item): ?>  
                <item>
                    <title><?php echo xml_convert($item['title']); ?></title>
                    <link><?php echo site_url($item['link']) ?></link>
                    <pubDate><?php echo date('D, d M Y H:i:s O', $item['pub_date']) ?></pubDate>
                    <author><?php echo $item['author'] ?></author>
                    <guid isPermaLink="true"><?php echo site_url($item['slug']) ?></guid>
                    <description><![CDATA[<?php echo strip_tags(html_entity_decode($item['description'])); ?>]]></description>      
                    <?php if (!empty($item['categories'])): ?>
                    <?php foreach ($item['categories'] as $category): ?>
                        <category><![CDATA[<?php echo $category;?>]]></category>
                    <?php endforeach; ?> 
                    <?php endif; ?> 
                </item>        
            <?php endforeach; ?> 
        <?php endif; ?> 
    </channel>
</rss>