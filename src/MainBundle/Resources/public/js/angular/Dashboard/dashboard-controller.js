(function () {
    angular
        .module('ml')
        .controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope', 'endpointFactory', 'ngNotify'];

    function DashboardCtrl($scope, endpointFactory, ngNotify) {

        $scope.test = () => {
            let rand = ~~(Math.random(1, 100) * 100);
            mixpanel.track("post send",
                {"User": rand});
            console.info(rand);
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