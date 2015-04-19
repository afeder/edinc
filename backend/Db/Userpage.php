<?php
namespace edinc\Db;

require_once(__DIR__."/Wikihost.php");
require_once(__DIR__."/User.php");
require_once(__DIR__."/Username.php");


class Userpage {
    protected $user;

    protected function fetchData($url) {
        return json_decode(file_get_contents($url));
    }

    function __construct($url) {
        if ($host = parse_url($url, PHP_URL_HOST)) {
            if ($wikihost = new \edinc\Db\Wikihost($host)) {
                $path = explode("/", parse_url($url, PHP_URL_PATH), 3);
                if ($path[1] == "wiki") {
                    $title = $path[2];
                    $response = $this->fetchData("https://".$wikihost->getHostname()."/w/api.php?action=query&prop=pageprops&format=json&titles=".rawurlencode($title));
                    if (isset($response->query->pages)) {
                        $pageprops = reset($response->query->pages);
                        $title = $pageprops->title;
                        $title_div = explode("/", $title);
                        switch ($pageprops->ns) {
                            case 2:
                            case 3:
                                $top_div = explode(":", $title_div[0]);
                                $title_username = $top_div[1];
                                break;
                            case -1:
                                $response = $this->fetchData("https://".$wikihost->getHostname()."/w/api.php?action=query&prop=pageprops&format=json&titles=Special:Contributions/".rawurlencode($title_div[1]));
                                $pageprops = reset($response->query->pages);
                                if ($pageprops->title == $title) {
                                    $title_div = explode("/", $pageprops->title);
                                    $title_username = $title_div[1];
                                }
                                break;
                        }
                    }

                    $wikiname = $wikihost->getWikiname();
                    $username = new Username($title_username);
                    $this->user = new User($wikiname, $username);
                }
            }
        }
    }

    public function getUser() {
        return($this->user);
    }

    public function getJson() {
        $userobj = (object)array("dbname" => $this->user->getWikiname()->getValue(),
                                 "username" => $this->user->getUsername()->getValue());
        return(json_encode($userobj));
    }
}

?>
