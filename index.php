<?php

require 'bootstrap.php';

use OAuth\Common\Consumer\Credentials;


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

include 'view/index.php';