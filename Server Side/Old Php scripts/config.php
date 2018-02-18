<?php
/*
Last Modification Time: 12/7/2017
- This is a configuration file that was implemented at the end of our project.
- We made it so that the database uses this config to make a connection each time a user logs in, however the user that logs into the website.
- The cache time is not currently user, but we left the config line here.

*/

class Config {
    private $host = 'cedar.humboldt.edu';
    private $port = '1521';
    private $database_username = 'Alt_F4';
    private $database_password = 'tuttle458';
    private $hold_cache_time = 3600; // seconds

	public function get_host()
	{
		return $this->host;
	}

	public function get_port()
	{
		return $this->port;
	}

	public function get_user()
	{
		return $this->database_username;
	}

	public function get_pass()
	{
		return $this->database_password;
	}

	public function get_hold_cache_time()
	{
		return $this->hold_cache_time;
	}
}
?>