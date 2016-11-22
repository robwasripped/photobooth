<?php

require 'bootstrap.php';

use OAuth\OAuth2\Service\Instagram;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;
use Arcanedev\QrCode\QrCode;


// Setup the credentials for the requests
$credentials = new Credentials(
    $servicesCredentials['instagram']['key'],
    $servicesCredentials['instagram']['secret'],
    $currentUri->getAbsoluteUri()
);

$scopes = array('basic', 'comments', 'relationships', 'likes');

// Instantiate the Instagram service using the credentials, http client and storage mechanism for the token
/** @var $instagramService Instagram */
$instagramService = $serviceFactory->createService('instagram', $credentials, $storage, $scopes);

$data = json_decode($instagramService->request('/users/self/media/recent'));

foreach($data->data as $image) {
    $qrCode = new QrCode;
    $qrCode->setText($image->link);
    $qrCode->setSize(200);
    
    include 'view/image.php';
}