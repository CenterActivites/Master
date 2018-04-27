/*--------------- Center Activities DataBase ---------------*/

drop table Packages cascade constraints;
  
  /* Table Packages */
  /* Purpose: To have mult items select at onces for certain packages */
  /* Example: Surf package contains surfboard, lease, wetsuit */
  
  create table Packages
  (pack_id           int,
   pack_name         varchar2(20),
   stu_day_price     int,
   day_price         int,
   stu_weekend_price int,
   weekend_price     int,
   stu_week_price    int,
   week_price        int,
   primary key       (pack_id)
  );
  
drop table Category cascade constraints;

/*  Table Category */
/*  Purpose: categorize the items in inventory */
/*  Example: a surfboard would be a inventory item that would be under the Surf category */

create table Category                     
(cat_id              int,                  
 cat_name            varchar2(20),   
 primary key         (cat_id)
 );

 drop table Inventory cascade constraints;
 
 /* Table Inventory */
 /* Purpose: provide the inventory item name and a connection to category */
 /* Example: Tents would be an inventory item */
 
create table Inventory                    
(inv_id              int,                  
 inv_name            varchar2(30),         
 cat_id              int,
 stu_day_price       int,
 day_price           int,
 stu_weekend_price   int,
 weekend_price       int,
 stu_week_price      int,
 week_price          int,
 primary key         (inv_id),
 foreign key         (cat_id)
 references          Category(cat_id)
 );
 
 drop table Item cascade constraints;
 
 /* Table Item */
 /* Purpose: provide every item that it in the inventory */
 /* Example: There can be 10 different sleeping bags with different brands, ids under the inventory name "Sleeping Bag" */
 
 create table Item                         
 (item_Backid        int,                 
  item_Frontid       varchar2(20),     
  item_name          varchar2(20),
  /* item_name could be the model name of the item. If item have both a item name and model name, just combine them. 
     Example: Name-"Surftech"  Model-"Softtop"        item_name would be "Surftech Softtop" */
  item_size          varchar2(30),   
  /* sizes can be numeric or a quick size description. Example: 4 person tent, a 2 person kayak, Regular size*/
  item_status        varchar2(20) check(item_status in
                          ('ready', 'check_out', 'repair', 'check_in')),
  inv_id             int,
  primary key        (item_Backid),
  foreign key        (inv_id)
  references          Inventory(inv_id)
  );
  
  drop table InvPack cascade constraints;
  
  /* Table InvPack */
  /* Purpose: For a many-to-many relation between Packages and Inventory */
  /* Example: Package Surf can have many inventory items in it and inventory 
			  item surfboard can be in many packages like the Surfboard package
			  and Surf package */
  
  create table InvPack
  (invpack_id           int,
   pack_id              int,
   inv_id               int,
   primary key          (invpack_id),
   foreign key          (pack_id)
   references           Packages(pack_id),
   foreign key          (inv_id)
   references           Inventory(inv_id)
  );
  
  drop table Customer cascade constraints;

  /* Table Customer */
  /* Purpose: Table contains information about the customer, fname, lname, dob, address,
     phone, etc... ALSO depending if the customer is a STUDENT: "yes" "no" he/she/other
     gets discount. */
  /* Example: David, Beckem, 10-NOV-1992, 1st Harpst St Arcata CA 95521, '707-329-3231',
     DavidB@humboldt.edu, "Yes", "707-324-2313" */

  create table Customer
  (cust_id           int,
   f_name            varchar2(25),
   l_name            varchar2(25),
   c_dob             varchar2(10),
   c_addr            varchar2(30),
   c_phone           varchar2(12),
   c_email           varchar2(20),
   is_student        varchar2(5) check(is_student in
                          ('yes', 'no')),
   emerg_contact     varchar2(50),
   primary key       (cust_id)
  );
 
  drop table ItemReservation cascade constraints;

  /* Table ItemReservation */
  /* Purpose: Table that requests item rental, return date, and shows which customer rents what items */
  /* Example: item: surf board, rental request date: 10-MAY-2018 rental return date: 12-MAY-2018, cust_id */
  
  create table ItemReservation
  (rental_id	     int,
   item_Backid       int,
   request_date      date,
   return_date       date,
   /* Kinda realize that we need to keep the date the item is due back by and the actual date the customer 
	  picked up the item -Lam*/
   due_date          date,
   pick_up_date      date,
   cust_id           int,
   primary key       (rental_id),
   foreign key       (item_Backid)
   references        Item(item_Backid),
   foreign key       (cust_id)
   references         Customer(cust_id)
  );
  
  drop table Employee cascade constraints;
  
  /* Table Employee */
  /* Purpose: Table that contains information about the employees at center activities */
  /* Example: Jimmy Hip works at the front desk at Center Activities */
  
  create table Employee
  (empl_id	         int,
   empl_fname        varchar2(20),
   empl_lname        varchar2(20),
   primNum           varchar2(12),
   title             varchar2(15) check(title in
                          ('Front Desk', 'Inventory Room', 'Supervisor', 'Boss')),
   primary key       (empl_id)
  );
  
  drop table Repair cascade constraints;
  
  /* Table Repair */
  /* Purpose: Table that contains information about item repairs like when it was las repaired, what was repair for, who did it, etc. */
  /* Example: Surfboard number 2 was last repaired on the 17th of Dec, fixed the leasing problem that the board had */
  
  create table Repair
  (repair_id	     int,
   item_Backid       int,
   empl_id           int,
   repair_date       date,
   repair_comment    varchar2(100),
   primary key       (repair_id),
   foreign key       (item_Backid)
   references        Item(item_Backid),
   foreign key       (empl_id)
   references         Employee(empl_id)
  );
  
  drop table Vendor cascade constraints;
  
  /* Vendor */
  /* Purpose: Has all information about the different companies the center buys/have repairs from */
  /* Example: The center buys replaces all their surfboards from the _____ company */
  
  create table Vendor
  (ven_id            int,
   ven_name          varchar2(30),
   ven_phone         varchar2(12),
   ven_address       varchar2(50),
   primary key       (ven_id)
  );
  
  
  
 /*
     Not sure if we would really need a log table for both customers 
     and employees since we can just simply do a report to get the 
	 necessary information about their history -Lam 2/26/2018
*/
  
  
  drop table Transaction cascade constraints;
  
  /* Table Transaction */
  /* Purpose: Keeps information about each customer's transaction like what items they rented or returned, what the transaction happens. */
  /* Example: Bob rented out a surfboard and a lease on 4/5/2018 or Bob returned a tent on 9/20/16 */
  
  create table Transaction
  (trans_id 		int,
   time_stamp 		DATE DEFAULT(sysdate),
   cust_id 			int,
   trans_type		varchar2(10)check(trans_type in
                          ('rental', 'return')),
   primary key (trans_id),
   foreign key (cust_id)
   references Customer(cust_id)
  );  
  
  
  
  
  
