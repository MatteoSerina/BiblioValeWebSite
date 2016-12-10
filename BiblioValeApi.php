<?php

//seleziono la funzione da richiamare
$function = html_entity_decode($_GET['fName']);

switch($function){
	case 'ping':
		ping();
		break;
	case 'getBook':
		getBook();
		break;
	case 'getAuthors':
		getAuthors();
		break;
	case 'setIsbn':
		setIsbn();
		break;
	case 'createBook':
		createBook();
		break;
	case 'createAuthor':
		createAuthor();
		break;
	case 'getGenreID':
		getGenreID();
		break;
	case 'getStatusID':
		getStatusID();
		break;
	case 'getAllGenres':
		getAllGenres();
		break;
	case 'getAllAuthors':
		getAllAuthors();
		break;
	case 'updateBook':
		updateBook();
		break;
	default: break;
}

function selectHelper($sql){
    //carico script contenente i parametri di configurazione
	include_once 'config.php';
	//carico script di interfaccia al database
	include_once 'database.php';

	//creo una connessione al database
	$conn = database::dbConnect();
	//eseguo la query di ricerca
	$result = database::qSelect($conn, $sql);
	//chiudo la connessione
	database::dbClose();

	return $result;
}

function updateHelper($sql){
	//carico script contenente i parametri di configurazione
	include_once 'config.php';
	//carico script di interfaccia al database
	include_once 'database.php';

	//creo una connessione al database
	$conn = database::dbConnect();
	//eseguo la query di aggiornamento
	$ret = database::qUpdate($conn, $sql);
	//chiudo la connessione
	database::dbClose();

	return $ret;
}

function insertHelper($sql){
	//carico script contenente i parametri di configurazione
	include_once 'config.php';
	//carico script di interfaccia al database
	include_once 'database.php';

	//creo una connessione al database
	$conn = database::dbConnect();
	//eseguo la query di inserimento
	$ret = database::qInsertInto($conn, $sql);
	//chiudo la connessione
	database::dbClose();

	return $ret;
}

function deleteHelper($sql){
	//carico script contenente i parametri di configurazione
	include_once 'config.php';
	//carico script di interfaccia al database
	include_once 'database.php';

	//creo una connessione al database
	$conn = database::dbConnect();
	//eseguo la query di cancellazione
	$ret = database::qDelete($conn, $sql);
	//chiudo la connessione
	database::dbClose();

	return $ret;
}

function ping($_json = true){
	$result = array();
	if($_json){
		$result = array("result" => true);
		echo json_encode($result);
	}
	else{
		echo true;
	}
}

function getBook($_surname='', $_name='', $_title='', $_json = true){
	$book_list = array();

	//recupero parametri inseriti nella form
	$surname = filter_input(INPUT_GET, 'surname');
	$name = filter_input(INPUT_GET, 'name');
	$title = filter_input(INPUT_GET, 'title');
	$isbn_10 = filter_input(INPUT_GET, 'isbn_10');
	$isbn_13 = filter_input(INPUT_GET, 'isbn_13');
	if(empty($surname)){$surname = $_surname;}
	if(empty($name)){$name = $_name;}
	if(empty($title)){$title = $_title;}

	//eseguo la query di ricerca
	$sql = "SELECT * FROM `tutti_libri` WHERE `titolo` LIKE \"%$title%\" AND `cognome` LIKE \"%$surname%\" AND `nome` LIKE \"%$name%\" AND `isbn_10` LIKE \"%$isbn_10%\" AND `isbn_13` LIKE \"%$isbn_13%\" ORDER BY `cognome`, `nome`, `titolo`";
	$result = selectHelper($sql);
	if(mysql_num_rows($result)==0){
	}
	else{
		while($record = mysql_fetch_array($result)){
			extract($record);
			$book = array("id" => $id, "title" => $titolo, "surname" => $cognome, "name" =>  $nome, "year" => $anno, "genre" => $genere, "isbn_10" => $isbn_10, "isbn_13" => $isbn_13, "status" => $stato, "notes" => $note);
			$book_list[] =$book;
		}
	}

  if($_json){
  	echo json_encode($book_list);
  }
  else{
  	return $book_list;
  }
}

