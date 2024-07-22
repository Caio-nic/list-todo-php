create table tarefas (
    id int not null auto_increment,
    nome varchar(255) not null,
    prioridade varchar(55) not null,
    done datetime,
    created_at datetime not null default now(),
    primary key (id)
);