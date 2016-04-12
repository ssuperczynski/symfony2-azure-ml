(function () {
    angular
        .module('ml')
        .controller('WineCtrl', WineCtrl);

    WineCtrl.$inject = ['$scope', 'WineFactory', 'ngNotify', '$firebaseArray'];

    function WineCtrl($scope, WineFactory, ngNotify, $firebaseArray) {

        $scope.send = (selected) => {
            ngNotify.set('Message queued', {
                theme: 'pastel',
                position: 'bottom',
                duration: 1000
            });
            WineFactory.send(selected);
        };

        var ref = new Firebase("https://azurewines.firebaseio.com/wine");
        $scope.wines = $firebaseArray(ref);
        $scope.selected = {};
    }
}());