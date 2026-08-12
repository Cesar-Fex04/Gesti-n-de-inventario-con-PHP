const boton_backup = document.getElementById("backup");

boton_backup.addEventListener("click", realizarBackup);

function realizarBackup() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "backup.php", true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            alert(xhr.responseText);
        }
    };
    xhr.send();
}