function getAuthors($_surname='', $_name='', $_json = true){
	$author_list = array();

	//recupero parametri inseriti nella form
	$surname = filter_input(INPUT_GET, 'surname');
	$name = filter_input(INPUT_GET, 'name');
	if(empty($surname)){$surname = $_surname;}
	if(empty($name)){$name = $_name;}

	//eseguo la query di ricerca
	$sql = "SELECT `id`, `cognome`, `nome` FROM `autori` WHERE `cognome` LIKE \"%$surname%\" AND `nome` LIKE \"%$name%\" ORDER BY CONVERT(CAST(`cognome` AS BINARY) USING utf8)";
	$result = selectHelper($sql);
	if(mysql_num_rows($result)==0){
	}
	else{
		while($record = mysql_fetch_array($result)){
			extract($record);
			$author = array("id" => $id, "surname" => $cognome, "name" =>  $nome);
			$author_list[] =$author;
		}
	}

  if($_json){
  	echo json_encode($author_list);
  }
  else{
  	return $author_list;
  }
}

function getAllAuthors($_json = true){
	$authors_list = array();

	$sqlAllAUT = "SELECT * FROM autori";
	$resultAllAUT = selectHelper($sqlAllAUT);
	if(mysql_num_rows($resultAllAUT)==0){
	}
	else{
		while($record = mysql_fetch_array($resultAllAUT)){
			extract($record);
			$author = array("id" => $id, "name" => $nome, "surname" => $cognome);
			$authors_list[] = $author;
		}
	}
	if($_json){
		echo json_encode($authors_list);
	}
	else{
		return $authors_list;
	}
}

function setIsbn(){
	//recupero parametri inseriti nella form
	$title = filter_input(INPUT_GET, 'title');
	$surname = filter_input(INPUT_GET, 'surname');
	$name = filter_input(INPUT_GET, 'name');
	$newIsbn_10 = filter_input(INPUT_GET, 'isbn_10');
	$newIsbn_13 = filter_input(INPUT_GET, 'isbn_13');
	//Input check
	if(empty($title) || empty($name) || empty($surname) || (empty($newIsbn_10) && empty($newIsbn_13))){
		echo "Fill all mandatory parameters!";
		return;
	}

	//recupero id autore
	$sqlAUT = "SELECT * FROM `autori` WHERE `cognome` LIKE \"%$surname%\" AND `nome` LIKE \"%$name%\"";
	$resultAUT = selectHelper($sqlAUT);
	$recordAUT = mysql_fetch_assoc($resultAUT);
	$id_aut = $recordAUT['id'];
	if(empty($id_aut)){
		echo "Author not found!";
		return;
	}

	//recupero codici isbn attuali e imposto i nuovi
	$sqlCurrISBN = "SELECT `ISBN_10`, `ISBN_13` FROM `libri` WHERE `titolo` = \"%$title%\" AND `id_autore` = \"$id_aut\"";
	$resultISBN = selectHelper($sqlCurrISBN);
	if(mysql_num_rows($resultISBN)==0){
	}
	else{
		$recordISBN = mysql_fetch_assoc($resultISBN);
		if(empty($newIsbn_10)){
			$newIsbn_10 = $resultISBN['isbn_10'];
		}
		if(empty($newIsbn_13)){
			$newIsbn_13 = $resultISBN['isbn_13'];
		}
	}

	//aggiorno i codici isbn
	$sqlUpdate = "UPDATE `libri` SET `ISBN_10`=\"$newIsbn_10\",`ISBN_13`=\"$newIsbn_13\" WHERE `titolo` LIKE \"%$title%\" AND `id_autore` LIKE \"$id_aut\"";
	$ret = updateHelper($sqlUpdate);

	if($ret == 1){
		echo "Update succeeded";
	}
	else{
		echo "Update failed!";
	}
}

function getGenreID($_genName = '', $_json = true){
	//recupero parametri inseriti nella form
	$genName = filter_input(INPUT_GET, 'genName');
	if(empty($genName)){$genName = $_genName;}

	//recupero id genere
	$sqlGEN = "SELECT id FROM generi WHERE nome = \"$genName\"";
	$resultGEN = selectHelper($sqlGEN);
	$recordGEN = mysql_fetch_assoc($resultGEN);
	$id_gen = $recordGEN['id'];

	if($_json){
		echo $id_gen;
	}
	else{
		return $id_gen;
	}
}

