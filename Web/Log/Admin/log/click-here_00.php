<html>

    <title>Something here!</title>

    <body>

            <?php



          		if(!isset($_GET['file']))
          		{
          			echo "You got the right 'file' :)";
          		} elseif($file=$_GET['file'])
          		{

          			include("php://filter/read=convert.base64-encode/resource=$file");
          			die();
          		}
            #There is something phishy in logs try to access it.
            ?>

    </body>

</html>
