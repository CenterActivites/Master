/* Running populate_tests.sql first*/

start populate_tests.sql;
 
/* 
   =======================================================================================
   =======================================================================================
   =======================================================================================
   
   Query Tests Below 
   
*/
prompt ==========================================================
prompt ==========================================================
prompt Query Tests
prompt ==========================================================
prompt ==========================================================


prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Doing a simple Join select between Category and Inventory
select *
from Category a, Inventory b
where a.cat_id = b.cat_id;


prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Pulling up all inv_name under 'Camping' 
select inv_name
from Category a, Inventory b
where a.cat_id = b.cat_id and cat_name = 'Camping';


prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Pulling up all items that are under the category 'Camping' 
select inv_name, item_name
from Category a, Inventory b, Item c
where a.cat_id = b.cat_id and b.inv_id = c.inv_id and cat_name = 'Camping';


prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Pulling up all items that are under the category 'Surf' 
select inv_name, item_name
from Category a, Inventory b, Item c
where a.cat_id = b.cat_id and b.inv_id = c.inv_id and cat_name = 'Surf';

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Pulling up all Men Wetsuit and their sizes 
select item_name, item_size
from Inventory b, Item c
where b.inv_id = c.inv_id and inv_name = 'Men Wetsuit';

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Pulling all items that are in the Surf package 
select inv_name
from Inventory b, Packages c, InvPack a
where a.pack_id = c.pack_id and b.inv_id = a.inv_id and pack_name = 'Surf';

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Pulling all surfboards available that are in the Surf package 
select item_name, item_Frontid
from Inventory b, Packages c, Item a, InvPack d
where a.inv_id = b.inv_id and d.pack_id = c.pack_id and b.inv_id = d.inv_id and pack_name = 'Surf' and inv_name = 'Surfboard';

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Pulling items that are going to be rented out on Feb 2nd of 2018
select inv_name, item_Frontid
from Inventory b, ItemReservation c, Item a
where a.inv_id = b.inv_id and a.item_Backid = c.item_Backid and request_date = '02-FEB-2018';

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Seeing who is renting out a sleeping bag with the front id as "SP13002"
select f_name, l_name, c_phone
from Customer b, ItemReservation c, Item a
where a.item_Backid = c.item_Backid and b.cust_id = c.cust_id and item_Frontid = 'SP13002';

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Seeing who has items out at the moment (moment is being Feb 2nd of 2018)
select f_name, l_name, c_phone
from Customer b, ItemReservation c, Item a
where a.item_Backid = c.item_Backid and b.cust_id = c.cust_id
group by f_name, l_name, c_phone;

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Seeing how many repairs each inventory people have done
select empl_fname, empl_lname, count(item_Frontid) AS total_repairs
from Employee a, Repair b, Item c
where a.empl_id = b.empl_id and b.item_Backid = c.item_Backid
group by empl_fname, empl_lname;

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Seeing what items got repaired and what of the item was repaired
select inv_name, item_Frontid, repair_comment
from Inventory a, Item b, Repair c
where a.inv_id = b.inv_id and b.item_Backid = c.item_Backid;

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Seeing who repair what item
select empl_fname, inv_name, item_Frontid
from Inventory a, Item b, Repair c, Employee d
where a.inv_id = b.inv_id and b.item_Backid = c.item_Backid and c.empl_id = d.empl_id;

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Simple query of all the employees and their titles/jobs
select empl_fname, empl_lname, title
from Employee;

prompt
prompt
prompt
prompt *********************************************************
prompt
prompt Simple query of all the Vendors the center have on file
select ven_name
from Vendor;


















