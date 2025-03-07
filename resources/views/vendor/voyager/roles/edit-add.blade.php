@extends('voyager::master')

@section('page_title', __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular'))

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager::generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->getTranslatedAttribute('display_name_singular') }}
    </h1>
@stop

@section('content')
    <div class="page-content container-fluid">
        @include('voyager::alerts')
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form class="form-edit-add" role="form"
                          action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                          method="POST" enctype="multipart/form-data">

                        <!-- PUT Method if we are editing -->
                        @if(isset($dataTypeContent->id))
                        {{ method_field("PUT") }}
                        <input type="hidden" name="role_id" value="{{ $dataTypeContent->id }}">
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @foreach($dataType->addRows as $row)
                                <div class="form-group">
                                    <label for="name">{{ $row->getTranslatedAttribute('display_name') }}</label>

                                    {!! Voyager::formField($row, $dataType, $dataTypeContent) !!}

                                </div>
                            @endforeach

                            <label for="permission">{{ __('voyager::generic.permissions') }}</label><br>
                            <a href="#" class="permission-select-all">{{ __('voyager::generic.select_all') }}</a> / <a href="#"  class="permission-deselect-all">{{ __('voyager::generic.deselect_all') }}</a>
                            <ul class="permissions checkbox">
                                <?php
                                    $role_permissions = (isset($dataTypeContent)) ? $dataTypeContent->permissions->pluck('key')->toArray() : [];
                                ?>
                                @foreach(Voyager::model('Permission')->all()->groupBy('table_name') as $table => $permission)
                                    <li>
                                    <?php
                                   $admin=false;
                                    $a=DB::select("SELECT dt.display_name_plural FROM data_types dt WHERE name='$table'");
                                    $nombre_tabla=ucfirst($table);
                                    foreach($a as $obj){
                                        if($obj->display_name_plural){
                                        $nombre_tabla=ucfirst($obj->display_name_plural);
                                        }
                                    }
                                    
                                   
                                    ?>
                                        <input type="checkbox" id="{{$table}}" class="permission-group">
                                        <label for="{{$table}}"><strong>{{$nombre_tabla}}</strong></label>
                                        <ul>
                                            @foreach($permission as $perm)
                                            <?php
                                           
                                            if(!$nombre_tabla) {$nombre_tabla='Admin'; $admin=true;}
                                            $checked='';
                                            if($admin){
                                                $ti=explode('_',$perm->key)[1];
                                                if($ti=='admin') {$ti.=' (Obligatorio para acceder al panel admin)';
                                                    $checked='checked';
                                                }
                                                $nombre_tabla=$ti;
                                                
                                            }
                                            $permiso=explode('_',$perm->key);
                                            $tipo_permiso='';
                                            switch($permiso[0]){
                                                case 'browse':
                                                    $tipo_permiso='Ver';
                                                break;
                                                case 'read':
                                                    $tipo_permiso='Consultar';
                                                break;
                                                case 'add':
                                                    $tipo_permiso='Agregar';
                                                break;
                                                case 'edit':
                                                    $tipo_permiso='Editar';
                                                break;
                                                case 'delete':
                                                    $tipo_permiso='Eliminar';
                                                break;
                                        
                                            }
                                            $permiso=$tipo_permiso.' '.($nombre_tabla ?? $perm->key);
                                            ?>
                                                <li>
                                                    <input type="checkbox" id="permission-{{$perm->id}}" name="permissions[]" class="the-permission" <?php echo $checked; ?> value="{{$perm->id}}" @if(in_array($perm->key, $role_permissions)) checked @endif>
                                                    <label for="permission-{{$perm->id}}">{{$permiso}}</label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div><!-- panel-body -->
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary">{{ __('voyager::generic.submit') }}</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                          enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        {{ csrf_field() }}
                        <input name="image" id="upload_file" type="file"
                               onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                    </form>

                </div>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            $('.permission-group').on('change', function(){
                $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
            });

            $('.permission-select-all').on('click', function(){
                $('ul.permissions').find("input[type='checkbox']").prop('checked', true);
                return false;
            });

            $('.permission-deselect-all').on('click', function(){
                $('ul.permissions').find("input[type='checkbox']").prop('checked', false);
                return false;
            });

            function parentChecked(){
                $('.permission-group').each(function(){
                    var allChecked = true;
                    $(this).siblings('ul').find("input[type='checkbox']").each(function(){
                        if(!this.checked) allChecked = false;
                    });
                    $(this).prop('checked', allChecked);
                });
            }

            parentChecked();

            $('.the-permission').on('change', function(){
                parentChecked();
            });
        });
    </script>
@stop
