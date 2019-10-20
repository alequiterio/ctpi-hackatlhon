require 'nokogiri'
require 'base64'
require 'openssl'
private_key = OpenSSL::PKey::RSA.new(File.read("chave_privada.pem"), "123456")
certificate = OpenSSL::X509::Certificate.new(File.read("certificado_publico.pem"))
print private_key

inf_nfe = %{
<infNFe xmlns="http://www.portalfiscal.inf.br/nfe" Id="NFe35161102916265000160550014978610231050925991" versao="3.10"><ide><cUF>35</cUF><cNF>05092599</cNF><natOp>x</natOp><indPag>0</indPag><mod>55</mod><serie>1</serie><nNF>497861023</nNF><dhEmi>2016-11-01T00:00:00-03:00</dhEmi><tpNF>1</tpNF><idDest>3</idDest><cMunFG>3544608</cMunFG><tpImp>2</tpImp><tpEmis>1</tpEmis><cDV>1</cDV><tpAmb>2</tpAmb><finNFe>1</finNFe><indFinal>0</indFinal><indPres>0</indPres><procEmi>3</procEmi><verProc>3.10.92</verProc></ide><emit><CNPJ>02916265000160</CNPJ><xNome>Teste</xNome><enderEmit><xLgr>teste</xLgr><nro>12</nro><xBairro>sw</xBairro><cMun>3544608</cMun><xMun>Sabino</xMun><UF>SP</UF><CEP>70670108</CEP><cPais>1058</cPais><xPais>BRASIL</xPais></enderEmit><IE>116625121118</IE><CRT>3</CRT></emit><dest><idEstrangeiro/><xNome>UNIDADE ENCAT</xNome><enderDest><xLgr>UME X UMT</xLgr><nro>12</nro><xBairro>CA</xBairro><cMun>9999999</cMun><xMun>Exterior</xMun><UF>EX</UF><cPais>2496</cPais><xPais>ESTADOS UNIDOS</xPais></enderDest><indIEDest>9</indIEDest></dest><det nItem="1"><prod><cProd>local despacho/embarque</cProd><cEAN/><xProd>Carne</xProd><NCM>02012020</NCM><CFOP>7101</CFOP><uCom>KG</uCom><qCom>2.0000</qCom><vUnCom>15.0000000000</vUnCom><vProd>30.00</vProd><cEANTrib/><uTrib>KG</uTrib><qTrib>2.0000</qTrib><vUnTrib>15.0000000000</vUnTrib><indTot>1</indTot></prod><imposto><ICMS><ICMS40><orig>0</orig><CST>41</CST></ICMS40></ICMS><IPI><cEnq>1</cEnq><IPINT><CST>02</CST></IPINT></IPI><PIS><PISNT><CST>07</CST></PISNT></PIS><COFINS><COFINSNT><CST>07</CST></COFINSNT></COFINS></imposto></det><total><ICMSTot><vBC>0.00</vBC><vICMS>0.00</vICMS><vICMSDeson>0.00</vICMSDeson><vFCPUFDest>0.00</vFCPUFDest><vICMSUFDest>0.00</vICMSUFDest><vICMSUFRemet>0.00</vICMSUFRemet><vBCST>0.00</vBCST><vST>0.00</vST><vProd>30.00</vProd><vFrete>0.00</vFrete><vSeg>0.00</vSeg><vDesc>0.00</vDesc><vII>0.00</vII><vIPI>0.00</vIPI><vPIS>0.00</vPIS><vCOFINS>0.00</vCOFINS><vOutro>0.00</vOutro><vNF>400000.00</vNF><vTotTrib>0.00</vTotTrib></ICMSTot></total><transp><modFrete>0</modFrete></transp><infAdic><procRef><nProc>20160000837671-9</nProc><indProc>9</indProc></procRef></infAdic></infNFe>}
infnfe_canonized = Nokogiri::XML(inf_nfe.gsub(/>\s+</,"><")).canonicalize(Nokogiri::XML::XML_C14N_1_1)
digest_value = Base64.encode64(OpenSSL::Digest::SHA1.digest(infnfe_canonized)).strip
print digest_value+"\n"

signed_info = %{
	<SignedInfo xmlns="http://www.w3.org/2000/09/xmldsig">
		<CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
		<SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1"/>
		<Reference URI="#NFe35161102916265000160550014978610231050925991">
			<Transforms>
				<Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature"/>
				<Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315"/>
			</Transforms>
			<DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1"/>
			<DigestValue>}+digest_value+%{</DigestValue>
		</Reference>
	</SignedInfo>}

signed_info_canonized = Nokogiri::XML(signed_info.gsub(/>\s+</,"><")).canonicalize(Nokogiri::XML::XML_C14N_1_1)
signature_value = Base64.encode64(private_key.sign(OpenSSL::Digest::SHA1.new, signed_info_canonized))
signature_value_canonized = Nokogiri::XML(signature_value.gsub(/>\s+</,"><")).canonicalize(Nokogiri::XML::XML_C14N_1_1)
#signed_info = Nokogiri::XML(signed_info_canonized.gsub(/>\ xmlns="http://www.w3.org/2000/09/xmldsig+</,"><")).canonicalize(Nokogiri::XML::XML_C14N_1_1)
certificado=certificate.to_s.gsub(/\-+[A-Z]+ CERTIFICATE\-+/, "").strip()
cerificate_canonized = Nokogiri::XML(certificado.gsub(/>\s+</,"><")).canonicalize(Nokogiri::XML::XML_C14N_1_1)
nota = inf_nfe+%{<Signature xmlns="http://www.w3.org/2000/09/xmldsig#">}+signed_info_canonized+%{<SignatureValue>}+signature_value_canonized+%{</SignatureValue>}+%{<KeyInfo><X509Data><X509Certificate>}+cerificate_canonized+%{</X509Certificate></X509Data></KeyInfo></Signature>}
print nota
