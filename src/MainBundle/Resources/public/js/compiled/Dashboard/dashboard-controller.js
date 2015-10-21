'use strict';

(function () {
    angular.module('ml').controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope', 'endpointFactory'];

    function DashboardCtrl($scope, endpointFactory) {

        $scope.test = function () {
            mixpanel.track("post send");
            endpointFactory.get().then(function (response) {
                console.log(response.data);
            });
        };
    }
})();