<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ইনপুট ডাটা
    $name = $_POST['name'];
    $reference = $_POST['reference'];
    $father = $_POST['father'];
    $mother = $_POST['mother'];
    $facebook = $_POST['facebook'];
    $bikash = $_POST['bikash'];
    $profession = $_POST['profession'];
    $address = $_POST['address'];

    // ফাইল আপলোড (index.php যেখানে আছে সেখানেই সেভ হবে)
    $uploadedFiles = [];
    foreach ($_FILES as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = time() . "_" . basename($file["name"]);
            $target = __DIR__ . "/" . $fileName;
            move_uploaded_file($file["tmp_name"], $target);
            $uploadedFiles[$key] = $fileName;
        }
    }

    // রেজাল্ট দেখানো
    echo "<h2>✅ ভেরিফিকেশন সফলভাবে জমা হয়েছে</h2>";
    echo "<p><b>নাম:</b> $name</p>";
    echo "<p><b>রেফারেন্স:</b> $reference</p>";
    echo "<p><b>পিতার নাম্বার:</b> $father</p>";
    echo "<p><b>মাতার নাম্বার:</b> $mother</p>";
    echo "<p><b>ফেসবুক লিংক:</b> $facebook</p>";
    echo "<p><b>বিকাশ/নগদ/রকেট:</b> $bikash</p>";
    echo "<p><b>পেশা:</b> $profession</p>";
    echo "<p><b>ঠিকানা:</b> $address</p>";
    echo "<h3>আপলোডকৃত ফাইল:</h3><ul>";
    foreach ($uploadedFiles as $key => $file) {
        echo "<li>$key: <a href='$file' target='_blank'>$file</a></li>";
    }
    echo "</ul>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="bn">
<head>
  <meta charset="UTF-8">
  <title>ভেরিফিকেশন ফর্ম</title>
  <style>
    body { font-family: Arial, sans-serif; background:#f9f9f9; padding:20px; }
    form { background:#fff; padding:20px; border-radius:10px; max-width:600px; margin:auto; }
    input, textarea { width:100%; padding:8px; margin:6px 0; border:1px solid #ccc; border-radius:5px; }
    button { background:#28a745; color:#fff; padding:10px 15px; border:none; border-radius:5px; cursor:pointer; }
    button:hover { background:#218838; }
    h2 { text-align:center; }
  </style>
</head>
<body>
  <h2>ভেরিফিকেশন ফর্ম</h2>
  <form method="POST" enctype="multipart/form-data">

    নাম: <input type="text" name="name" required><br>
    রেফারেন্স নাম + নাম্বার: <input type="text" name="reference" required><br>
    পিতার নাম্বার: <input type="text" name="father" required><br>
    মাতার নাম্বার: <input type="text" name="mother" required><br>
    ফেসবুক লিংক: <input type="url" name="facebook" required><br>
    বিকাশ/নগদ/রকেট নাম্বার: <input type="text" name="bikash" required><br>
    পেশা: <input type="text" name="profession"><br>
    ঠিকানা: <textarea name="address"></textarea><br><br>

    জাতীয় পরিচয়পত্র (সামনে): <input type="file" name="nid_front" required><br>
    জাতীয় পরিচয়পত্র (পিছনে): <input type="file" name="nid_back" required><br>
    নিজের ছবি (১): <input type="file" name="photo1" required><br>
    নিজের ছবি (২): <input type="file" name="photo2" required><br><br>

    <button type="submit">সাবমিট</button>
  </form>
</body>
</html>￼Enter
