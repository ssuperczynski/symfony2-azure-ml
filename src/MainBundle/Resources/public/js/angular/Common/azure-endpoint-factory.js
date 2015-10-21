(function () {
    angular
        .module('ml')
        .factory('endpointFactory', endpointFactory);

    endpointFactory.$inject = ['$http'];

    function endpointFactory($http) {

        var self = this;

        const URL = 'https://ussouthcentral.services.azureml.net/workspaces/8cc62d04a53c415cb85e331b37682a91/services/aca4b706c9f6419b82e68497ad51dedb/execute?api-version=2.0&details=true',
            TOKEN = 'cPKeyP8TVyRfPFl9bkZ2fwZptYEiGRX8IsWi8/y/ez/8ytmey6h6bFtas0M+Xah/Mc00jYjUMGcRQdHV62MfcQ==';

        var headers = {
            "Access-Control-Allow-Origin": "*",
            "Access-Control-Allow-Headers": "Content-Type",
            "Access-Control-Allow-Methods": "GET, POST, OPTIONS",
            "Accept": "application/json",
            "Content-Type": "application/json",
            "Authorization": `Bearer ${TOKEN}`
        };
        self.get = function () {
            return $http.get("http://www.mocky.io/v2/561a654a100000892168d562");
        };

        return self;
    }

}());