<?php
require_once "../src/whatsprot.class.php";
require_once "./WAAccountData.php";
//Change the time zone if you are in a different country
date_default_timezone_set('Europe/Rome');

// Create a instance of WhastPort
$w = new WhatsProt(
    WAAccountData::$d["username"],
    WAAccountData::$d["identity"],
    WAAccountData::$d["nickname"],
    WAAccountData::$d["debug"]
);
$w->connect();
$w->loginWithPassword(WAAccountData::$d["password"]);
echo "[*]connected\n\n";

$target = WAAccountData::$phonebook["ERIKA"];

//Print when the user goes online/offline (you need to bind a function to the event onPressence
//so the script knows what to do)
$w->eventManager()->bind("onPresence", "onPresenceReceived");

$w->sendMessage($target, "Let's chat");

while ($w->pollMessage()) ;

/**
 * You can create a ProcessNode class (or whatever name you want) that has a process($node) function
 * and pass it through setNewMessageBind, that way everytime the class receives a text message it will run
 * the process function to it.
 */
$pn = new ProcessNode($w, $target);
$w->setNewMessageBind($pn);

echo "\n\nYou can also write and send messages to $target (interactive conversation)\n\n> ";

while (1) {
    $w->pollMessage();
    $msgs = $w->getMessages();
    foreach ($msgs as $m) {
        # process inbound messages
        //print($m->NodeString("") . "\n");
    }
    $line = fgets_u(STDIN);
    if ($line != "") {
        if (strrchr($line, " ")) {
            $command = trim(strstr($line, ' ', TRUE));
        } else {
            $command = $line;
        }
        //available commands in the interactive conversation [/lastseen, /query]
        switch ($command) {
            case "/query":
                $dst = trim(strstr($line, ' ', FALSE));
                echo "[] Interactive conversation with $target:\n";
                break;
            case "/lastseen":
                echo "[] last seen: ";
                $w->sendGetRequestLastSeen($target);
                break;
            default:
                $w->sendMessage($target, $line);
                break;
        }
    }
}


/**
 * Demo class to show how you can process inbound messages
 */
class ProcessNode {
    /**
     * @var WhatsProt $wp
     */
    protected $wp = false;

    /**
     * @var string $target
     */
    protected $target = false;

    public function __construct($wp, $target) {
        $this->wp = $wp;
        $this->target = $target;
    }

    /**
     * @param ProtocolNode $node
     */
    public function process($node)
    {
        // Example of process function, you have to guess a number (psss it's 5)
        // If you guess it right you get a gift
        $text = $node->getChild('body');
        $text = $text->getData();
        if ($text && ($text == "5" || trim($text) == "5")) {
            $this->wp->sendMessageImage($this->target, "https://s3.amazonaws.com/f.cl.ly/items/2F3U0A1K2o051q1q1e1G/baby-nailed-it.jpg");
            $this->wp->sendMessage($this->target, "Congratulations you guessed the right number!");
        }
        elseif (ctype_digit($text)) {
            if( (int)$text != "5")
                $this->wp->sendMessage($this->target, "I'm sorry, try again!");
        }
        $text = $node->getChild('body');
        $text = $text->getData();
        $notify = $node->getAttribute("notify");

        echo "\n- ".$notify.": ".$text."    ".date('H:i')."\n";

    }
}


function fgets_u($pStdn)
{
    $pArr = array($pStdn);

    if (false === ($num_changed_streams = stream_select($pArr, $write = NULL, $except = NULL, 0))) {
        print("\$ 001 Socket Error : UNABLE TO WATCH STDIN.\n");

        return FALSE;
    } elseif ($num_changed_streams > 0) {
        return trim(fgets($pStdn, 1024));
    }
    return null;
}

function onPresenceReceived($username, $from, $type)
{
    $dFrom = str_replace(array("@s.whatsapp.net", "@g.us"), "", $from);
    if ($type == "available")
        echo "<$dFrom is online>\n\n";
    else
        echo "<$dFrom is offline>\n\n";
}
