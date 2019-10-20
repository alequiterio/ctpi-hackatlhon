var Q = require('q');
var fs = require('fs');
var request = require('request');
var parser = require('url');

var ca1 = fs.readFileSync('./icp.cer');
var ca2 = fs.readFileSync('./serprov3.cer');
var ca3 = fs.readFileSync('./serproacfv3.cer');

var autentica = function (perfil, ambiente, host) {
	var q = Q.defer();

	if (ambiente === 'hom') {
		var a1 = fs.readFileSync('./a1.p12');
		var passphrase = '123456'
	}
	else {
		var a1 = fs.readFileSync('./a1_prod.p12');
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
		if (err) console.log(err)
		if (err) q.reject(err);

		q.resolve({
			set_token: resp.headers['set-token'],
			csrf_token: resp.headers['x-csrf-token'],
			passphrase: passphrase
		});
	});

	return q.promise;
}

var chamaURL = function (path, perfil, ambiente, host, verb, body_send) {
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

			switch (verb) {
				case 'GET':
					request.get(options, function (err, resp, body) {
						if (err) console.log(err)
						if (err) q.reject(err);
						else q.resolve({
							"statusCode": resp.statusCode,
							"headers": resp.headers,
							// "body": JSON.parse(body)
							"body": body
						});
					})
					break;
				case 'PUT':
					options.method = 'put';
					options.json = true;
					options.body = body_send;

					request(options, function (err, resp, body) {
						if (err) console.log(err)
						if (err) q.reject(err);
						else q.resolve({
							"statusCode": resp.statusCode,
							"headers": resp.headers,
							// "body": JSON.parse(body)
							"body": body
						});
					});
					break;
				case 'POST':
					options.method = 'post';
					options.json = true;
					options.body = body_send;

					request(options, function (err, resp, body) {
						if (err) console.log(err)
						if (err) q.reject(err);
						else q.resolve({
							"statusCode": resp.statusCode,
							"headers": resp.headers,
							// "body": JSON.parse(body)
							"body": body
						});
					});
					break;
				case 'DELETE':
					options.method = 'delete';
					options.json = true;
					options.body = body_send;

					request(options, function (err, resp, body) {
						if (err) console.log(err)
						if (err) q.reject(err);
						else q.resolve({
							"statusCode": resp.statusCode,
							"headers": resp.headers,
							// "body": JSON.parse(body)
							"body": body
						});
					});
					break;
			}
		})
		.catch(function (err) {
			console.log(err);
			q.reject(err);
		});

	return q.promise;
}

// function handler (event, context, callback) {

// 	// var body = JSON.parse(event.body);
// 	var body = event;
// 	var url = body.url;
// 	var parametros = body.parametros;
// 	var perfil = body.perfil;

// 	parametros.forEach(function (parametro, i) {
// 		if (i === 0) {
// 			url += '?' + parametro;
// 		} else {
// 			url += '&' + parametro
// 		}
// 	});

// 	var host = parser.parse(url).host;
// 	switch(host) {
// 		case 'portalunico.siscomex.gov.br':
// 			var ambiente = 'prod'
// 			break
// 		case 'val.portalunico.siscomex.gov.br':
// 			var ambiente = 'val'
// 			break
// 		case 'hom.stpconnect.serpro.gov.br':
// 			var ambiente = 'hom'
// 			break
// 	}

// 	chamaURL(url, perfil, ambiente, host)
// 		.then(function (resp) {
// 			console.log(JSON.stringify(resp))
// 		})
// 		.catch(function (err) {
// 			console.log(err)
// 		});
// }

function handler (event, context, callback) {

	var body = event;
	var url = body.url;
	var verb = event.verb;
	var perfil = body.perfil;
	var ambiente = 'hom';
	var body_send = event.body_send;

	var host = parser.parse(url).host;
	switch(host) {
		case 'portalunico.siscomex.gov.br':
			var ambiente = 'prod'
			break
		case 'val.portalunico.siscomex.gov.br':
			var ambiente = 'val'
			break
		case 'hom-mdic.stpconnect.serpro.gov.br':
			var ambiente = 'hom'
			break
	}
	console.log(verb + ' ' + url);

	chamaURL(url, perfil, ambiente, host, verb, body_send)
		.then(function (resp) {
			console.log(resp.statusCode)
			console.log(resp.headers)
			console.log(resp.body)
		})
		.catch(function (err) {
			console.log(err)
		});
}

