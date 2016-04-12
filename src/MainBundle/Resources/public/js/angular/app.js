(function () {
    'use strict';

    var app = angular.module('surveyapp', [
        'configuration',
        'ngNotify'
    ]);

    app.config(['$interpolateProvider', function ($interpolateProvider) {
        $interpolateProvider.startSymbol('[[');
        $interpolateProvider.endSymbol(']]');
    }]);

}());