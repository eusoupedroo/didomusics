<?php
	class FavoritesAlbums {

		private $con;
		private $id;

		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;

            $query = mysqli_query($con, "SELECT * FROM albums WHERE id ");
            
		}

		public function getId() {
			return $this->id;
		}

	}
?>