// var base_url = 'https://hom-mdic.stpconnect.serpro.gov.br/talpco/api';
var base_url = 'https://hom.stpconnect.serpro.gov.br/talpco/api';

var lpco = {
	post: base_url + '/ext/lpco',
	get_consulta: base_url + '/ext/lpco/consulta',
	get: base_url + '/ext/lpco/',
	put: base_url + '/ext/lpco/',
};

var lpco_exigencia = {
	put: base_url + '/ext/lpco/exigencia/',
	post: base_url + '/ext/lpco/exigencia/',
	get: base_url + '/ext/lpco/exigencia/',
	delete: base_url + '/ext/lpco/exigencia/'
}

var lpco_template = {
	get: base_url + '/ext/lpco/template/'
}

var lpco_modelo = {
	get: base_url + '/ext/lpco/modelo/'
}

var lpco_situacao = {
	put: base_url + '/ext/lpco/situacao/',
	get: base_url + '/ext/lpco/situacao/',
}

var numero_lpco = 'E1700000243';

var body_send = {
  "situacao": "EM_ANALISE",
  "justificativa": "OK",
  // "dataInicioVigencia": "2017-12-07T12:18:52.674Z",
  // "dataFinalVigencia": "2017-12-10T12:18:52.674Z",
  // "numeroOrgaoOrigem": "DECEX",
  "requerInspecao": true
}

var body_send_lpco = {
  // "codigoModelo": "E00178",
  // "importadorExportador": "02916265000160",
  // "declarante": "02916265000160",
  "unidadeMedidaEstatistica": "KG",
  "unidadeMedidaComercializada": "KG",
  "listaNcm": [
    {
      "ncm": "87142000",
      "listaCamposNcm": [],
      "listaAtributosNcm": []
    }
  ],
  "listaCamposFormulario": [
    {
      "codigo": "CONDICAO_VENDA",
      "listaValor": [
        "DAP"
      ]
    },
    {
      "codigo": "MOEDA",
      "listaValor": [
        "USD"
      ]
    },
    {
      "codigo": "TIPOS_EMBALAGEM",
      "listaValor": [
        "Caixa de pape"
      ]
    },
    {
      "codigo": "ATT_1462",
      "listaValor": [
        "10/09/2017"
      ]
    },
    {
      "codigo": "ATT_1461",
      "listaValor": [
        "2017"
      ]
    }

    // {
    //   "codigo": "CONDICAO_VENDA",
    //   "listaValor": [
    //     "CIF"
    //   ]
    // },
    // {
    //   "codigo": "MOEDA",
    //   "listaValor": [
    //     "CAD"
    //   ]
    // },
    // {
    //   "codigo": "TIPOS_EMBALAGEM",
    //   "listaValor": [
    //     "Caixa de papelão"
    //   ]
    // },
    // {
    //   "codigo": "ATT_1461",
    //   "listaValor": [
    //     "1"
    //   ]
    // },
    // {
    //   "codigo": "ATT_1462",
    //   "listaValor": [
    //     "31/12/2017"
    //   ]
    // }
    // {
    //   "codigo": "NCM",
    //   "listaValor": [
    //     "22072011"
    //   ]
    // },
    // {
    //   "codigo": "IMPORTADOR",
    //   "listaValor": [
    //     "JEREMIAS"
    //   ]
    // },
    // {
    //   "codigo": "QTDE_ESTATISTICA",
    //   "listaValor": [
    //     "22,50000"
    //   ]
    // },
    // {
    //   "codigo": "ATT_1395",
    //   "listaValor": [
    //     "003"
    //   ]
    // },
    // {
    //   "codigo": "ATT_1339",
    //   "listaValor": [
    //     "2"
    //   ]
    // }
  ]
}

