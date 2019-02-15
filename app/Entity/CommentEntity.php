<?php

namespace App\Entity;

class CommentEntity
{
    use AuthorAble;

    /**
     * Get post of comment
     *
     * @return array|int|mixed
     */
    public function getPost()
    {
        if (empty($this->post)) {
            $this->post = \App::getInstance()->getTable('Post')->getById($this->post_id);
        }
        return $this->post;
    }

    /**
     * Get formated date of comment
     *
     * @return string
     */
    public function getDate()
    {
        $date = date_create($this->date);
        $day = date_format($date, 'd/m/Y');
        $hours = date_format($date, 'H:i');
        return "Ajouté le {$day} à {$hours}";
    }

    /**
     * Get a random logo
     *
     * @return mixed
     */
    public function getLogo()
    {
        $logo = array(
            'images/avatar/1.jpg',
            'images/avatar/2.jpg',
            'images/avatar/3.jpg',
            'images/avatar/4.jpg',
            'images/avatar/5.jpg'
        );
        return $logo[rand(0, sizeof($logo) - 1)];
    }
}
