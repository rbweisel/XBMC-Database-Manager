<?php
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	session_start();
	
	class Movies extends CI_Controller
	{
		// Class constructor -----------------------------------------------------------//
		function __construct()															//
		{																				//
			parent::__construct();														// Calls the parent class constructor
			$this->load->model('movie');												// Init the model
			$this->load->library('ConfigDB');											// Load the database config class
			$dbconn = $this->configdb->xbmcdb();										// Gets the XBMC Database connection config
			$this->load->database($dbconn);												// Loads the XBMC Database
		}																				//
		// End __construct() -----------------------------------------------------------//

		// Index controller ------------------------------------------------------------//
		public function index()															//
		{																				//
			$this->load->helper(array('form', 'url'));									// Load the url helper
			$data['title'] = 'Movies';													// Set page title
			$this->load->view('common/header', $data);									// Load page header
			$this->load->view('movies/navigation');										// Load page navigation
			$this->load->view('common/background');										// Load page background
			$this->load->view('movies/sidebar');										// Load sidebar for movies
			$this->load->view('common/content');										// Load page content, send $data along
			$this->load->view('common/footer');											// Load page footer
		}																				//
		// End function index() --------------------------------------------------------//

		// Deletes a movie from the database -------------------------------------------//
		public function delete()							//
		{										//
			$movieid = $this->input->post('id');					// Which Movie ID to delete
			if($this->session->userdata('logged_in'))				// Check to see that a user is logged in
			{									//
				$this->movie->deletemovie($movieid);				// If user is logged in, call the edit function
			}									//
		}										//
		// End function delete() -------------------------------------------------------//

		// Edit database values --------------------------------------------------------//
		public function edit()								//
		{										//
			$editwhat = $this->input->post('what');					// What to edit
			$movieid = $this->input->post('id');					// Which Movie ID the value belongs to
			$towhat = $this->input->post('to');					// The new value
			if($this->session->userdata('logged_in'))				// Check to see that a user is logged in
			{									//
				$this->movie->editmovie($movieid, $editwhat, $towhat);		// If user is logged in, call the edit function
			}									//
		}										//
		// End function edit() ---------------------------------------------------------//
		
		// Renders the html formatted movie list ---------------------------------------//
		public function getlist()														//
		{																				//
			if ($this->input->get('sortby') != "")										// Check to see if a sorting option is chosen
			{																			//
				$sortby = $this->input->get('sortby');									// Get sortby value 
				$sortdir = $this->input->get('sortdir');								// Get sorting direction (Ascending/descending)
				$filter = $this->input->get('filter');									// Get filter options
				$data['list'] = $this->movie->getmovielinks($sortby, $sortdir, $filter);// Puts all movie titles in an array (as a href) 
			}																			//
			else																		// If there is no sorting options:
			{																			//
				$data['list'] = $this->movie->getmovielinks();							// Puts all movie titles in an array (as a href) 
			}																			//
			$this->load->view('common/list', $data);									// Load the list view with movie titles
		}																				//
		// End function getlist() ------------------------------------------------------//
		
		// Renders the html formatted movie content ------------------------------------//
		public function viewmovie()														//
		{																				//
			$view = $this->input->get('view');											// Which view (info/edit/etc)
																						//
			if ($view != '')															// If view is set
			{																			//
				$this->session->set_userdata('view', $this->input->get('view'));		// Set session view to view
			}																			//
			if ($this->session->userdata('view') == '')									// If session view is empty
			{																			//
				$this->session->set_userdata('view', 'info');							// Set session view to info
			}																			//
																						//
			switch($this->session->userdata('view'))									//
			{																			//
				case 'info':															// If view is info
					$movieinfo = $this->movie->getmovieinfo($this->input->get('id'));	// Get info about movie
					$this->load->view('common/info.php', $movieinfo);					// Load the info view
					break;																//
				case 'cast':															// If view is info
					$actors = $this->movie->getmoviecast($this->input->get('id'));
					$this->load->view('common/cast.php', $actors);					// Load the info view
					break;																//
				case 'fanart':															// If view is info
					$info['hash'] = $this->movie->getmoviehash($this->input->get('id'));
					$this->load->view('common/fanart.php', $info);					// Load the info view
					break;																//
				case 'edit':															// If view is edit
					if($this->session->userdata('logged_in'))							// And a user is logged in
					{																	//
						$movieedit = $this->movie->getmovieedit($this->input->get('id'));// Get edit page for the movie
						$this->load->view('movies/movieedit.php', $movieedit);			// Load the edit view
					}																	//
					else																// If there isn't a user logged in
					{																	//
						$movieinfo = $this->movie->getmovieinfo($this->input->get('id'));// Get info about movie
						$this->load->view('common/info.php', $movieinfo);				// Load the info view
					}																	//
					break;																//
				default:																// If a view isn't matched
					$movieinfo = $this->movie->getmovieinfo($this->input->get('id'));	// Get info about movie
					$this->load->view('common/info.php', $movieinfo);					// Load the info view
					break;																//
			}																			//
		}																				//
		// End function viewmovie() ----------------------------------------------------//
		
		// Renders the html formatted content navigation -------------------------------//
		public function viewcontentnav()												//
		{																				//
			$data = array();															// Set data to empty array
			if($this->input->get('view') != '')											// If view isn't empty
			{																			//
				$this->session->set_userdata('view', $this->input->get('view'));		// set session view to view
			}																			//
			if(!$this->session->userdata('view') || $this->session->userdata('view') == '')	// If session view isn't set or session view is empty
			{																			//
				$this->session->set_userdata('view', 'info');							// Set session view to info
			}																			//
			if($this->session->userdata('view') == 'epinfo')							// If session view is set to episode info
			{																			//
				$this->session->set_userdata('view', 'info');							// Set session view to info
			}																			//
			$id = $this->input->get('id');												//
			$view = $this->session->userdata('view');									//
			$data['menulist'] = $this->movie->getmoviemenu($id, $view);					//
			$data['selected'] = $this->session->userdata('view');						//
			$data['hash'] = $this->movie->getmoviehash($this->input->get('id'));		//
			$this->load->view('common/contentnav.php', $data);							//
		}																				//
		// End function viewcontentnav() -----------------------------------------------//

		public function getposters()
		{
			$imdb_id=$this->input->get('imdb_id');
			$this->load->library('TMDb');											// Load the database config class
			$data = array();
			$data['base'] = $this->tmdb->getImageURL();
			$data['urls'] = $this->tmdb->moviePoster($imdb_id);
			$data['hash'] = $this->movie->getmoviehash($this->input->get('id'));		//
			$data['id'] = $this->input->get('id');
			//echo "Images:<br>";
			//echo "<pre>";print_r($pelinfo);echo"</pre>";
			//echo "<img src=\"".$this->tmdb->getImageURL().$pelinfo['0']['file_path']."\">";
			//$buscar = $this->tmdb->searchMovie('tt0080487','cl');
			//echo"<pre>";print_r($buscar);echo"</pre>";
			//echo "Fetching poster urls<br>";
			//$data['urls'] = $this->tmdb->moviePoster('tt0080487');
			//echo "Posters:<br>";
			//print_r($data);
			$this->load->view('common/posters.php', $data);							// Load the content navigation menu
		}
		
		public function saveposter()
		{
			$url=$this->input->get('purl');
			$file=$this->input->get('pfile');
			$folder=$_SERVER['DOCUMENT_ROOT'].'/thumbs/'.substr($file,0,1).'/';
			if($this->session->userdata('logged_in'))							// And a user is logged in
			{
				$in = fopen($url, 'r');
				$out = fopen($folder.$file, 'w');
				while (!feof($in))
				{
					$buffer = fread($in, 2048);
					fwrite($out, $buffer);
				}
			}
			else
			{
				echo "<script>alert('You need to be logged in for this!');</script>";
			}
		}

		// Destructor ------------------------------------------------------------------//
		function __destruct()															//
		{																				//
			$this->db->close();															// Close the db connection
		}																				//
		// End of __destruct() ---------------------------------------------------------//
	}
/* End of file movies.php */
/* Location: ./application/controllers/movies.php */
