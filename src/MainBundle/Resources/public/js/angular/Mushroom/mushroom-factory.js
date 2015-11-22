angular
    .module('ml')
    .factory('MushroomFactory', MushroomFactory);

MushroomFactory.$inject = ['$http', 'BASE_END_POINT'];

function MushroomFactory($http, BASE_END_POINT) {
    var self = this;

    self.send = function (selected) {
        return $http.put(BASE_END_POINT + "/mushrooms", {payload: selected}).then((response) => console.info(response));
    };

    return self;
}
