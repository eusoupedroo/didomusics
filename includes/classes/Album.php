<?php
	class Album {

		private $con;
		private $id;
		private $title;
		private $artistId;
		private $genre;
		private $year;
		private $description_album;
		private $artWorkPath;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

			$query = mysqli_query($this->con, "SELECT * FROM albums WHERE id='$this->id'");
			$album = mysqli_fetch_array($query);

			$this->title = $album['title'];
			$this->artistId = $album['artist'];
			$this->genre = $album['genre'];
			$this->artWorkPath = $album['artWorkPath'];
			$this->description_album = $album['description_album'];
			$this->year = $album['year'];


		}

		public function getId() {
			return $this->id;
		}

		public function getTitle() {
			return $this->title;
		}

		public function getYear() {
			return $this->year;
		}

		public function getArtist() {
			return new Artist($this->con, $this->artistId);
		}

		public function getDescriptionAlbum(){
			return $this->description_album;
		}

		public function getGenre() {
			return $this->genre;
		}

		public function getartWorkPath() {
			return $this->artWorkPath;
		}

		public function getNumberOfSongs() {
			$query = mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id'");
			return mysqli_num_rows($query);
		}

		public function getNumbersOfPlays() {
			$query = mysqli_query($this->con, "SELECT count(plays) as 'reproductions' FROM `songs` WHERE album='$this->id' ");
			$row = mysqli_fetch_array($query);
			return intval($row['reproductions']);
		}

		public function getSongIds() {

			$query = mysqli_query($this->con, "SELECT id FROM songs WHERE album='$this->id' ORDER BY albumOrder ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;

		}






	}
?>