function getAllGenres($_json = true){
	$genres_list = array();

	$sqlAllGEN = "SELECT * FROM generi";
	$resultAllGEN = selectHelper($sqlAllGEN);
	if(mysql_num_rows($resultAllGEN)==0){
	}
	else{
		while($record = mysql_fetch_array($resultAllGEN)){
			extract($record);
			$genre = array("id" => $id, "name" => $nome);
			$genres_list[] =$genre;
		}
	}
	if($_json){
		echo json_encode($genres_list);
	}
	else{
		return $genres_list;
	}
}

function createAuthor($_surname='', $_name='', $_json=true){
	//recupero parametri inseriti nella form
	$surname = filter_input(INPUT_GET, 'surname');
	$name = filter_input(INPUT_GET, 'name');
	if(empty($surname)){$surname = $_surname;}
	if(empty($name)){$name = $_name;}
	//Input check
	if(empty($name) || empty($surname)){
		if($_json){
			$response = array("status_id" => 1, "status_desc" => "Fill all mandatory parameters");
			echo json_encode($response);
		}
		else{
			echo "Fill all mandatory parameters!";
		}
		return;
	}

	//verifico che non esista già l'autore che si sta per inserire
	$sqlCheck = "SELECT * FROM `autori` WHERE `nome` = \"$name\" AND `cognome` = \"$surname\"";
	$occorrenzeAutore = mysql_num_rows(selectHelper($sqlCheck));

	if($occorrenzeAutore==0){
        //eseguo la query per l'inserimento dell'autore
        $sqlInsert = "INSERT INTO `autori`(`cognome`, `nome`) VALUES ('$surname','$name')";
        $ret = insertHelper($sqlInsert);
		if($ret != 1){
			if($_json){
				$response = array("status_id" => 3, "status_desc" => "Insert failed!");
				echo json_encode($response);
			}
			else{
				echo "Insert failed!";
			}
			return;
		}
		else{
			if($_json){
				$response = array("status_id" => 0, "status_desc" => "New author created");
				echo json_encode($response);
			}
			else{
				echo "New author created";
			}
			return;
		}
	}
	else{
		if($_json){
			$response = array("status_id" => 2, "status_desc" => "Author already exists!");
			echo json_encode($response);
		}
		else{
			echo "Author already exists!";
		}
		return;
	}

}

function createBook($_json = true){
	//recupero parametri inseriti nella form
	$title = filter_input(INPUT_GET, 'title');
	$genre = filter_input(INPUT_GET, 'genre');
	$surname = filter_input(INPUT_GET, 'surname');
	$name = filter_input(INPUT_GET, 'name');
	$year = filter_input(INPUT_GET, 'year');
	$status = filter_input(INPUT_GET, 'status');
	$liking = filter_input(INPUT_GET, 'liking');
	$isbn_10 = filter_input(INPUT_GET, 'isbn_10');
	$isbn_13 = filter_input(INPUT_GET, 'isbn_13');
	$notes = filter_input(INPUT_GET, 'notes');
	//Input check
	if(empty($title) || empty($name) || empty($surname) || empty($genre)){
		if($_json){
			$response = array("status_id" => 1, "status_desc" => "Fill all mandatory parameters");
			echo json_encode($response);
		}
		else{
			echo "Fill all mandatory parameters!";
		}
		return;
	}

	//Verifico esistenza autore
	$auts = getAuthors($surname, $name, false);
	$aut = $auts[0];
	$id_aut = $aut['id'];
	if(empty($id_aut)){
		if($_json){
			$response = array("status_id" => 2, "status_desc" => "Author does not exists!");
			echo json_encode($response);
		}
		else{
			echo "Author does not exists!";
		}
		return;
	}

	//Verifico che non esista già il libro
	$book = getBook($surname, $name, $title, FALSE);
	if(!empty($book)){
		if($_json){
			$response = array("status_id" => 3, "status_desc" => "Book already exists!");
			echo json_encode($response);
		}
		else{
			echo "Book already exists!";
		}
		return;
	}

	//recupero id genere
	$id_gen = getGenreID($genre, false);
	if(empty($id_gen)){
		if($_json){
			$response = array("status_id" => 4, "status_desc" => "Genre does not exists!");
			echo json_encode($response);
		}
		else{
			echo "Genre does not exists!";
		}
		return;
	}

	//Aggiungo il libro
	$sqlInsert = "INSERT INTO `libri`(`titolo`, `id_autore`, `id_genere`, `anno`, `stato`, `gradimento`, `note`, `ISBN_10`, `ISBN_13`) VALUES (\"$title\", \"$id_aut\", \"$id_gen\", \"$year\", \"$status\", \"$liking\", \"$notes\", \"$isbn_10\", \"$isbn_13\")";
	$res = insertHelper($sqlInsert);

	if($res == 1){
		if($_json){
			$response = array("status_id" => 0, "status_desc" => "New book created");
			echo json_encode($response);
		}
		else{
			echo "New book created";
		}
		return;
	}
	else {
		if($_json){
			$response = array("status_id" => 5, "status_desc" => "Book creation failure!");
			echo json_encode($response);
		}
		else{
			echo "Book creation failure!";
		}
		return;
	}
}

