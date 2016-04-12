(function () {
    angular
        .module('ml')
        .controller('MushroomCtrl', MushroomCtrl);

    MushroomCtrl.$inject = ['$scope', 'MushroomFactory', 'ngNotify', '$firebaseArray'];

    function MushroomCtrl($scope, MushroomFactory, ngNotify, $firebaseArray) {

        $scope.send = (selected) => {
            ngNotify.set('Message queued', {
                theme: 'pastel',
                position: 'bottom',
                duration: 1000
            });
            MushroomFactory.send(selected);
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