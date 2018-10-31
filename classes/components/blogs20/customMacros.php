<?php

    use UmiCms\Service;

	/** Класс пользовательских макросов */
	class BlogsCustomMacros {
		/** @var blogs20 $module */
		public $module;
        /**
         * Алиас для postsList()
         * Возвращает посты из заданного блога
         * @param bool|int $blogId идентификатор блога
         * @param string $template имя шаблона (для tpl)
         * @param bool|int $limit ограничение на количество выводимых постов
         * @return mixed
         */
        public function getPostsListCustom($blogId = false, $template = 'default', $limit = false) {
            return $this->postsListCustom($blogId, $template, $limit);
        }

        /**
         * Возвращает посты из заданного блога
         * @param bool|int $blogId идентификатор блога
         * @param string $template имя шаблона (для tpl)
         * @param bool|int $limit ограничение на количество выводимых постов
         * @return mixed
         * @throws coreException
         * @throws publicException
         * @throws selectorException
         */
        public function postsListCustom($blogId = false, $template = 'default', $limit = false) {
            $oUsersMdl = cmsController::getInstance()->getModule("blogs20");

            $year = getRequest('year'); // custom code

            $ot = strtotime($year . '-01-01 00:00:00'); // custom code
            $do = strtotime($year . '-12-31 23:59:59'); // custom code

            $blogId = $blogId ?: (int) getRequest('param0');
            $limit = $limit ?: $this->module->posts_per_page;

            $umiHierarchy = umiHierarchy::getInstance();
            $umiLinksHelper = umiLinksHelper::getInstance();

            list($postsListBlock, $postsListLine, $postsListBlockEmpty) = blogs20::loadTemplates(
                'blogs20/' . $template,
                'posts_list_block',
                'posts_list_line',
                'posts_list_block_empty'
            );

            $blog = null;

            $sel = new selector('pages');
            $sel->types('object-type')->name('blogs20', 'post');
            $sel->where('is_spam')->notequals(1);

            if (isset($year)) {
                $sel->where('publish_time')->between($ot, $do); // custom code
            }

            if ($blogId) {
                $blog = $umiHierarchy->getElement($blogId);

                if (!$blog) {
                    throw new publicException(getLabel('error-page-does-not-exist', null, $blogId));
                }

                $umiLinksHelper->loadLinkPartForPages([$blogId]);
            }

            if ($blogId) {
                $permissions = permissionsCollection::getInstance();
                $auth = Service::Auth();
                $userId = $auth->getUserId();
                $friendList = $blog->getValue('friendlist');
                $systemUsersPermissions = Service::SystemUsersPermissions();

                $friendList[] = $systemUsersPermissions->getSvUserId();

                if ($friendList === null) {
                    $friendList = [];
                }

                $authorList = $permissions->getUsersByElementPermissions($blogId, 2);
                $authorList[] = $blog->getObject()->getOwnerId();
                $sel->where('hierarchy')->page($blogId);

                if (!in_array($userId, $friendList) && !in_array($userId, $authorList)) {
                    $sel->where('only_for_friends')->notequals(1);
                }
            } else {
                $sel->where('only_for_friends')->notequals(1);
            }

            $oUsersMdl->applyTimeRange($sel);
            $sel->option('load-all-props')->value(true);
            $sel->order('publish_time')->desc();

            $page = (int) getRequest('p');
            $sel->limit($page * $limit, $limit);

            $postList = $sel->result();
            $total = $sel->length();

            if (!$postList) {
                return blogs20::parseTemplate($postsListBlockEmpty, ['bid' => $blogId]);
            }

            $lines = [];

            /** @var iUmiHierarchyElement $post */
            foreach ($postList as $post) {
                if (!$post instanceof iUmiHierarchyElement) {
                    continue;
                }

                $postId = $post->getId();

                if (!$blogId) {
                    $blog = $umiHierarchy->getElement($post->getParentId());
                }

                $postLink = $umiLinksHelper->getLinkByParts($post);
                $blogLink = $umiLinksHelper->getLinkByParts($blog);

                /** @var iUmiObject $postObject */
                $postObject = $post->getObject();

                $lineVariables = [];
                $lineVariables['attribute:id'] = $postId;
                $lineVariables['attribute:author_id'] = $postObject->getOwnerId();
                $lineVariables['name'] = $post->getName();
                $lineVariables['post_link'] = $postLink;
                $lineVariables['blog_link'] = $blogLink;
                $lineVariables['bid'] = $blog->getId();
                $lineVariables['blog_name'] = $blog->getName();
                $lineVariables['blog_title'] = $blog->getValue('title');
                $lineVariables['title'] = $post->getValue('title');
                $lineVariables['cut'] = system_parse_short_calls($oUsersMdl->prepareCut($post->getValue('content'), $postLink, $template), $postId);
                $lineVariables['subnodes:tags'] = $oUsersMdl->prepareTags($post->getValue('tags'), $template);
                $lineVariables['comments_count'] = $umiHierarchy->getChildrenCount($postId, false);

                /** @var umiDate $publishTime */
                $publishTime = $post->getValue('publish_time');
                $lineVariables['publish_time'] = ($publishTime instanceof umiDate) ? $publishTime->getFormattedDate('U') : '';

                $lines[] = blogs20::parseTemplate($postsListLine, $lineVariables, $postId);
                blogs20::pushEditable('blogs20', 'post', $postId);
            }

            $blockVariables = [];
            $blockVariables['void:lines'] = $blockVariables['subnodes:items'] = $lines;
            $blockVariables['bid'] = $blogId;
            $blockVariables['per_page'] = $limit;
            $blockVariables['total'] = $total;

            return blogs20::parseTemplate($postsListBlock, $blockVariables);
        }

    }
