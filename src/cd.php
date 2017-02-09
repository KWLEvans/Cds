<?php
class Cd
{
    public $title;
    public $artist;

    function __construct($title, $artist)
    {
        $this->title = $title;
        $this->artist = $artist;
    }

    function save()
    {
        array_push($_SESSION['list_of_cds'], $this);
    }

    static function getAll()
    {
        return $_SESSION['list_of_cds'];
    }

}

?>
