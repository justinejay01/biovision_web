<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Application Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=radio],
        input.radio {
            float: left;
            clear: none;
            margin: 2px 0 0 2px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        #job_title {
            text-align: center;
        }

        .container {
            display: grid;
            grid-template-columns: auto auto;
            gap: 10px;
        }

        label.checkbox {
            display: block;
            margin-bottom: 8px;
        }
    </style>
</head>

<body>

    <form action="db.php" method="post">
        <div id="job_title">
            <h2>Job Application Form</h2>
        </div>

        <!-- Personal Information -->
        <label for="name">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>

        <label for="name">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="phone">Address:</label>
        <input type="text" id="address" name="address" required>

        <!-- Job Information -->
        <label for="position">Position Applied For:</label>
        <input type="text" id="position" name="position" required>

        <label for="exp_years">Years of Experience:</label>
        <input type="number" id="exp_years" name="exp_years" required>

        <label for="educ_level">Highest Education Level:</label>
        <select id="educ_level" name="educ_level">
            <option value="high_school">High School</option>
            <option value="college">College</option>
            <option value="bachelor">Bachelor's Degree</option>
            <option value="master">Master's Degree</option>
            <option value="doctorate">Doctorate</option>
        </select>

        <!-- Availability -->
        <div class="container">
            <div class="row">
                <label>Availability:</label>
                <input type="radio" id="full_time" name="availability" value="full_time" checked>
                <label for="full_time">Full Time</label>

                <input type="radio" id="part_time" name="availability" value="part_time">
                <label for="part_time">Part Time</label>
            </div>
            <div class="row">
                <label class="checkbox">Skills:</label>
                <input type="checkbox" id="html" name="skills[]" value="HTML">
                <label for="html">HTML</label>

                <input type="checkbox" id="css" name="skills[]" value="CSS">
                <label for="css">CSS</label>

                <input type="checkbox" id="javascript" name="skills[]" value="JavaScript">
                <label for="javascript">JavaScript</label>

                <input type="checkbox" id="python" name="skills[]" value="Python">
                <label for="python">Python</label>
            </div>
        </div>

        <!-- Submit Button -->
        <input type="submit" value="Submit Application">
    </form>

</body>

</html>