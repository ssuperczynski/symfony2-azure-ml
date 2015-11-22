(function () {
    angular
        .module('ml')
        .controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope', 'endpointFactory', 'ngNotify'];

    function DashboardCtrl($scope, endpointFactory, ngNotify) {

        $scope.test = () => {
            mixpanel.track("post send");
            ngNotify.set('Message queued', {
                theme: 'pastel',
                position: 'bottom',
                duration: 1000
            });
            endpointFactory.get()
                .then(response => {
                    console.log(response.data);
                });
        };

    }

}());