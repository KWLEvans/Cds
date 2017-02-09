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
        if (in_array($this->artist, array_keys($_SESSION['list_of_cds']))) {
            array_push($_SESSION['list_of_cds'][$this->artist], $this);
        } else {
            $_SESSION['list_of_cds'][$this->artist] = [$this];
        }
    }

    static function getAll()
    {
        return $_SESSION['list_of_cds'];
    }

}

?>
