<?php
// Silence is golden.
require __DIR__ . '/vendor/autoload.php';

class Gcalender{

    const CLIENT_ID         = '';
    const CLIENT_SECRET     = '';

    protected $client;


    public function __construct() {
        parent::__construct();
        $this->clientId = '858931159995-kq83ita15ifm0rrqaq300fh4ccknbem4.apps.googleusercontent.com';
        $this->clientSecret = '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';
        $this->client = new Google_Client();
        $this->client->setApplicationName('quickstart-1616176320929');
        $this->client->setClientId($clientId);
        $this->client->setClientSecret($clientSecret);
        $this->service = new Google_Service_Calendar($this->client);

    }


    


}