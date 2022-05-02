<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>JUMIA's Exercise</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="/inc/css/screen.css">

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body class="bg-light">

<div class="container">

    <div>
        <img class="float-left" src="" alt="JUMIA" width="100px;">
        <h2 class="text-left">Phone numbers</h2>
        <hr class="mb-4">
    </div>

    <div class="row">
        <form class="needs-validation" id="customer-form">
            <div class="row">
                <div class="col-md-4">
                    <label for="country">Country</label>
                    <select class="form-control" name="country" id="country">
                        <option value="all">Show All</option>
                        <option value="Cameroon">Cameroon</option>
                        <option value="Ethiopia">Ethiopia</option>
                        <option value="Morocco">Morocco</option>
                        <option value="Mozambique">Mozambique</option>
                        <option value="Uganda">Uganda</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="country">Phone State</label>
                    <select class="form-control" name="phonestate" id="phonestate">
                        <option value="all">All phone numbers</option>
                        <option value="valid">Valid phone numbers</option>
                        <option value="invalid">Invalid phone numbers</option>
                    </select>
                </div>
                <div id="resetbutton" class="col-md-2" style="padding-top: 2%;">
                    <button type="button" class="btn btn-primary">Reset</button>
                </div>
            </div>
        </form>


        <div class="row" style="margin-top: 5%;">
            <table class="table table-hover" id="phone-table">
                <thead class="thead-dark">
                <tr>
                    <th>Country</th>
                    <th>State</th>
                    <th>Country code</th>
                    <th>Phone num.</th>
                </tr>
                </thead>
                <tbody>
               <?php
/*                foreach( $result as $row ) {

                    // Tests the validation
                    if( $row['country_phonevalidation'] != '' ) {
                        preg_match( '/'.$row['country_phonevalidation'].'/', $row['phone'], $output_array );
                        $validation = ( isSet( $output_array[0] ) ) ? 'OK' : 'NOK';
                    }

                    $link   = '<a href="tel:+'.$row['phone'].'" data-toggle="tooltip" title="Dial">';

                    echo '<tr>';
                    echo '  <td>'.$row['country_name'].'</td>';
                    echo '  <td>'.$validation.'</td>';
                    echo '  <td>+'.$row['country_code'].'</td>';
                    echo '  <td>'.$link.trim( substr( $row['phone'], 5, -1 ) ).'</a></td>';
                    echo '</tr>';
                }
                */?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>

</html>