var body_send_lpco =
{ 
        "codigoModelo": "E00297", 
        "importadorExportador": "02916265000160", 
        "declarante": "02916265000160", 
        "listaNcm": [ 
                { 
                "ncm": "02022090", 
                "listaCamposNcm": [ 
                        { 
                    "codigo": "QTDE_ESTATISTICA", 
                    "listaValor": ["100"] 
            }, 

            { 
                "codigo": "QTDE_COMERCIALIZADA", 
                "listaValor": ["200"] 
            } 
                
                ], 
                "listaAtributosNcm": [] 
                } 
        ], 
        "listaCamposFormulario": [ 
                { 
                        "codigo": "ENQUADRAMENTO_OPERACAO", 
                        "listaValor": ["81503"] 
                }, 

                { 
                        "codigo": "MOEDA", 
                        "listaValor": ["BRL"] 
                }, 

                { 
                        "codigo": "VMLE", 
                        "listaValor": ["123.45"] 
                } 

        ] 
}

var body_teste = 
[
  {
    "seq": 234,
    "cnpjRaiz": "02916265",
    "codigo": "codigoTeste",
    "nome": "Produto teste",
    "logradouro": "SHIS",
    "nomeCidade": "Brasília",
    "codigoSubdivisaoPais": "04",
    "codigoPais": "02",
    "cep": "70390135"
  },
  {
    "seq": 2345,
    "cnpjRaiz": "02916265",
    "codigo": "codigoTeste",
    "nome": "Produto teste",
    "logradouro": "SHIS",
    "nomeCidade": "Brasília",
    "codigoSubdivisaoPais": "04",
    "codigoPais": "02",
    "cep": "70390135"
  }
]
// [
//   {
//     "seq": 0,
//     "descricao": "Produto via upload json",
//     "cnpjRaiz": "02916265",
//     "situacao": "Ativado",
//     "modalidade": "AMBOS",
//     "ncm": "02012020",
//     "codigoNaladi": 123,
//     "codigoGPC": 456,
//     "codigoGPCBrick": 789,
//     "codigoUNSPSC": 101112,
//     "paisOrigem": "BR",
//     "cpfCnpjFabricante": "02916265",
//     "fabricanteConhecido": false,
//     "codigoOperadorEstrangeiro": "código do operador via serviço",
//     "atributos": [
//     ],
//     "codigosInterno": [
//       "string"
//     ]
//   }
// ];

// return handler({
// 	url: 'https://hom.stpconnect.serpro.gov.br/cct/api/ext/deposito-carga/consultar-estoque-pos-acd?numeroDUE=17BR0000445540',
// 	verb: 'GET',
// 	perfil: 'IMPEXP',
// 	body_send: body_send_lpco
// })

// var campos_formulario_dat = [
// 		{
// 			"codigo": "NCM",
// 			"listaValor": ["02012020"]
// 		},
// 		{
// 			"codigo": "ATT_1660",
// 			"listaValor": ["1234"]
// 		},
// 		{
// 			"codigo": "NUMERO_CONTEINER",
// 			"listaValor": ["1234"]
// 		},
// 		{
// 			"codigo": "ATT_1666",
// 			"listaValor": ["2342"]
// 		},
// 		{
// 			"codigo": "NUMERO_LACRE",
// 			"listaValor": ["1234"]
// 		},
// 		{
// 			"codigo": "ATT_1663",
// 			"listaValor": ["1234"]
// 		},
// 		{
// 			"codigo": "ATT_1801",
// 			"listaValor": ["1234"]
// 		},
// 		// Usos propostos
// 		{
// 			"codigo": "ATT_1802",
// 			"listaValor": ["14"]
// 		},
// 		// Unidade vigiagro
// 		{
// 			"codigo": "ATT_1803",
// 			"listaValor": ["002740"]
// 		},
// 		// {
// 		// 	"codigo": "SITUACAO_ESPECIAL",
// 		// 	"listaValor": ["Teste"]
// 		// }
// ];

// Validacao
// var campos_formulario_dat = [
// 		{
// 			"codigo": "NCM",
// 			"listaValor": ["02071400"]
// 		},
// 		// Usos propostos
// 		{
// 			"codigo": "ATT_1408",
// 			"listaValor": ["14"]
// 		},
// 		// Unidade vigiagro
// 		{
// 			"codigo": "ATT_1409",
// 			"listaValor": ["002740"]
// 		},
// 		{
// 			"codigo": "PAIS_DESTINO",
// 			"listaValor": ["US"]
// 		},
// 		{
// 			"codigo": "SITUACAO_ESPECIAL",
// 			"listaValor": ["2002"]
// 		}
// ];

