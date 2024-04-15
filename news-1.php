<?php
include(__DIR__ . '/a.php');
$coindesk = "";
if (isset ($_GET ['coindesk'])) {
    $coindesk = clean_input($_GET ['coindesk']);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $coindesk);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
$contents = curl_exec($ch);

$exploded = explode("<div", $contents);
array_shift($exploded);

$pharagraphs = "";

foreach ($exploded as $div) {
    if (found($div, "article-pharagraph")) {
        $pharagraphs = $pharagraphs . "<div " . $div;
    }

    if (found($div, "article-hero-headline")) {
        $headline = $pharagraphs . "<div " . $div;
    }
}
?>

    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <title>
            How Do Cryptocurrency Lending Platforms Work? | Investment market Academy </title>
        <link href="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/images/favicon.png" rel="shortcut icon" type="image/png">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/plugins/font-awesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/plugins/font-awesome/css/fa-regular.min.css">
        <link rel="stylesheet" href="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/plugins/font-awesome/css/fa-light.min.css">
        <link rel="stylesheet" href="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/plugins/font-awesome/css/fa-solid.min.css">
        <link rel="stylesheet" href="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/plugins/font-awesome/css/brands.min.css">
        <link rel="stylesheet" href="https://academy.Investment market.com/wp-content/themes/academy-v2/style.css?ver=4">
        <link rel="stylesheet" href="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/css/custom.css?ver=28">
        <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">

        <link rel="stylesheet" id="iss-css" href="https://academy.Investment market.com/wp-content/plugins/instant-search-suggest/assets/css/iss.css?ver=1537190198" type="text/css" media="all">
        <link rel="stylesheet" id="wp-block-library-css" href="https://academy.Investment market.com/wp-includes/css/dist/block-library/style.min.css?ver=5.7.2" type="text/css" media="all">
        <link rel="stylesheet" id="contact-form-7-css" href="https://academy.Investment market.com/wp-content/plugins/contact-form-7/includes/css/styles.css?ver=5.4.1" type="text/css" media="all">
        <link rel="stylesheet" id="socialsnap-styles-css" href="https://academy.Investment market.com/wp-content/plugins/socialsnap/assets/css/socialsnap.css?ver=1.1.15" type="text/css" media="all">
        <link rel="stylesheet" id="ez-icomoon-css" href="https://academy.Investment market.com/wp-content/plugins/easy-table-of-contents/vendor/icomoon/style.min.css?ver=2.0.17" type="text/css" media="all">
        <link rel="stylesheet" id="ez-toc-css" href="https://academy.Investment market.com/wp-content/plugins/easy-table-of-contents/assets/css/screen.min.css?ver=2.0.17" type="text/css" media="all">
        <style id="ez-toc-inline-css" type="text/css">
            div#ez-toc-container p.ez-toc-title {
                font-size: 120%;
            }

            div#ez-toc-container p.ez-toc-title {
                font-weight: 800;
            }

            div#ez-toc-container ul li {
                font-size: 100%;
            }

            div#ez-toc-container {
                background: #f8fcfe;
                border: 1px solid #eaeced;
            }

            div#ez-toc-container p.ez-toc-title {
                color: #f08b3e;
            }

            div#ez-toc-container ul.ez-toc-list a {
                color: #454d77;
            }

            div#ez-toc-container ul.ez-toc-list a:hover {
                color: #454d77;
            }

            div#ez-toc-container ul.ez-toc-list a:visited {
                color: #454d77;
            }
        </style>
        <style></style>
    </head>
