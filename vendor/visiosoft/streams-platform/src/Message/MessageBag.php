<?php namespace Anomaly\Streams\Platform\Message;

use Illuminate\Session\Store;

/**
 * Class MessageBag
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class MessageBag
{

    /**
     * The session store.
     *
     * @var Store
     */
    protected $session;

    /**
     * Create a new MessageBag instance.
     *
     * @param Store $session
     */
    public function __construct(Store $session)
    {
        $this->session = $session;
    }

    /**
     * Add a message.
     *
     * @param $type
     * @param $message
     * @return MessageBag
     */
    public function add($type, $message)
    {
        return $this->merge($type, $message);
    }

    /**
     * Merge a message onto the session.
     *
     * @param $type
     * @param $message
     * @return $this
     */
    protected function merge($type, $message)
    {
        $messages = $this->session->get($type, []);

        if (is_array($message)) {
            $messages = array_merge($messages, $message);
        }

        if (is_string($message)) {
            array_push($messages, $message);
        }

        $messages = array_unique($messages);

        $this->session->put($type, $messages);

        return $this;
    }

    /**
     * Return whether messages exist.
     *
     * @param $type
     * @return bool
     */
    public function has($type)
    {
        return $this->session->has($type);
    }

    /**
     * Get messages.
     *
     * @param $type
     * @return array
     */
    public function get($type)
    {
        return $this->session->get($type);
    }

    /**
     * Pull the messages.
     *
     * @param $type
     * @return array
     */
    public function pull($type)
    {
        return $this->session->pull($type);
    }

    /**
     * Add an error message.
     *
     * @param $message
     * @return $this
     */
    public function error($message)
    {
        $this->merge(__FUNCTION__, $message);

        return $this;
    }

    /**
     * Add an info message.
     *
     * @param $message
     * @return $this
     */
    public function info($message)
    {
        $this->merge(__FUNCTION__, $message);

        return $this;
    }

    /**
     * Add a success message.
     *
     * @param $message
     * @return $this
     */
    public function success($message)
    {
        $this->merge(__FUNCTION__, $message);

        return $this;
    }

    /**
     * Add a warning message.
     *
     * @param $message
     * @return $this
     */
    public function warning($message)
    {
        $this->merge(__FUNCTION__, $message);

        return $this;
    }

    /**
     * Add an important message.
     *
     * @param $message
     * @return $this
     */
    public function important($message)
    {
        $this->merge(__FUNCTION__, $message);

        return $this;
    }

    /**
     * Flush the messages.
     *
     * @param null $type
     * @return $this
     */
    public function flush($type = null)
    {
        if ($type) {

            $this->session->forget($type);

            return $this;
        }

        $this->session->forget('info');
        $this->session->forget('error');
        $this->session->forget('success');
        $this->session->forget('warning');
        $this->session->forget('important');

        return $this;
    }
}
