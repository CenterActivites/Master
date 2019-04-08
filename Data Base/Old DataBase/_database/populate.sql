/* Populating the Database*/ 


/* ===================================================================================== 

   insert into Packages
   values
   (pack_id, pack_name, pack_items);
*/



insert into Packages
values
(1, 'Camping Package');

insert into Packages
values
(2, 'Diving Package');





/* ===================================================================================== 

insert into Reservation
values
(reserve_id, start_date, end_date);
*/



insert into Reservation
values
(1, '10-OCT-2017', '17-OCT-2017');

insert into Reservation
values
(2, '20-MAR-2017', '23-MAR-2017');

insert into Reservation
values
(3, '17-JUN-2017', '01-JUL-2017');

insert into Reservation
values
(4, '10-JAN-2017', '15-JAN-2017');

insert into Reservation
values
(5, '01-JUL-2017', '17-OCT-2017');

insert into Reservation
values
(6, '25-SEP-2017', '30-SEP-2017');

insert into Reservation
values
(7, '07-JUN-2017', '09-JUN-2017');

insert into Reservation
values
(8, '19-JAN-2017', '21-JAN-2017');

insert into Reservation
values
(9, '31-AUG-2017', '02-DEC-2017');

insert into Reservation
values
(10, '08-FEB-2017', '15-FEB-2017');

insert into Reservation
values
(11, '10-JUL-2017', '14-JUL-2017');

insert into Reservation
values
(12, '20-JAN-2017', '25-JAN-2017');





/* ===================================================================================== 

   insert into Item
   values
   (item_back_id, item_front_id, item_name, item_size, item_type, reserve_id, status, model, price, note, pack_id, location);
*/



insert into Item
values
(1, 'S13-002', 'Thermarest Ridgerest', 'regular', 'Pads', 1, 'Ready for Rent', NULL, NULL, NULL, 1, 'School');

insert into Item
values
(2, 'S17-01', 'FORM Ultra Lite Air Mattress', '25"x85"', 'Pads', 1, 'Ready for Rent', NULL, '50', NULL, NULL, 'Aquatic Center');

insert into Item
values
(3, 'F14-04', 'Grand Trunk', NULL, 'Hammock', 4, 'Repair', NULL, '60', 'Holes in the front of the hammock', 1, 'School');

insert into Item
values
(4, 'ONSNP17-05', 'North Face', NULL, 'Tents', 2, 'Checked-in', 'Talus 2', '200', NULL, 1, 'School');

insert into Item
values
(5, 'S14-01', 'Brown', NULL, 'Tarps', 3, 'Ready for Rent', NULL, NULL, NULL, 1, 'School');

insert into Item
values
(6, '4', 'Osprey', 'LG/XL', 'Backpacks', NULL, 'Repair', 'La Plata 70', NULL, 'tearing near hip belt', NULL, 'School');

insert into Item
values
(7, 'F13-01', 'Osprey', 'Youth', 'Backpacks', NULL, 'Ready for Rent', 'Ace', NULL, NULL, NULL, 'School');

insert into Item
values
(8, 'F13-02', 'Osprey', 'S/M', 'Backpacks', 10, 'Ready for Rent', 'Escalante 70', NULL, NULL, NULL, 'School');

insert into Item
values
(9, 'ONSP17-01', 'North Face', NULL, 'Backpacks', 9, 'Ready for Rent', 'Terra 65', '180', NULL, NULL, 'School');

insert into Item
values
(10, 'ONSP17-02', 'North Face', NULL, 'Backpacks', NULL, 'Ready for Rent', 'Terra 65', '180', NULL, NULL, 'School');

insert into Item
values
(11, 'F13-01', 'Cocoon', NULL, 'Sleeping Bag Liners', 1, 'Ready for Rent', 'Mummyliner Coolmax', NULL, NULL, 1, 'School');

insert into Item
values
(12, 'F13-03', 'Cocoon', NULL, 'Sleeping Bag Liners', NULL, 'Ready for Rent', 'Mummyliner Coolmax', NULL, NULL, NULL, 'School');

insert into Item
values
(13, 'IN-1', 'Kokatat cotton teal', NULL, 'Sleeping Bag Liners', 7, 'Ready for Rent', NULL, NULL, NULL, NULL, 'School');

