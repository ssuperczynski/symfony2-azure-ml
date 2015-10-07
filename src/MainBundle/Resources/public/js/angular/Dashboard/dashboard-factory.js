angular
    .module('ml')
    .factory('DashboardFactory', DashboardFactory);

DashboardFactory.$inject = [];

function DashboardFactory() {
    var multiline = `test`;

    let test2 = `${multiline} test 888`;
    console.log(test2);
}
