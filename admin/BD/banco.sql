CREATE DATABASE porto;
USE porto;

CREATE TABLE Usuario (
    idUsuario INTEGER NOT NULL AUTO_INCREMENT,
    nome VARCHAR(20) NOT NULL,
    senha VARCHAR(32) NOT NULL,
    PRIMARY KEY(idUsuario)
);

CREATE TABLE Navio (
	idNavio VARCHAR(7) NOT NULL,
    transportadora VARCHAR(20) NOT NULL,
    comandante VARCHAR(20) NOT NULL,
    dtChegada datetime,
    idUsuario INTEGER NOT NULL,
    PRIMARY KEY(idNavio),
    FOREIGN KEY(IdUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Caminhao (
	idCaminhao VARCHAR(7) NOT NULL,
    transportadora VARCHAR(20) NOT NULL,
    motorista VARCHAR(20) NOT NULL,
    dtChegada datetime,
    idUsuario INTEGER NOT NULL,
    PRIMARY KEY(idCaminhao),
    FOREIGN KEY(idUsuario) REFERENCES Usuario(idUsuario)
);

CREATE TABLE Container (
	idContainer VARCHAR(3) NOT NULL,
    descricao VARCHAR(20) NOT NULL,
    localizacao VARCHAR(3) NOT NULL,
    origem VARCHAR(7) NOT NULL,
    destino VARCHAR(7) NOT NULL,
    dtEntrada datetime NOT NULL,
    dtSaida datetime,
    PRIMARY KEY(idContainer)
);

CREATE TABLE CarregamentoNavio (
    idCarregamentoNavio INTEGER NOT NULL AUTO_INCREMENT,
    dtCarregamentoNavio datetime NOT NULL,
    idNavio VARCHAR(7) NOT NULL,
    idContainer VARCHAR(3) NOT NULL,
    PRIMARY KEY(idCarregamentoNavio)
);

CREATE TABLE CarregamentoCaminhao (
    idCarregamentoCaminhao INTEGER NOT NULL AUTO_INCREMENT,
    dtCarregamentoCaminhao datetime NOT NULL,
    idCaminhao VARCHAR(7) NOT NULL,
    idContainer VARCHAR(3) NOT NULL,
    PRIMARY KEY(idCarregamentoCaminhao)
);



/* INSERTS PARA TESTES */
INSERT INTO Usuario (nome,senha) VALUES ("admin",MD5(123)); /*com md5*/
INSERT INTO Usuario (nome,senha) VALUES ("a",MD5(1));

/* INSERTS PARA TESTES (NÃO VÁLIDOS AO SISTEMA, COMPROMETEM O SISTEMA, somente para testes!)
INSERT INTO Navio (idNavio,transportadora,comandante,idUsuario) VALUES ("ipp4444","XpNavios","Marcos",1);
INSERT INTO Navio (idNavio,transportadora,comandante,idUsuario) VALUES ("ipp4445","XpNavios","Daniel",1);
INSERT INTO Navio (idNavio,transportadora,comandante,idUsuario) VALUES ("ijk4443","XpNavios","Maria",1);

INSERT INTO Caminhao (idCaminhao,transportadora,motorista,idUsuario) VALUES ("iqq0001","Transito Brasil","Karlos",1);
INSERT INTO Caminhao (idCaminhao,transportadora,motorista,idUsuario) VALUES ("iqq0002","Transito Brasil","Nero",1);
INSERT INTO Caminhao (idCaminhao,transportadora,motorista,idUsuario) VALUES ("iqq0003","Transito Brasil","Vivian",1);
*/