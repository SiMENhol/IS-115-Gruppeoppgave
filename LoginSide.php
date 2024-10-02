<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotell</title>
    <link rel="stylesheet" href="CSS/styles.css" />
</head>
<body>
<?php
include('Include/header.php');
include('Include/footer.php');


  if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_POST;
}
    ?>
  
  <body>

  <div class="form">

    <div class="title">Vennligst login</div>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
    <div class="input-container ic1">
        <input type="text" name="epost" placeholder=" " class="input" required>
            <div class="cut"></div>
        <label asp-for="Email" class="placeholder"><b>Epost</b></label>
        <span validation-for="Email" class="text-danger"></span>
        </div>
    
    <div class="input-container ic2">
        <input for="Password" type="password" placeholder=" " class="input" required>
            <div class="cut2"></div>
        <label for="Password" class="placeholder"><b>Passord</b></label>
        <span validation-for="Password" class="text-danger"></span>
            <button type="submit" class="submit">Login</button>

  

</form>

  </body>

</html>

<style>





    .form {
        background-color: #FFFFFF;
        border-radius: 5px;
        box-sizing: border-box;
        height: 500px;
        padding: 20px;

        width: 320px;
    }

    .title {
        color: #2D333A;
        font-size: 24px;
        font-weight: 600;
        margin-top: 30px;
        font-weight: lighter;
        margin-left: 70px;
        margin-right: auto;
    }

    .input-container {
        height: 50px;
        position: relative;
        width: 100%;
    }

    .ic1 {
        margin-top: 40px;
    }

    .ic2 {
        margin-top: 30px;
    }

    .input {
        border: 5px;
        box-sizing: border-box;
        color: #6F8CB5;
        font-size: 18px;
        height: 100%;
        outline: 0;
        padding: 4px 20px 0;
        width: 100%;
        border-radius: .5px;
        font-weight: lighter;
    }

        .input:focus {
            border: 2px solid #06b; /* Add a blue border when input is focused */
        }

    .cut {
        background-color: white;
        height: 20px;
        left: 10px;
        position: absolute;
        top: -20px;
        transform: translateY(0);
        transition: transform 200ms;
        width: 40px;
    }

    .cut2 {
        background-color: white;
        height: 20px;
        left: 10px;
        position: absolute;
        top: -20px;
        transform: translateY(0);
        transition: transform 200ms;
        width: 55px;
    }

    .cut-short {
        width: 50px;
    }

    .cut-short2 {
        width: 50px;
    }
    .input:focus ~ .cut,
    .input:not(:placeholder-shown) ~ .cut {
        transform: translateY(8px);
    }

    .input:focus ~ .cut2,
    .input:not(:placeholder-shown) ~ .cut2 {
        transform: translateY(8px);
    }

    .placeholder {
        color: #65657b;
        left: 5px;
        line-height: 14px;
        pointer-events: none;
        position: absolute;
        transform-origin: 0 50%;
        transition: transform 200ms, color 200ms;
        top: 20px;
    }

    .input:focus ~ .placeholder,
    .input:not(:placeholder-shown) ~ .placeholder {
        transform: translateY(-30px) translateX(10px) scale(0.75);
    }

    .input:not(:placeholder-shown) ~ .placeholder {
        color: #808097;
    }

    .input:focus ~ .placeholder {
        color: #06b;
    }

    .submit {
        background-color: #E7792C;
        border-radius: 5px;
        border: 0;
        box-sizing: border-box;
        color: #333C4D;
        cursor: pointer;
        font-size: 18px;
        height: 50px;
        margin-top: 38px;
        text-align: center;
        width: 100%;
    }
        .submit:active {
            background-color: #06b;
        }
</style>


<script>
    function showAlert() {
        alert("Vennligst rapporter problemet til ledelsen");
    }
</script>