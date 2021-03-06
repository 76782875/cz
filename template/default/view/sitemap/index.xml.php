<?php echo '<?xml version="1.0" encoding="UTF-8" ?>';?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">
  <?php
  foreach($products as $product):
  $url = str_replace('&', '&amp;', $systemURL . helper::createLink('product', 'view', "id=$product->id", "category={$product->category->alias}&name=$product->alias"));
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo substr($product->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.9</priority>
  </url>
  <?php endforeach;?>
  <?php
  foreach($articles as $article):
  $url = str_replace('&', '&amp;', $systemURL . helper::createLink('article', 'view', "id=$article->id", "category={$article->category->alias}&name=$article->alias"));
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo substr($article->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php if(commonModel::isAvailable('blog')):?>
  <?php
  foreach($blogs as $blog):
  $url = str_replace('&', '&amp;', $systemURL . helper::createLink('blog', 'view', "id=$blog->id", "category={$blog->category->alias}&name=$blog->alias"));
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo substr($blog->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php endif;?>
  <?php if(commonModel::isAvailable('book')):?>
  <?php foreach($books as $nodeID => $node):?>
  <?php
  if($node->type != 'article') $url  = str_replace('&', '&amp;', $systemURL . helper::createLink('book', 'browse', "nodeID=$node->id", "book={$node->book}&node={$node->alias}"));
  if($node->type == 'article') $url  = str_replace('&', '&amp;', $systemURL . helper::createLink('book', 'read', "nodeID=$node->id", "book={$node->book}&node={$node->alias}"));
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo substr($node->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php endif;?>
  <?php if(commonModel::isAvailable('forum')):?>
  <?php
  foreach($threads as $id => $editedDate):
  $url = str_replace('&', '&amp;', helper::createLink('thread', 'view', "id=$id"));
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo substr($editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
  <?php endif;?>
  <?php
  foreach($pages as $page):
  $url = str_replace('&', '&amp;', $systemURL . helper::createLink('page', 'view', "id=$page->id", "name=$page->alias"));
  ?>
  <url>
    <loc><?php echo $url;?></loc>
    <lastmod><?php echo substr($page->editedDate, 0, 10);?></lastmod>
    <changefreq>daily</changefreq>
    <priority>0.8</priority>
  </url>
  <?php endforeach;?>
</urlset>
