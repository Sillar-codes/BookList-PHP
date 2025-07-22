create database eshop;

create database eshop;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

create table booklist(
	id int not null auto_increment,
    book varchar(100) not null,
    primary key (id)
) engine = InnoDB;

desc booklist;