var Q = require('q');
var fs = require('fs');
var request = require('request');
var parser = require('url');

var ca1 = fs.readFileSync('/var/task/icp.cer');
var ca2 = fs.readFileSync('/var/task/serprov3.cer');
var ca3 = fs.readFileSync('/var/task/serproacfv3.cer');

var autentica = function (perfil, ambiente, host) {
	var q = Q.defer();

	if (ambiente === 'hom') {
		var a1 = fs.readFileSync('/var/task/a1.p12');
		var passphrase = '123456'
	}
	else {
		var a1 = fs.readFileSync('/var/task/a1_prod.p12');
		var passphrase = '110983'	
	}

	var options = {
		url: 'https://' + host +'/portal/api/autenticar',
		agentOptions: {
			ca: [ca1, ca2, ca3],
			pfx: a1,
			passphrase: passphrase
		},
		headers: {
			'Role-Type': perfil
		}
	}

	request.post(options, function (err, resp, body) {
		if (err) console.log(JSON.stringify(err))
		if (err) q.reject(err);
		q.resolve({
			set_token: resp.headers['set-token'],
			csrf_token: resp.headers['x-csrf-token'],
			passphrase: resp.passphrase
		});
	});

	return q.promise;
}

var chamaURL = function (path, perfil, ambiente, host) {
	var q = Q.defer();

	if (ambiente === 'hom') {
		var a1 = fs.readFileSync('./a1.p12');
		var passphrase = '123456'
	}
	else {
		var a1 = fs.readFileSync('./a1_prod.p12');
		var passphrase = '110983'	
	}

	autentica(perfil, ambiente, host)
		.then(function (resp) {
			var set_token = resp.set_token;
			var csrf_token = resp.csrf_token;
			var passphrase = resp.passphrase;

			var options = {
				url: path,
				agentOptions: {
					ca: [ca1, ca2, ca3],
					pfx: a1,
					passphrase: passphrase
				},
				headers: {
					'Authorization': set_token,
					'X-CSRF-Token': csrf_token
				}
			}

			request.get(options, function (err, resp, body) {
				if (err) console.log(JSON.stringify(err))
				if (err) q.reject(err);
				else q.resolve({
					"statusCode": resp.statusCode,
					"headers": resp.headers,
					"body": JSON.parse(body)
				});
			})
		})
		.catch(function (err) {
			console.log(JSON.stringify(err))
			q.reject(err);
		});

	return q.promise;
}

exports.handler = function(event, context, callback) {

	var body = JSON.parse(event.body);
	var url = body.url;
	var parametros = body.parametros;
	var perfil = body.perfil;

	parametros.forEach(function (parametro, i) {
		if (i === 0) {
			url += '?' + parametro;
		} else {
			url += '&' + parametro
		}
	});

	var host = parser.parse(url).host;
	switch(host) {
		case 'portalunico.siscomex.gov.br':
			var ambiente = 'prod'
			break
		case 'val.portalunico.siscomex.gov.br':
			var ambiente = 'val'
			break
		case 'hom.stpconnect.serpro.gov.br':
			var ambiente = 'hom'
			break
	}

	chamaURL(url, perfil, ambiente, host)
		.then(function (resp) {

			callback(null, {
			  statusCode: 200,
			  body: JSON.stringify(resp),
			  headers: {
			    'Content-Type': 'application/json',
			    'Access-Control-Allow-Origin': '*'
			  }
			});

		})
		.catch(function (err) {
			console.log(JSON.stringify(err))
			callback({
			  statusCode: 500,
			  body: JSON.stringify(err),
			  headers: {
			    'Content-Type': 'application/json',
			    'Access-Control-Allow-Origin': '*'
			  }
			}, null);
		});
}