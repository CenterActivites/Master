/*
Last Modified: 12/7/2017
The permissions system would be added to the index.php (right above the comment 'sharon's framework.' It would/should check the permissions table vs the user and his permission level)

If the user has the ability to view said page, then his session['next_screen'] would not change from the desired page.. If the user could not view the page, then it should change with an error and be redirected to another screen, eg. session['next_screen'] = permission_error that might take a variable within that section to customize the error.

THAT PROCESS, however small and in index.php should work with functions within this session
-- lol, you will have to create those functions.  Functions should require_once into the database file and call db_query to check permissions from the permissions table and  the user permission table from use then make a check and return...

*/