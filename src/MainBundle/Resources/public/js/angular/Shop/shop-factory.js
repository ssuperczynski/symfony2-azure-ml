angular
    .module('ml')
    .factory('ShopFactory', ShopFactory);

ShopFactory.$inject = ['$http', 'BASE_END_POINT'];

function ShopFactory($http, BASE_END_POINT) {
    var self = this;

    self.send = function (selected) {
        return $http.put(BASE_END_POINT + "/shops", {payload: selected});
    };

    return self;
}
