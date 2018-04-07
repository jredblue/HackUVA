<?php
require_once("db.php");
function hasAccount($username, $connect){
	$stmt = $connect->prepare("SELECT EXISTS(SELECT id FROM users WHERE username = ?)");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($exists);
		$stmt->fetch();
		return $exists;
	}
}
function insertUser($username, $connect){
	$stmt = $connect->prepare("INSERT INTO users(username) VALUES(?)");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->close();
	}
}
//check if user has a value
function hasGoal($username, $connect){
$stmt = $connect->prepare("SELECT EXISTS(SELECT id FROM users WHERE goal IS NOT NULL AND username = ?)");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($exists);
		$stmt->fetch();
		return $exists;
}
}

function hasSalary($username, $connect){
$stmt = $connect->prepare("SELECT EXISTS(SELECT id FROM users WHERE salary IS NOT NULL AND username = ?)");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($exists);
		$stmt->fetch();
		return $exists;
}
}

function hasStartDate($username, $connect){
$stmt = $connect->prepare("SELECT EXISTS(SELECT id FROM users WHERE start_date IS NOT NULL AND username = ?)");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($exists);
		$stmt->fetch();
		return $exists;
}
}

function hasEndDate($username, $connect){
	$stmt = $connect->prepare("SELECT EXISTS(SELECT id FROM users WHERE start_date IS NOT NULL AND username = ?)");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($exists);
		$stmt->fetch();
		return $exists;

}
}

function hasPurchaseDate($username, $connect){
	$stmt = $connect->prepare("SELECT EXISTS(SELECT id FROM users WHERE purchase_date IS NOT NULL AND username = ?)");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$stmt->bind_result($exists);
		$stmt->fetch();
		return $exists;

}
}

//set values - update all
function setGoal($username, $value, $connect){
	$stmt = $connect->prepare("UPDATE users SET goal = ? WHERE username = ?");
	if($stmt){
		$stmt->bind_param("is", $value, $username);
		$stmt->execute();
		$stmt->close();
	}

}

function setSalary($username, $value, $connect){
 $stmt = $connect->prepare("UPDATE users SET salary = ? WHERE username = ?");
	if($stmt){
		$stmt->bind_param("is", $value, $username);
		$stmt->execute();
		$stmt->close();
	}
}


function setStartDate($username, $value, $connect){
	$stmt = $connect->prepare("UPDATE users SET start_date = ? WHERE username = ?");
	if($stmt){
		$stmt->bind_param("ss", $value, $username);
		$stmt->execute();
		$stmt->close();
	}

}

function setEndDate($username, $value, $connect){
	$stmt = $connect->prepare("UPDATE users SET end_date = ? WHERE username = ?");
	if($stmt){
		$stmt->bind_param("ss", $value, $username);
		$stmt->execute();
		$stmt->close();
	}

}

function setPurchaseDate($username, $value, $connect){
	$stmt = $connect->prepare("UPDATE users SET purchase_date = ? WHERE username = ?");
	if($stmt){
		$stmt->bind_param("ss", $value, $username);
		$stmt->execute();
		$stmt->close();
	}

}

//get values 
function getGoal($username, $connect){
	$stmt = $connect->prepare("SELECT goal FROM users WHERE username = ?");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		return $row['goal'];
	}

}

//get salary
function getSalary($username, $connect){
	$stmt = $connect->prepare("SELECT salary FROM users WHERE username = ?");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		return $row['salary'];
	}

}

function getStartDate($username, $connect){
	$stmt = $connect->prepare("SELECT start_date FROM users WHERE username = ?");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		return $row['start_date'];
	}

}

function getEndDate($username, $connect){
	$stmt = $connect->prepare("SELECT end_date FROM users WHERE username = ?");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		return $row['end_date'];
	}

}

function getPurchaseDate($username, $connect){
	$stmt = $connect->prepare("SELECT purchase_date FROM users WHERE username = ?");
	if($stmt){
		$stmt->bind_param("s", $username);
		$stmt->execute();
		$res = $stmt->get_result();
		$row = $res->fetch_assoc();
		return $row['purchase_date'];
	}

}


?>