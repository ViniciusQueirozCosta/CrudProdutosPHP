create database dbProdutos
go

use dbProdutos
go

create table Produtos
(
	id int primary key identity,
	nome varchar(30) not null,
	descricao ntext not null,
	preco money not null,
)
go
