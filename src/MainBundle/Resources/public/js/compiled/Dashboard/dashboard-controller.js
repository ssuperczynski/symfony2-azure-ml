'use strict';

(function () {
    angular.module('ml').controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope', 'endpointFactory'];

    function DashboardCtrl($scope, endpointFactory) {

        $scope.test = function () {
            return endpointFactory.get().then(function (response) {
                return console.log(response.data);
            });
        };
    }
})();