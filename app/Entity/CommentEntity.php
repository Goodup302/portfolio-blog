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
            'https://upload.wikimedia.org/wikipedia/commons/e/e7/Photo_de_profil_JK.jpg',
            'http://media.lemeilleurjobdete.com/uploads/3656/profil-1435853876.jpg',
            'https://images.vinted.net/thumbs/04bf8_hMYjmUes6GLatryL2Xc9xNRY.jpeg',
            'https://pbs.twimg.com/profile_images/1015063956614938624/uxfcTNNt.jpg',
            'https://vignette.wikia.nocookie.net/yandere-simulator-fr/images/0/06/Profil_Genka_Kunahito.png/revision/latest?cb=20171221192806&path-prefix=fr',
            'http://s3.amazonaws.com/academos/production/mentor_profiles/photo/medium_AF_2018_-_profil_sociaux.jpg'
        );
        return $logo[rand(0, sizeof($logo))];
    }
}
