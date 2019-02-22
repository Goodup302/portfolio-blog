<?php

namespace App\Controller;

use App\Form\CommentForm;
use Core\Auth\Session;

class PostController extends AppController
{
    protected $viewPath;

    /**
     * Show all post on front side
     */
    public function loop()
    {
        $this->setTitle('Tous les articles');
        $posts = $this->postTable->getAll();
        $this->twigRender('posts/loop', compact('posts'));
    }

    /**
     * Show a post on front side
     */
    public function single()
    {
        if (!empty($_GET['id'])) {
            $post = $this->postTable->getById($_GET['id']);
            if ($post) {
                //Comment Form
                $commentform = new CommentForm($_POST);
                if ($commentform->isPost()) {
                    if ($commentform->fieldsIsValid() && Session::isLogged()) {
                        $args = array(
                            "post_id" => $post->id,
                            "user_id" => Session::getUserId(),
                            "content" => $commentform->get('message'),
                            "validate" => $this->logged_user->admin
                        );
                        if ($this->commentTable->insert($args)) {
                            if ($this->logged_user->admin) {
                                $commentform->setSuccess('Votre commentaire a été envoyé');
                            } else {
                                $commentform->setSuccess(
                                    'Votre commentaire a été envoyé, il va être soumis à une vérification'
                                );
                            }
                        } else {
                            $commentform->setError('Une erreur est survenue lors de l\'envoi');
                        }
                    }
                }
                //
                $this->setTitle("Article - $post->title");
                $comments = $this->commentTable->getByPostId($_GET['id'], true);
                $commentsnumber = $this->commentTable->getByPostId($_GET['id'], true, false);
                $this->twigRender('posts/single', compact('post', 'comments', 'commentsnumber', 'commentform'));
            } else {
                $this->error404("Cette article n'existe pas ou plus !");
            }
        } else {
            $this->error404("Aucun article selectionné !");
        }
    }
}