insert into Item
values
(14, 'IN-2', 'Kokatat cotton blue', NULL, 'Sleeping Bag Liners', NULL, 'Ready for Rent', NULL, NULL, NULL, NULL, 'School');

insert into Item
values
(15, '1', NULL, NULL, NULL, NULL, 'Ready for Rent', 'Backpacker''s Cache', NULL, NULL, NULL, 'School');

insert into Item
values
(16, '3', NULL, NULL, NULL, NULL, 'Ready for Rent', 'Backpacker''s Cache', NULL, NULL, NULL, 'School');

insert into Item
values
(17, 'Sp13-001', NULL, NULL, NULL, NULL, 'Ready for Rent', 'Bear Vault', NULL, NULL, NULL, 'School');

insert into Item
values
(18, 'Sp13-002', NULL, NULL, NULL, NULL, 'Ready for Rent', 'Bear Vault', NULL, NULL, NULL, 'School');

insert into Item
values
(19, '1', 'Butante - 2 Burners', NULL, 'Stoves', NULL, 'Ready for Rent', 'Primus', NULL, NULL, NULL, 'School');

insert into Item
values
(20, 'SP16-001', 'Butante', NULL, 'Stoves', NULL, 'Ready for Rent', 'Primus Classic', NULL, NULL, NULL, 'School');



/* ===================================================================================== 

insert into Customer
values
(cust_id, cust_fname, cust_lname, cust_address, cust_pref_contact)
*/



insert into Customer
values
(1, 'John', 'Smith', '10213 Wood Road ,Long Beach CA 92843', 'Home Phone');

insert into Customer
values
(2, 'Dang', 'Tran', '5263 Code Way Apt#4c ,LA CA 98523', 'Cell Phone');

insert into Customer
values
(3, 'Tom', 'Riddle', '?????, Some Where Dead', 'E-mail');

insert into Customer
values
(4, 'Ash', 'Ketchum', 'Pallet Town, Kanto Region', NULL);

insert into Customer
values
(5, 'Jack', 'Smith', 'Frog Creek, Pennslvania', 'Home Phone');





/* ===================================================================================== 

insert into Cust_phone
values
(cust_phone_id, cust_id, cust_phone_num, note)
*/



insert into Cust_phone
values
(1, 1, '592-482-6262', 'Cell Phone');

insert into Cust_phone
values
(2, 1, '789-951-1545', 'Home Phone');

insert into Cust_phone
values
(3, 2, '714-899-9999', 'His mom''s phone');

insert into Cust_phone
values
(4, 2, '714-300-7335', 'His dad''s phone');

/* someone left an extra (') in this section of the code. Fixed it. ~Eric */
insert into Cust_phone
values
(5, 3, '626-955-5555', 'Lucius Malfoy''s phone number');

insert into Cust_phone
values
(6, 4, '909-855-8785', 'Pokey number');

insert into Cust_phone
values
(7, 5, '123-456-7890', 'HouseHold number');





/* ===================================================================================== 

insert into Cust_email
values
(cust_email_id, cust_id, cust_email, note);
*/



insert into Cust_email
values
(1, 1, 'whoamI@yahoo.com', NULL);

insert into Cust_email
values
(2, 2, 'coolkidsclub@yahoo.com', NULL);

insert into Cust_email
values
(3, 3, 'PotterMustDie@gmail.com', 'NO spam please');

insert into Cust_email
values
(4, 4, 'POKEYLOVER23@yahoo.com', NULL);

insert into Cust_email
values
(5, 5, NULL, NULL);

/* ===================================================================================== 

insert into Vendors
values
(ven_id, ven_name, ven_phone, ven_email,ven_location)
*/

insert into Vendors
values
(1,'Kayak Dooods','808-599-5582','kayakdoods@gmail.com','1234 Somewhere ST Los Angeles Ca 90001');

insert into Vendors
values
(2,'Back Pack Guys','707-888-5692','backpackguys@yahoo.com','22 inhumboldt ct Eureka Ca 95502');

insert into Vendors
values
(3,'Paddle Masters','560-555-9897','paddlemasters@gmail.com','555 outofcalifornia ST WA 56933');

insert into Vendors
values
(4,'OutDoor Electronics','408-370-8044','notownedbygoogle@gmail.com','1600 Amphitheatre Pkwy MountainView CA 94043');


