<?php
header('Content-Type: charset=utf-8');
ini_set("max_execution_time", 0);


// Database credentials
$host = 'mysql.hostinger.it'; //host name
$username = 'u566514421_libri'; //username
$password = 'Sturm89'; // your password
$dbname = 'u566514421_libri'; // database name
// Backup directory and filename
$backupdir="./mysqlbackups";
$backupfilename=$dbname."-dump";
$backupext="sql";

function dbConnect()
{   
   global $host, $username, $password, $dbname;

   $con = mysql_connect($host,$username,$password)
   or die('Could not connect: ' . mysql_error());
   mysql_select_db($dbname,$con);

   return $con;
}

function dbClose($con)
{
   mysql_close($con);
}

function getTablesList($con)
{
   $tables = array();
   $result = mysql_query('SHOW TABLES',$con);
   while($row = mysql_fetch_row($result))
   {
      $tables[] = $row[0];
   }
   return $tables;
}

function getTableSqlDump($table,$con)
{
   $sqldump="";

   // adding DROP TABLE to backup
   $sqldump.= 'DROP TABLE '.$table.';';

   // adding CREATE TABLE to backup
   $createtable = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
   $sqldump.= "\n\n";
   $sqldump.= $createtable[1];
   $sqldump.= ";\n\n";

   // adding TABLE data to backup
   $result = mysql_query('SELECT * FROM '.$table, $con);
   $num_fields = mysql_num_fields($result);

   while($row = mysql_fetch_row($result))
   {
      $sqldump.= 'INSERT INTO '.$table.' VALUES(';
      for($j=0; $j<$num_fields; $j++)
      {
         $row[$j] = addslashes($row[$j]);
         if (isset($row[$j]))
         {
            $sqldump.= '"'.$row[$j].'"' ;
         } else {
            $sqldump.= '""';
         }
         if ($j<($num_fields-1)) { $sqldump.= ','; }
      } 
      $sqldump.= ");\n"; 
   } 
   $sqldump.="\n\n\n"; return $sqldump; 
} 

function zipFile($filename) 
{ 
   $zip = new ZipArchive();
   $res = $zip->open($filename.".zip", ZipArchive::CREATE);
   if ($res === TRUE)
   {
      $zip->addFile($filename);
      $zip->close();
      unlink($filename);
   }

   return true;
}

function getFileName($id)
{
   global $backupdir, $backupfilename, $backupext;

   if (!isset($id)) { $id=0; }
   $filename="$backupdir/$backupfilename.$id.$backupext";

   return $filename;
}

function createBackupDir($backupdir)
{
   if (!is_dir($backupdir)) { mkdir($backupdir); }

   return true;
}

function writeFile($sqldump,$filename)
{
   $handle = fopen($filename,'w+');
   fwrite($handle,$sqldump);
   fclose($handle);

   return true;
}

function rotateZipFiles()
{
   $minbackupid=0;
   //$maxbackupid=9;
   $maxbackupid=0;

   for ($i=$maxbackupid; $i>$minbackupid; $i--)
   {
      $curfilename=getFileName($i).".zip";
      $prevfilename=getFileName($i-1).".zip";
      if ( file_exists($prevfilename) )
      {
         if ( file_exists($curfilename) )
         {
            unlink($curfilename);
         }
         rename($prevfilename,$curfilename);
      }
   }

return true;
}

function mail_file( $to, $subject, $messagehtml, $from, $fileatt, $replyto="" ) {
        // handles mime type for better receiving
        $ext = strrchr( $fileatt , '.');
        $ftype = "";
        if ($ext == ".doc") $ftype = "application/msword";
        if ($ext == ".jpg") $ftype = "image/jpeg";
        if ($ext == ".gif") $ftype = "image/gif";
        if ($ext == ".zip") $ftype = "application/zip";
        if ($ext == ".pdf") $ftype = "application/pdf";
        if ($ftype=="") $ftype = "application/octet-stream";
         
        // read file into $data var
        $file = fopen($fileatt, "rb");
        $data = fread($file,  filesize( $fileatt ) );
        fclose($file);
 
        // split the file into chunks for attaching
        $content = chunk_split(base64_encode($data));
        $uid = md5(uniqid(time()));
 
        // build the headers for attachment and html
        $h = "From: $from\r\n";
        if ($replyto) $h .= "Reply-To: ".$replyto."\r\n";
        $h .= "MIME-Version: 1.0\r\n";
        $h .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
        $h .= "This is a multi-part message in MIME format.\r\n";
        $h .= "--".$uid."\r\n";
        $h .= "Content-type:text/html; charset=iso-8859-1\r\n";
        $h .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $h .= $messagehtml."\r\n\r\n";
        $h .= "--".$uid."\r\n";
        $h .= "Content-Type: ".$ftype."; name=\"".basename($fileatt)."\"\r\n";
        $h .= "Content-Transfer-Encoding: base64\r\n";
        $h .= "Content-Disposition: attachment; filename=\"".basename($fileatt)."\"\r\n\r\n";
        $h .= $content."\r\n\r\n";
        $h .= "--".$uid."--";
 
        // send mail
        return mail( $to, $subject, strip_tags($messagehtml), str_replace("\r\n","\n",$h) ) ;
 
 
    }


// MAIN SCRIPT

$con = dbConnect();

$sqldump="";
foreach(getTablesList($con) as $table)
{
   $sqldump.=getTableSqlDump($table,$con);
}

dbClose($con);

if (!is_dir($backupdir)) { createBackupDir($backupdir); }
//$filename=getFileName(0);
$filename="$backupdir/dump.sql";
writeFile($sqldump,$filename);

rotateZipFiles();
zipFile($filename);

/// SEND MAIL
/*
$to      = 'sturmtruppen89@libero.it';
$subject = 'Bibliovale backup';
$message = $sqldump;
$headers = 'From: webmaster@bibliovale.16mb.com' . "\r\n" .
    'Reply-To: webmaster@bibliovale.16mb.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
*/
mail_file('sturmtruppen89@libero.it', 'Bibliovale backup', 'In allegato il dump del database.', 'webmaster@bibliovale.16mb.com', "$backupdir/dump.sql.zip");

echo 'Dump del database eseguito e inviato via e-mail.';
?>
