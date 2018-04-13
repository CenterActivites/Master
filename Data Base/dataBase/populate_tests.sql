/* Testing to see if tables are querying up properly. 
   Top part is populating the tables.
   Bottom part is doing the query tests*/

/* Doing a start center_act_db_design.sql so we can work with a new set of empty tables each time */
prompt ==========================================================
prompt ==========================================================
prompt Creating Tables
prompt ==========================================================
prompt ==========================================================

start center_act_db_design.sql;

/* 
   There is an outline of the insert of tables in the beginning of each set of inserts.
   People can find what the required data and data type for the insert through the outline.
   You can also just copy the outline and just double click the field (example cat_id)
   and just type whatever you want in the required data type into that field.
*/

prompt ==========================================================
prompt ==========================================================
prompt Populating Tables
prompt ==========================================================
prompt ==========================================================

   
/* ====================================================
   insert into Category
   values
   (cat_id, 'cat_name');
*/

insert into Category
values
(1, 'Camping');

insert into Category
values
(2, 'Surf');




/* ====================================================
   insert into Inventory
   values
   (inv_id, 'inv_name', cat_id);
*/

insert into Inventory
values
(1, 'Tent', 1);

insert into Inventory
values
(2, 'Sleeping Bag', 1);

insert into Inventory
values
(3, 'Pad', 1);

insert into Inventory
values
(4, 'Surfboard', 2);

insert into Inventory
values
(5, 'Lease', 2);

insert into Inventory
values
(6, 'Men Wetsuit', 2);




/* ====================================================
   insert into Item
   values
   (item_Backid, 'item_Frontid', 'item_name', 'item_size', 'item_status', inv_id);
*/

insert into Item
values
(1, '2', 'Ridgecrest Foam', 'Regular', 'repair', 3);

insert into Item
values
(2, '3', 'Ridgecrest Foam', 'Regular', 'ready', 3);

insert into Item
values
(3, 'S13-002', 'Thermarest Ridgerest', 'Regular', 'ready', 3);

insert into Item
values
(4, '1', 'Marmot LimeLight', '1 person', 'repair', 1);

insert into Item
values
(5, 'ONSP17-01', 'North Face', '3 person', 'ready', 1);

insert into Item
values
(6, 'SP13002', 'North Face', 'Long', 'check_out', 2);

insert into Item
values
(7, '2', 'Surftech Softtop', '10 inch', 'repair', 4);

insert into Item
values
(8, '16', 'Power Clip', '11 inch', 'ready', 5);

insert into Item
values
(9, '9', 'Outer Reef', '12 inch', 'check_in', 5);

insert into Item
values
(10, 'S17-02', 'Hotline Reflex5/4', 'small', 'repair', 6);

insert into Item
values
(11, '3', 'Hotline UHC', 'large', 'check_out', 6);

insert into Item
values
(12, '1', 'Hotline UHC', 'medium', 'check_out', 6);

insert into Item
values
(13, '3', 'Surftech Softtop', '9 inch', 'ready', 4);

insert into Item
values
(14, '4', 'Surftech Softtop', '8 inch', 'ready', 4);




/* ====================================================
   insert into Packages
   values
   (pack_id, 'pack_name', inv_id);
*/

insert into Packages
values
(1, 'Surf', 4);

insert into Packages
values
(2, 'Surf', 5);

insert into Packages
values
(4, 'Surf', 6);




/* ====================================================
   insert into Customer
   values
   (cust_id, 'f_name', 'l_name', 'date', 'c_addr', 'c_phone', 'c_email', 'is_student', 'emerg_contact');
*/

insert into Customer
values
(1, 'Tom', 'Yui', '02-OCT-1996', '161 F Street Arcata CA 95521', '714-987-1235', 'tomiscool@yahoo.com', 'no', 'Amy Yui 626-854-9512');

insert into Customer
values
(2, 'Amy', 'Yui', '10-MAY-1990', '161 F Street Arcata CA 95521', '626-854-9512', 'amyyui900@gmail.com', 'no', 'Tom Yui 714-987-1235');

insert into Customer
values
(3, 'Tom', 'Oni', '02-OCT-1996', '166 F Street Arcata CA 95521', '714-999-1235', 'tomiscool@yahoo.com', 'no', 'Amy Yui 626-854-9512');


/* ====================================================
   insert into ItemReservation
   values
   (rental_id, item_Backid, 'request_date', 'return_date', 'due_date', cust_id);
*/

insert into ItemReservation
values
(1, 4, '02-FEB-2018', '10-FEB-2018', '10-FEB-2018', 1);

insert into ItemReservation
values
(2, 1, '02-FEB-2018', NULL, '10-FEB-2018', 1);

insert into ItemReservation
values
(3, 6, '02-FEB-2018', '10-FEB-2018', '10-FEB-2018', 1);

insert into ItemReservation
values
(4, 13, '02-FEB-2018', NULL, '10-FEB-2018', 1);





/* ====================================================
   insert into Employee
   values
   (empl_id, 'empl_fname', 'empl_lname', 'primNum', 'title');
*/

insert into Employee
values
(1, 'Briget', 'Hand', '789-952-6521', 'Boss');

insert into Employee
values
(2, 'Susan', 'Doe', '123-456-7891', 'Supervisor');

insert into Employee
values
(3, 'Emma', 'Hill', '987-654-3219', 'Inventory Room');

insert into Employee
values
(4, 'Scottie', 'Smith', '987-123-4568', 'Front Desk');

insert into Employee
values
(5, 'Pono', 'Kick', '897-564-2313', 'Inventory Room');





/* ====================================================
   insert into Repair
   values
   (repair_id, item_Backid, empl_id, 'repair_date', 'repair_comment');
*/

insert into Repair
values
(1, 10, 3, '10-MAR-2017', 'repair the hole underneath the right arm');

insert into Repair
values
(2, 7, 3, '23-OCT-2017', 'reattach the tail fin');

insert into Repair
values
(3, 4, 5, '23-FEB-2018', 'un-bended the poles of the tent');

insert into Repair
values
(4, 1, 5, '1-MAR-2017', 'sewed the rip on the bottom of the pad');





/* ====================================================
   insert into Vendor
   values
   (ven_id, 'ven_name', 'ven_phone', 'ven_address');
*/

insert into Vendor
values
(1, 'Snow Company', '963-369-9531', '10231 Woodbury rd, Garden Grove CA 92843');

insert into Vendor
values
(2, 'Surf Company', '102-147-7415', '974 H Street, Arcata CA 95521');

insert into Vendor
values
(3, 'Hiking Company', '897-879-6542', '123 Hellow Street, Loveroute NY 45612');





/* ==================================================== 
   insert into Transaction
   values
   (trans_id, SYSDATE, 'cust_id', 'rental_id', 'trans_type'); 
*/ 
   
insert into Transaction
values
(1, SYSDATE, '1', '1', 'rental');
   
insert into Transaction
values
(2, SYSDATE, '1', '2', 'return');
   
insert into Transaction
values
(3, SYSDATE, '1', '3', 'return');






