function updateBook($_json = true){
	$OK = 0;
	//recupero parametri inseriti nella form
	$id = filter_input(INPUT_GET, 'id');
	$title = filter_input(INPUT_GET, 'title');
	$genre = filter_input(INPUT_GET, 'genre');
	$surname = filter_input(INPUT_GET, 'surname');
	$name = filter_input(INPUT_GET, 'name');
	$year = filter_input(INPUT_GET, 'year');
	$status = filter_input(INPUT_GET, 'status');
	$liking = filter_input(INPUT_GET, 'liking');
	$isbn_10 = filter_input(INPUT_GET, 'isbn_10');
	$isbn_13 = filter_input(INPUT_GET, 'isbn_13');
	$notes = filter_input(INPUT_GET, 'notes');
	//Input check
	if(empty($id) || empty($title) || empty($name) || empty($surname) || empty($genre)){
		if($_json){
			$response = array("status_id" => 1, "status_desc" => "Fill all mandatory parameters");
			echo json_encode($response);
		}
		else{
			echo "Fill all mandatory parameters!";
		}
		return;
	}

	//Verifico esistenza autore
	$auts = getAuthors($surname, $name, false);
	$aut = $auts[0];
	$id_aut = $aut['id'];
	if(empty($id_aut)){
		if($_json){
			$response = array("status_id" => 2, "status_desc" => "Author does not exists!");
			echo json_encode($response);
		}
		else{
			echo "Author does not exists!";
		}
		return;
	}

	//recupero id genere
	$id_gen = getGenreID($genre, false);
	if(empty($id_gen)){
		if($_json){
			$response = array("status_id" => 3, "status_desc" => "Genre does not exists!");
			//echo json_encode($response);
		}
		else{
			echo "Genre does not exists!";
		}
		return;
	}

	//Aggiorno il libro
	$sqlUpdate = "UPDATE \n"
    . "	`libri` \n"
    . "SET \n"
    . "	`titolo` = \"$title\", \n"
    . "	`id_autore` = \"$id_aut\", \n"
    . "	`id_genere` = \"$id_gen\", \n"
    . "	`anno` = \"$year\", \n"
    . "	`stato` = \"$status\", \n"
    . "	`gradimento` = \"$liking\", \n"
    . "	`note` = \"$notes\", \n"
    . "	`ISBN_10` = \"$isbn_10\", \n"
    . "	`ISBN_13` = \"$isbn_13\" \n"
    . "WHERE \n"
    . "	`id` = \"$id\"";
	$res = updateHelper($sqlUpdate);

	if($res == 1){
		if($_json){
			$response = array("status_id" => $OK, "status_desc" => "Book updated");
			echo json_encode($response);
		}
		else{
			echo "Book updated";
		}
		return;
	}
	else {
		if($_json){
			$response = array("status_id" => 4, "status_desc" => "Book update failure!");
			echo json_encode($response);
		}
		else{
			echo "Book update failure!";
		}
		return;
	}
}
?>
