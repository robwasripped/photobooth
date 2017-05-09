<?php

require 'bootstrap.php';

use OAuth\Common\Consumer\Credentials;
use Arcanedev\QrCode\QrCode;
use Arcanedev\QrCode\Builder;
use Arcanedev\QrCode\Entities\ErrorCorrection;


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
    $builder = new Builder;
    $builder->setText($image->link);
    $builder->setSize(200);
    $builder->setErrorCorrection(ErrorCorrection::LEVEL_HIGH);
    
    $qrCode = new QrCode($builder);
    
    include 'view/image.php';
}