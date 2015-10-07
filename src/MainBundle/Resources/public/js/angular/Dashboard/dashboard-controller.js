(function () {
    angular
        .module('ml')
        .controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope'];

    function DashboardCtrl($scope) {

        $scope.test = (e) => e * e;

    }

})();