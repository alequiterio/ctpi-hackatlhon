angular.module('app.controllers')


.controller('DashboardCtrl', function($scope, $http) {

	$scope.input = {};
	$scope.input.ambiente = 'https://portalunico.siscomex.gov.br';
	$scope.input.perfil = 'IMPEXP'

	$scope.chamar = function () {

		$scope.input.response = {
			body: 'Aguarde...'
		}

		var url_aws = 'https://fq9rpuvvd9.execute-api.us-east-1.amazonaws.com/prod/stpconnect-chamaURL';
		var perfil = $scope.input.perfil;

		var parser = document.createElement('a');
		parser.href = $scope.input.url;

		var url_stpconnect = parser.protocol + '//' + parser.host + parser.pathname;
		var parametros = parser.search.substring(1).split('&');
		console.log(parametros)

		$http({
			method: 'POST',
			url: 'https://fq9rpuvvd9.execute-api.us-east-1.amazonaws.com/prod/stpconnect-chamaURL',
			data: {
				url: url_stpconnect,
				parametros: parametros,
				perfil: perfil
			},
			headers: {'X-Api-Key': 'CSe8zz7N5kasoU0XxyjzQ68o7RsBBi989MChxgbG'}
		}).then(function (response) {
			console.log(response)
			$scope.input.response.body = response.data.body
			$scope.input.response.headers = response.data.headers;
			$scope.input.response.headers.statusCode = response.data.statusCode;
		}).catch(function (error) {
			$scope.input.response = JSON.stringify(error);
		})
	}

	$scope.setaURL = function (funcionalidade) {

		var ambiente = $scope.input.ambiente;
		switch(funcionalidade) {
			case 'dueResumida':
				$scope.input.url = ambiente + '/due/api/ext/due/consultarDadosResumidosDUE?numero=17BR0000219052'
				break
			case 'dueCompleta':
				$scope.input.url = ambiente + '/due/api/ext/due/numero-da-due/17BR0000219052'
				break
			case 'rucCompleta':
				$scope.input.url = ambiente + '/due/api/ext/due/numero-da-ruc/7BR07689002100000000000000000024118'
				break
			case 'cctConsultaDUERUC':
				$scope.input.url = ambiente + '/cct/api/ext/carga/due-ruc?nrDocumento=17BR0000219052'
				break
			case 'cctConsultaMRUC':
				$scope.input.url = ambiente + '/cct/api/ext/carga/mruc?nrDocumento=7BR020128621LILICACONS01'
				break
			case 'cctConsultaCTN':
				$scope.input.url = ambiente + '/cct/api/ext/carga/conteiner?nrConteiner=ASDE2343'
				break
			case 'cctConsultaDOC':
				$scope.input.url = ambiente + '/cct/api/ext/documento-transporte?tipo=8&nrDocumento=17BR0040852'
				break
		}
	}
});