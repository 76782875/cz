<?php
    /**
     * Extend update an article.
     * 
     * @param string   $articleID 
     * @access public
     * @return void
     */
    public function updateArticle($articleID, $type = 'article')
    {
        $article  = $this->getByID($articleID);
        $category = array_keys($article->categories);

        $article = fixer::input('post')
            ->stripTags('content,link', $this->config->allowedTags->admin)
            ->join('categories', ',')
            ->add('editor', $this->app->user->account)
            ->add('editedDate', helper::now())
            ->setIF(!$this->post->isLink, 'link', '')
			//置顶
            ->setIF(!$this->post->isTop, 'isTop', 0)
            ->get();

        $article->keywords = seo::unify($article->keywords, ',');
        $article->alias    = seo::unify($article->alias, '-');
        $article->content  = $this->rtrimContent($article->content);

        $this->dao->update(TABLE_ARTICLE)
            ->data($article, $skip = 'categories,uid,isLink')
            ->autoCheck()
            ->batchCheckIF($type != 'page' and !$this->post->isLink, $this->config->article->require->edit, 'notempty')
            ->batchCheckIF($type == 'page' and !$this->post->isLink, $this->config->article->require->page, 'notempty')
            ->batchCheckIF($type != 'page' and $this->post->isLink, $this->config->article->require->link, 'notempty')
            ->batchCheckIF($type == 'page' and $this->post->isLink, $this->config->article->require->pageLink, 'notempty')
            ->checkIF(($type == 'page') and $this->post->alias, 'alias', 'unique', "type='page' and id<>{$articleID}")
            ->where('id')->eq($articleID)
            ->exec();

        $this->loadModel('file')->updateObjectID($this->post->uid, $articleID, $type);
        $this->file->copyFromContent($this->post->content, $articleID, $type);

        if(dao::isError()) return false;

        $this->loadModel('tag')->save($article->keywords);
        if($type != 'page') $this->processCategories($articleID, $type, $this->post->categories);

        return !dao::isError();
    }
