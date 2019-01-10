<?php

namespace App\Entity;
use Core\Config;

class PostEntity
{
    const EXCERPT_LENGTH = 100;

    use AuthorAble;

    /**
     * Get formated url of post
     *
     * @return string
     */
    public function getUrl()
    {
        return 'index.php?p=single&id=' . $this->id;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param bool $forceExcerpt
     * @return bool|string
     */
    public function getExcerpt($forceExcerpt = false)
    {
        if (strlen($this->excerpt) > 0 || $forceExcerpt == true) {
            return $this->excerpt;
        } else {
            return substr($this->content, 0, self::EXCERPT_LENGTH);
        }
    }

    /**
     * Get formated last edit of post
     *
     * @return string
     */
    public function getLastdate()
    {
        $date = date_create($this->lastdate);
        return 'Rédigé le ' . date_format($date, 'd/m/Y') . ' à ' . date_format($date, 'H:i');
    }

    /**
     * @return mixed
     */
    public function getAuthorid()
    {
        return $this->user_id;
    }
}
