(function () {
    angular
        .module('ml')
        .controller('WineCtrl', WineCtrl);

    WineCtrl.$inject = ['$scope'];

    function WineCtrl($scope) {

        $scope.test = (e) => e * e;

    }

})();