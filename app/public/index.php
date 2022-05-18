<?php

require 'vendor/autoload.php'; // include Composer's autoloader

$client = new MongoDB\Client("mongodb://root:rootpassword@mongo-server:27017");
echo "Access Website Link from <a href='http://localhost:81/index.php'>Click Here </a><br/>";
echo "Access Mongodb Express from <a href='http://localhost:8081/'>Click Here </a><br/>";
echo "Access Phpmyadmin from <a href='http://localhost:8085/'>Click Here </a><br/>";
echo "Access Nodejs from <a href='http://localhost:5000/'>Click Here </a><br/>";

echo "<h5>List of MongoDB Database</h5>";
try
{
    $dbs = $client->listDatabases();
	foreach ($dbs as $d) {
    echo $d->getName() . "<br/>";
}

	//print_r($dbs);
}
catch (MongoDB\Driver\Exception\ConnectionTimeoutException $e)
{}
echo "<h5>List of Collection in Database demodb</h5>";
$database = $client->demodb;
$collections = $database->listCollections();
$collectiontoadd="mycollection";
$iscollectionexist=0;
foreach ($collections as $col) {
	if($col->getName()==$collectiontoadd){
		$iscollectionexist=1;
	}
    echo $col->getName(). "<br/>";
}

if($iscollectionexist==0){
	echo "<br/>Creating collection " . $collectiontoadd;
	$result = $database->createCollection($collectiontoadd);
}


$collection = $database->$collectiontoadd;  
$collection->insertOne( [ 'name' =>'Richa', 'email' =>'test@test.com' ] );  
echo "<br/>Data inserted into collection " . $collectiontoadd;

$record = $collection->find();  
foreach ($record as $data) {  
echo $data['_id'], ' - ' , $data['name'], ' - ', $data['email']."<br>";  
}  


echo "<h5>Other Details</h5>";
$pdo = new PDO('mysql:dbname=mydb;host=mysql', 'admin', 'admin', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$query = $pdo->query('SHOW VARIABLES like "version"');
$row = $query->fetch();
echo 'MySQL version:' . $row['Value'];
echo "<br/>";
echo "<br/>Current version is PHP " . phpversion();
echo "<br/><br/>";
echo "Extensions:<br/>";
print_r(get_loaded_extensions());
 


?>

<?php phpinfo(); ?>