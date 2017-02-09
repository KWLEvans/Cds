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
        $cds = Cd::getAll();
        return $app["twig"]->render("cd_list.html.twig", ["cds" => $cds]);
    });

    $app->get("/search", function() use ($app) {
        return $app["twig"]->render("search.html.twig");
    });

    $app->post("/results", function() use ($app) {
        $query = $_POST["artist_search"];
        $cds = Cd::getAll();
        $matches = [];
        foreach (array_keys($cds) as $artist) {
            if (preg_match(("/" . $query . "/i"), $artist)) {
                $matches[$artist] = $cds[$artist];
            }
        }
        return $app["twig"]->render("results.html.twig", ["cds" => $matches]);
    });

    return $app;
?>
