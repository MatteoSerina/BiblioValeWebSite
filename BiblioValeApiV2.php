<?php
header('Content-Type: application/json');

//seleziono la funzione da richiamare
$function = html_entity_decode($_GET['fName']);

switch($function){
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
	case 'getAllBooksBaseData':
		getAllBooksBaseData();
		break;
	case 'updateBook':
		updateBook();
		break;
	case 'getWishList':
		getWishList();
		break;
	case 'getStats':
		getStats();
		break;
	case 'getBooksByStatus':
		getBooksByStatus();
		break;
	case 'searchBook':
		searchBook();
		break;
	case 'searchHint':
		searchHint();
		break;
	case 'authorsHint':
		authorsHint();
		break;
	case 'deleteBook':
		deleteBook();
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
	database::dbClose($conn);
	
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
	database::dbClose($conn);
	
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
	database::dbClose($conn);
	
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
	database::dbClose($conn);
	
	return $ret;
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
	if(mysqli_num_rows($result)==0){
	}
	else{		
		while($record = mysqli_fetch_array($result)){
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

function searchBook($_queryString='', $_json = true){		
	$book_list = array();
	
	//recupero parametri inseriti nella form
	$queryString = filter_input(INPUT_GET, 'queryString');
	if(empty($queryString)){$surname = $_queryString;}
	
	//se la query contiene la virgola, potrebbe essere un autore completo
	
	//eseguo la query di ricerca
	$sql = "SELECT * FROM `tutti_libri` WHERE `titolo` LIKE \"%$queryString%\" OR `cognome` LIKE \"%$queryString%\" OR `nome` LIKE \"%$queryString%\" OR `autore` LIKE \"%$queryString%\" ORDER BY `cognome`, `nome`, SORTTITLE(titolo)";	
	$result = selectHelper($sql);
	if(mysqli_num_rows($result)==0){
	}
	else{		
		while($record = mysqli_fetch_array($result)){
			extract($record);
			$book = array("id" => $id, "title" => $titolo, "surname" => $cognome, "name" =>  $nome, "year" => $anno, "genre" => $genere, "isbn10" => $isbn_10, "isbn13" => $isbn_13, "status" => $stato, "notes" => $note);
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

function searchHint($_json = true){		
	$hint_list = array();	
		
	//eseguo la query di ricerca	
	$sql  = "SELECT CONCAT(`cognome`, \", \", `nome`) as SearchHint FROM `autori` UNION SELECT titolo from libri ORDER BY SearchHint";
	$result = selectHelper($sql);
	if(mysqli_num_rows($result)==0){
	}
	else{
		$id = 0;		
		while($record = mysqli_fetch_array($result)){
			extract($record);
			$hint = array("id" => $id, "name" => $SearchHint);
			$hint_list[] =$hint;
			$id = $id + 1;		
		}
	}

  if($_json){
  	echo json_encode($hint_list);
  }
  else{
  	return $hint_list;
  }
}

function authorsHint($_json = true){		
	$hint_list = array();	
		
	//eseguo la query di ricerca	
	$sql  = "SELECT CONCAT(`cognome`, \", \", `nome`) as AuthorsHint FROM `autori` ORDER BY CONVERT(CAST(`cognome` AS BINARY) USING utf8)";
	$result = selectHelper($sql);
	if(mysqli_num_rows($result)==0){
	}
	else{
		$id = 0;		
		while($record = mysqli_fetch_array($result)){
			extract($record);
			$hint = array("id" => $id, "name" => $AuthorsHint);
			$hint_list[] =$hint;
			$id = $id + 1;		
		}
	}

  if($_json){
  	echo json_encode($hint_list);
  }
  else{
  	return $hint_list;
  }
}

function getBookByISBN($_isbn_10='', $_isbn_13='', $_json = true){		
	$book_list = array();
	
	//recupero parametri inseriti nella form
	$isbn_10 = filter_input(INPUT_GET, 'isbn_10');
	$isbn_13 = filter_input(INPUT_GET, 'isbn_13');
	if(empty($isbn_10)){$isbn_10 = $_isbn_10;}
	if(empty($isbn_13)){$isbn_13 = $_isbn_13;}
	
	if(!(empty($isbn_10) && empty($isbn13))){
		//eseguo la query di ricerca
		$sql = "SELECT * FROM `tutti_libri` WHERE (`isbn_10` = \"$isbn_10\" OR `isbn_13` = \"$isbn_13\") AND (TRIM(`isbn_10`) NOT LIKE '' OR TRIM(`isbn_13`) NOT LIKE '') ORDER BY `cognome`, `nome`, `titolo`";
		$result = selectHelper($sql);
		if(mysqli_num_rows($result)==0){
		}
		else{		
			while($record = mysqli_fetch_array($result)){
				extract($record);
				$book = array("id" => $id, "title" => $titolo, "surname" => $cognome, "name" =>  $nome, "year" => $anno, "genre" => $genere, "isbn_10" => $isbn_10, "isbn_13" => $isbn_13, "status" => $stato, "notes" => $note);
				$book_list[] =$book;			
			}
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
	if(mysqli_num_rows($result)==0){
	}
	else{		
		while($record = mysqli_fetch_array($result)){
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
	if(mysqli_num_rows($resultAllAUT)==0){
	}
	else{		
		while($record = mysqli_fetch_array($resultAllAUT)){
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

function getAllBooksBaseData($_json = true){
	$books = array();
	
	$sqlBooks = "SELECT * FROM tutti_libri ORDER BY cognome, nome, SORTTITLE(titolo)";
	$resultBooks = selectHelper($sqlBooks);
	if(mysqli_num_rows($resultBooks)==0){
	}
	else{		
		while($record = mysqli_fetch_array($resultBooks)){
			extract($record);
			$book = array("id" => $id, "title" => $titolo, "name" => $nome, "surname" => $cognome, "genre" => $genere, "year" => $anno, "status" => $stato, "evaulation" => $gradimento, "isbn10" => $isbn_10, "isbn13" => $isbn_13, "notes" => $note);
			$books_list[] = $book;	
		}
	}
	if($_json){
		echo json_encode($books_list);
	}
	else{
		return $books_list;
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
	$recordAUT = mysqli_fetch_assoc($resultAUT);
	$id_aut = $recordAUT['id'];
	if(empty($id_aut)){
		echo "Author not found!";
		return;
	}
		
	//recupero codici isbn attuali e imposto i nuovi
	$sqlCurrISBN = "SELECT `ISBN_10`, `ISBN_13` FROM `libri` WHERE `titolo` = \"%$title%\" AND `id_autore` = \"$id_aut\"";
	$resultISBN = selectHelper($sqlCurrISBN);
	if(mysqli_num_rows($resultISBN)==0){
	}
	else{		
		$recordISBN = mysqli_fetch_assoc($resultISBN);
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
	
	if($ret == 0){
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
	$recordGEN = mysqli_fetch_assoc($resultGEN);
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
	
	$sqlAllGEN = "SELECT * FROM generi ORDER BY nome";
	$resultAllGEN = selectHelper($sqlAllGEN);
	if(mysqli_num_rows($resultAllGEN)==0){
	}
	else{		
		while($record = mysqli_fetch_array($resultAllGEN)){
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
			http_response_code(500);
			print json_encode($response);
		}
		else{
			echo "Fill all mandatory parameters!";
		}
		return;
	}
	
	//verifico che non esista già l'autore che si sta per inserire
	$sqlCheck = "SELECT * FROM `autori` WHERE `nome` = \"$name\" AND `cognome` = \"$surname\"";
	$occorrenzeAutore = mysqli_num_rows(selectHelper($sqlCheck));
	
	if($occorrenzeAutore==0){					
        //eseguo la query per l'inserimento dell'autore
        $sqlInsert = "INSERT INTO `autori`(`cognome`, `nome`) VALUES ('$surname','$name')";
        $ret = insertHelper($sqlInsert);
		if($ret != 0){
			if($_json){
				$response = array("status_id" => 3, "status_desc" => "Insert failed!");
				http_response_code(500);
				print json_encode($response);
			}
			else{
				echo "Insert failed!";
			}
			return;			
		}
		else{
			if($_json){
				$response = array("status_id" => 0, "status_desc" => "New author created");
				http_response_code(200);
				print json_encode($response);
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
			http_response_code(500);
			print json_encode($response);
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
	$liking = (filter_input(INPUT_GET, 'liking') == '') ? 0 : filter_input(INPUT_GET, 'liking');
	$isbn_10 = filter_input(INPUT_GET, 'isbn_10');
	$isbn_13 = filter_input(INPUT_GET, 'isbn_13');
	$notes = filter_input(INPUT_GET, 'notes');	
	//Input check		
	if(empty($title) || empty($name) || empty($surname) || empty($genre)){
		if($_json){
			$response = array("status_id" => 1, "status_desc" => "Fill all mandatory parameters");
			http_response_code(500);
			print json_encode($response);
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
			http_response_code(500);
			print json_encode($response);
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
			http_response_code(500);
			print json_encode($response);
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
			http_response_code(500);
			print json_encode($response);
		}
		else{
			echo "Genre does not exists!";
		}
		return;
	}
	
	//Aggiungo il libro	
	$sqlInsert = "INSERT INTO `libri`(`titolo`, `id_autore`, `id_genere`, `anno`, `stato`, `gradimento`, `note`, `ISBN_10`, `ISBN_13`) VALUES (\"$title\", \"$id_aut\", \"$id_gen\", \"$year\", \"$status\", \"$liking\", \"$notes\", \"$isbn_10\", \"$isbn_13\")";
	$res = insertHelper($sqlInsert);
	
	if($res == 0){
		if($_json){
			$response = array("status_id" => 0, "status_desc" => "New book created");
			http_response_code(200);
			print json_encode($response);
		}
		else{
			echo "New book created";
		}
		return;
	}
	else {
		if($_json){
			$response = array("status_id" => 5, "status_desc" => "Book creation failure!");
			http_response_code(500);
			print json_encode($response);
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
			http_response_code(500);
			print json_encode($response);
		}
		else{
			echo "Fill all mandatory parameters!";
		}
		return;
	}
	
	//Verifico esistenza autore
	$auts = getAuthors($surname, $name, false);
	if(empty($auts)){
		if($_json){
			$response = array("status_id" => 2, "status_desc" => "Author does not exists!");
			http_response_code(500);
			print json_encode($response);
		}
		else{
			echo "Author does not exists!";
		}
		return;
	}
	$aut = $auts[0];
	$id_aut = $aut['id'];
			
	//recupero id genere  
	$id_gen = getGenreID($genre, false);
	if(empty($id_gen)){
		if($_json){
			$response = array("status_id" => 3, "status_desc" => "Genre does not exists!");
			http_response_code(500);
			print json_encode($response);
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
    . "	`note` = \"$notes\", \n"
    . "	`ISBN_10` = \"$isbn_10\", \n"
    . "	`ISBN_13` = \"$isbn_13\" \n"
    . "WHERE \n"
    . "	`id` = \"$id\"";
	$res = updateHelper($sqlUpdate);
	
	if($res == 0){
		if($_json){
			$response = array("status_id" => $OK, "status_desc" => "Book updated");
			http_response_code(200);
			print json_encode($response);
		}
		else{
			echo "Book updated";
		}
		return;
	}
	else {
		if($_json){
			$response = array("status_id" => 4, "status_desc" => "Book update failure!");
			http_response_code(500);
			print json_encode($response);
		}
		else{
			echo "Book update failure!";
		}
		return;
	}
}

function getWishList($_json = true){		
	$book_list = array();
			
	//eseguo la query di ricerca
	$sql = "SELECT * FROM `tutti_libri` where `stato` = 'wish list' ORDER BY `cognome`, `nome`, `titolo`";
	$result = selectHelper($sql);
	if(mysqli_num_rows($result)==0){
	}
	else{		
		while($record = mysqli_fetch_array($result)){
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

function getStats($_json = true){		
	$stat_list = array();
			
	//eseguo la query di ricerca: conteggio per stato
	$sql = "SELECT `stato`, count(*) AS 'count' FROM `tutti_libri` group by `stato`";
	$result = selectHelper($sql);
	if(mysqli_num_rows($result)==0){
	}
	else{		
		while($record = mysqli_fetch_array($result)){
			extract($record);
			$stat = array("status" => $stato, "count" => $count);
			$stat_list[] = $stat;			
		}
	}
	
	//eseguo la query di ricerca: totale libri posseduti
	$sql = "SELECT count(*) AS 'count' FROM `tutti_libri` where `stato` <> 'wish list'";
	$result = selectHelper($sql);
	if(mysqli_num_rows($result)==0){
	}
	else{		
		while($record = mysqli_fetch_array($result)){
			extract($record);
			$stat = array("status" => "Totale", "count" => $count);
			$stat_list[] = $stat;			
		}
	}
  if($_json){
  	echo json_encode($stat_list);
  }
  else{
  	return $stat_list;
  }
}

function getBooksByStatus($_status='', $_json = true){		
	$book_list = array();
	
	//recupero parametri inseriti nella form
	$status = filter_input(INPUT_GET, 'status');
	if(empty($status)){$status = $_status;}
	
	//eseguo la query di ricerca
	$sql = "SELECT * FROM `tutti_libri` where `stato` = \"$status\" ORDER BY `cognome`, `nome`, `titolo`";
	$result = selectHelper($sql);
	if(mysqli_num_rows($result)==0){
	}
	else{		
		while($record = mysqli_fetch_array($result)){
			extract($record);
			$book = array("id" => $id, "title" => $titolo, "surname" => $cognome, "name" =>  $nome, "year" => $anno, "genre" => $genere, "isbn10" => $isbn_10, "isbn13" => $isbn_13, "status" => $stato, "notes" => $note);
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

function deleteBook($_id='', $_json = true){
	$OK = 0;	
	$book_list = array();
	
	//recupero parametri inseriti nella form
	$id = filter_input(INPUT_GET, 'id');
	if(empty($id)){$id = $id;}
	
	//eseguo la query di cancellazione
	$sqlDelete = "DELETE FROM `libri` WHERE `id` = \"$id\"";
	$ret = deleteHelper($sqlDelete);
	
	if($ret == 0){
		if($_json){
			$response = array("status_id" => $OK, "status_desc" => "Book deleted");
			http_response_code(200);
			print json_encode($response);
		}
		else{
			echo "Book deleted";
		}
		return;
	}
	else {
		if($_json){
			$response = array("status_id" => 1, "status_desc" => "Book delete failure!");
			http_response_code(500);
			print json_encode($response);
		}
		else{
			echo "Book delete failure!";
		}
		return;
	}
}


?>