<body data-rsssl="1">
<div id="wrap__header">
    <header>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.php">
                            <img src="assets/images/hindex-logo.svg" alt="Investment market Advertising Network"
                                 class="logo">
                        </a>
                        <div class="navbar-collapse collapse toggle-menu-mobile" id="navbarSupportedContent">
                            <ul class="navbar-nav navbar-right-Investment market">
                                <li class="nav-item">
                                    <a class="nav-link" href="advertisers/index.html"
                                       id="advertisersMenu">Advertisers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="publishers/index.html" id="publishersMenu">Publishers</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="marketplace/index.html"
                                       id="marketplaceMenu">Marketplace</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="https://academy.Investment market.com//" id="marketplaceMenu">Academy</a>
                                </li>
                            </ul>
                            <ul class="navbar-nav navbar-right">
                                <?php if (isset($_COOKIE ['cus_id'])) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="display/account.php">Member Area</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="logout.php">Logout</a>
                                    </li>
                                <?php } else { ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="login.php">Sign In</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="signup.php">Sign Up</a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
    </header>
</div>

<section class="content page-top-slider top-slider-spacing"></section>
<section class="content academy-container">
    <div class="container post-academy-v2">
        <div class="row">
            <div class="col-12">
                <div class="card card-academy">
                    <div>
                        <figure class="post_image">
                            <div class="article-hero-media-wrapper">
                                <div class="article-hero-image-wrapper">
                                    <picture class="responsive-picture">
                                        <source media="(min-width: 415px)"
                                                sizes="(min-width: 415px) 710px"
                                                srcSet="https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-710x458.jpeg?format=webp 710w"
                                                type="image/webp"/>
                                        <source media="(min-width: 415px)"
                                                sizes="(min-width: 415px) 710px"
                                                srcSet="https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-710x458.jpeg?format=jp2 710w"
                                                type="image/jp2"/>
                                        <source media="(min-width: 415px)"
                                                sizes="(min-width: 415px) 710px"
                                                srcSet="https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-710x458.jpeg 710w"
                                                type="image/jpeg"/>
                                        <source media="(max-width: 414px)"
                                                sizes="(max-width: 414px) 345px"
                                                srcSet="https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-1035x666.jpeg?format=webp 1035w, https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-690x444.jpeg?format=webp 690w, https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-345x222.jpeg?format=webp 345w"
                                                type="image/webp"/>
                                        <source media="(max-width: 414px)"
                                                sizes="(max-width: 414px) 345px"
                                                srcSet="https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-1035x666.jpeg?format=jp2 1035w, https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-690x444.jpeg?format=jp2 690w, https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-345x222.jpeg?format=jp2 345w"
                                                type="image/jp2"/>
                                        <source media="(max-width: 414px)"
                                                sizes="(max-width: 414px) 345px"
                                                srcSet="https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-1035x666.jpeg 1035w, https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-690x444.jpeg 690w, https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-345x222.jpeg 345w"
                                                type="image/jpeg"/>
                                        <img width="710" height="458"
                                             src="https://static.coindesk.com/wp-content/uploads/2021/07/diana-polekhina-Q3t49sVquH0-unsplash-710x458.jpeg"
                                             alt="" loading="lazy"/></picture>
                                    <div class="caption-credit-block">
                                        <figcaption class="image-credit"><a
                                                    href="https://unsplash.com/photos/Q3t49sVquH0"
                                                    target="_blank" rel="noopener noreferrer">(Diana
                                                Polekhina/Unsplash)</a></figcaption>
                                    </div>
                                </div>
                            </div>

                        </figure>
                    </div>
                    <div class="top-content-v2">
                        <div class="row align-items-center text-center text-lg-left">
                            <div class="col-lg-6 col-md-12">
                                <div>
                                    <h1 class="subject-title"> <?= $headline ?></h1>
                                </div>
                            </div>
                            <!--                            <p> --><?//= $headline ?><!--</p>-->

                            <div class="offset-lg-3 col-lg-3 col-md-12">
                                <div class="d-none d-lg-inline-block">
                                    <img alt="author image" src="https://secure.gravatar.com/avatar/d3f3c3bd8a28df9e42f3e7b7a58fd5c4?s=55&amp;d=https%3A%2F%2Facademy.Investment market.com%2Fwp-content%2Fuploads%2F2020%2F02%2F45919560_2248561225391456_5920456939719884800_n.png&amp;r=g" class="avatar avatar-55 photo subject-author-photo lazyloaded" height="55" width="55" srcset="https://secure.gravatar.com/avatar/d3f3c3bd8a28df9e42f3e7b7a58fd5c4?s=110&amp;d=https%3A%2F%2Facademy.Investment market.com%2Fwp-content%2Fuploads%2F2020%2F02%2F45919560_2248561225391456_5920456939719884800_n.png&amp;r=g 2x" data-ll-status="loaded">
                                    <noscript><img alt='author image' src='https://secure.gravatar.com/avatar/d3f3c3bd8a28df9e42f3e7b7a58fd5c4?s=55&#038;d=https%3A%2F%2Facademy.Investment market.com%2Fwp-content%2Fuploads%2F2020%2F02%2F45919560_2248561225391456_5920456939719884800_n.png&#038;r=g' srcset='https://secure.gravatar.com/avatar/d3f3c3bd8a28df9e42f3e7b7a58fd5c4?s=110&#038;d=https%3A%2F%2Facademy.Investment market.com%2Fwp-content%2Fuploads%2F2020%2F02%2F45919560_2248561225391456_5920456939719884800_n.png&#038;r=g 2x' class='avatar avatar-55 photo subject-author-photo' height='55' width='55'/></noscript>
                                </div>
                                <hr class="d-block d-lg-none">
                                <div class="display-inline">
                                    <div class="subject-author-name text-left">
                                        <a href="https://academy.Investment market.com/user/jacob-thompson/">
                                            Jacob Thompson </a>
                                    </div>
                                    <span class="subject-author-type">Contributor</span>
                                </div>
                                <hr>
                                <div>
                                    Last updated July 16, 2021
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <div class="subject-body row clearfix">
                            <div class="subject-container--left col-xs-12">
                                <div class="sticky-position right-border table-of-content-v2">
                                    <div id="ez-toc-container" class="ez-toc-v2_0_17 counter-hierarchy counter-decimal">
                                        <div class="ez-toc-title-container">
                                            <p class="ez-toc-title">Table of Contents</p>
                                            <span class="ez-toc-title-toggle"></span></div>
                                        <nav>
                                            <ul class="ez-toc-list ez-toc-list-level-1">
                                                <li class="ez-toc-page-1 ez-toc-heading-level-2"><a class="ez-toc-link ez-toc-heading-1" href="#How_Cryptocurrency_Lending_Platforms_Work" title="How Cryptocurrency Lending Platforms Work">How Cryptocurrency Lending Platforms Work</a></li>
                                                <li class="ez-toc-page-1 ez-toc-heading-level-2"><a class="ez-toc-link ez-toc-heading-2" href="#Benefits_of_Borrowing_from_Crypto_Platforms" title="Benefits of Borrowing from Crypto Platforms">Benefits of Borrowing from Crypto Platforms</a></li>
                                                <li class="ez-toc-page-1 ez-toc-heading-level-2"><a class="ez-toc-link ez-toc-heading-3" href="#Loans_with_flexible_terms" title="Loans with flexible terms">Loans with flexible terms</a></li>
                                                <li class="ez-toc-page-1 ez-toc-heading-level-2"><a class="ez-toc-link ez-toc-heading-4" href="#Disadvantages_of_Borrowing_from_Crypto_Platforms" title="Disadvantages of Borrowing from Crypto Platforms">Disadvantages of Borrowing from Crypto Platforms</a></li>
                                            </ul>
                                        </nav>
                                    </div>
                                    <div class="time-to-read">
                                        <div class="time-to-read__item">
                                            Estimated Reading Time: <br>
                                            <img src="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/images/icons/reading_time.svg" alt="" class="estimate-time lazyloaded" data-ll-status="loaded">
                                            <noscript><img src="https://academy.Investment market.com/wp-content/themes/academy-v2/assets/images/icons/reading_time.svg" alt="" class="estimate-time"></noscript>
                                            <span id="time-read-minutes">6 minutes, 27 seconds</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="subject-container col-xs-12">
                                <div class="subject-content">
                                    <div class="subject-content__body">
                                        <article class="subject-text">
                                            <?= $pharagraphs ?>
                                        </article>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
include 'footer.php';
