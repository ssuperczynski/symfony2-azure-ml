(function () {
    angular
        .module('ml')
        .controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope', 'DashboardFactory', 'ngNotify', '$firebaseArray'];

    function DashboardCtrl($scope, DashboardFactory, ngNotify, $firebaseArray) {

        $scope.send = (selected) => {
            ngNotify.set('Message queued', {
                theme: 'pastel',
                position: 'bottom',
                duration: 1000
            });
            DashboardFactory.send(selected);
        };

        var ref = new Firebase("https://azureml.firebaseio.com/mushrooms");
        $scope.mushrooms = $firebaseArray(ref);
        $scope.selected = {
            edible: "edible",
            capShape: "bell",
            capColor: "red",
            odor: false,
            gillColor: "red",
            stalkColor: "yellow"
        };

        $scope.types = [
            {name: "edible"},
            {name: "poisonous"}
        ];

        $scope.shapes = [
            {name: "bell"},
            {name: "flatten"}
        ];

        $scope.colors = [
            {name: "pink"},
            {name: "red"},
            {name: "yellow"},
            {name: "brown"}
        ];
    }
}());