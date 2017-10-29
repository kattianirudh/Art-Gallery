create table seller (
	seller_id varchar primary key,
	seller_name varchar,
	seller_phone number(10),
	seller_address varchar(50)
);

create table customer (
	cust_id varchar primary key,
	cust_pasword varchar,
	cust_name varchar,
	cust_phone number(10),
	cust_address varchar(50)
);

create table art (
	art_id varchar primary key,
	art_name varchar,
	artist varchar,
	art_type varchar,
	art_price number(10,2),
	seller_id varchar
);

create table art_description (
	art_id references art(art_id),
	description varchar,
	age number
	image blob
);

create table purchases (
	cust_id references customer(cust_id),
	art_id references art(art_id),
	seller_id references seller(seller_id)
);