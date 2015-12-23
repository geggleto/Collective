<?php
/**
 * Created by PhpStorm.
 * User: Glenn
 * Date: 2015-12-22
 * Time: 4:33 PM
 */

namespace Collective\RateLimit;


use Collective\Session\ISession;

class RateLimiter
{
    protected $maxPerMinute;

    protected $session;

    /**
     * RateLimiter constructor.
     *
     * @param \Collective\Session\ISession $session
     * @param int $maxPerMinute Number of calls per minute allowed
     */
    public function __construct (ISession $session, $maxPerMinute = 60)
    {
        $this->session = $session;

        $this->maxPerMinute = $maxPerMinute;

        $session->put("rateLimit", []);
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function hit() {
        $hits = $this->session->get("rateLimit");
        $t = time();
        $hits[] = $t;

        $counter = 0;

        foreach ($hits as $k => $hit) {
            if ($hit < $t - 60) {
                unset($hits[$k]);
            } else {
                $counter++;
            }
        }
        $this->session->put("rateLimit", $hits);

        if ($counter > $this->maxPerMinute) {
            throw new \Exception();
        } else {
            return true;
        }
    }
}