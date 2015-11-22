angular
    .module('ml')
    .factory('DashboardFactory', DashboardFactory);

DashboardFactory.$inject = ['$http'];

function DashboardFactory($http) {
    var self = this;

    self.send = function (selected) {
        console.info(selected)
        //return $http.post("", selected).then(() => console.info("queued"));
    };

    return self;
}
