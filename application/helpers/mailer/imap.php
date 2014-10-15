<?
// Ensure Zend folder is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    '/home/rohmanahmad/public_html/zend/library/',
     get_include_path(),
)));

// require the ZF autoloader file if you have it in your include path
require_once 'Zend/Loader/Autoloader.php';
// if ZF is not in your path you can specify the full path
// otherwise if it's in a subdir (most likely if you're on a web hosting)
// you can do something like this
//require_once dirname(__FILE__) . '/Zend/Loader/AutoLoader.php';

// laod the autoloader so you don't need to require any ZF file
Zend_Loader_Autoloader::getInstance();

// connecting with Imap to gmail
$mail = new Zend_Mail_Storage_Imap(
    array(
        'host'     => 'imap.gmail.com',
        'port'     => '993',
        'ssl'      => true,
        'user'     => 'susedamedia@gmail.com',
        'password' => 'janganmasuk',
    )
);

// get the message object
$message = $mail->getMessage(1);
// output subject of message
echo $message->subject . "\n";
// dump message headers
Zend_Debug::dump($message->getHeaders());
