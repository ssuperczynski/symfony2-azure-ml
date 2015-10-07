'use strict';

(function () {
    'use strict';

    var app = angular.module('ml', []);

    app.config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);
})();
'use strict';

(function () {
    angular.module('ml').controller('DashboardCtrl', DashboardCtrl);

    DashboardCtrl.$inject = ['$scope'];

    function DashboardCtrl($scope) {

        $scope.test = function (e) {
            return e * e;
        };
    }
})();
'use strict';

angular.module('ml').factory('DashboardFactory', DashboardFactory);

DashboardFactory.$inject = [];

function DashboardFactory() {
    var multiline = 'test';

    var test2 = multiline + ' test 888';
    console.log(test2);
}
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