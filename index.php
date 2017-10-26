<?php

require 'bootstrap.php';

use OAuth\Common\Consumer\Credentials;
use OAuth\Common\Storage\Exception\TokenNotFoundException;


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

try {
    $data = json_decode($instagramService->request('/users/self/media/recent'));
} catch (TokenNotFoundException $e) {
    header('Location: authorise.php');
    exit;
}

include 'view/index.php';