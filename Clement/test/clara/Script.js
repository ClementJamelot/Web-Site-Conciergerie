
  function submitForm() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "submit.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        alert(xhr.responseText);
      }
    };
    xhr.send("name=" + name + "&email=" + email);
  }
