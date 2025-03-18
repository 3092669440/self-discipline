function handleLogin($username, $password) {
$conn = getDBConnection();
$stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
$stmt->execute([$username]);

if($user = $stmt->fetch()) {
if(password_verify($password, $user['password'])) {
$_SESSION['user_id'] = $user['id'];
updateLoginStreak($user['id']);
return true;
}
}
return false;
}

function handleRegistration($username, $email, $password) {
$conn = getDBConnection();
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

try {
$stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
$stmt->execute([$username, $email, $hashedPassword]);
initGrowthData($conn->lastInsertId());
return true;
} catch(PDOException $e) {
return false;
}
}
