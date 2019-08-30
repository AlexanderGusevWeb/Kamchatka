<?php
	/** Класс пользовательских макросов */
	class PhotoAlbumCustomMacros {
		/** @var photoalbum $module */
		public $module;

        /**
         * Возвращает фотографии заданного фотоальбома
         * @param bool|int|string $path идентификатор или адрес фотоальбома
         * @param string $template имя шаблона (для tpl)
         * @param bool|int $limit ограничение на количество выводимых элементов
         * @param bool $ignore_paging игнорировать пагинацию
         * @return mixed
         * @throws publicException
         * @throws selectorException
         */
        public function customAlbum($path = false, $template = 'default', $limit = false, $ignore_paging = false) {
            $curr_page = (int) getRequest('p');
//            $per_page = $limit ?: $this->module->per_page;

            //custom code
            $per_page = INF;

            if ($ignore_paging) {
                $curr_page = 0;
            }

            $element_id = $this->module->analyzeRequiredPath($path);

            if ($element_id === false && $path != KEYWORD_GRAB_ALL) {
                throw new publicException(getLabel('error-page-does-not-exist', null, $path));
            }

            list($template_block, $template_block_empty, $template_line) = photoalbum::loadTemplates(
                'photoalbum/' . $template,
                'album_block',
                'album_block_empty',
                'album_block_line'
            );

            $photos = new selector('pages');
            $photos->types('hierarchy-type')->name('photoalbum', 'photo');

            if($path != KEYWORD_GRAB_ALL) {
                $photos->where('hierarchy')->page($element_id);
            }

            $photos->option('load-all-props')->value(true);
            $photos->limit($curr_page * $per_page, $per_page);
            $result = $photos->result();
            $total = $photos->length();

            $block_arr = [];
            $block_arr['id'] = $block_arr['void:album_id'] = $element_id;

            if ($total == 0) {
                return photoalbum::parseTemplate($template_block_empty, $block_arr, $element_id);
            }

            $lines = [];
            $umiLinksHelper = umiLinksHelper::getInstance();

            foreach ($result as $photo) {
                $line_arr = [];

                if (!$photo instanceof iUmiHierarchyElement) {
                    continue;
                }

                $photo_element_id = $photo->getId();
                $line_arr['attribute:id'] = $photo_element_id;
                $line_arr['attribute:link'] = $umiLinksHelper->getLinkByParts($photo);
                $line_arr['xlink:href'] = 'upage://' . $photo_element_id;
                $line_arr['node:name'] = $photo->getName();

                photoalbum::pushEditable('photoalbum', 'photo', $photo_element_id);
                $lines[] = photoalbum::parseTemplate($template_line, $line_arr, $photo_element_id);
            }

            $block_arr['subnodes:items'] = $block_arr['void:lines'] = $lines;
            $block_arr['total'] = $total;
            $block_arr['per_page'] = $per_page;
            $block_arr['link'] = umiHierarchy::getInstance()->getPathById($element_id);
            return photoalbum::parseTemplate($template_block, $block_arr, $element_id);
        }
	}
