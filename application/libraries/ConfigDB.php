<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	Class ConfigDB
	{
		protected $connection = NULL;

		public function __construct()
		{
			if (file_exists('../data/xbmcdm.db'))
			{
				try
				{
					$this->connection = new PDO('sqlite:../data/xbmcdm.db');
				}
				catch(PDOException $e)
				{
					$this->connection = NULL;
					echo $e->getMessage();
					redirect('main');
				}
			}
			else
			{
				echo "<script>alert('Configuration missing!');</script>";
				redirect(base_url().'install','refresh');
			}
		}

		public function query($sql)
		{
			return $this->connection->query($sql);
		}

		public function xbmcdb()
		{
			$result = array();
			$sth = $this->connection->prepare('SELECT hostname,username,password,database,dbdriver,dbprefix FROM dbconnection');
			$sth->execute();
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			$result['db_debug'] = TRUE;	// Set DB debugging to true
			return $result;
		}

		public function user()
		{
			$result = array();
			$sth = $this->connection->prepare('SELECT username,password FROM members');
			$sth->execute();
			$result = $sth->fetch(PDO::FETCH_ASSOC);
			return $result;
		}
		
		public function setdbcfg($data)
		{
			$sth = $this->connection->prepare('UPDATE dbconnection SET hostname=?, username=?, password=?, database=?, dbdriver=?, dbprefix=?');
			$host = $data['hostname'];
			$user = $data['username'];
			$pass = $data['password'];
			$db = $data['database'];
			$driver = $data['dbdriver'];
			$prefix = $data['dbprefix'];
			$sth->execute(array($host,$user,$pass,$db,$driver,$prefix)) or die(print_r($sth->errorInfo(), true));
		}

		public function hashit($filename)
		{
			$chars = strtolower($filename);
			$crc = 0xffffffff;
			for ($ptr = 0; $ptr < strlen($chars); $ptr++)
			{
				$chr = ord($chars[$ptr]);
				$crc ^= $chr << 24;

				for ((int) $i=0; $i < 8; $i++)
				{
					if ($crc & 0x80000000)
					{
						$crc = ($crc << 1) ^ 0x04C11DB7;
					}
					else
					{
						$crc <<= 1;
					}
				}
			}
			// Système d'exploitation en 64 bits ?
			if (strpos(php_uname('m'), '_64') !== false)
			{
				//Formatting the output in a 8 character hex
				if ($crc>=0)
				{
					$hash = sprintf("%16s",sprintf("%x",sprintf("%u",$crc)));
				}
				else
				{
					$source = sprintf('%b', $crc);
					$hash = "";
					while ($source <> "")
					{
						$digit = substr($source, -4);
						$hash = dechex(bindec($digit)) . $hash;
						$source = substr($source, 0, -4);
					}
				}
				$hash = substr($hash, 8);
			}
			else
			{
				//Formatting the output in a 8 character hex
				if ($crc>=0)
				{
					$hash = sprintf("%08s",sprintf("%x",sprintf("%u",$crc)));
				}
				else
				{
					$source = sprintf('%b', $crc);
					$hash = "";
					while ($source <> "")
					{
						$digit = substr($source, -4);
						$hash = dechex(bindec($digit)) . $hash;
						$source = substr($source, 0, -4);
					}
				}
			}
			return $hash;
		}

		public function __destruct()
		{
			$this->connection = NULL;
		}
	}
