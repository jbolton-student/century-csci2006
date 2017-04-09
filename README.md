# PHP project overview

Project Overview, not everything is required.

# Pages

## product:search

Displays multiple results based on names or categories.

## product:show id

Show one specific item.

## cart

Shows shopping cart. Allows purchase.

 ## history

 Shows all items bought by user.

 ## admin:Product add/edit
 Adds new (or edits existing) product. Possibly **scrapes** meta-data from Amazon.

 form: description, price, image, category

# Tables

Overview of types. I prefixed lines with "?" if I'm not sure.

## products

    create table products(
        id int not null auto_increment,
        cost decimal(18, 2) not null,
        name varchar(128),
        image varchar(256),
        description text,

        primary key(id)
    );

## users

    create table users(
        id int not null auto_increment,
        username varchar(64) not null,
        money decimal(18,2),
        primary key(id)
    );

## shopping cart

    create table cart(
        ? id int not null auto_increment,
        ? user_id foreign users.id,
        product_id int not null,
        product_cost decimal(18, 2),
        ? product_quantity int not null,

        ? primary key(id)
    );

## purchase history

List of all items user has purchased

    create table purchase_history(
        id int not null auto_increment,
        product_id int not null,
        product_quantity int not null,

        primary key(id)
    );
