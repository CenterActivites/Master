<?php

class Config {
    private $host = 'centeractivitiesequipment.reclaim.hosting';
    private $port = '3306';
    private $database_username = 'centerac';
    private $database_password = 'Westgym95521+';
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