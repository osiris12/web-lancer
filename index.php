<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Google Maps Lead Generator</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        .container{
            margin-top: 50px;
        }
        #page-header-text{
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div id="page-header-text">
            <h1>Enter Name of Neighborhood or Zipcode</h1><br/>
        </div>
        <form method="POST" action="scraper.php">
            <div class="form-group row">
                <label for="neighborhood" class="col-sm-2 col-form-label">Neighborhood or Zipcode</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="neighborhood" name="neighborhood">
                </div>
            </div>
            <div class="form-group row">
                <label for="keywords" class="col-sm-2 col-form-label">Keywords</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="keywords" id="keywords" placeholder="bars, restaurants, hotels, etc...">
                </div>
            </div>
            <div class="form-group row">
                <label for="website" class="col-sm-2 col-form-label">No Website</label>
                <div class="col-sm-10">
                    <input type="checkbox" name="website" id="website" style="height: 20px; width: 20px;">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Create Report</button>
                </div>
            </div>
        </form>
    </div>

    
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>