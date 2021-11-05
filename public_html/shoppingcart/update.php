<?php
    if(isset($_POST['editMahasiswa'])){

        include('https://projectpaw.000webhostapp.com//customer-login/lib/DataSource.php');

        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
       

        mysqli_query($con,"UPDATE tbl_member SET username='$username', password='$password' WHERE id='$id'")
        or die(mysqli_error($con));

        if($query){
            echo
                '<script>
                alert("Edit Data Success"); window.location = "https://projectpaw.000webhostapp.com/shoppingcart/"
                </script>';
        }else{
            echo
                '<script>
                alert("Edit Data Failed");
                </script>';
        }
    }else{
        echo
            '<script>
            window.history.back()
            </script>';
    }
?>
