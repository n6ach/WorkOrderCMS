<!DOCTYPE html>
<html lang="en">
<head>
 <title>Workorder CMS</title>
    <meta charset="utf-8">
   <!-- <link rel="stylesheet" href="/mvc/CSS/styles.css"> -->
    <style>
    <?php include 'CSS/styles.css'; ?>
    </style>

    <!-- JavaScript code to validate form -->
    <script>


        // global variable
        var erMessage = "This field is required";
      // Validate form
        function validateForm() {

    var location = document.forms["form"]["location"].value;
    var description = document.forms["form"]["description"].value;
    var estimate = document.forms["form"]["estimate"].value;

        if (location == "") {

                document.getElementById("errorLocation").innerHTML = erMessage;
                //total--;
                return false;

            } else
                document.getElementById("errorLocation").innerHTML = "";

    }

    // Get current date
    function getCurrentDate() {
        var currentDate = new Date();
        var day = currentDate.getDate();
        var month = currentDate.getMonth() + 1;
        var year = currentDate.getFullYear();

return  document.write("<b>" +month + "/" + day + "/" + year + "</b>");
    }



    </script>

</head>


<body>
    <div id="wrapper">
<header><h2>New workorder</h2></header>

<nav>
    <b>

    </b>

</nav>

    <main>


        <h4>* Required fields</h4>

    <!-- Form for Help -->
<form name="form" action="newWorkorder" method="post" onsubmit="return validateForm()">
            <!-- form controlls -->

<fieldset>
    <legend>New service request</legend>


    <label id="label1">Location</label>
    <input type="text" name="location"><h8 id="errorLocation" class="error"></h8><br/>

    <label id="label1"> Received:</label>
    <input type="date" name="received"><h8 id="date" name="date" class="error">*
    <script> getCurrentDate();</script>
    </h8><br/>

    <label id="label1">Scheduled:</label>
    <input type="date" name="scheduled"><br/>

    <label id="label1">Compleated?</label>
     <select id="custom" name="compleated">

         <option selected="no">no</option>
            <option value="yes" >yes</option>
          <!--  <option value="no" >no</option> -->

  </select>

    <label id="label1">Location id:</label><br/>
    <input type="text" name="location_id"><br/>

  <!--  <label id="label1"> Description:</label><br/>
    <input type="text" name="description"><br/>

  -->
    <label id="label1">Estimate</label><br>
    <input type="text" name="estimate"><br/>

    <br>
    <label for="feedback">Description:</label> <br>
            <textarea id="feedback" name="description" rows="4" cols="40">


            </textarea>

</fieldset>
 <br>

            <div id="custom1">

            <input type=submit>
            <input type=reset>
             </div>

        </form>

    <br>
        <?php      include 'footer.php'; ?>

        </main>
</div>
</body>
</html>
