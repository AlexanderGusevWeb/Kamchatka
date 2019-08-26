<?php

use UmiCms\Service;

/** Класс пользовательских макросов */
class VoteCustomMacros
{

    /** @var vote $module */
    public $module;

    /**
     * Учитывает ответ пользователя на опрос.
     * Идентификатор ответа берется либо из get-параметра "param0", либо из get-параметра "vote_answer".
     *
     * Если был передан параметр "param0", запрос завершается отдачей результата выполнения макроса в буфер.
     * Если был передан параметр "vote_answer", запрос завершается редиректом на предыдущую страницу.
     *
     * @param string $template имя шаблона (для tpl)
     * @throws coreException
     * @throws errorPanicException
     * @throws privateException
     */
    public function post($template = 'default')
    {
        $template = $template ?: getRequest('template') ?: 'default';

        if (vote::isXSLTResultMode()) {
            list(
                $templateBlock,
                $templateBlockVoted,
                $templateBlockClosed,
                $templateBlockOk
                ) = [
                false,
                false,
                false,
                false,
            ];
        } else {
            list(
                $templateBlock,
                $templateBlockVoted,
                $templateBlockClosed,
                $templateBlockOk
                ) = vote::loadTemplates(
                "vote/{$template}",
                'js_block',
                'js_block_voted',
                'js_block_closed',
                'js_block_ok'
            );
        }

        $umiObjects = umiObjectsCollection::getInstance();
        $referrer = getServer('HTTP_REFERER') ?: '/';
        $module = $this->module;
        $module->errorRegisterFailPage($referrer);

        $answerId = (int)(getRequest('param0') ?: getRequest('vote_answer'));
        $answer = $umiObjects->getObject($answerId);
        if (!$answer instanceof iUmiObject) {
            $this->reportError(getLabel('error-page-does-not-exist'));
        }

        $pollId = $answer->getValue('poll_rel');
        $poll = $umiObjects->getObject($pollId);
        if (!$poll instanceof iUmiObject) {
            $this->reportError(getLabel('error-page-does-not-exist'));
        }

        switch (true) {
            case ($module->checkIsVoted($pollId)): {
                $result = $templateBlockVoted ?: getLabel('error-already-voted');
                break;
            }

            case ($poll->getValue('is_closed')): {
                $result = $templateBlockClosed ?: getLabel('error-vote-not-active-or-closed');
                break;
            }

            default: {
                $module->incrementVote($poll, $answer);
                $result = $templateBlockOk ?: getLabel('vote-success');
            }
        }

        $session = Service::Session();
        $polledVotes = $session->get('vote_polled');
        $polledVotes = is_array($polledVotes) ? $polledVotes : [];
        $polledVotes[] = $pollId;
        $session->set('vote_polled', $polledVotes);

        if (getRequest('vote_answer')) {
            Service::Response()
                ->getCurrentBuffer()
                ->redirect($referrer);
        }

        $this->pollResult_Custom($result, $templateBlock);
    }

    /**
     * Завершает голосование опроса
     * @param mixed $result результат опроса
     * @param bool $templateBlock блок шаблона (для tpl)
     */
    public function pollResult_Custom($result, $templateBlock = false)
    {
        $result = vote::parseTPLMacroses($result);

        if ($templateBlock) {
            $block_arr = [];
            $block_arr['res'] = $result;
            $r = vote::parseTemplate($templateBlock, $block_arr);
//                $this->module->flush($r, 'text/javascript');
        } else {
//                $this->module->flush("alert('{$result}');", 'text/javascript');
        }
    }
}