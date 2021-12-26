create database empresta;
use empresta;

create table Cliente(
	id int auto_increment primary key,
    nomeCliente varchar(50),
    phone varchar(20),
    username varchar(20),
    senha varchar(32)
);

insert into Cliente(nomeCliente,phone, username, senha)
values
("João Victor","987772818", "jvsmlzz", md5(12345));

SELECT * FROM Cliente ;
SELECT username FROM Cliente WHERE id = 1;

/*drop table Cliente;*/
/*drop table Itens;*/

create table Itens(
	id int auto_increment primary key,
    nome varchar(50),
    dataEmprestimo date,
    previsao date,
    dataEntrega date,
    status varchar(20),
    tipo varchar(20),
    idCliente int,
    idClienteEmprestado int
);

alter table Itens add constraint fk_cliente foreign key Itens(idCliente) references Cliente(id);
alter table Itens add constraint fk_clienteEmprestado foreign key Itens(idClienteEmprestado) references Cliente(id);
select Cliente.nome, Itens.nome from Cliente 
inner join Itens on Itens.idCliente = Cliente.id;




