var Q = require('q');
var fs = require('fs');
var request = require('request');
var url = require('url');

var ca1 = fs.readFileSync('/var/task/icp.cer');
var ca2 = fs.readFileSync('/var/task/serprov3.cer');
var ca3 = fs.readFileSync('/var/task/serproacfv3.cer');
var a1 = fs.readFileSync('/var/task/a1.p12');

var autentica = function (perfil) {
	var q = Q.defer();

	var options = {
		url: 'https://hom.stpconnect.serpro.gov.br/portal/api/autenticar',
		agentOptions: {
			ca: [ca1, ca2, ca3],
			pfx: a1,
			passphrase: '123456'
		},
		headers: {
			'Role-Type': perfil
		}
	}

	request.post(options, function (err, resp, body) {
		if (err) q.reject(err);
		q.resolve({
			set_token: resp.headers['set-token'],
			csrf_token: resp.headers['x-csrf-token']
		});
	});

	return q.promise;
}