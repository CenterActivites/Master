-- Tables for the Alt F4

drop table Item cascade constraints;
drop table Rental cascade constraints;
drop table Customer cascade constraints;
drop table Cust_history cascade constraints;
drop table Cust_phone cascade constraints;
drop table Cust_email cascade constraints;
drop table Reservation cascade constraints;
drop table Log cascade constraints;
drop table Packages cascade constraints;
drop table Users cascade constraints;
drop table Usergroups cascade constraints;
drop table Permission cascade constraints;
drop table Vendors cascade constraints;

-- Changed all id from 'chars' to 'ints' -Lam

create table Packages
(pack_id              int,
 pack_name            varchar2(20), 
 primary key          (pack_id));

create table Reservation
(reserve_id           int,
 start_date           date,
 end_date             date,
 primary key          (reserve_id)
);

create table Item
(item_back_id         int,                      
 item_front_id        varchar2(20),             
 item_name            varchar2(30),
 item_size            varchar2(15),
 item_type            varchar2(20),
 reserve_id           int,
 status               varchar2(20),
 model                varchar2(30),
 price                varchar2(20),
 note                 varchar2(50),
 pack_id              int,
 location             varchar2(30),
 primary key          (item_back_id),
 foreign key          (pack_id)
 references           Packages(pack_id)
 );

create table Customer
(cust_id              int,
 cust_fname           varchar2(20),
 cust_lname           varchar2(20),
 cust_address         varchar2(50),
 cust_pref_contact    varchar2(50),
 primary key          (cust_id)
);

create table Cust_history
(cust_hist_id         int,
 cust_id              int,
 item_back_id         int,
 primary key          (cust_hist_id),
 foreign key          (cust_id)
 references           Customer(cust_id),
 foreign key          (item_back_id)
 references           Item(item_back_id)
);

create table Cust_phone
(phone_id             int,
 cust_id              int,
 cust_phone_num       varchar2(12),
 note                 varchar2(30),
 primary key          (phone_id),
 foreign key          (cust_id)
 references           Customer(cust_id)
);
 
create table Cust_email
(cust_email_id        int,
 cust_id              int,
 cust_email           varchar2(40),
 note                 varchar2(30),
 primary key          (cust_email_id),
 foreign key          (cust_id)
 references           Customer(cust_id));

create table Rental
(rent_id              int,
 item_back_id         int,  
 cust_id              int,
 rent_out             date,
 return_date          date,
 date_was_returned    date,
 primary key          (rent_id),
 foreign key          (item_back_id)
 references           Item(item_back_id),
 foreign key          (cust_id)
 references           customer(cust_id)); 

-- massive issue here. We can't have user level be the prim key for this table since there is going to be more than one of each
--level type. We should make the username the prim key since each user name can be totally different or we add in a random num gen
-- and create ids for each insert. ~Eric
create table Usergroups
(id	              int,
 power_level          int,              
 title	              varchar2(50),
 CONSTRAINTS	      Usergroups_unique UNIQUE (power_level),
 primary key          (id));

create table Permission
(id                     int,
 power_level	        int,
 rentals		int,
 returns		int,
 inventory		int,
 history		int,
 admin_reports		int,
 admin_exports		int,
 admin_vendors		int,
 admin_setup		int,
 primary key		(id),
 foreign key		(power_level)
 references		Usergroups(power_level));
 
create table Users
(user_id              int,
 username             varchar(28),
 password             char(50),
 empl_fname           varchar2(20),
 empl_lname           varchar2(20),
 power_level          int,
 primary key          (user_id),
 foreign key          (power_level)
 references           Usergroups(power_level));

 
create table Log
(id		      int,
 user_id              int,
 action               varchar2(100),
 date_stamp           date,
 time_stamp           timestamp,
 primary key          (id),
 foreign key          (user_id)
 references           Users(user_id));

create table Vendors
(ven_id			int,
 ven_name		varchar2(30),
 ven_phone		varchar2(12),
 ven_email		varchar2(50),
 ven_location 	  	varchar2(50),
 primary key		(ven_id));
	
