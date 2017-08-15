<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-route.min.js"></script>
        <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width" />
    </head>
    <body>
        <script type="text/javascript">
            angular.module('myApp', ['ngRoute'])
                    .controller('photo', ['$scope', 'Poller',
                        function ($scope, Poller) {
                            $scope.imageUrl = Poller.data.response.images[0].url;
                            $scope.imageQr = Poller.data.response.images[0].qr;
                        }
                    ])
                    .controller('gallery', ['$scope', 'Poller',
                        function ($scope, Poller) {
                            $scope.images = Poller.data.response.images;
                        }
                    ])
                    .config(function ($routeProvider) {
                        $routeProvider
                                .when('/', {
                                    controller: 'photo',
                                    templateUrl: 'view/photo.html'
                                })
                                .when('/gallery', {
                                    controller: 'gallery',
                                    templateUrl: 'view/gallery.html'
                                });
                    })
                    .factory('Poller', function ($http, $timeout, $location) {
                        var previous = '';
                        var data = {response: {}};
                        var poller = function () {
                            $http.get('images.php').then(function (r) {
                                data.response = r.data;
                                if(data.response.latest_image === previous) {
                                    $location.url('/gallery');
                                    timeoutPeriod = 8000;
                                } else {
                                    $location.url('/');
                                    timeoutPeriod = 30000;
                                }
                                previous = r.data.latest_image;
                                $timeout(poller, timeoutPeriod);
                            });
                        };
                        poller();

                        return {
                            data: data
                        };
                    })
                    .run(function (Poller) {});
        </script>
        <section ng-app="myApp">
            <div ng-view></div>
        </section>
    </body>
</html>
