<?php

//MySQL server and database
$dbhost = 'mysql.hostinger.it';
$dbuser = 'u566514421_libri';
$dbpass = 'Sturm89';
$dbname = 'u566514421_libri';
$tables = '*';
$folder = './mysqlbackups';

$mailFrom = 'sturmtruppen89@libero.it';
$mailFromName = 'Bibliovale webmaster';
$mailSubject = 'Dump DB Bibliovale';
$mailBody = 'In allegato il dump del database';
$mailTo = 'sturmtruppen89@libero.it';


//Call the core function
//unlink($folder.'/db-backup.sql');
//unlink($folder.'/dump.zip');

backup_tables($dbhost, $dbuser, $dbpass, $dbname, $folder, $tables);
/*
if(zipFile($folder, $folder.'/db-backup.sql')){
	echo "Done, the zip file name is: dump.zip<br>";
}

if(mail_file( $mailTo, $mailSubject, $mailBody, $mailFrom, $folder.'/dump.zip', $replyto="" )){
	echo "Done, mail sent.<br>";
}
*/

//Core function
function backup_tables($host, $user, $pass, $dbname, $folder, $tables = '*') {
    $link = mysqli_connect($host,$user,$pass, $dbname);

    // Check connection
    if (mysqli_connect_errno())
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit;
    }

    mysqli_query($link, "SET NAMES 'utf8'");

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysqli_query($link, 'SHOW TABLES');
        while($row = mysqli_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }

    $return = '';
    //cycle through
    foreach($tables as $table)
    {
        $result = mysqli_query($link, 'SELECT * FROM '.$table);
        $num_fields = mysqli_num_fields($result);
        $num_rows = mysqli_num_rows($result);

        $return.= 'DROP TABLE IF EXISTS '.$table.';';
        $row2 = mysqli_fetch_row(mysqli_query($link, 'SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";
        $counter = 1;

        //Over tables
        for ($i = 0; $i < $num_fields; $i++) 
        {   //Over rows
            while($row = mysqli_fetch_row($result))
            {   
                if($counter == 1){
                    $return.= 'INSERT INTO '.$table.' VALUES(';
                } else{
                    $return.= '(';
                }

                //Over fields
                for($j=0; $j<$num_fields; $j++) 
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = str_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j<($num_fields-1)) { $return.= ','; }
                }

                if($num_rows == $counter){
                    $return.= ");\n";
                } else{
                    $return.= "),\n";
                }
                ++$counter;
            }
        }
        $return.="\n\n\n";
    }

    //save file
    /*
	$fileName = $folder.'/db-backup.sql';	
    $handle = fopen($fileName,'w+');
    fwrite($handle,$return);
    if(fclose($handle)){
        echo "Done, the file name is: ".$fileName."<br>";
        //exit; 
    }*/
	
	mail_text($return);
	
}

function zipFile($folder, $sqlfile) 
{ 
    // Get real path for our folder
	$rootPath = realpath($folder);

	// Initialize archive object
	$zip = new ZipArchive();
	$zip->open($folder.'/dump.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

	// Create recursive directory iterator
	/** @var SplFileInfo[] $files */
	$files = new RecursiveIteratorIterator(
		new RecursiveDirectoryIterator($rootPath),
		RecursiveIteratorIterator::LEAVES_ONLY
	);

	foreach ($files as $name => $file)
	{
		// Skip directories (they would be added automatically)
		if (!$file->isDir())
		{
			// Get real and relative path for current file
			$filePath = $file->getRealPath();
			$relativePath = substr($filePath, strlen($rootPath) + 1);

			// Add current file to archive
			$zip->addFile($filePath, $relativePath);
		}
	}

	// Zip archive will be created only after closing object
	$zip->close();
	
	return true;
}

function mail_text($message) {       
/* Email Detials */
  $mail_to = "sturmtruppen89@libero.it";
  $from_mail = "webmaster@bibliovale.16mb.com";
  $from_name = "webmaster@bibliovale.16mb.com";
  $reply_to = "webmaster@bibliovale.16mb.com";
  $subject = "Dump database";
 

  // Email header
  $header = "From: ".$from_name." <".$from_mail.">".PHP_EOL;
  $header .= "Reply-To: ".$reply_to.PHP_EOL;
  $header .= "MIME-Version: 1.0".PHP_EOL;  
  $header .= "Content-Type: text/html; charset=UTF-8".PHP_EOL;
  
   
  // Send email
  if (mail($mail_to, $subject, $message, $header)) {
    echo "Sent";
  } else {
    echo "Error";
  }
}



?>