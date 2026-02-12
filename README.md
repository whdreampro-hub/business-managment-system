
# business-managment-system
this is single user system becouse admin of business is one only other person can access it when admin offered access for her or him.

this repository was designed for every one want to make single user system it can help you in you project

as you us you can send your request on:
http://Discord.com
email: whdreampro@gmail.com
number: 0794068520     //all is available

/*============ the some code of this system it like this one where you can download and use it in your project when is neccessary */

-----------------------------------------------------------------------------------------------------------
|  A single-use system of business management refers to                                                    |
| a strategic, project-oriented plan designed to achieve a specific, one-time goal. Unlike standing        |
| plans (which are policies or procedures for recurring situations), single-use plans are developed to     |
| address non-repetitive, unique events and are designed to become obsolete once the goal is accomplished. |
------------------------------------------------------------------------------------------------------------

Key Characteristics

    Non-Repetitive: They are tailored for a single, unique situation.
    Time-Bound: They last only for the duration of the project (e.g., a day, week, or specific campaign).
    Narrow Scope: They generally focus on a specific task or department, rather than company-wide, long-term operations.
    Outcome-Oriented: Focused on reaching a particular result within a defined timeframe.
    Flexibility: They are adaptable during the project but are discarded once the goal is met. 

   YOU CAN USE THIS CODE IN YOUR OWNER SEE LIKE THIS ONE:

   dashboard.php
   <?php
session_start();
include "connect.php";

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

/* STATS */
$employees = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM employees"))['total'];
$paid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM employees WHERE payment_status='paid'"))['total'];
$unpaid = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) total FROM employees WHERE payment_status='unpaid'"))['total'];
$expenses = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(amount) total FROM used_today"))['total'];
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="sidebar">
  <h2>Business</h2>
  <a class="active" href="dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
  <a href="employees.php"><i class="fas fa-users"></i> Employees</a>
  <a href="used_today.php"><i class="fas fa-money-bill"></i> Expenses</a>
  <a href="saving.php"><i class="fas fa-piggy-bank"></i> Saving</a>
  <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>

<div class="content">

<div class="header">
  <h1>📊 Dashboard</h1>
  <span>Welcome, <?php echo $_SESSION['user']; ?></span>
</div>

<div class="stats">

  <div class="card">
    <h3>Employees</h3>
    <p><?php echo $employees; ?></p>
  </div>

  <div class="card green">
    <h3>Paid</h3>
    <p><?php echo $paid; ?></p>
  </div>

  <div class="card red">
    <h3>Unpaid</h3>
    <p><?php echo $unpaid; ?></p>
  </div>

  <div class="card blue">
    <h3>Total Expenses</h3>
    <p>FRW <?php echo number_format($expenses,2); ?></p>
  </div>

</div>

<div class="card">
<h3>Quick Actions</h3>
<div class="quick-links">
  <a href="employees.php">➕ Add Employee</a>
  <a href="used_today.php">💸 Add Expense</a>
  <a href="saving.php">🏦 View Savings</a>
</div>
</div>

</div>

</body>
</html>


/* AND ONTHER IMPORTANCE CODE YOU CAN TRY IS SIGHNUP THE LOGIC OF SINGLE USER SYSTEM */

   THIS IS signup.php   //but here is one person have access when signed in 

   <?php
include "connect.php";
session_start();

$error = "";
$success = "";

if(isset($_POST['signup'])){
    // Check if a user already exists
    $userCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users"))['count'];

    if($userCount > 0){
        $error = "Umukoresha umwe gusa wemerewe. Injira ukoresheje konti isanzwe.";
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users(username, email, password) VALUES('$username', '$email', '$password')";
        if(mysqli_query($conn, $sql)){
            $success = "Konti yakozwe neza! Injira hano.";
            header("refresh:2;url=login.php");
        } else {
            $error = "Habaye ikibazo, ongera ugerageze.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="rw">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        body { font-family: Arial; background: #f8fafc; display:flex; justify-content:center; align-items:center; height:100vh; margin:0; }
        .box { background:#fff; padding:30px; border-radius:15px; width:350px; box-shadow:0 5px 20px rgba(0,0,0,0.1); text-align:center;}
        input { width:100%; padding:12px; margin:10px 0; border-radius:8px; border:1px solid #ccc; }
        button { padding:12px; width:100%; background:#3b82f6; color:#fff; border:none; border-radius:8px; cursor:pointer; }
        .error { background:#fee2e2; color:#b91c1c; padding:10px; border-radius:8px; margin-bottom:10px; }
        .success { background:#dcfce7; color:#15803d; padding:10px; border-radius:8px; margin-bottom:10px; }
        a { color:#3b82f6; text-decoration:none; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Create Account</h2>

        <?php if($error) echo "<div class='error'>$error</div>"; ?>
        <?php if($success) echo "<div class='success'>$success</div>"; ?>

        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="signup">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>


 //other description write for me in box 
   

    
