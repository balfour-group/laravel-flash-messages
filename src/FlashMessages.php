<?php

namespace Balfour\LaravelFlashMessages;

use Illuminate\Session\Store;

class FlashMessages
{
    /**
     * @var Store
     */
    protected $session;

    /**
     * @var string
     */
    protected $key = 'flash_messages';

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * @param string $type
     * @param string $message
     * @param string|null $title
     */
    public function add($type, $message, $title = null)
    {
        $this->messages[] = $this->makeMessageArr($type, $message, $title);
    }

    /**
     * @param string $type
     * @param string $message
     * @param string|null $title
     */
    public function flash($type, $message, $title = null)
    {
        $messages = $this->getMessagesFromSession();
        $messages[] = $this->makeMessageArr($type, $message, $title);
        $this->session->put($this->key, $messages);
    }

    /**
     * @param string $type
     * @param string $message
     * @param string|null $title
     * @return array
     */
    protected function makeMessageArr($type, $message, $title = null)
    {
        return [
            'type' => $type,
            'message' => $message,
            'title' => $title,
        ];
    }

    /**
     * @return array
     */
    protected function getMessagesFromSession()
    {
        return $this->session->get($this->key, []);
    }

    /**
     * @return array
     */
    public function all()
    {
        return array_merge(
            $this->messages,
            $this->getMessagesFromSession()
        );
    }

    public function clear()
    {
        $this->messages = [];
        $this->session->forget($this->key);
    }
}
