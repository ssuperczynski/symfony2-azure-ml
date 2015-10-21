(function () {
    angular
        .module('ml')
        .controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope', 'endpointFactory'];

    function DashboardCtrl($scope, endpointFactory) {

        $scope.test = () => endpointFactory.get()
            .then(response => console.log(response.data));

    }

})();