// // Validacao
// var lista_ncm_dat = [
// 	{
// 		"ncm": "02071400",
// 		"listaCamposNcm": [{
// 			"codigo": "QTDE_ESTATISTICA",
// 			"listaValor": ["2.0"]
// 		}],
// 		"listaAtributosNcm": [
// 			{
// 				"codigo": "ATT_1463",
// 				"listaValor": ["01"]
// 			}
// 		]
// 	},
// ];


// Validacao
// var body_dat = {
// 	"codigoModelo": "E00333",
// 	"importadorExportador": "02916265000160",
// 	"declarante": "02150017105",
// 	"unidadeMedidaEstatistica": "KG",
// 	"unidadeMedidaComercializada": "KG",
// 	"informacaoAdicional": "Teste",
// 	"listaNcm": lista_ncm_dat,
// 	"listaCamposFormulario": campos_formulario_dat
// }

// Homologacao
var campos_formulario_dat = [
		{
			"codigo": "NCM",
			"listaValor": ["02071400"]
		},
		// Numero CSI
		{
			"codigo": "ATT_1660",
			"listaValor": ["Numero_CSI"]
		},
		// Numero lacre
		{
			"codigo": "NUMERO_LACRE",
			"listaValor": ["Numero_Lacre"]
		},
		// Usos propostos
		{
			"codigo": "ATT_1802",
			"listaValor": ["14"]
		},
		// Unidade vigiagro
		{
			"codigo": "ATT_1803",
			"listaValor": ["002740"]
		},
		// Qtd estatistica
		{
			"codigo": "QTDE_ESTATISTICA",
			"listaValor": ["2.0"]
		},
		{
			"codigo": "PAIS_DESTINO",
			"listaValor": ["US"]
		},
		{
			"codigo": "SITUACAO_ESPECIAL",
			"listaValor": ["2002"]
		}
];

// Homologacao
var lista_ncm_dat = [
	{
		"ncm": "02071400",
		"listaCamposNcm": [],
		"listaAtributosNcm": [
			{
				"codigo": "ATT_1912",
				"listaValor": ["01"]
			}
		]
	},
];

// Homologacao
var body_dat = {
	"codigoModelo": "E00374",
	"importadorExportador": "02916265000160",
	"declarante": "02150017105",
	"unidadeMedidaEstatistica": "KG",
	"unidadeMedidaComercializada": "KG",
	"informacaoAdicional": "Teste",
	"listaNcm": lista_ncm_dat,
	"listaCamposFormulario": campos_formulario_dat
}
// return console.log(JSON.stringify(body_dat))
return handler({
	// url: 'https://hom.stpconnect.serpro.gov.br/catp/api/ext/operador-estrangeiro',
	// url: 'https://hom.stpconnect.serpro.gov.br/catp/api/ext/produto',
	// url: 'https://hom.stpconnect.serpro.gov.br/talpco/api/ext/lpco/modelo/E00374',
	// url: 'https://hom.stpconnect.serpro.gov.br/talpco/api/ext/lpco/modelo/E00374/02071400',
	// url: 'https://hom.stpconnect.serpro.gov.br/talpco/api/ext/lpco',
	// url: 'https://hom.stpconnect.serpro.gov.br/talpco/api/ext/lpco/situacao/E1800000110',
	// url: 'https://val.portalunico.siscomex.gov.br/talpco/api/ext/lpco/modelo/E00022',
	// url: 'https://val.portalunico.siscomex.gov.br/talpco/api/ext/lpco',
	// url: 'https://val.portalunico.siscomex.gov.br/due/api/ext/due/consultarDadosResumidosDUE?numero=18BR0000015155',
	url: 'https://val.portalunico.siscomex.gov.br/due/api/ext/due',
	// verb: 'GET',
	verb: 'POST',
	perfil: 'IMPEXP',
	body_send: '<><>'
})