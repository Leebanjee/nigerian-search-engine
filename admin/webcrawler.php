<?php

include("DOMParser.php");
include("databaseconfig.php");

$crawled_links = array();
$crawled_images = array();
$crawled_videos = array();

function checkExitsLink($url)
{
    global $connection;

    $query = $connection->prepare("SELECT * FROM sites WHERE url = :url");

    $query->bindParam(':url', $url);
    $query->execute();

    return $query->rowCount() != 0;
}

function checkExitsImages($imageurl)
{
    global $connection;

    $query = $connection->prepare("SELECT * FROM images WHERE imageurl = :imageurl");

    $query->bindParam(':imageurl', $imageurl);
    $query->execute();

    return $query->rowCount() != 0;
}

function insertDetailToDB($url, $title, $description, $keywords)
{

    global $connection;

    $query = $connection->prepare("INSERT INTO SITES(url,title,description,keywords)
                                 VALUES(:url,:title,:description,:keywords)");


    $query->bindParam(":url", $url);
    $query->bindParam(":title", $title);
    $query->bindParam(":description", $description);
    $query->bindParam(":keywords", $keywords);

    return $query->execute();
}

function insertImageToDB($siteurl, $imageurl, $alt, $title)
{

    global $connection;

    $query = $connection->prepare("INSERT INTO IMAGES(siteurl,imageurl,alt,title)
                                 VALUES(:siteurl,:imageurl,:alt,:title)");


    $query->bindParam(":siteurl", $siteurl);
    $query->bindParam(":imageurl", $imageurl);
    $query->bindParam(":alt", $alt);
    $query->bindParam(":title", $title);

    return $query->execute();
}

function insertVideoToDB($siteurl, $videourl, $title)
{

    global $connection;

    $query = $connection->prepare("INSERT INTO VIDEOS(siteurl,videourl,title)
                                 VALUES(:siteurl,:videourl,:title)");


    $query->bindParam(":siteurl", $siteurl);
    $query->bindParam(":videourl", $imageurl);
    +$query->bindParam(":title", $title);

    return $query->execute();
}

function formLinks($href, $url)
{
    $scheme = parse_url($url)['scheme'];
    $host = parse_url($url)['host'];

    if (substr($href, 0, 2) == "//") {
        $href = $scheme . ":" . $href;
    } else if (substr($href, 0, 1) == "/") {
        $href = $scheme . "://" . $host . $href;
    }

    return $href;
}

function extractDetails($url)
{

    global $crawled_images;

    $parser = new DOMParser($url);

    $titleTags = $parser->getTitleTags();

    if (sizeof($titleTags) == 0 || $titleTags->item(0) == NULL) {
        return;
    }

    $title = $titleTags->item(0)->nodeValue;
    $title = str_replace("\n", "", $title);

    if ($title == "") {
        return;
    }

    $description = "";
    $keywords = "";

    $metaTags = $parser->getMetaTags();

    foreach ($metaTags as $metaTag) {
        if ($metaTag->getAttribute("name") == "description") {
            $description = $metaTag->getAttribute("content");
        } else if ($metaTag->getAttribute("name") == "keywords") {
            $keywords = $metaTag->getAttribute("content");
        }
    }

    if (!checkExitsLink($url)) {

        insertDetailToDB($url, $title, $description, $keywords);
    }

    $imageTags = $parser->getImageTags();

    foreach ($imageTags as $imageTag) {

        $src = $imageTag->getAttribute("src");
        $alt = $imageTag->getAttribute("alt");
        $title = $imageTag->getAttribute("title");

        if (!$alt && !$title) {
            continue;
        }

        $src = formLinks($src, $url);

        if (!in_array($src, $crawled_images)) {
            $crawled_images[] = $src;
            if (!checkExitsImages($url)) {

                insertImageToDB($url, $src, $alt, $title);
            }
        }
    }
    $videoTags = $parser->getVideoTags();
    foreach ($videoTags as $videoTag) {

        $src = $videoTag->getAttribute("src");

        $title = $videoTag->getAttribute("title");

        if (!$title) {
            continue;
        }

        $src = formLinks($src, $url);


        if (!checkExitsImages($src)) {

            insertVideoToDB($url, $src, $title);
        }
    }
}



function crawlLinks($url)
{

    global $crawled_links;


    if (str_contains($url, '.ng')) {
        $parser = new DOMParser($url);

        $links = $parser->getLinks();

        foreach ($links as $link) {

            $href = $link->getAttribute("href");

            if (strpos($href, "#") !== false || substr($href, 0, 11) == "javascript:") {
                continue;
            }

            $href = formLinks($href, $url);

            if (!in_array($href, $crawled_links)) {
                $crawled_links[] = $href;
                echo "$href <br>";
                extractDetails($href);
                crawlLinks($href);
            }
        }
    } else {
        exit("$url is not a Nigerian domain!");
    }
}
function autocrawlLinks()
{
    global $connection;
    global $crawled_links;
    $statement = $connection->prepare('SELECT * FROM posts');
    $statement->execute();
    $urls = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($urls as $url) {

        if (str_contains($url["siteurl"], '.ng')) {
            $parser = new DOMParser($url);

            $links = $parser->getLinks();

            foreach ($links as $link) {

                $href = $link->getAttribute("href");

                if (strpos($href, "#") !== false || substr($href, 0, 11) == "javascript:") {
                    continue;
                }

                $href = formLinks($href, $url["siteurl"]);

                if (!in_array($href, $crawled_links)) {
                    $crawled_links[] = $href;
                    echo "$href <br>";
                    extractDetails($href);
                    crawlLinks($href);
                }
            }
        } else {

            continue;
        }
    }
}



?>


<section class="body">
    <?php include_once 'includes/header.php'; ?>
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Crawler</h2>

            <div class="right-wrapper pull-right">
                <ol class="breadcrumbs">
                    <li>
                        <a href="">
                            <i class="fa fa-home"></i>
                        </a>
                    </li>
                    <li><span>Crawler</span></li>
                </ol>

                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
            </div>
        </header>
        <div class="row">

            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Auto Crawler</h2>
                </header>
                <form class="form-horizontal form-bordered" method="post">
                    <div class="panel-body">
                        <div class="form-group">
                            <footer class=" panel-footer">
                                <button type="submit" class="btn btn-primary" name="autocrawler">Activate Crawler</button>

                            </footer>
                        </div>
                    </div>
                </form>

                <div class="panel-body">

                </div>
            </section>
            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Manual Crawler</h2>
                </header>
                <form class="form-horizontal form-bordered" method="POST" enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputReadOnly">Site Url</label>
                            <div class="col-md-6">
                                <input type="url" name="url" class="form-control" id="inputReadOnly"">
                                                                        </div>
                                                                    </div>
                                                                                             
                                                </div>
                                                                        <footer class=" panel-footer">
                                <button type="submit" class="btn btn-primary">Crawl Site</button>
                                </footer>
                </form>
                <div class="panel-body">

                </div>
            </section>
        </div>
        <div class="row">

            <section class="panel">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>
                    <h2 class="panel-title">Crawled Results</h2>
                </header>


                <div class="panel-body">

                    <?php

                    if (isset($_POST['url'])) {
                        $startUrl = filter_var($_POST['url'], FILTER_SANITIZE_URL);;
                        if (!$startUrl) {
                            echo 'Link is required';
                        } else {
                            crawlLinks($startUrl);
                        }
                    }
                    ?>
                    <?php

                    if (isset($_POST['autocrawler'])) {
                        autocrawlLinks();
                    }
                    ?>
                </div>
            </section>
        </div>
        <?php include_once 'includes/footer.php'; ?>