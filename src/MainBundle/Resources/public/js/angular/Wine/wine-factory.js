angular
    .module('ml')
    .factory('WineFactory', WineFactory);

WineFactory.$inject = ['$http', 'BASE_END_POINT'];

function WineFactory($http, BASE_END_POINT) {
    var self = this;

    self.send = function (selected) {
        return $http.put(BASE_END_POINT + "/wines", {payload: selected}).then((response) => console.info(response));
    };

    return self;
}
