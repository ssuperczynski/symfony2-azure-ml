'use strict';

(function () {
    angular.module('ml').controller('WineCtrl', WineCtrl);

    WineCtrl.$inject = ['$scope'];

    function WineCtrl($scope) {

        $scope.test = function (e) {
            return e * e;
        };
    }
})();