'use strict';

(function () {
    angular.module('ml').controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope', 'endpointFactory', 'ngNotify'];

    function DashboardCtrl($scope, endpointFactory, ngNotify) {

        $scope.test = function () {
            mixpanel.track("post send");
            ngNotify.set('Your notification message goes here!', {
                theme: 'pastel',
                position: 'bottom',
                duration: 1000
            });
            endpointFactory.get().then(function (response) {
                console.log(response.data);
            });
        };
    }
})();