<?php
require_once('db.php');

/*create table

    create table users(
        id int not null auto_increment,
        username varchar(64) not null,
        password varchar(32) not null,
        money decimal(18,2),
        primary key(id)
    );

insert:
    insert into users(username, password, money) values ("jake b", "foo", 100.00);
    insert into users(username, password, money) values ("bob", "bar", 10.00);


    insert into users(username, money) values ("jake b", 100.00)
    where not exists
    (select * from users
        where username = 'jake b');


*/

// add user
// insert into users(username, money) values ("dan", 10.00);


// query user

?>