-- =======================================================================================
-- insert into Usergroups
-- values
-- (id,power_level,tittle);
-- =======================================================================================

insert into Usergroups
values
(1,'1','Front Desk');

insert into Usergroups
values
(2,'2','Inventory Managment');

insert into Usergroups
values
(3,'3','Activity Cordinator');

insert into Usergroups
values
(4,'4','Center Activities Supervisor');


/* =======================================================================================
 insert into Users
 values
 (user_id,username,password,empl_fname,empl_lname,user_level);
 
*/

insert into Users
values
(1,'em1909','f99','Eric','Misner',1);


/* =======================================================================================
 insert into Rental
 values
 (rent_id, item_back_id, cust_id, rent_out, return_date, date_was_returned);
 
*/

insert into Rental
values
(1, 1, 1, '10-SEP-2016', '15-SEP-2016', '16-SEP-2016');

insert into Rental
values
(2, 1, 2, '06-MAR-2016', '20-MAR-2016', '18-MAR-2016');

insert into Rental
values
(3, 2, 1, '11-JUN-2016', '15-JUN-2016', '15-JUN-2016');

insert into Rental
values
(4, 3, 1, '10-SEP-2017', '20-SEP-2017', '20-SEP-2017');

insert into Rental
values
(5, 4, 1, '04-AUG-2015', '16-AUG-2015', '16-AUG-2015');

insert into Rental
values
(6, 4, 2, '12-FEB-2017', '17-FEB-2017', '20-FEB-2017');

insert into Rental
values
(7, 4, 5, '10-MAR-2014', '10-MAY-2014', '16-JAN-2015');

insert into Rental
values
(8, 5, 3, '25-JUL-2016', '30-JUL-2016', '30-JUL-2016');

insert into Rental
values
(9, 5, 3, '10-SEP-2016', '15-SEP-2016', '16-SEP-2016');

insert into Rental
values
(10, 6, 2, '02-DEC-2016', '01-JAN-2017', '21-JAN-2017');

insert into Rental
values
(11, 7, 5, '10-DEC-2016', '12-DEC-2016', '12-DEC-2016');

insert into Rental
values
(12, 8, 5, '16-NOV-2016', '20-NOV-2016', '18-NOV-2016');

insert into Rental
values
(13, 9, 5, '18-MAR-2016', '30-MAR-2016', '20-MAR-2016');

insert into Rental
values
(14, 10, 2, '31-JUL-2016', '09-JUN-2017', '05-JUN-2017');

insert into Rental
values
(15, 10, 1, '11-JAN-2014', '15-FEB-2014', '13-FEB-2014');

insert into Rental
values
(16, 10, 2, '17-DEC-2012', '19-DEC-2012', '16-SEP-2017');

insert into Rental
values
(17, 11, 1, '28-AUG-2015', '10-SEP-2015', '10-SEP-2015');

insert into Rental
values
(18, 12, 1, '05-NOV-2014', '15-NOV-2014', '13-NOV-2014');

insert into Rental
values
(19, 13, 1, '01-AUG-2015', '05-AUG-2015', '09-AUG-2015');

insert into Rental
values
(20, 14, 1, '29-MAY-2016', '06-JUN-2016', '05-JUN-2016');

insert into Rental
values
(21, 15, 1, '16-DEC-2016', '26-DEC-2016', '26-DEC-2016');

insert into Rental
values
(22, 15, 1, '14-OCT-2016', '17-OCT-2016', '18-OCT-2016');

insert into Rental
values
(23, 15, 1, '01-OCT-2015', '10-OCT-2015', '10-OCT-2015');

insert into Rental
values
(24, 15, 1, '20-JUL-2014', '26-JUL-2014', '25-JUL-2014');

insert into Rental
values
(25, 16, 3, '18-NOV-2011', '30-NOV-2011', '26-AUG-2016');

insert into Rental
values
(26, 17, 4, '25-OCT-2015', '01-NOV-2015', '01-NOV-2015');

insert into Rental
values
(27, 18, 4, '10-AUG-2016', '15-AUG-2016', '16-AUG-2016');

insert into Rental
values
(28, 19, 4, '10-JUL-2016', '15-JUL-2016', '16-JUL-2016');

insert into Rental
values
(29, 20, 4, '10-JAN-2016', '15-JAN-2016', '16-JAN-2016');

commit;




