<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            width: 100%;
        }

        nav {
            width: 200px;
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            height: 100vh;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            margin: 10px 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav ul li a:hover {
            background-color: #ddd;
        }

        main {
            flex: 1;
            padding: 20px;
        }

        section {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 5px;
        }

        footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px 0;
            position: relative;
            width: 100%;
            bottom: 0;
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <img src="logo.jpg" alt="Logo" class="logo"> <!-- Change the logo path as needed -->
    </header>
    
    <nav>
        <ul>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="Manage Courses.php">Manage Courses</a></li>
            <li><a href="Announcements.PHP">Manage Announcements</a></li>
            <li><a href="grades.php">post grade</a></li>
            <li><a href="setup.php">Logout</a></li>
        </ul>
    </nav>
    
    <main>
        <section id="manage-users">
            <h2>Manage Users</h2>
            <p>Here you can view, edit, or delete user accounts.</p>
            <!-- User management functionalities (e.g., table of users) would go here -->
            <button onclick="location.href='manage_users.php'">Add New User</button>
        </section>
        
        <section id="manage-courses">
            <h2>Manage Courses</h2>
            <p>Manage course details, enrollments, and schedules.</p>
            <button onclick="location.href='manage_users.php'">Add New Course</button>
        
        </section>
        
        <section id="manage-announcements">
            <h2>Manage Announcements</h2>
            <p>Create or modify announcements for students.</p>
            <button>Add New Announcement</button>
        </section>
        
        <section id="view-reports">
            <h2>View Reports</h2>
            <p>Overview of student performance and statistics.</p>
            <!-- Report display functionalities would go here -->
        </section>
    </main>
    
    <footer>
        <p>Contact support at: <a href="mailto:support@example.com">support@example.com</a></p>
    </footer>
</body>
</html>