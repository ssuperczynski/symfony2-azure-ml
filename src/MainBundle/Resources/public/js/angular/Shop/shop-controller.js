(function () {
    angular
        .module('ml')
        .controller('ShopCtrl', ShopCtrl);

    ShopCtrl.$inject = ['$scope', 'ShopFactory', 'ngNotify', '$firebaseArray'];

    function ShopCtrl($scope, ShopFactory, ngNotify, $firebaseArray) {

        $scope.send = (selected) => {
            ngNotify.set('Message queued', {
                theme: 'pastel',
                position: 'bottom',
                duration: 1000
            });
            console.table(selected);
            ShopFactory.send(selected);
        };

        var ref = new Firebase("https://amber-heat-9116.firebaseio.com/shops");
        $scope.shops = $firebaseArray(ref);
        $scope.selected = {
            city: "Poznań",
            street: "Grunwaldzka",
            streetNr: 21,
            hasStreetEntrance: false,
            hasBusStop: false,
            hasGasStation: false,
            distanceAnotherShop100m: false,
            distanceAnotherShop500m: false,
            hasParking: false,
            cityPopulation: 0,
            incomeUSD: 0,
            priceSq: 0
        };
    }
})();