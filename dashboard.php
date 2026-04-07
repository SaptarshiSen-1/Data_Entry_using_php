<?php
session_start();
include "db.php";

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

// INSERT DATA
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $course = $_POST['course'];
    $college = $_POST['college'];

    $sql = "INSERT INTO students (name, age, course, college)
            VALUES ('$name', '$age', '$course', '$college')";
    $conn->query($sql);
}

// DELETE DATA
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM students WHERE id=$id");
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Welcome <?php echo $_SESSION['user']; ?></h2>
<a href="logout.php">Logout</a>

<div class="container">
    <h1 style="text-align: center;">Add Details</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="Name" required>
        <input type="number" name="age" placeholder="Age" required>
        <input type="text" name="course" placeholder="Course" required>
        <input type="text" name="college" placeholder="College Name" required>
        <button name="add">Add</button>
    </form>
</div>

<div class="container">
    <h3>Student List</h3>

    <table border="1" width="100%">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Course</th>
            <th>College</th>
            <th>Action</th>
        </tr>

        <?php
        $result = $conn->query("SELECT * FROM students");

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['course']}</td>
                    <td>{$row['college']}</td>
                    <td>
                        <a href='dashboard.php?delete={$row['id']}' onclick=\"return confirm('Are you sure?')\">Delete</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>
