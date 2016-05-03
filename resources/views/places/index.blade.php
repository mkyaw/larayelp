<!DOCTYPE html>
<html>
    <head>
        <title>LaraYelp</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    </head>
    <body class="container">
        <div class="text-center">
            <h1>Welcome to <i class="fa fa-code"></i> LaraYelp <i class="fa fa-yelp"></i></h1>
        </div>
        
        <form class="text-center" method="POST" action="/">
          <fieldset class="form-group">
            <label for="cuisine">Select Cuisine</label>
            <select class="form-control" id="cuisine" name="cuisine">
              <option value="American">American</option>
              <option value="Indian">Indian</option>
              <option value="Chinese">Chinese</option>
              <option value="Mexican">Mexican</option>
              <option value="Vietnamese">Vietnamese</option>
            </select>
          </fieldset>
          <fieldset class="form-group">
            <label for="zip">Zip</label>
            <input type="text" name="zip" class="form-control" id="zip" placeholder="90034">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <small class="text-muted">We cannot guarantee you will like the places here but people seem to like them <strong>a lot</strong>.</small>
          </fieldset>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
        @foreach($inputs as $k => $v)
            Top 5 {{ $k }} places near {{ $v }} are:
        @endforeach
        
        <ul style="list-style: none;">
        @foreach($places as $k => $v)
            <li class="jumbotron">
            @foreach($v as $a => $b)
              @if($a == 'rating_img_url')
                <img src={{$b}} alt="">
              @endif
              @if($a == 'review_count')
                {{$b}} REVIEWS
              @endif
              @if($a == 'name')
                <strong>{{$b}}</strong>
              @endif
              @if($a == 'image_url')
                <img src={{$b}} alt="">
              @endif
            @endforeach
            </li>
        @endforeach
        </ul>
        
        
    </body>
</html>
