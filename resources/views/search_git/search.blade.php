<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<src="https: //cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">

<div class='container' id="container">
    <form>
        <div style="text-align: center; margin-top: 20px;">
            <input type="text" class="form-control" placeholder="Введите текст"
                style="display: inline-block;  width: 50%;" id="search_text" name="search_text"
                value="{{ $query }}">
            <button class="btn btn-primary" style="vertical-align: inherit;" id="SendText">Поиск</button>
        </div>
    </form>

    <div class="row" style="row-gap: 10px;">
        @if ($result)
            @foreach ($result as $val)
                <div class="col-sm-3">
                    <div class="card h-100">
                        <div class="card-body" style="position: relative; z-index: 0;">
                            <a href="{{ $val->html_url }}"> </a>
                            <p class="card-title">{{ $val->name }}</p>
                            <p class="card-text">{{ $val->author }}</p>
                            <p class="info-text">Кол-во звезд: {{ $val->stargazers }}</p>
                            <p class="info-text">Просмотры: {{ $val->watchers }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>


<style>
    .card-title {
        font-size: 1.25rem;
    }

    .info-text {
        margin: 0;
        font-size: 10px;
    }

    a::before {
        position: absolute;
        content: '';
        inset: 0;
        z-index: -1;
    }

    .container {
        padding-bottom: 20px;
    }
</style>
