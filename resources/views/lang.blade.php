<!DOCTYPE html>
<html>

<head>
    <title>Document</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <div class="container">

        <h1>How to Create Multi Language Website in Laravel</h1>

        <div class="row">
            <div class="col-md-2 col-md-6 text-right">
                <strong>Select Language: </strong>
            </div>
            <div class="col-md-4">
                <select class="form-control" id="changeLang">
                    <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                    <option value="fr" {{ session()->get('locale') == 'fr' ? 'selected' : '' }}>France</option>

                    <option value="sp" {{ session()->get('locale') == 'sp' ? 'selected' : '' }}>Spanish</option>
                </select>
            </div>
        </div>

        <h1>{{ __('messages.title', ['name' => 'Ami']) }}</h1>
        <p>{{__('messages.paragraph', ['name' => 'Ami'])}}</p>

    </div>
</body>

<script type="text/javascript">
    var url = "{{ route('changeLang') }}";
    $("#changeLang").change(function() {
        $.post(url, {
            lang: $(this).val(),
            _token: "{{ csrf_token() }}"
        }).done(function() {
            location.reload();
        });
    });
</script>

</html>