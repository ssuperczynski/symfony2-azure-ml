(function () {
    'use strict';

    var app = angular.module('ml', [
        'ngNotify',
        'firebase'
    ]);

    app.config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

}());