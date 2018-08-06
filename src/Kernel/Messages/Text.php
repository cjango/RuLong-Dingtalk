<?php

namespace RuLong\DingTalk\Kernel\Messages;

/**
 * Class Text.
 *
 * @author
 */
class Text extends Message
{
    protected $type = 'text';

    public function __construct(string $content)
    {
        parent::__construct(compact('content'));
    }
}
