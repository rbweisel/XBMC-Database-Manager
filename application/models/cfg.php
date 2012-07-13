<?php  
	class cfg extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		public function getsettingslist()
		{
			if ($this->session->userdata('logged_in'))
			{
				$list = array();
				$list[0] = '<a href="" onclick="return viewsettings(this);" id="database">Database settings</a>';
				$list[1] = '<a href="" onclick="return viewsettings(this);" id="usercfg">User settings</a>';
				$list[2] = '<a href="" onclick="return viewsettings(this);" id="users">Users</a>';
				return $list;
			}
			return NULL;
		}

		public function getcfg($what='database')
		{
			$set = 0;
			switch($what)
			{
				case 'database':
					$set = $this->cfg->getdbsettings();
					break;
				case 'usercfg':
					$set = $this->cfg->getusersettings();
					break;
				case 'users':
					$set = $this->cfg->getusers();
					break;
			}
			return $set;
		}
		
		public function getdbsettings()
		{
			if ($this->session->userdata('logged_in'))
			{
				$info['col1'] = array();
				$info['col2'] = array();
				$col1 = array('dbcfg','Hostname','Username','Password','Database','Database driver','Database prefix');
				foreach ($col1 as $row)
				{
					array_push($info['col1'], $row);
				}
				$info['col2']['0'] = 'Database Settings';
				$query = $this->configdb->xbmcdb();
				foreach ($query as $row)
				{
					array_push($info['col2'], $row);
				}
				return $info;
			}
			return NULL;
		}
		
		public function getusersettings()
		{
			if ($this->session->userdata('logged_in'))
			{
				$info['col1'] = array();
				$info['col2'] = array();
				$info['col1']['0'] = 'usercfg';
				$info['col2']['0'] = 'User settings';
				
				$query = $this->configdb->user();
				array_push($info['col1'], 'Username');
				array_push($info['col1'], 'Password');
				foreach ($query as $row)
				{
					array_push($info['col2'], $row);
				}
				return $info;
			}
			return NULL;
		}
		
		public function getusers()
		{
			if ($this->session->userdata('logged_in'))
			{
				$info['col1'] = array();
				$info['col2'] = array();
				$info['col1']['0'] = 'users';
				$info['col2']['0'] = 'User settings';
				
				$query = $this->configdb->user();
				array_push($info['col1'], 'Username');
				array_push($info['col1'], 'Password');
				foreach ($query as $row)
				{
					array_push($info['col2'], $row);
				}
				return $info;
			}
			return NULL;
		}
		
		public function updatedbcfg()
		{
			if ($this->session->userdata('logged_in'))
			{
				$post = $this->input->post();
				$this->configdb->setdbcfg($post);
			}
			return NULL;
		}

		public function getmenu($what='database')
		{
			$menu=NULL;
			if ($this->session->userdata('logged_in'))
			{
				switch($what)
				{
					case 'database':
						$menu='<a href="" class="current" id="dbcfg" onclick="return editcfg(this);">Save settings</a>';
						break;
					case 'usercfg':
						$menu='<a href="" class="current" id="usercfg" onclick="return editcfg(this);">Save settings</a>';
						break;
					case 'users':
						$menu='<a href="" class="current" id="users" onclick="return useradd(this);">Add user</a>';
						break;
				}
			}
			return $menu;
		}

		public function adduser()
		{
			if ($this->session->userdata('logged_in'))
			{
				$post = $this->input->post();
				$this->configdb->setdbcfg($post);
			}
			return NULL;
		}

		public function deluser()
		{
			if ($this->session->userdata('logged_in'))
			{
				$post = $this->input->post();
				$this->configdb->setdbcfg($post);
			}
			return NULL;
		}
	}
/* End of file cfg.php */  
/* Location: ./application/models/cfg.php */  
