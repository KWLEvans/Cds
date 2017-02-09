<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/cd.php";

    session_start();
    if (empty($_SESSION['list_of_cds'])) {
        $_SESSION['list_of_cds'] = [];
    }

    $app = new Silex\Application();

    $app["debug"] = true;

    $app->register(new Silex\Provider\TwigServiceProvider(), ["twig.path" => __DIR__."/../views"]);

    $app->get("/", function() use ($app) {
        return $app["twig"]->render("add_cd.html.twig");
    });

    $app->post("/list", function() use ($app) {
        $new_cd = new Cd($_POST["title"], $_POST["artist"]);
        $new_cd->save();
        return $app["twig"]->render("cd_list.html.twig", ["cd" => $new_cd]);
    });

    return $app;
?>
