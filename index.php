<?php
$servername = "mytestdb.cryisq2mm0lf.us-west-2.rds.amazonaws.com";
$username = "mysqldb";
$password = "casas123";
$dbname = "college";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $class = $_POST['class'];

        $sql = "INSERT INTO students (name, email, address, mobile, class) 
                VALUES (:name, :email, :address, :mobile, :class)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':class', $class);
        $stmt->execute();

        // 🎨 Styled success message
        echo "
        <html>
        <head>
          <style>
            body {
              background-color: #f0f8ff;
              font-family: Arial, sans-serif;
              text-align: center;
              padding-top: 100px;
            }
            .message-box {
              display: inline-block;
              background: #ffffff;
              padding: 30px;
              border-radius: 12px;
              box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            }
            h2 {
              color: green;
              font-size: 24px;
            }
            a.button {
              display: inline-block;
              margin-top: 20px;
              padding: 10px 20px;
              background: #007bff;
              color: #fff;
              text-decoration: none;
              border-radius: 6px;
              font-weight: bold;
            }
            a.button:hover {
              background: #0056b3;
            }
          </style>
        </head>
        <body>
          <div class='message-box'>
            <h2>✅ Your data was submitted successfully!</h2>
            <a class='button' href='index.html'>Go Back to Form</a>
          </div>
        </body>
        </html>
        ";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


<!-- connect to the db -->

bash
mysql -h <RDS-ENDPOINT> -u mysqldb -p


<!-- create the table -->
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    address VARCHAR(255),
    mobile VARCHAR(20),
    class VARCHAR(50)
);