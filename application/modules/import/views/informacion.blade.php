@layout('layout')
@section('contenido')
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Importar productos</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Album</th>
                                    <th>Album Id</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($informacion as $key => $value)
                                    <tr>
                                        <td>{{ $value->id }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->album }}</td>
                                        <td>{{ $value->album_id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('included_js')
@endsection
