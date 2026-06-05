#grade calculator
<?php

echo '<form method="post">';
echo 'Enter Marks: <input type="number" name="marks">';
echo '<input type="submit" value="Submit">';
echo '</form>';

if(isset($_POST['marks']))
{
    $marks = $_POST['marks'];

    if($marks >= 90)
        echo "A Grade";
    elseif($marks >= 75)
        echo "B Grade";
    elseif($marks >= 60)
        echo "C Grade";
    else
        echo "Fail";
}

?>
# STUDENT REGISTRATION FORM 


<?php

echo "<h2>Student Registration Form</h2>";

echo '<form method="post">';

echo 'Name: <input type="text" name="name"><br><br>';

echo 'Email: <input type="email" name="email"><br><br>';

echo 'Phone: <input type="text" name="phone"><br><br>';

echo 'Course: <input type="text" name="course"><br><br>';

echo '<input type="submit" value="Register">';

echo '</form>';

if(isset($_POST['name']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $course = $_POST['course'];

    echo "<h3>Student Details</h3>";

    echo "Name: $name <br>";
    echo "Email: $email <br>";
    echo "Phone: $phone <br>";
    echo "Course: $course <br>";
}
?>





<?php

echo "<h2>Age Calculator</h2>";

echo '<form method="post">';

echo 'Enter Birth Year: ';
echo '<input type="number" name="birthyear" required>';

echo '<input type="submit" value="Calculate Age">';

echo '</form>';

if(isset($_POST['birthyear']))
{
    $birthyear = $_POST['birthyear'];

    $currentyear = date("Y");

    $age = $currentyear - $birthyear;

    echo "<h3>Your Age is: $age Years</h3>";
}

?>

# AGE Calculator

<?php

session_start();

if(!isset($_SESSION['tasks']))
{
    $_SESSION['tasks'] = array();
}

if(isset($_POST['task']))
{
    $_SESSION['tasks'][] = $_POST['task'];
}

if(isset($_GET['delete']))
{
    $index = $_GET['delete'];

    unset($_SESSION['tasks'][$index]);

    $_SESSION['tasks'] = array_values($_SESSION['tasks']);
}



#to-do list   

echo "<h2>To-Do List</h2>";

echo '<form method="post">';
echo '<input type="text" name="task" placeholder="Enter Task" required>';
echo '<input type="submit" value="Add Task">';
echo '</form>';

echo "<h3>Tasks</h3>";

if(count($_SESSION['tasks']) > 0)
{
    echo "<ul>";

    foreach($_SESSION['tasks'] as $index => $task)
    {
        echo "<li>$task 
        <a href='?delete=$index'>Delete</a>
        </li>";
    }

    echo "</ul>";
}
else
{
    echo "No Tasks Available";
}

?>