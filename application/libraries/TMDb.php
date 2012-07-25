<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	Class TMDb
	{
		const _API_URL_ = "http://api.themoviedb.org/3/";
		private $_apikey;
		private $_lang;
		private $_imgUrl;	
		
		function __construct()
		{
			$this->setApikey("ee9360a8ce7d01f043615829b5e841e7");
			$this->setLang();
			//Get Configuration
			$conf = $this->getConfig();
			if (empty($conf))
			{
				echo "Imposible leer configuracion, verifique que la llave de la API sea valida";
				exit;
			}
			//set Images URL contain in config
			$this->setImageURL($conf);
		}

		/**
		* Movie Info
		* http://api.themoviedb.org/3/movie/$id
		* @param array movieInfo
		*/
		public function movieTitles($idMovie)
		{
			$titleTmp = $this->movieInfo($idMovie,"alternative_titles",false);
			foreach ($titleTmp['titles'] as $titleArr)
			{
				$title[]=$titleArr['title']." - ".$titleArr['iso_3166_1'];
			}
			return $title;
		}

		/**
		* Movie Info
		* http://api.themoviedb.org/3/movie/$id
		* @param array movieInfo
		*/
		public function movieTrans($idMovie)
		{
			$transTmp = $this->movieInfo($idMovie,"translations",false);
			foreach ($transTmp['translations'] as $transArr)
			{
				$trans[]=$transArr['english_name']." - ".$transArr['iso_639_1'];
			}
			return $trans;
		}

		/**
		* Movie Info
		* http://api.themoviedb.org/3/movie/$id
		* @param array movieInfo
		*/
		public function movieTrailer($idMovie)
		{
			$trailer = $this->movieInfo($idMovie,"trailers",false);
			// $trailer =$trailer['posters'];
			return $trailer;
		}
		public function movieDetail($idMovie)
		{
			return $this->movieInfo($idMovie,"",false);
		}

		/**
		* Movie Info
		* http://api.themoviedb.org/3/movie/$id
		* @param array movieInfo
		*/
		public function moviePoster($idMovie)
		{
			$posters = $this->movieInfo($idMovie,"images",false);
			$posters = $posters['posters'];
			return $posters;
		}

		/**
		* Movie Info
		* http://api.themoviedb.org/3/movie/$id
		* @param array movieInfo
		*/
		public function movieCast($idMovie)
		{
			$castingTmp = $this->movieInfo($idMovie,"casts",false);
			foreach ($castingTmp['cast'] as $castArr)
			{
				$casting[]=$castArr['name']." - ".$castArr['character'];
			}
			return $casting;
		}

		/**
		* Movie Info
		* http://api.themoviedb.org/3/movie/$id
		* @param array movieInfo
		*/
		public function movieInfo($idMovie,$option="",$print=false)
		{
			$option = (empty($option))?"":"/" . $option;
			$params = "movie/" . $idMovie . $option;
			$movie= $this->_call($params,"");
			return $movie;
		}

		/**
		* Search Movie
		* http://api.themoviedb.org/3/search/movie?api_keyf&language&query=future
		* @param string $peopleName
		*/
		public function searchMovie($movieTitle,$lang="en")
		{
			$movieTitle="query=".urlencode($movieTitle);
			return $this->_call("search/movie",$movieTitle,$lang);
		}

		/**
		* Get Confuguration of API
		* configuration http://api.themoviedb.org/3/configuration?apikey
		* @param
		* @return array
		*/
		public function getConfig()
		{
			return $this->_call("configuration","");
		}

		/**
		* Makes the call to the API
		*
		* @param string $action API specific function name for in the URL
		* @param string $text Unencoded paramter for in the URL
		* @return string
		*/
		private function _call($action,$text,$lang="")
		{
			// # http://api.themoviedb.org/3/movie/11?api_key=XXX
			$lang=(empty($lang))?$this->getLang():$lang;
			
			$url= TMDb::_API_URL_.$action."?api_key=".$this->getApikey()."&language=".$lang."&".$text;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FAILONERROR, 1);

			$results = curl_exec($ch);
			$headers = curl_getinfo($ch);

			$error_number = curl_errno($ch);
			$error_message = curl_error($ch);

			curl_close($ch);
			// header('Content-Type: text/html; charset=iso-8859-1');
			// echo"<pre>";print_r(($results));echo"</pre>";
			$results = json_decode(($results),true);
			return (array) $results;
		}

		/* Setter for the API-key */
		private function setApikey($apikey)
		{
			$this->_apikey = (string) $apikey;
		}

		/* Setter for the default language */
		public function setLang($lang="en")
		{
			$this->_lang = $lang;
		}

		/* Set URL of images */
		public function setImageURL($config)
		{
			$this->_imgUrl = (string) $config['images']["base_url"];
		}

		/* Getter for the API-key */
		private function getApikey()
		{
			return $this->_apikey;
		}

		/* Getter for the default language */
		public function getLang()
		{
			return $this->_lang;
		}

		/* Getter for the URL images */
		public function getImageURL()
		{
			return $this->_imgUrl . "w500";
		}

	}
