<?php
function errorCheck($sql,$conn,$result){
    if ($result == TRUE) {
      echo "New record created successfully.";
    } else {
      echo "Error:" . $sql . "<br>" . $conn->error;
    }
  }

?>