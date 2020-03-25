<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Saver</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    </head>
  <body>
    <div class="container">
        <h1>Saver app</h1>
        <p>See how much you will save on a sale item</p>
        <div class="col-5">
            <form>
                <div class="form-group">
                    <label>Item Cost:</label>
                    <input type="text" class="form-control" name="item_cost">
                </div>
                <div class="form-group">
                    <label> Sale Precent Off:</label>
                    <input type="number" class="form-control" name="percent_off">
                </div>
                <div class="form-group">
                    <label> State Tax?</label>
                    <input type="checkbox" name="state_tax">
                </div>
                <button type="button" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
  </body>
</html>
