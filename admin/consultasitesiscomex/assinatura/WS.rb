require 'savon'
client = Savon.client(
    encoding: "UTF-8",
    wsdl: "https://hom.sefazvirtual.fazenda.gov.br/NfeAutorizacao/NfeAutorizacao.asmx?WSDL",
    ssl_verify_mode: :none,
    ssl_cert_file: "certificado_publico.pem",
    ssl_cert_key_file: "chave_privada.pem",
    ssl_cert_key_password: "123456"
)
operations=client.operations
print operations

mensagem_soap = %{
	<soap12:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap12="http://www.w3.org/2003/05/soap-envelope">
  <soap12:Header>
    <nfeCabecMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeAutorizacao">
      <versaoDados>3.10</versaoDados>
      <cUF>35</cUF> 
    </nfeCabecMsg>
  </soap12:Header>
  <soap12:Body>
    <nfeDadosMsg xmlns="http://www.portalfiscal.inf.br/nfe/wsdl/NfeAutorizacao"><NFe xmlns="http://www.portalfiscal.inf.br/nfe/nfe/"></NFe></nfeDadosMsg>
  </soap12:Body>
</soap12:Envelope>}.gsub(/\>\s{1,}\</,"><")

resposta = client.call(:nfe_autorizacao_lote, xml: mensagem_soap)

puts resposta.to_s