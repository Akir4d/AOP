<?php
$H1 = '<h1>';
$H1C = '</h1>';
$P = '<p>';
$PC = '</p>';
$PRE = '<script>var irr=setInterval(()=>{let el=document.getElementById("pre"); el.addEventListener("mouseover", (event) => {clearInterval(irr)}); el.scrollTop = el.scrollHeight;},10)</script><pre id="pre" style="height: 50vh; width: 100%; overflow-y:scroll">';
$PREC = "\n\nThis page will do an auto-refresh in 10 seconds</pre>";
if (php_sapi_name() === 'cli') {
    $H1 = "\033[0;31m\033[1m";
    $H1C = "\033[0m\033[0m" . PHP_EOL;
    $P = "\033[0;32m";
    $PC = "\033[0m" . PHP_EOL;
    $PRE = "";
    $PREC = "" . PHP_EOL;
}

if (!extension_loaded('intl')) {
    echo "$H1" . "You have to enable php-intl in your php.ini configuration$H1C";
    die();
}
if (!extension_loaded('gd')) {
    echo "$H1" . "You have to enable php-gd in your php.ini configuration$H1C";
    die();
}

$composerPath = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
$updateDir = realpath($composerPath . DIRECTORY_SEPARATOR . 'aopm' . DIRECTORY_SEPARATOR . 'versions');
$updateFile = $updateDir . DIRECTORY_SEPARATOR . 'firstup.info.txt';

if (!file_exists($composerPath . DIRECTORY_SEPARATOR . 'vendor') || !file_exists($updateFile)) {

    if (php_sapi_name() !== 'cli') {
        @apache_setenv('no-gzip', 1);
        @ini_set('zlib.output_compression', 0);
        @ini_set('implicit_flush', 1);
        for ($i = 0; $i < ob_get_level(); $i++) {
            ob_end_flush();
        }
        ob_implicit_flush(1);
        include "header.php";
    }

    function removeFolder($folderName)
    {
        if (is_dir($folderName)) $folderHandle = opendir($folderName);
        if (!$folderHandle) return false;
        while ($file = readdir($folderHandle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($folderName . "/" . $file))
                    unlink($folderName . "/" . $file);
                else
                    removeFolder($folderName . '/' . $file);
            }
        }
        closedir($folderHandle);
        rmdir($folderName);
        return true;
    }
    $updateTemp = $updateDir . DIRECTORY_SEPARATOR . 'composer';
    if (!file_exists($updateTemp)) mkdir($updateTemp);
    if (!file_exists($composerPath . '/.env')) file_put_contents($composerPath . '/.env', file_get_contents($composerPath . '/env'));
    $cv = 'https://getcomposer.org/download/latest-stable/composer.phar';
    echo $H1 . "AOP auto-update started: please wait!$H1C";
    echo $PRE;
    echo "\n-Downloading composer from $cv...";
    chdir($composerPath);
    $exec = $composerPath . DIRECTORY_SEPARATOR .  'composer.phar';
    file_put_contents($updateFile, 'update', FILE_APPEND);
    file_put_contents($exec, file_get_contents($cv));
    if (file_exists($updateDir . '/composer/vendor/autoload.php') == false) {
        $composerPhar = new Phar($exec);
        echo "\n-Unpack Composer...  ";
        //php.ini setting phar.readonly must be set to 0
        echo ($composerPhar->extractTo($updateTemp)) ? "Success! \n" : "Fail! \n";
    }
    echo "-Exec Composer...\n";
    require_once($updateDir . '/composer/vendor/autoload.php');
    require_once  $updateDir . '/composer.php';
    define('COMPOSER_HOME', $composerPath);
    define('HOME', $composerPath);
    putenv('COMPOSER_HOME=' . $composerPath);
    $success = true;
    @unlink($updateFile);
    try {
        $composer = new ComposerCommandLine();
        $composer->update();
        echo $PREC;
        unlink($exec);
        removeFolder($updateTemp);
    } catch (\Throwable $e) {
        $success = false;
    }
    if($success) file_put_contents($updateFile, "done", FILE_APPEND);
    $spark = preg_replace(
        '/\<\?php/',
        '<?php' . PHP_EOL . 'include realpath("aopm/update.php");',
        file_get_contents(realpath($composerPath . '/vendor/codeigniter4/framework/spark')),
        1
    );

    $index = preg_replace(
        '/\<\?php/',
        '<?php' . PHP_EOL . 'include realpath("../aopm/update.php");',
        file_get_contents(realpath($composerPath . '/vendor/codeigniter4/framework/public/index.php')),
        1
    );

    file_put_contents($composerPath . '/aopm/index.php', $index);
    if (!file_exists($composerPath . '/../backend')) {
        file_put_contents($composerPath . '/public/index.php', $index);
    } else {
        $index = str_replace('../', 'backend/', $index);
        $spark = str_replace('public', '..', $spark);
        file_put_contents($composerPath . '/../index.php', $index);
    }

    file_put_contents($composerPath . '/spark', $spark);

    if (php_sapi_name() !== 'cli') {
        echo '<script>setTimeout(()=>parent.window.location.reload(true), 10000);</script>';
        /* 
             
        require_once realpath($composerPath . '/vendor/autoload.php');
        $dotenv = \Dotenv\Dotenv::createUnsafeMutable($composerPath);
        $dotenv->load();
        try {
            $dotenv->required(['database.default.hostname', 'database.default.database', 'database.default.username', 'database.default.password']);
        } catch (\Throwable $e) {
            echo 'DB config';
            putenv('database.default.hostname=localhost');
        } 
        echo '<pre>', var_dump($_ENV), '</pre>';

        */
        echo '</section></body></html>';
        die();
    }
}
