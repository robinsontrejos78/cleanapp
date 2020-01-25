@if($empresas == 0)

	<div class="alert alert-warning alert-dismissible msg" role="alert"><button type="button" class="close" data-dismiss="alert" margin-top: 20px;><span>&times;</span></button><span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span> No existe ninguna empresa asociada a este documento</div>
	
@else
		<select class="form-control" name="empresa">
			@foreach($empresas as $empresa)
	 			<option value="{{$empresa->EMP_IDEMPRESA}}">{{$empresa->EMP_NOMBRE}}</option>
			@endforeach
  		</select>

  	    <div class="row" style="margin-top:20px">
  	        <div class="col-xs-12">
  	            <button type="submit" class="btn btn-danger btn-block btn-flat">{{ trans('adminlte_lang::message.buttonsign') }}</button>
  	        </div>
  	    </div>
  	    
@endif