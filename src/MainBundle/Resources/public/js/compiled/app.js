'use strict';

(function () {
    'use strict';

    var app = angular.module('ml', ['ngNotify']);

    app.config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);
})();