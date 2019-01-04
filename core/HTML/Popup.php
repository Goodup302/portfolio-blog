<?php
namespace Core\HTML;


class Popup
{
    private $id;
    private $title;
    private $content;

    public function __construct($id, $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

//    public function addButton($name, $title)
//    {
//
//    }
//
//    public function closeButton($name, $title)
//    {
//
//    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function showButton()
    {
        (new Button('Modifier', 'button'))
            ->setArgs('data-toggle="modal" data-target="#' . $this->id . '"')
            ->show();
        ?>
        <div class="modal fade" id="#<?= $this->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle"><?= $this->title ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <?= $this->content ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
