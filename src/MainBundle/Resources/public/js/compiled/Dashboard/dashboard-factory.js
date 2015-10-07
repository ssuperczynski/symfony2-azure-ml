'use strict';

angular.module('ml').factory('DashboardFactory', DashboardFactory);

DashboardFactory.$inject = [];

function DashboardFactory() {
    var multiline = 'test';

    var test2 = multiline + ' test 888';
    console.log(test2);
}