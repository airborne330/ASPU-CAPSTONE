<?php
    require_once('central_concessions_db.php');
	
	/* 
	    The following code is for defining user permissions based on the current user. If the user has a manager title, they get full permissions. 
	    If they are a supervisor, they can search through the records but not modify or add. If they are an employee, 
	    they cannot view the page at all.
	*/
	
	$query = "SELECT * FROM employee 
			WHERE Emp_ID = :username 
			AND Password = :password
			ORDER BY Emp_ID";
				
	$statement = $db->prepare($query);
	$statement->bindValue(':username', $_SESSION['username'], PDO::PARAM_STR); //bind query headings to session username and password
	$statement->bindValue(':password', $_SESSION['password'], PDO::PARAM_STR);
	$statement->execute();
	$employees = $statement;
  
	foreach($employees as $em)
	{
		$title = $em['Emp_Job']; //this stores the title of the user. Might want to use a title id in the tables
	}
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <title>Error</title>
    <link href="css/menus.css" rel="stylesheet">
  </head>
  <body>
    <div class="page-wrap">

        <div class="form-container">
          <section class="error-message">

            <h1>No Access!</h1>
            <p class="c-red">You don't have access to the requested page.</p>
  
            
            <nav>
              <ul>
                <li><a class="c-green" href="index.php">Login</a></li>
              </ul>
            </nav>
        
          </section>

        </div>
    </div> <!-- END class="page-wrap" -->
  </body>
</html>