<?php  
	class Show extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		
		// Edits the database ----------------------------------------------------------//
		public function editshow($id, $what, $tovalue)									//
		{																				//
			$editdata = array();														// Set editdata to empty array
			if($this->session->userdata('logged_in'))									// Check to see that a user is logged in
			{																			//
				$this->db->where('idShow', $id);										// Sets DB Where clause to the correct TV-Show ID
				switch($what)															// Switch on which value to edit
				{																		//
					case 'Watched':														// If watched is what to edit
						$editdata['playCount'] = ($tovalue == '1') ? '1' : NULL;		// Set editdata
						break;															//
					case 'Title':														// If Title is what to edit
						$editdata['c00'] = $tovalue;									// Set editdata to tovalue
						break;															//
					case 'Path':														// If Path is what to edit
						$editdata['strPath'] = $tovalue;								// Set editdata to tovalue
						break;															//
					case 'File':														// If File is what to edit
						$editdata['strFileName'] = $tovalue;							// Set editdata to tovalue
						break;															//
				}																		//
				$this->db->update('tvshow', $editdata);									// Updata tvshow table with new values
			}																			//
		}																				//
		// End function editshow() -----------------------------------------------------//

		// Creates the HTML code for the tv-show list menu -----------------------------//
		public function getshowmenu($idshow = '1', $idepisode = '0', $view = 'info')	//
		{																				//
			$menu = array();															//
			switch ($view)																//
			{																			//
				case 'info':															//
					array_push($menu,'<a class="current" href="" id="'.$idshow.'" onclick="return viewtv(this, \'info\');" title="'.$idepisode.'" title="showinfo">Info</a>');						//
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'cast\');" title="'.$idepisode.'" title="cast">Cast</a>');
					if($this->session->userdata('logged_in'))							//
					{																	//
						array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'edit\');" title="'.$idepisode.'" title="edit">Edit</a>');									//
					}																	//
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'epinfo\');" title="'.$idepisode.'" title="epinfo">Episode Info</a>');													//
					break;																//
				case 'cast':															//
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'info\');" title="'.$idepisode.'" title="showinfo">Info</a>');
					array_push($menu,'<a class="current" href="" id="'.$idshow.'" onclick="return viewtv(this, \'cast\');" title="'.$idepisode.'" title="cast">Cast</a>');
					if($this->session->userdata('logged_in'))							//
					{																	//
						array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'edit\');" title="'.$idepisode.'" title="edit">Edit</a>');												//
					}																	//
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'epinfo\');" title="'.$idepisode.'" title="epinfo">Episode Info</a>');
					break;																//
				case 'edit':															//
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'info\');" title="'.$idepisode.'" title="showinfo">Info</a>');
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'cast\');" title="'.$idepisode.'" title="cast">Cast</a>');
					array_push($menu,'<a class="current" href="" id="'.$idshow.'" onclick="return viewtv(this, \'edit\');" title="'.$idepisode.'" title="edit">Edit</a>');
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'epinfo\');" title="'.$idepisode.'" title="epinfo">Episode Info</a>');
					break;																//
				case 'epinfo':															//
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'info\');" title="'.$idepisode.'" title="showinfo">Info</a>');
					array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'cast\');" title="'.$idepisode.'" title="cast">Cast</a>');
					if($this->session->userdata('logged_in'))							//
					{																	//
						array_push($menu,'<a href="" id="'.$idshow.'" onclick="return viewtv(this, \'edit\');" title="'.$idepisode.'" title="edit">Edit</a>');
					}																	//
					array_push($menu,'<a class="current" href="" id="'.$idshow.'" onclick="return viewtv(this, \'epinfo\');" title="'.$idepisode.'" title="epinfo">Episode Info</a>');
					break;																//
			}																			//
			return $menu;																//
		}																				//
		// End function getshowmenu($idshow, $idepisode, $view) ------------------------// 

		// Creates the HTML TV-show info -----------------------------------------------//
		public function getshowinfo($id = '1')											// TV-Show ID is 1 if nothing is given
		{																				//
			$info['col1'] = array();													// Info col1 and col2 is empty arrays
			$info['col2'] = array();													//
			$info['thumb'] = '';
																						//
			$select = 's.c00,COUNT(e.idEpisode),s.c05,s.c08,s.c04,s.c14,p.strPath,s.c01';
			$col1 = array('Title:','Episodes:','First Aired:','Genre:','Rating:','Network:','Path:<br/>','Plot:</br>');
																						//
			$this->db->select($select);													// Prepare SELECT clause
			$this->db->from('tvshow AS s');												// Select from tvshow table as s
			$this->db->join('tvshowlinkepisode AS e', 'e.idShow = s.idShow', 'left');	// Also select from tvshowlinkepisode table as e
			$this->db->join('tvshowlinkpath AS tslp', 'tslp.idShow = s.idShow', 'left');// Also select from tvshowlinkpath table as tslp
			$this->db->join('path AS p', 'p.idPath = tslp.idPath', 'left');				// And select from path table as p
			$this->db->where('s.idShow', $id);											// Select rows WHERE idShow matches
			$query = $this->db->get();													// Execute query
			$col2 = $query->row_array();												// Put the resulting array into col2 
			foreach ($col1 as $row)														// Loop through the rows in $col1
			{																			//
				array_push($info['col1'], $row);										// Put the values in info, col1, standard indexed 0-n
			}																			//
			foreach ($col2 as $row)														// Loop through the rows in $col2
			{																			//
				array_push($info['col2'], $row);										// Put the values in info, col2, standard indexed 0-n
			}																			//
			$info['thumb'] = $this->configdb->hashit($info['col2'][6]);
			$info['id'] = $id;
			$info['type'] = 'show';
			$info['col2']['4'] = number_format($info['col2']['4'], 1);					// Set rating to 1 decimal
			return $info;																// Return the info array
		}																				//
		// End function getshowinfo($id) -----------------------------------------------//

		// Creates the HTML TV-show casts ----------------------------------------------//
		public function getshowcast($id = '1')											// TV-Show ID is 1 if nothing is given
		{																				//
			$cast['actor'] = array();
			$cast['role'] = array();
			$cast['thumb'] = array();
			// Defines what to extract from database
			$select = 'idActor,strRole';
			$this->db->where('idShow', $id);							// Prepare WHERE clause
			$query = $this->db->get('actorlinktvshow');
			foreach ($query->result() as $row)
			{
				array_push($cast['role'], $row->strRole);
				$select = 'strActor';
				$this->db->where('idActor', $row->idActor);						// Prepare WHERE clause
				$query2 = $this->db->get('actors');
				foreach ($query2->result() as $row2)
				{
					array_push($cast['actor'], $row2->strActor);
				}
			}
			foreach ($cast['actor'] as $actor)
			{
				array_push($cast['thumb'], $this->configdb->hashit('actor'.$actor));
			}
			return $cast;
		}																				//
		// End function getshowcast($id) -----------------------------------------------//

		// Creates the HTML episode info -----------------------------------------------//
		public function getepisodeinfo($id = '0')										//
		{																				//
			$info['col1'] = array();													//
			$info['col2'] = array();													//
			$info['thumb'] = '';													//
																						//
			$select = 'CONCAT(strTitle,\' - \',c00),CONCAT(\'S\',c12,\' E\',c13),c05,strStudio,c03,c09,strPath,strFileName,c01,playCount,lastPlayed';
			$col1 = array('Title:','Season/Episode:','First Aired:','Studio:','Rating:','Length:','Path:<br/>','Filename:<br/>','Plot:<br/>','Playcount:','Last played:');

			if($id == '0' || $id == '')													// If episode id is 0
			{																			// Means no episode is chosen yet
				array_push($info['col2'], 'Select episode');							// Print this text
				$info['id'] = $id;
				$info['type'] = 'episode';
				return $info;															// exit function
			}																			//

			$this->db->select($select, FALSE);											// Prepare SELECT clause
			$this->db->from('episodeview');												//
			$this->db->where('idEpisode', $id);											// Prepare WHERE clause
			$query = $this->db->get();													// Execute query
			$col2 = $query->row_array();												// Put the resulting array into col2 
			foreach ($col1 as $row)														// Loop through the rows in $col1
			{																			//
				array_push($info['col1'], $row);										// Put the values in info, col1, standard indexed 0-n
			}																			//
			foreach ($col2 as $row)														// Loop through the rows in $col2
			{																			//
				array_push($info['col2'], $row);										// Put the values in info, col2, standard indexed 0-n
			}																			//
			$info['col2']['4'] = number_format($info['col2']['4'], 1);					// Set rating to only 1 decimal
			$info['col2']['5'] = str_replace('<thumb>','<a target="_blank" href="',$info['col2']['5']);	// Replace <thumb> tag in thumb column with a href to thetvdb
			$info['col2']['5'] = str_replace('</thumb>','">The TVDB</a>',$info['col2']['5']);
			$info['col2']['9'] = $info['col2']['9'] ? $info['col2']['9'] : '0';		// Set the playcount to actual playcount or 0 if it is NULL
			$info['col2']['10'] = $info['col2']['10'] ? $info['col2']['10'] : 'Never';	// Set the last watched to corresponding time or Never if value is NULL
			$info['thumb'] = $this->configdb->hashit($info['col2'][6].$info['col2'][7]);

			if(!$this->session->userdata('logged_in'))
			{
				unset($info['col1'][6]);
				unset($info['col2'][6]);
				unset($info['col1'][7]);
				unset($info['col2'][7]);
				//Re-index the arrays
				$info['col1'] = array_values($info['col1']);
				$info['col2'] = array_values($info['col2']);
			}
			$info['id'] = $id;
			$info['type'] = 'episode';

			return $info;																// Return with the info array
		}																				//
		// End function getepisodeinfo($id) --------------------------------------------//

		// Renders the TV-Show edit page -----------------------------------------------//
		public function getshowedit($id = '0', $view = 'edit')							//
		{																				//
			$edit['col1'] = array();													// edit, col1 to col3 is empty arrays
			$edit['col2'] = array();													//
			$edit['col3'] = array();													//
																						//
			$select = 'c00';															// Prepares the SELECT statement
			$col1 = array('Title');														// Sets the corresponding items in col1
																						//
			$this->db->where('idShow', $id);											// Prepare WHERE clause
			$this->db->select($select);													// Prepare SELECT clause
			$query = $this->db->get('tvshow');											// Execute query
			$col2 = $query->row_array();												// Put the resulting array into col2 
			foreach ($col1 as $row)														//
			{																			//
				array_push($edit['col1'], $row);										//
				array_push($edit['col3'], '<button id="'.$id.'" name="'.$row.'" onclick="return editshow(this);">Edit</button>');
			}																			//
			foreach ($col2 as $row)														//
			{																			//
				array_push($edit['col2'], $row);										//
			}																			//
			return $edit;																//
		}																				//
		// End function getshowedit($id, $view) ----------------------------------------//

		// Renders the HTML TV-Show links ----------------------------------------------//
		public function getshowlinks($sortby = 'c00', $sortdir = 'ASC', $filter = 'all')//
		{																				//
			$link = array();															// Link is empty array
			$this->db->select('c00,idShow');											// Prepare select statement
			$this->db->order_by("$sortby " . "$sortdir");								// Prepare sorting
			$query = $this->db->get('tvshow');											// Execute query
																						//
			foreach ($query->result() as $row)											// Loop through the results
			{																			// Create a TV-show link with the values, put in array
				array_push($link,"\n\t\t\t\t\t\t".'<li id="'.$row->idShow.'" onclick="return viewtv(this, \'\');" class="tvshowlink">'.$row->c00.'</li>');
			}																			//
			return $link;																// Return with the link array
		}																				//
		// End function getshowlinks($sortby, $sortdir, $filter) -----------------------//

		// Renders the HTML Episode links ----------------------------------------------//
		public function getepisodelinks($idshow, $season = 'all', $filter = 'all')		//
		{																				//
			$link = array();															//
			if ($season == 'all' || $season == '')										//
			{																			//
				$this->db->select('c12');												//
				$this->db->where('idShow', $idshow);									//
				$this->db->group_by('c12');												//
				$queryseasons = $this->db->get('episodeview');							//
				foreach ($queryseasons->result() as $row)								//
				{																		//
					if ($row->c12 == '0')
					{
						array_push($link,'<b><h4>Specials</h4></b>');			//
					}
					else
					{
						array_push($link,'<b><h4>Season '.$row->c12.'</h4></b>');			//
					}
					$this->db->select('c12,c13,c00,idEpisode');								//
					$this->db->where('idShow', $idshow);								//
					if ($filter == 'watched')											//
					{																	//
						$this->db->where('playCount !=', 'NULL');						//
					}																	//
					elseif ($filter == 'notwatched')									//
					{																	//
						$this->db->where('playCount IS NULL', NULL, FALSE);				//
					}																	//
					$this->db->where('c12', $row->c12);									//
					$this->db->order_by('c13 + 0');										// Orders by Episode number, +0 to get the correct ordering
					$queryepisodes = $this->db->get('episodeview');						//
					foreach ($queryepisodes->result() as $row2)							//
					{																	//
						array_push($link,"\n\t\t\t\t\t\t".'<li id="'.$idshow.'" onclick="return viewtv(this, \'epinfo\');" class="eplink" title="'.$row2->idEpisode.'"><table class="listtable"><tr><th>'.$row2->c12.'x'.$row2->c13.'</th><td>'.$row2->c00.'</td></tr></table></li>');
					}																	//
				}																		//
			}																			//
			else																		//
			{																			//
				$this->db->select('c12,c13,c00,idEpisode');									//
				$this->db->where('idShow', $idshow);									//
				$this->db->where('c12', $season);										//
				if ($filter == 'watched')												//
				{																		//
					$this->db->where('playCount !=', 'NULL');							//
				}																		//
				elseif ($filter == 'notwatched')										//
				{																		//
					$this->db->where('playCount IS NULL', NULL, FALSE);					//
				}																		//
				$this->db->order_by('c13 + 0');											//
				$queryepisodes = $this->db->get('episodeview');							//
				foreach ($queryepisodes->result() as $row2)								//
				{																		//
					array_push($link,"\n\t\t\t\t\t\t".'<li id="'.$idshow.'" onclick="return viewtv(this, \'epinfo\');" class="eplink" title="'.$row2->idEpisode.'"><table class="listtable"><tr><th>'.$row2->c12.'x'.$row2->c13.'</th><td>'.$row2->c00.'</td></tr></table></li>');
				}																		//
			}																			//
			return $link;																//
		}																				//
		// End function getepisodelinks($idshow, $season, $filter) ---------------------//
		
		// Returns a option list of the seasons in chosen TV-show ----------------------//
		public function getseasonlinks($idshow)												//
		{																				//
			$link = array();															// seasons is empty array
			//array_push($link,'<a href="" id="'.$idshow.'" onclick="return sortepisodes(this);" title="season" name="all">All seasons</a>');	// Set first option to all seasons
			array_push($link,"\n\t\t\t\t\t\t".'<li id="'.$idshow.'" onclick="return sortepisodes(this);" class="season" title="all">All seasons</li>');
			$this->db->select('c12');													// Prepare select statement (season column)
			$this->db->where('idShow', $idshow);										// Prepare where statement (idshow must match)
			$this->db->group_by('c12');													// Only get one row for each season
			$query = $this->db->get('episodeview');										// Execute query
			foreach ($query->result() as $row)											// Loop through the results
			{																			// Put each returned row into the seasons array as an option
				if ($row->c12 == '0')
				{
					array_push($link,"\n\t\t\t\t\t\t".'<li id="'.$idshow.'" onclick="return sortepisodes(this);" class="season" title="'.$row->c12.'">Specials</li>');
				}
				else
				{
					array_push($link,"\n\t\t\t\t\t\t".'<li id="'.$idshow.'" onclick="return sortepisodes(this);" class="season" title="'.$row->c12.'">Season '.$row->c12.'</li>');
				}
			}																			//
			return $link;															// Return the seasons array
		}																				//
		// End function getseasons($idshow) --------------------------------------------//
		
		public function getshowhash($id = '1')
		{
			$hash = '';

			$select = 'p.strPath';
			$this->db->select($select);													// Prepare SELECT clause
			$this->db->from('tvshow AS s');												// Select from tvshow table as s
			$this->db->join('tvshowlinkpath AS tslp', 'tslp.idShow = s.idShow', 'left');// Also select from tvshowlinkpath table as tslp
			$this->db->join('path AS p', 'p.idPath = tslp.idPath', 'left');				// And select from path table as p
			$this->db->where('s.idShow', $id);											// Select rows WHERE idShow matches
			$query = $this->db->get();													// Execute query
			foreach ($query->result() as $row)
			{
				$hash = $this->configdb->hashit($row->strPath);
			}
			return $hash;
		}
	}
/* End of file movie.php */  
/* Location: ./application/models/movie.php */  
