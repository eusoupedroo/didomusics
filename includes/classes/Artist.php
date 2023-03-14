<?php
	class Artist {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}

		public function getId() {
			return $this->id;
		}

		public function getName() {
			$artistQuery = mysqli_query($this->con, "SELECT name FROM artists WHERE id='$this->id'");
			$artist = mysqli_fetch_array($artistQuery);
			return $artist['name'];
		}
		
		public function getProfilePicture() {
			$queryProfilePicture = mysqli_query($this->con, "SELECT profilePicture FROM artists WHERE id='$this->id'");
			$profilePicture = mysqli_fetch_array($queryProfilePicture);
			return $profilePicture['profilePicture'];
		}
		
		public function getSongsId() {

			$query = mysqli_query($this->con, "SELECT id FROM songs WHERE artist='$this->id' ORDER BY plays ASC");

			$array = array();

			while($row = mysqli_fetch_array($query)) {
				array_push($array, $row['id']);
			}

			return $array;

		}
	}
?>