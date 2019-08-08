<?php
    //errors var
    $errors = "";
    //connect to db
    $db = mysqli_connect("localhost", "robert", "Tangoecho44", "todo");

    //insert task to db
    if (isset($_POST['submit'])){
        if (empty($_POST['task'])){
            $errors = "You must fill in the task";
        }
        else{
            $task = $_POST['task'];
            $sql = "INSERT INTO toDoList(task) VALUES ('$task')";
            mysqli_query($db, $sql);
            header('location: index.php');
        }
    }

    if (isset($_GET['del_task'])){
        $id = $_GET['del_task'];

        mysqli_query($db, "DELETE FROM toDoList WHERE id=".$id);
        header('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="heading">
    <h2>Robert's Todo List</h2>
</div>
    <form class="input_form" action="index.php" method="post">
        <?php if (isset($errors)){?>
        <p><?php echo $errors;?></p>
        <?php } ?>
             <input type="text" class="task_input" name="task">
             <button type="submit" class="add_btn" name="submit" id="add_btn">Add Task</button>
    </form>
<table>
        <tr>
            <td>N</td>
            <td>Tasks</td>
            <td style="width: 60px">Action</td>
        </tr>
        <?php
            //select all tasks
            $tasks = mysqli_query($db, "SELECT * FROM toDoList");
            $i = 1; while ($row = mysqli_fetch_array($tasks)){ ?>
            <tr>
                <td> <?php echo $i ?></td>
                <td class="task"> <?php echo $row['task']; ?></td>
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id'] ?>">X</a>
                </td>
            </tr>
        <?php $i++;} ?>
</table>

</body>
</html>