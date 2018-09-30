<?php

$configFile = fopen("config.json", "r") or die("Unable to open config.json file");
$configJson = fread($configFile, filesize("config.json"));
fclose($configFile);
$config = json_decode($configJson, true);

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$acceptLang = ['it', 'en']; 
$lang = in_array($lang, $acceptLang) ? $lang : 'en';

$langFile = fopen("localization/$lang.json", "r") or die("Unable to open localization/$lang.json file");
$langJson = fread($langFile, filesize("config.json"));
fclose($langFile);
$lang = json_decode($langJson, true);

function tr($key) {
    echo $GLOBALS['lang'][$key] ?? $key;
}

?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php tr("SITE_TITLE") ?></title>
    <meta name="description" content="<?php tr("SITE_DESCRIPTION") ?>">
    <link rel="stylesheet" href="dist/style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="dist/images/favicon.ico" />
</head>
<body class="Wrapper">
    <div class="Sheet">
        <div class="Title">
            <a href="https://wikitolearn.org" class="Title__content"> 
                <img class="Title__logo" src="dist/images/wikitolearn-logo.png" alt="">
                <img class="Title__name" src="dist/images/name.svg" alt="">
                <span class="Title__text">Chat</span>
            </a>
        </div>
        <main class="Content">
            <div class="Content__description">
                <?php tr("CHAT_DESCRIPTION") ?>
            </div>
            <div class="Content__chats Chats">
                <?php 
                    $chats = $config["chats"];
                    foreach ($chats as $chat) {
                        ?>
                            <a href="<?php echo $chat["href"]; ?>" class="Chat__link">
                                <div class="Chat">
                                    <div class="Chat__meta">
                                        <div class="Chat__title"><?php tr("CHAT_" . $chat["key"] . "_TITLE"); ?></div>
                                        <div class="Chat__description"><?php tr("CHAT_" . $chat["key"] . "_DESCRIPTION"); ?></div>
                                    </div>
                                    <div class="Chat__control">
                                        <i class="<?php echo $chat["icon"]; ?>"></i>
                                        <span class="Chat__control-text"><?php tr("CHAT_" . $chat["key"] . "_ACTION"); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php
                    }
                ?>
            </div>
            <div class="Content__description">
                <?php tr("OTHER_DESCRIPTION") ?>
            </div>
            <div class="Content__chats Chats">
                <?php 
                    $others = $config["others"];
                    foreach ($others as $other) {
                        ?>
                            <a href="<?php echo $other["href"]; ?>" class="Chat__link">
                                <div class="Chat">
                                    <div class="Chat__meta">
                                        <div class="Chat__title"><?php tr("OTHER_" . $other["key"] . "_TITLE"); ?></div>
                                        <div class="Chat__description"><?php tr("OTHER_" . $other["key"] . "_DESCRIPTION"); ?></div>
                                    </div>
                                    <div class="Chat__control">
                                        <i class="<?php echo $other["icon"]; ?>"></i>
                                        <span class="Chat__control-text"><?php tr("OTHER_" . $other["key"] . "_ACTION"); ?></span>
                                    </div>
                                </div>
                            </a>
                        <?php
                    }
                ?>
            </div>
        </main>
    </div>
    <div class="Footer">
    </div>
</body>
</html>
