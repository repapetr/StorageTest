<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        require_once 'vendor/autoload.php';

        use WindowsAzure\Common\ServicesBuilder;
        use MicrosoftAzure\Storage\Common\ServiceException;

$connectionString = "DefaultEndpointsProtocol=http;AccountName=iscloud;AccountKey=AxuXnblTRtFbRGD5p9tNnxeE5w6XMND+p66f/yWt/ugP8JG4bAKVRhCwPhljDM3rBuhQfyPAeujYTLtYpj9DFw==;";

// Create blob REST proxy.
        $blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);
if(isset($_GET['upload'])){
    //uloží soubor jako stream
    //
    #$content = fopen("https://www.enterprise.com/content/enterprise_cros/data/vehicle/bookingCountries/US/TRUCKS/PPAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1444355026452.png", "r");
//uloží klasicky 
    $content = file_get_contents("https://www.enterprise.com/content/enterprise_cros/data/vehicle/bookingCountries/US/TRUCKS/PPAR.doi.768.high.imageSmallThreeQuarterNodePath.png/1444355026452.png");
    $blob_name = "pickup2.png";

    echo "sdfds";
    
try    {
    //Upload blob
    $blobRestProxy->createBlockBlob("test", $blob_name, $content);
}
catch(ServiceException $e){
    // Handle exception based on error codes and messages.
    // Error codes and messages are here:
    // http://msdn.microsoft.com/library/azure/dd179439.aspx
    $code = $e->getCode();
    $error_message = $e->getMessage();
    echo $code.": ".$error_message."<br />";
}
    
}

        try {
            #echo serialize($blobRestProxy->listContainers());
            $containers = $blobRestProxy->listContainers();
            $container = $containers->getContainers();
            foreach ($container as $key) {
                // List blobs.
                $blob_list = $blobRestProxy->listBlobs($key->getName());
                $blobs = $blob_list->getBlobs();
                echo "Kontejner:" . $key->getName() . "<br/>";
                foreach ($blobs as $blob) {
                    echo "Soubory:" . $blob->getName() . ": " . $blob->getUrl();
                    echo "<br />";
                }
                echo "_------------_<br/>";
            }
        } catch (ServiceException $e) {
            // Handle exception based on error codes and messages.
            // Error codes and messages are here:
            // http://msdn.microsoft.com/library/azure/dd179439.aspx
            $code = $e->getCode();
            $error_message = $e->getMessage();
            echo $code . ": " . $error_message . "<br />";
        }
        ?>
        <form action="" method="GET">
            <input type="submit" name="upload" value="Upload" />
        </form>
    </body>
</html>
