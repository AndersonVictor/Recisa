@extends('layouts.app')
@section('title','Editar Usuario')
    @push('css')
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">
        <!--JQuery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>          
    @endpush

    @section('content')
        <div class="d-sm-flex justify-content-between align-items-center mb-4">
            <h3 class="text-dark mb-0">Editar al Usuario - {{$user->username}}</h3>
        </div>        
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 fw-bold">Formulario del Usuario</p>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label for="nombre" class="form-label">Nombre:</label>
                                    <input readonly class="form-control" type="text" name="name" id="name" value="{{old('name',$user->name)}}">
                                    @error('name')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Usuario:</label>
                                    <input class="form-control" type="text" name="username" id="username" value="{{old('username',$user->username)}}">
                                    @error('username')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Email:</label>
                                    <input class="form-control" type="text" name="email" id="email" value="{{old('email',$user->email)}}">
                                    @error('email')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="role" class="form-label">Rol:</label>
                                    <select title="Seleccione el rol..." name="user_level" id="user_level" data-style="btn-secondary" data-size="2" class="form-control selectpicker show-tick">
                                        @foreach ($rol as $item)
                                            @if ($user->user_level == $item->group_level)
                                                <option selected value="{{$item->group_level}}" {{old('user_level') == $item->group_level ? 'selected':''}}>Admin</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('user_level')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Contraseña:</label>
                                    <input class="form-control" type="text" name="password" id="password" value="">
                                    @error('password')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="nombre" class="form-label">Confirmar Contraseña:</label>
                                    <input class="form-control" type="text" name="password_confirm" id="password_confirm" value="">
                                    @error('password_confirm')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="image" class="form-label">Imagen:</label>
                                    <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                    @error('image')
                                        <small class="text-danger">{{'*'.$message}}</small>
                                    @enderror
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">Actualizar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    @endsection
    @push('js')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    @endpush