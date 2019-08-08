<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div>
    <form class="todo" action="index.php" method="post" id="toDoList">

         <label class="todoLabel">
             List Item: <br>
             <input type="text" class="todoText" name="txtTodo">
             <input type="submit" class="todoText" value="Add" name="toDoSubmit">
         </label>

    </form>

    <?php
    //get user input
    if (isset($_POST['toDoSubmit'])) {
        //adding input to list if the submit button is pressed

        $listItem = $_POST['txtTodo'];
    }
    // create a connection to the db
    $mysqli = new mysqli("localhost", "robert", "Tangoecho44", "todo");
    //check connection to db
    if ($mysqli->connect_error){
        die("Connection failed: " . $mysqli->connect_error);
    }
    //build sql insert query
    $sql = "INSERT INTO toDoList(task) VALUES ('$listItem')";
    //run sql query
    if ($mysqli->query($sql) === TRUE){
        echo "TASK Added!";
    }
    else{
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
    ?>
    <ul>
        <?php
            //save database values to array
            $collect = $mysqli->query("SELECT task FROM toDoList");
            //initialise array
            $list = array();
            $list = $mysqli->query($collect);

            foreach ($list as $listItem){
                echo "<li>$listItem</li>";
            }
    ?>
    </ul>
</div>
</body>
</html>